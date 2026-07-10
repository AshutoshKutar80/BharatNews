<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\TempPayment;
use App\Models\PurchasedProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    private $appId;
    private $secretKey;
    private $baseUrl;

    public function __construct()
    {
        $this->appId = config('services.cashfree.app_id');
        $this->secretKey = config('services.cashfree.secret_key');
        $this->baseUrl = config('services.cashfree.env') === 'production'
            ? 'https://api.cashfree.com/pg'
            : 'https://sandbox.cashfree.com/pg';
    }

    // ============================================
    // STEP 1: User payment start karta hai
    // ============================================
    public function initiate(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Please login first'], 401);
        }

        $user = Auth::user();
        $productType = $request->product_type;

        $productDetails = Payment::getProductDetails($productType);

        if (!$productDetails || !isset($productDetails['amount'])) {
            return response()->json(['success' => false, 'message' => 'Invalid product type'], 400);
        }

        $amount = $productDetails['amount'];
        $productName = $productDetails['name'] ?? ucwords(str_replace('_', ' ', $productType));
        $txnRef = 'TX_' . time() . '_' . Str::random(8);

        // Pehle temp_payments mein "pending" entry bana do
        $tempPayment = TempPayment::create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'product_type' => $productType,
            'amount' => $amount,
            'txn_ref' => $txnRef,
            'status' => 'pending',
        ]);

        // Cashfree ko order banane ke liye bolo
        $response = Http::withHeaders([
            'x-api-version' => '2022-09-01',
            'x-client-id' => $this->appId,
            'x-client-secret' => $this->secretKey,
        ])->post($this->baseUrl . '/orders', [
            'order_id' => $txnRef,
            'order_amount' => $amount,
            'order_currency' => 'INR',
            'order_note' => $productName,
            'customer_details' => [
                'customer_id' => (string) $user->id,
                'customer_name' => $user->name,
                'customer_email' => $user->email,
                'customer_phone' => $user->mobile ?? '9999999999',
            ],
            'order_meta' => [
                'return_url' => route('payment.callback') . '?order_id=' . $txnRef,
            ],
        ]);

        $data = $response->json();

        if ($response->failed()) {
            $tempPayment->update(['status' => 'failed']);
            return response()->json([
                'success' => false,
                'message' => $data['message'] ?? 'Payment failed to start',
            ], 500);
        }

        $tempPayment->update(['order_id' => $data['order_id'] ?? $txnRef]);

        return response()->json([
            'success' => true,
            'payment_session_id' => $data['payment_session_id'],
            'order_id' => $txnRef,
            'amount' => $amount,
            'product_name' => $productName,
        ]);
    }

    public function callback(Request $request)
    {
        $orderId = $request->order_id;

        $tempPayment = TempPayment::where('txn_ref', $orderId)->first();

        if (!$tempPayment) {
            $payment = Payment::where('txn_ref', $orderId)->first();
            return $payment
                ? redirect()->route('payment.success', ['order_id' => $orderId])
                : redirect()->route('services')->with('error', 'Payment not found');
        }

        // Cashfree se asli status poocho (kabhi bhi sirf redirect par bharosa mat karo)
        $status = $this->getGatewayStatus($tempPayment->order_id);

        if ($status === 'PAID') {
            $this->markSuccess($tempPayment);
            return redirect()->route('payment.success', ['order_id' => $orderId]);
        }

        if ($status === 'FAILED') {
            $tempPayment->update(['status' => 'failed']);
        }

        // Abhi bhi pending ho sakta hai
        return redirect()->route('payment.failed', ['order_id' => $orderId]);
    }

    private function getGatewayStatus($orderId)
    {
        $response = Http::withHeaders([
            'x-api-version' => '2022-09-01',
            'x-client-id' => $this->appId,
            'x-client-secret' => $this->secretKey,
        ])->get($this->baseUrl . '/orders/' . $orderId . '/payments');

        if (!$response->successful()) {
            return null;
        }

        $payments = $response->json();
        $latest = $payments[0] ?? null;

        if (!$latest || !isset($latest['payment_status'])) {
            return null;
        }

        $status = strtoupper($latest['payment_status']);

        if (in_array($status, ['SUCCESS', 'PAID'])) {
            return 'PAID';
        }

        if (in_array($status, ['FAILED', 'CANCELLED'])) {
            return 'FAILED';
        }

        return 'PENDING';
    }

    // ============================================
    // Helper 2: Payment ko success mark karna
    // (permanent record banata hai, temp wala delete karta hai)
    // ============================================
    private function markSuccess($tempPayment)
    {
        $alreadyExists = Payment::where('txn_ref', $tempPayment->txn_ref)->exists();

        if (!$alreadyExists) {
            Payment::create([
                'user_id' => $tempPayment->user_id,
                'user_name' => $tempPayment->user_name,
                'user_email' => $tempPayment->user_email,
                'product_type' => $tempPayment->product_type,
                'amount' => $tempPayment->amount,
                'txn_ref' => $tempPayment->txn_ref,
                'order_id' => $tempPayment->order_id,
                'status' => 'success',
                'paid_at' => now(),
            ]);

            $productDetails = Payment::getProductDetails($tempPayment->product_type);

            PurchasedProduct::create([
                'user_id' => $tempPayment->user_id,
                'product_type' => $tempPayment->product_type,
                'product_name' => $productDetails['name'] ?? ucwords(str_replace('_', ' ', $tempPayment->product_type)),
                'amount' => $tempPayment->amount,
                'txn_ref' => $tempPayment->txn_ref,
                'order_id' => $tempPayment->order_id,
                'payment_status' => 'success',
                'purchased_at' => now(),
            ]);
        }

        $tempPayment->delete();
    }

    public function adminApprove(TempPayment $tempPayment)
    {
        $status = $this->getGatewayStatus($tempPayment->order_id);

        if ($status !== 'PAID') {
            return [
                'success' => false,
                'message' => "Gateway not confirm  (status: " . ($status ?? 'unknown') . "). Not Approved .",
            ];
        }

        $this->markSuccess($tempPayment);

        return [
            'success' => true,
            'message' => 'Gateway Confirm, Payment Approve.',
        ];
    }

    // ============================================
    // Simple pages
    // ============================================
    public function success(Request $request)
    {
        $payment = Payment::where('txn_ref', $request->order_id)->where('status', 'success')->first();

        if (!$payment) {
            return redirect()->route('services')->with('error', 'Payment not found');
        }

        return view('payment.success', compact('payment'));
    }

    public function failed(Request $request)
    {
        $tempPayment = TempPayment::where('txn_ref', $request->order_id)->first();

        if (!$tempPayment) {
            return redirect()->route('services')->with('error', 'Payment not found');
        }

        return view('payment.failed', compact('tempPayment'));
    }
}
