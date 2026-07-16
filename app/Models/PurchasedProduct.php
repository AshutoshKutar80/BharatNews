<?php
// app/Models/PurchasedProduct.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_type',
        'product_name',
        'amount',
        'gst_amount',
        'total_amount',
        'txn_ref',
        'order_id',
        'payment_status',
        'purchased_at',
        'tracking_id',
        'remark',
        'admin_remark',
        'is_approved',
        'approved_at',
        'approved_by',
        'is_upgrade',
        'upgraded_from',
        'is_upgraded',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'gst_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'purchased_at' => 'datetime',
            'approved_at'  => 'datetime',
            'created_at'  => 'datetime',
            'updated_at'  => 'datetime',
            'is_approved'  => 'boolean',
            'is_upgrade'  => 'boolean',
            'is_upgraded'  => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function upgradedFromProduct()
    {
        return $this->belongsTo(self::class, 'upgraded_from');
    }

    public function getUpgradedFromProduct()
    {
        if (!$this->is_upgrade || !$this->upgraded_from) {
            return null;
        }
        return self::where('id', $this->upgraded_from)->first();
    }

    /**
     * Get all products that this user owns (not upgraded)
     */
    public static function getUserActiveProducts($userId)
    {
        return self::where('user_id', $userId)
            ->where('payment_status', 'success')
            ->where('is_upgraded', false)
            ->get();
    }

    /**
     * Check if user owns a specific product
     */
    public static function userOwnsProduct($userId, $productType)
    {
        return self::where('user_id', $userId)
            ->where('product_type', $productType)
            ->where('payment_status', 'success')
            ->where('is_upgraded', false)
            ->exists();
    }
}
