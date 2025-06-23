<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'total_amount',
        'tax_amount',
        'shipping_amount',
        'discount_amount',
        'currency',
        'payment_status',
        'payment_method',
        'notes',
        'shipped_at',
        'delivered_at',
    ];
    protected $casts = [
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function order_items()
    {
        return $this->hasMany(Order_item::class);
    }

    public function shipping_address()
    {
        return $this->hasOne(Shipping_address::class);
    }
}
