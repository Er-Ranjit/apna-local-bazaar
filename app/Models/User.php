<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'latitude',
    'longitude',
    'is_active',
];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
    'latitude' => 'float',
    'longitude' => 'float',
    'is_active' => 'boolean',
];

    public function vendor(): HasOne
    {
        return $this->hasOne(Vendor::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function deliveryBoy(): HasOne
    {
        return $this->hasOne(DeliveryBoy::class);
    }
}