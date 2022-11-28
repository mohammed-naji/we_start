<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory, Trans;

    protected $guarded = [];

    protected $appends = ['trans_name', 'en_name', 'ar_name'];

    public function products()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
