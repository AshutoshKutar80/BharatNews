<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    protected $fillable = [
        'country',
        'states',
        'statecode',
        'district',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Relationship with tehsils
    public function tehsils()
    {
        return $this->hasMany(TehsilList::class, 'disid', 'id');
    }
}
