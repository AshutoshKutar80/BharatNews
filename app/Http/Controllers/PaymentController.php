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
    private $returnUrl;

    public function __construct()
    {
        $this->appId = config('services.cashfree.app_id');
        $this->secretKey = config('services.cashfree.secret_key');
        $this->baseUrl = config('services.cashfree.env') === 'production'
            ? 'https://api.cashfree.com/pg'
            : 'https://sandbox.cashfree.com/pg';
        $this->returnUrl = route('payment.return');

        Log::info('Payment controller initialized', [
            'app_id' => $this->appId,
            'environment' => config('services.cashfree.env'),
            'base_url' => $this->baseUrl
        ]);
    }

    public function initiate(Request $request)
    {
        try {
            Log::info('Payment initiation started', [
                'request_data' => $request->all(),
                'user_agent' => $request->userAgent(),
                'ip' => $request->ip()
            ]);

            if (!Auth::check()) {
                Log::warning('User not logged in');
                return response()->json([
                    'success' => false,
                    'message' => 'Please login first to make payment',
                    'redirect' => route('login')
                ], 401);
            }

            $user = Auth::user();
            Log::info('User authenticated', [
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->name
            ]);

            $productType = $request->product_type;
            Log::info('Product type received', ['product_type' => $productType]);

            if (empty($productType)) {
                Log::error('Product type is empty');
                return response()->json([
                    'success' => false,
                    'message' => 'Product type is required'
                ], 400);
            }

            $productDetails = Payment::getProductDetails($productType);

            Log::info('Product details retrieved', [
                'product_type' => $productType,
                'product_details' => $productDetails
            ]);

            if (!$productDetails || !isset($productDetails['amount'])) {
                Log::error('Product details not found or amount missing', [
                    'product_type' => $productType,
                    'product_details' => $productDetails
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid product type or product details missing'
                ], 400);
            }

            $amount = $productDetails['amount'];
            $productName = $productDetails['name'] ?? ucwords(str_replace('_', ' ', $productType));

            Log::info('Product details extracted', [
                'amount' => $amount,
                'product_name' => $productName
            ]);

            $txnRef = 'TX_' . time() . '_' . Str::random(8);
            $sessionId = session()->getId();

            Log::info('Creating temp payment', [
                'txn_ref' => $txnRef,
                'amount' => $amount,
                'user_id' => $user->id
            ]);

            // Temp payment holds everything while it is still pending/failed.
            // Nothing is written to the main payments table at this stage.
            $tempPayment = TempPayment::create([
                'user_id' => $user->id,
                'session_id' => $sessionId,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'product_type' => $productType,
                'amount' => $amount,
                'txn_ref' => $txnRef,
                'status' => TempPayment::STATUS_INITIATED ?? 'initiated',
                'payment_data' => [
                    'product_name' => $productName,
                    'user_agent' => $request->userAgent(),
                    'ip_address' => $request->ip()
                ],
                'expires_at' => now()->addMinutes(30)
            ]);

            Log::info('Temp payment created', ['temp_payment_id' => $tempPayment->id]);

            $orderData = [
                'order_id' => $txnRef,
                'order_amount' => $amount,
                'order_currency' => 'INR',
                'order_note' => $productName,
                'customer_details' => [
                    'customer_id' => (string) $user->id,
                    'customer_name' => $user->name,
                    'customer_email' => $user->email,
                    'customer_phone' => $user->phone ?? '9999999999'
                ],
                'order_meta' => [
                    'return_url' => $this->returnUrl . '?order_id=' . $txnRef
                ]
            ];

            Log::info('Sending request to Cashfree', [
                'url' => $this->baseUrl . '/orders',
                'order_data' => $orderData
            ]);

            $response = Http::withHeaders([
                'x-api-version' => '2022-09-01',
                'x-client-id' => $this->appId,
                'x-client-secret' => $this->secretKey,
                'Content-Type' => 'application/json'
            ])->post($this->baseUrl . '/orders', $orderData);

            $responseData = $response->json();
            $statusCode = $response->status();

            Log::info('Cashfree response received', [
                'status_code' => $statusCode,
                'response' => $responseData
            ]);

            if ($response->failed()) {
                Log::error('Cashfree order creation failed', [
                    'response' => $responseData,
                    'status_code' => $statusCode,
                    'user_id' => $user->id
                ]);

                // Failed at the gateway level -> stays in temp_payments as 'failed'.
                $tempPayment->status = TempPayment::STATUS_FAILED;
                $tempPayment->raw_response = ['error' => $responseData];
                $tempPayment->save();

                $errorMessage = $responseData['message'] ?? 'Payment initialization failed. Please try again.';

                return response()->json([
                    'success' => false,
                    'message' => $errorMessage,
                    'debug' => $responseData
                ], 500);
            }

            // Order created successfully at gateway - still "pending" until actually paid.
            $tempPayment->order_id = $responseData['order_id'] ?? null;
            $tempPayment->payment_session_id = $responseData['payment_session_id'] ?? null;
            $tempPayment->status = 'pending';
            $tempPayment->raw_response = $responseData;
            $tempPayment->save();

            Log::info('Temp payment updated', [
                'temp_payment_id' => $tempPayment->id,
                'order_id' => $responseData['order_id'] ?? null
            ]);

            // NOTE: main `payments` table record is intentionally NOT created here.
            // It is only created once the payment is confirmed successful
            // (see markSuccess(), called from verifyPayment()/webhook()).

            return response()->json([
                'success' => true,
                'payment_session_id' => $responseData['payment_session_id'],
                'order_id' => $txnRef,
                'amount' => $amount,
                'product_name' => $productName,
                'temp_payment_id' => $tempPayment->id
            ]);
        } catch (\Exception $e) {
            Log::error('Payment initiation error', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again.',
                'debug' => $e->getMessage()
            ], 500);
        }
    }

    public function handleReturn(Request $request)
    {
        $orderId = $request->order_id;

        $tempPayment = TempPayment::where('txn_ref', $orderId)->first();

        if ($tempPayment) {
            // This may delete the temp row internally if the gateway confirms success.
            $this->verifyPayment($tempPayment);
            $tempPayment = TempPayment::where('txn_ref', $orderId)->first();
        }

        $payment = Payment::where('txn_ref', $orderId)->first();

        if ($payment) {
            // payments table only ever holds successful transactions
            return redirect()->route('payment.success', ['order_id' => $orderId]);
        }

        if ($tempPayment) {
            // still here => pending or failed
            return redirect()->route('payment.failed', ['order_id' => $orderId]);
        }

        return redirect()->route('services')->with('error', 'Payment not found');
    }

    /**
     * Checks the live status with Cashfree and routes the record to the
     * correct table:
     *  - SUCCESS/PAID  -> payments table (+ purchased_products), temp row deleted
     *  - FAILED/CANCELLED -> temp_payments table, status updated to failed
     *  - anything else -> left as-is (still pending) in temp_payments
     */
    public function verifyPayment($tempPayment)
    {
        try {
            $response = Http::withHeaders([
                'x-api-version' => '2022-09-01',
                'x-client-id' => $this->appId,
                'x-client-secret' => $this->secretKey,
                'Content-Type' => 'application/json'
            ])->get($this->baseUrl . '/orders/' . $tempPayment->order_id . '/payments');

            if ($response->successful()) {
                $payments = $response->json();
                if (!empty($payments)) {
                    $latestPayment = $payments[0] ?? null;
                    if ($latestPayment && isset($latestPayment['payment_status'])) {
                        $status = strtoupper($latestPayment['payment_status']);

                        if ($status === 'SUCCESS' || $status === 'PAID') {
                            $this->markSuccess($tempPayment, $latestPayment);
                        } else if ($status === 'FAILED' || $status === 'CANCELLED') {
                            $this->markFailed($tempPayment, $latestPayment);
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Payment verification error', [
                'error' => $e->getMessage(),
                'temp_payment_id' => $tempPayment->id
            ]);
        }
    }

    /**
     * Public entry point used by the admin panel to manually push a
     * pending/initiated temp payment into the permanent success tables,
     * without needing a fresh gateway callback. Reuses the exact same
     * logic as a normal successful webhook so payments + purchased_products
     * stay perfectly consistent regardless of how success was triggered.
     */
    public function adminApprove(TempPayment $tempPayment)
    {
        $this->markSuccess($tempPayment, $tempPayment->raw_response ?? ['manual_admin_approval' => true]);
    }

    /**
     * Moves a temp payment into the permanent tables on success:
     *  - creates the Payment row (status = success)
     *  - creates the PurchasedProduct row (user_id + payment_status)
     *  - deletes the temp_payments row
     */
    public function markSuccess($tempPayment, $gatewayResponse = [])
    {
        // Guard against duplicate processing if both the return URL and the
        // webhook fire for the same order.
        $existingPayment = Payment::where('txn_ref', $tempPayment->txn_ref)->first();

        if (!$existingPayment) {
            $payment = Payment::create([
                'user_id' => $tempPayment->user_id,
                'user_name' => $tempPayment->user_name,
                'user_email' => $tempPayment->user_email,
                'product_type' => $tempPayment->product_type,
                'amount' => $tempPayment->amount,
                'txn_ref' => $tempPayment->txn_ref,
                'order_id' => $tempPayment->order_id,
                'payment_session_id' => $tempPayment->payment_session_id,
                'status' => 'success',
                'paid_at' => now(),
                'raw_response' => array_merge($tempPayment->raw_response ?? [], ['verify_response' => $gatewayResponse])
            ]);

            Log::info('Payment marked success', [
                'payment_id' => $payment->id,
                'txn_ref' => $tempPayment->txn_ref
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

            Log::info('Purchased product record created', [
                'user_id' => $tempPayment->user_id,
                'product_type' => $tempPayment->product_type
            ]);
        } else {
            Log::info('Payment already recorded, skipping duplicate create', [
                'txn_ref' => $tempPayment->txn_ref
            ]);
        }

        $tempPaymentId = $tempPayment->id;
        $tempPayment->delete();

        Log::info('Temp payment deleted after success', ['temp_payment_id' => $tempPaymentId]);
    }

    public function markFailed($tempPayment, $gatewayResponse = [])
    {
        $tempPayment->status = TempPayment::STATUS_FAILED;
        $tempPayment->raw_response = array_merge($tempPayment->raw_response ?? [], ['verify_response' => $gatewayResponse]);
        $tempPayment->save();

        Log::info('Temp payment marked failed', ['temp_payment_id' => $tempPayment->id]);
    }

    public function checkStatus(Request $request)
    {
        $orderId = $request->order_id;
        $tempPayment = TempPayment::where('txn_ref', $orderId)->first();

        if ($tempPayment && in_array($tempPayment->status, ['initiated', 'pending', 'processing'])) {
            $this->verifyPayment($tempPayment);
            // Re-fetch: verifyPayment() may have deleted this row on success.
            $tempPayment = TempPayment::where('txn_ref', $orderId)->first();
        }

        $payment = Payment::where('txn_ref', $orderId)->first();

        if ($payment) {
            return response()->json([
                'status' => $payment->status,
                'payment' => $payment
            ]);
        }

        if ($tempPayment) {
            return response()->json([
                'status' => $tempPayment->status,
                'temp_payment' => $tempPayment
            ]);
        }

        return response()->json(['status' => 'not_found']);
    }

    public function success(Request $request)
    {
        $orderId = $request->order_id;
        $payment = Payment::where('txn_ref', $orderId)->where('status', 'success')->first();

        if (!$payment) {
            return redirect()->route('services')->with('error', 'Payment not found');
        }

        return view('payment.success', compact('payment'));
    }

    public function failed(Request $request)
    {
        $orderId = $request->order_id;
        $tempPayment = TempPayment::where('txn_ref', $orderId)->first();

        if (!$tempPayment) {
            return redirect()->route('services')->with('error', 'Payment not found');
        }

        return view('payment.failed', compact('tempPayment'));
    }

    public function webhook(Request $request)
    {
        try {
            $payload = $request->all();
            Log::info('Payment webhook received', ['payload' => $payload]);

            $orderId = $payload['order_id'] ?? null;
            if (!$orderId) {
                return response()->json(['status' => 'error'], 400);
            }

            $tempPayment = TempPayment::where('order_id', $orderId)->first();
            if (!$tempPayment) {
                // Already moved to payments (success) by handleReturn(), or unknown order.
                Log::info('Webhook: no temp payment found (already processed or unknown)', [
                    'order_id' => $orderId
                ]);
                return response()->json(['status' => 'already_processed']);
            }

            $status = strtoupper($payload['order_status'] ?? '');

            if ($status === 'PAID' || $status === 'SUCCESS') {
                $this->markSuccess($tempPayment, $payload);
            } else if ($status === 'FAILED' || $status === 'CANCELLED') {
                $this->markFailed($tempPayment, $payload);
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Webhook error', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'error'], 500);
        }
    }
}
