<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_name',
        'product_image',
        'quantity',
        'price',
    ];

    // Không cast price, giữ nguyên string
    protected $casts = [
        'quantity' => 'integer',
    ];

    // Quan hệ với Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Accessor để lấy giá dạng số
    public function getPriceNumericAttribute()
    {
        return \App\Helper\helpers::parse($this->price);
    }

    // Accessor để format giá
    public function getPriceFormattedAttribute()
    {
        return \App\Helper\helpers::format($this->price_numeric);
    }

    // Accessor để tính subtotal
    public function getSubtotalAttribute()
    {
        return $this->price_numeric * $this->quantity;
    }

    // Accessor để format subtotal
    public function getSubtotalFormattedAttribute()
    {
        return \App\Helper\helpers::format($this->subtotal);
    }
}