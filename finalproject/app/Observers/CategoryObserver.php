<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    function creating($value) {

        $slug = Str::slug(request()->en_name);

        // $count = Category::whereSlug($slug)->count();
        $count = Category::where('slug', 'like', $slug.'%')->count();
        if($count) {
            $slug = $slug.'-'.$count;
        }

        $value->slug = $slug;
    }
}
