<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class SiteController extends Controller
{
    public function contact(Request $request)
    {

        // return $request->all();
        $data = $request->except('cv');

        $cv = $request->file('cv')->store('uploads/cv', 'custom');

        $data['cv'] = $cv;

        // return $data;

        Mail::to('ahmed.alghoul98@gmail.com')->queue(new ContactMail($data));
    }

    public function home_categories()
    {
        // $data = Category::with(['products' => function() {

        // }])->get();

        // $data = Category::withWhereHas(['products' => function() {

        // }])->get();

        $data = Category::has('products')->withCount('products')->OrderByDesc('products_count')->limit(6)->get();

        return BaseController::msg(1, 'All Categories with products', 200, $data);
    }
}
