<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
