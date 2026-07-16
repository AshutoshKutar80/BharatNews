<?php
// app/Http/Controllers/PaymentController.php

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

    public function checkAuth()
    {
        return response()->json([
            'authenticated' => Auth::check(),
            'login_url' => route('login')
        ]);
    }

    public function getUpgradeInfo(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Please login first'], 401);
        }

        $productType = $request->product_type;
        $user = Auth::user();

        // Log the request for debugging
        Log::info('getUpgradeInfo called', [
            'product_type' => $productType,
            'user_id' => $user->id
        ]);

        // Get product details with GST
        $productDetails = Payment::getProductWithGST($productType);

        if (!$productDetails) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid product: ' . $productType,
                'available_products' => Payment::getAvailableProducts()
            ], 400);
        }

        // Check if user already owns this product (not upgraded)
        $alreadyOwned = PurchasedProduct::where('user_id', $user->id)
            ->where('product_type', $productType)
            ->where('payment_status', 'success')
            ->where('is_upgraded', false)
            ->exists();

        if ($alreadyOwned) {
            return response()->json([
                'success' => false,
                'message' => 'You already own this product',
                'already_owned' => true
            ]);
        }

        // Get all purchased products (not upgraded)
        $purchasedProducts = PurchasedProduct::where('user_id', $user->id)
            ->where('payment_status', 'success')
            ->where('is_upgraded', false)
            ->get();

        $eligibleUpgrade = null;
        $ownedProducts = [];

        foreach ($purchasedProducts as $purchased) {
            $ownedProducts[] = $purchased->product_type;

            // Check if this product can be upgraded to the new product
            $upgradePrice = Payment::getUpgradePrice($purchased->product_type, $productType);
            if ($upgradePrice) {
                $eligibleUpgrade = $upgradePrice;
                $eligibleUpgrade['from_product_id'] = $purchased->id;
                $eligibleUpgrade['from_product_name'] = $purchased->product_name;
                break;
            }
        }

        return response()->json([
            'success' => true,
            'product' => $productDetails,
            'owned_products' => $ownedProducts,
            'eligible_upgrade' => $eligibleUpgrade,
            'has_owned_products' => count($ownedProducts) > 0
        ]);
    }

    public function initiate(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first',
                'redirect' => route('login')
            ], 401);
        }

        $user = Auth::user();
        $productType = $request->product_type;
        $isUpgrade = $request->is_upgrade ?? false;
        $upgradedFrom = $request->upgraded_from ?? null;
        $upgradeProductId = $request->upgrade_product_id ?? null;

        // Log the request for debugging
        Log::info('Payment initiate called', [
            'product_type' => $productType,
            'is_upgrade' => $isUpgrade,
            'upgraded_from' => $upgradedFrom,
            'user_id' => $user->id
        ]);

        // Check if user already owns this product (for non-upgrade)
        if (!$isUpgrade) {
            $alreadyOwned = PurchasedProduct::where('user_id', $user->id)
                ->where('product_type', $productType)
                ->where('payment_status', 'success')
                ->where('is_upgraded', false)
                ->exists();

            if ($alreadyOwned) {
                return response()->json([
                    'success' => false,
                    'message' => 'You already own this product. You can upgrade to a higher plan.',
                    'already_owned' => true
                ]);
            }
        }

        $productDetails = Payment::getProductDetails($productType);

        if (!$productDetails || !isset($productDetails['amount'])) {
            Log::error('Invalid product type', [
                'product_type' => $productType,
                'available_products' => Payment::getAvailableProducts()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Invalid product type: ' . $productType,
                'available_products' => Payment::getAvailableProducts()
            ], 400);
        }

        $baseAmount = $productDetails['amount'];
        $gstAmount = 0;
        $totalAmount = 0;
        $productName = $productDetails['name'];
        $isUpgradeActual = false;
        $fromProductId = null;
        $upgradeMessage = null;

        // Handle upgrade pricing
        if ($isUpgrade && $upgradedFrom) {
            $upgradeInfo = Payment::getUpgradePrice($upgradedFrom, $productType);
            if ($upgradeInfo) {
                $baseAmount = $upgradeInfo['base_amount'];
                $gstAmount = $upgradeInfo['gst_amount'];
                $totalAmount = $upgradeInfo['total_amount'];
                $isUpgradeActual = true;
                $fromProductId = $upgradeInfo['from_product_id'];
                $productName = 'Upgrade: ' . $productDetails['name'];
                $upgradeMessage = "Upgrading from " . strtoupper(str_replace('_', ' ', $upgradedFrom));
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No valid upgrade path available. The new product must be of higher value.'
                ]);
            }
        } else {
            // Regular purchase with GST
            $gstCalc = Payment::calculateGST($baseAmount);
            $gstAmount = $gstCalc['gst_amount'];
            $totalAmount = $gstCalc['total_amount'];
        }

        $txnRef = 'TX_' . time() . '_' . Str::random(8);

        $tempPayment = TempPayment::create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'product_type' => $productType,
            'amount' => $baseAmount,
            'gst_amount' => $gstAmount,
            'total_amount' => $totalAmount,
            'txn_ref' => $txnRef,
            'status' => 'pending',
            'is_upgrade' => $isUpgradeActual,
            'upgraded_from' => $fromProductId,
        ]);

        // Cashfree order
        try {
            $response = Http::withHeaders([
                'x-api-version' => '2025-01-01',
                'x-client-id' => $this->appId,
                'x-client-secret' => $this->secretKey,
            ])->post($this->baseUrl . '/orders', [
                'order_id' => $txnRef,
                'order_amount' => $totalAmount,
                'order_currency' => 'INR',
                'order_note' => $productName . ($upgradeMessage ? ' - ' . $upgradeMessage : ''),
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
                Log::error('Cashfree order creation failed', [
                    'response' => $data,
                    'order_id' => $txnRef
                ]);
                return response()->json([
                    'success' => false,
                    'message' => $data['message'] ?? 'Payment failed to start',
                ], 500);
            }

            $tempPayment->update([
                'order_id' => $data['order_id'] ?? $txnRef,
                'payment_session_id' => $data['payment_session_id'] ?? null,
                'raw_response' => $data,
            ]);

            return response()->json([
                'success' => true,
                'payment_session_id' => $data['payment_session_id'],
                'order_id' => $txnRef,
                'amount' => $totalAmount,
                'base_amount' => $baseAmount,
                'gst_amount' => $gstAmount,
                'product_name' => $productName,
                'is_upgrade' => $isUpgradeActual,
                'upgrade_message' => $upgradeMessage,
                'temp_payment_id' => $tempPayment->id
            ]);
        } catch (\Exception $e) {
            Log::error('Payment initiation exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your payment. Please try again.'
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        $orderId = $request->order_id;

        Log::info('Payment callback received', ['order_id' => $orderId]);

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
        try {
            $response = Http::withHeaders([
                'x-api-version' => '2025-01-01',
                'x-client-id' => $this->appId,
                'x-client-secret' => $this->secretKey,
            ])->get($this->baseUrl . '/orders/' . $orderId . '/payments');

            if (!$response->successful()) {
                Log::error('Gateway status check failed', [
                    'order_id' => $orderId,
                    'status' => $response->status()
                ]);
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
        } catch (\Exception $e) {
            Log::error('Gateway status check exception', [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);
            return null;
        }
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
                'gst_amount' => $tempPayment->gst_amount,
                'total_amount' => $tempPayment->total_amount,
                'txn_ref' => $tempPayment->txn_ref,
                'order_id' => $tempPayment->order_id,
                'status' => 'success',
                'paid_at' => now(),
                'raw_response' => $gatewayResponse,
            ]);

            $productDetails = Payment::getProductDetails($tempPayment->product_type);

            $purchasedData = [
                'user_id' => $tempPayment->user_id,
                'product_type' => $tempPayment->product_type,
                'product_name' => $productDetails['name'] ?? ucwords(str_replace('_', ' ', $tempPayment->product_type)),
                'amount' => $tempPayment->amount,
                'gst_amount' => $tempPayment->gst_amount,
                'total_amount' => $tempPayment->total_amount,
                'txn_ref' => $tempPayment->txn_ref,
                'order_id' => $tempPayment->order_id,
                'payment_status' => 'success',
                'purchased_at' => now(),
                'is_upgrade' => $tempPayment->is_upgrade,
                'upgraded_from' => $tempPayment->upgraded_from,
                'is_upgraded' => false,
            ];

            // If it's an upgrade, mark the old product as upgraded
            if ($tempPayment->is_upgrade && $tempPayment->upgraded_from) {
                $oldPurchase = PurchasedProduct::where('id', $tempPayment->upgraded_from)->first();
                if ($oldPurchase) {

                    $oldPurchase->update([
                        'is_upgraded' => true,
                        'remark' => 'Upgraded from "' . $oldPurchase->product_type . '" to "' . $tempPayment->product_type . '" on ' . now()->format('d-m-Y H:i:s')
                    ]);
                }
            }

            PurchasedProduct::create($purchasedData);

            Log::info('Payment marked as success', [
                'txn_ref' => $tempPayment->txn_ref,
                'product_type' => $tempPayment->product_type,
                'is_upgrade' => $tempPayment->is_upgrade
            ]);
        }

        $tempPayment->delete();
    }

    public function getPaymentStatus($orderId)
    {
        $payment = Payment::where('txn_ref', $orderId)->first();

        if ($payment) {
            return response()->json([
                'status' => $payment->status,
                'order_id' => $orderId,
                'amount' => $payment->total_amount,
                'product' => $payment->product_type
            ]);
        }

        $tempPayment = TempPayment::where('txn_ref', $orderId)->first();

        if ($tempPayment) {
            return response()->json([
                'status' => $tempPayment->status,
                'order_id' => $orderId,
                'amount' => $tempPayment->total_amount,
                'product' => $tempPayment->product_type,
                'is_upgrade' => $tempPayment->is_upgrade
            ]);
        }

        return response()->json([
            'status' => 'not_found',
            'order_id' => $orderId
        ], 404);
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
