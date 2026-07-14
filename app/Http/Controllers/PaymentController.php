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
            'x-api-version' => '2025-01-01',
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
            $tempPayment->update([
                'status' => 'failed',
                'raw_response' => $data,
            ]);
            return response()->json([
                'success' => false,
                'message' => $data['message'] ?? 'Payment failed to start',
            ], 500);
        }

        $tempPayment->update([
            'order_id' => $data['order_id'] ?? $txnRef,
            'raw_response' => $data,
        ]);

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

        $gateway = $this->getGatewayStatus($tempPayment->order_id);

        if ($gateway && $gateway['status'] === 'PAID') {
            $this->markSuccess($tempPayment, $gateway['raw']);
            return redirect()->route('payment.success', ['order_id' => $orderId]);
        }

        if ($gateway && $gateway['status'] === 'FAILED') {
            $tempPayment->update([
                'status' => 'failed',
                'raw_response' => $gateway['raw'],
            ]);
        } elseif ($gateway) {
            $tempPayment->update([
                'raw_response' => $gateway['raw'],
            ]);
        }

        return redirect()->route('payment.failed', ['order_id' => $orderId]);
    }

    private function getGatewayStatus($orderId)
    {
        $response = Http::withHeaders([
            'x-api-version' => '2025-01-01',
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

        $rawStatus = strtoupper($latest['payment_status']);

        if (in_array($rawStatus, ['SUCCESS', 'PAID'])) {
            $status = 'PAID';
        } elseif (in_array($rawStatus, ['FAILED', 'CANCELLED'])) {
            $status = 'FAILED';
        } else {
            $status = 'PENDING';
        }

        return ['status' => $status, 'raw' => $latest];
    }

    private function markSuccess($tempPayment, $gatewayResponse = null)
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
                'raw_response' => $gatewayResponse,
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
        $gateway = $this->getGatewayStatus($tempPayment->order_id);

        if (!$gateway || $gateway['status'] !== 'PAID') {
            if ($gateway) {
                $tempPayment->update(['raw_response' => $gateway['raw']]);
            }

            return [
                'success' => false,
                'message' => "Gateway Status not Confirmed, Not Approved.",
            ];
        }

        $this->markSuccess($tempPayment, $gateway['raw']);

        return [
            'success' => true,
            'message' => 'Gateway Status Confirmed, Payment approved.',
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
