<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'minimum_amount',
        'usage_limit',
        'used_count',
        'is_active',
        'starts_at',
        'expires_at',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('D, d M Y H:i');
    }

    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('D, d M Y H:i');
    }

    public function getStartsAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('D, d M Y H:i');
    }

    public function getExpiresAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('D, d M Y H:i');
    }
}
