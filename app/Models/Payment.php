<?php
// app/Models/Payment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'product_type',
        'amount',
        'gst_amount',
        'total_amount',
        'txn_ref',
        'order_id',
        'payment_session_id',
        'status',
        'raw_response',
        'paid_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'raw_response' => 'array',
        'amount' => 'decimal:2',
        'gst_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    const PRODUCT_REPORTER_ID = 'reporter_id';
    const PRODUCT_REPORTER_MIC = 'reporter_mic';
    const PRODUCT_WIRELESS_MIC = 'wireless_mic';
    const PRODUCT_DISTRICT_BUREAU_CHIEF = 'district_bureau_chief';

    const GST_RATE = 18;

    public static function getProductDetails($type)
    {
        $products = [
            self::PRODUCT_REPORTER_ID => [
                'name' => 'Reporter ID',
                'amount' => 999,
                'description' => 'Official reporter ID card with digital identity',
                'level' => 1
            ],
            self::PRODUCT_REPORTER_MIC => [
                'name' => 'Reporter ID + Mic',
                'amount' => 3499,
                'description' => 'Reporter ID with branded interview microphone',
                'level' => 2
            ],
            self::PRODUCT_WIRELESS_MIC => [
                'name' => 'Wireless Mic + Reporter ID',
                'amount' => 7999,
                'description' => 'Wireless microphone setup with reporter ID',
                'level' => 3
            ],
            self::PRODUCT_DISTRICT_BUREAU_CHIEF => [
                'name' => 'District Bureau Chief',
                'amount' => 15999,
                'description' => 'Mic + Reporter ID + 600 Magazine Copies',
                'level' => 4
            ]
        ];

        if (!isset($products[$type])) {
            Log::error('Product type not found', [
                'product_type' => $type,
                'available_products' => array_keys($products)
            ]);
            return null;
        }

        return $products[$type];
    }

    public static function getAvailableProducts()
    {
        return [
            self::PRODUCT_REPORTER_ID,
            self::PRODUCT_REPORTER_MIC,
            self::PRODUCT_WIRELESS_MIC,
            self::PRODUCT_DISTRICT_BUREAU_CHIEF
        ];
    }

    public static function calculateGST($amount)
    {
        $gst = ($amount * self::GST_RATE) / 100;
        return [
            'gst_amount' => round($gst),
            'total_amount' => round($amount + $gst)
        ];
    }

    public static function getProductWithGST($type)
    {
        $product = self::getProductDetails($type);
        if (!$product) {
            return null;
        }

        $gstCalc = self::calculateGST($product['amount']);

        return array_merge($product, [
            'gst_amount' => $gstCalc['gst_amount'],
            'total_amount' => $gstCalc['total_amount'],
            'gst_rate' => self::GST_RATE
        ]);
    }

    /**
     * Check if a user can upgrade from one product to another
     * Only allows upgrade to higher level products
     */
    public static function canUpgrade($currentProductType, $newProductType)
    {
        $current = self::getProductDetails($currentProductType);
        $new = self::getProductDetails($newProductType);

        if (!$current || !$new) {
            return false;
        }

        // Only allow upgrade if new product has higher level
        return $new['level'] > $current['level'];
    }

    public static function getUpgradePrice($currentProductType, $newProductType)
    {
        $currentProduct = self::getProductDetails($currentProductType);
        $newProduct = self::getProductDetails($newProductType);

        if (!$currentProduct || !$newProduct) {
            return null;
        }

        // Check if upgrade is valid (new product must be higher level)
        if ($newProduct['level'] <= $currentProduct['level']) {
            return null;
        }

        // Check if user owns the current product
        $purchased = PurchasedProduct::where('user_id', auth()->id())
            ->where('product_type', $currentProductType)
            ->where('payment_status', 'success')
            ->where('is_upgraded', false)
            ->first();

        if (!$purchased) {
            return null;
        }

        $difference = $newProduct['amount'] - $currentProduct['amount'];

        // Only calculate if difference is positive
        if ($difference <= 0) {
            return null;
        }

        $gstCalc = self::calculateGST($difference);

        return [
            'base_amount' => $difference,
            'gst_amount' => $gstCalc['gst_amount'],
            'total_amount' => $gstCalc['total_amount'],
            'from_product' => $currentProductType,
            'to_product' => $newProductType,
            'is_upgrade' => true,
            'from_product_id' => $purchased->id,
            'from_product_name' => $purchased->product_name,
            'current_level' => $currentProduct['level'],
            'new_level' => $newProduct['level'],
            'current_product_amount' => $currentProduct['amount'], // Add this
            'new_product_amount' => $newProduct['amount'] // Add this
        ];
    }
}
