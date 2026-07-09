<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_no',
        'user_id',
        'subject',
        'status'
    ];

    public function messages()
    {
        return $this->hasMany(TicketMessage::class)
            ->orderBy('created_at');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
