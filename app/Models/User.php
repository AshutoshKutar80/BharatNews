<?php

namespace App\Models;

// Note: extend from Authenticatable as Laravel ships by default.
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'state',
        'district',
        'tehsil',
        'city',
        'pincode',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'created_at'  => 'datetime',
            'updated_at'  => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contacts()
    {
        return $this->hasMany(\App\Models\Contact::class);
    }
    
    public function payments()
    {
        return $this->hasMany(\App\Models\Payment::class);
    }
    
    public function tempPayments()
    {
        return $this->hasMany(\App\Models\TempPayment::class);
    }
    
    public function purchasedProducts()
    {
        return $this->hasMany(\App\Models\PurchasedProduct::class);
    }
}