<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Trans;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function gallery()
    {
        return $this->morphMany(Image::class, 'imageable')->where('feature', 0);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('feature', 1);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function coupons()
    {
        return $this->hasOne(Coupon::class);
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
