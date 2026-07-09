<?php

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
        'txn_ref',
        'order_id',
        'payment_status',
        'purchased_at',
        'tracking_id',
        'remark',
        'is_approved',
        'approved_at',
        'approved_by',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'purchased_at' => 'datetime',
            'approved_at'  => 'datetime',
            'created_at'  => 'datetime',
            'updated_at'  => 'datetime',
            'is_approved'  => 'boolean',
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
}
