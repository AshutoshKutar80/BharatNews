<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TehsilList extends Model
{
    protected $table = 'tehsillist';

    protected $fillable = [
        'disid',
        'tehsil'
    ];

    public $timestamps = true;

    public function district()
    {
        return $this->belongsTo(State::class, 'disid', 'id');
    }

    public function scopeActive($query)
    {
        return $query;
    }
}
