<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeCategoriesResource;
use App\Http\Resources\ProductsResource;
use App\Mail\ContactMail;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class SiteController extends Base
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

        // DB::connection('abc')->table('')

        $data = Category::has('products')->withCount('products')->OrderByDesc('products_count')->limit(6)->get();

        $data = HomeCategoriesResource::collection($data);

        return BaseController::msg(1, 'All Categories with products', 200, $data);
    }

    public function products()
    {
        $data = ProductsResource::collection(Product::with('image', 'gallery', 'variations', 'category')->get());
        return $this->msg(1, 'All Categories with products', 200, $data);
    }

    public function add_to_cart(Request $request)
    {

        $product = Product::find($request->product_id);

        Cart::create([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'quantity' => $request->quantity,
            'price' => $product->price
        ]);

    }

    public function cart(Request $request)
    {
        return Cart::where('user_id', $request->user_id)->get();
    }
}
