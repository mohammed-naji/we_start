<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

        // static::creating(function($value) {
        //     $slug = Str::slug(request()->en_name);

        //     // $count = Category::whereSlug($slug)->count();
        //     $count = Category::where('slug', 'like', $slug.'%')->count();
        //     if($count) {
        //         $slug = $slug.'-'.$count;
        //     }

        //     $value->slug = $slug;
        // });
    }

    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }
}
