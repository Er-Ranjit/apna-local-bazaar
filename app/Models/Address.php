<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $fillable = [
    'user_id',
    'name',
    'phone',
    'address',
    'landmark',
    'village',
    'city',
    'state',
    'pincode',
    'latitude',
    'longitude',
    'type',
    'is_default',
];

    protected $casts = [
    'is_default' => 'boolean',
    'latitude' => 'float',
    'longitude' => 'float',
];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}