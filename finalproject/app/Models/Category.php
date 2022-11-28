<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory, Trans;

    protected $guarded = [];

    protected $appends = ['trans_name', 'en_name', 'ar_name'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->withDefault();
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    protected static function booted()
    {
        // static::addGlobalScope('parents', function (Builder $builder) {
        //     $builder->whereNull('parent_id');
        // });
    }

    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }
}
