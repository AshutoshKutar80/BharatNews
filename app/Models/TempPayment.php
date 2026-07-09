<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TempPayment extends Model
{
    protected $table = 'temp_payments';

    protected $fillable = [
        'user_id',
        'session_id',
        'user_name',
        'user_email',
        'product_type',
        'amount',
        'txn_ref',
        'order_id',
        'payment_session_id',
        'status',
        'payment_data',
        'raw_response',
        'created_at',
        'updated_at',
        'expires_at'
    ];

    protected $casts = [
        'payment_data' => 'array',
        'raw_response' => 'array',
        'amount' => 'decimal:2',
        'expires_at' => 'datetime',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    const STATUS_INITIATED = 'initiated';
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';
    const STATUS_EXPIRED = 'expired';
}
