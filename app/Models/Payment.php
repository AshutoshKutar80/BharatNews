<?php

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

    public static function getProductDetails($type)
    {
        $products = [
            self::PRODUCT_REPORTER_ID => [
                'name' => 'Reporter ID',
                'amount' => 999,
                'description' => 'Official reporter ID card with digital identity'
            ],
            self::PRODUCT_REPORTER_MIC => [
                'name' => 'Reporter ID + Mic',
                'amount' => 3499,
                'description' => 'Reporter ID with branded interview microphone'
            ],
            self::PRODUCT_WIRELESS_MIC => [
                'name' => 'Wireless Mic + Reporter ID',
                'amount' => 7999,
                'description' => 'Wireless microphone setup with reporter ID'
            ]
        ];

        // Log the product type being requested
        Log::info('Getting product details', [
            'product_type' => $type,
            'available_products' => array_keys($products)
        ]);

        // Check if product exists
        if (!isset($products[$type])) {
            Log::error('Product type not found', [
                'product_type' => $type,
                'available_products' => array_keys($products)
            ]);
            return null;
        }

        return $products[$type];
    }
}
