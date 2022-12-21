<?php

namespace App\Http\Controllers\API;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\HomeCategoriesResource;
use App\Models\Coupon;

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
        App::setlocale(request()->lang);
        $data = ProductsResource::collection(Product::with('image', 'gallery', 'variations', 'category', 'reviews')->get());
        return $this->msg(1, 'All Categories with products', 200, $data);
    }

    public function product($slug)
    {
        $data = new ProductsResource(Product::where('slug', $slug)->with('image', 'gallery', 'variations', 'category', 'reviews')->first());
        return $this->msg(1, 'Product Single', 200, $data);
    }

    public function related_products($id, $category_id)
    {
        $data = ProductsResource::collection(Product::where('category_id', $category_id)->where('id', '!=', $id)->with('image', 'gallery', 'variations', 'category', 'reviews')->get());
        return $this->msg(1, 'Related Products', 200, $data);
    }

    public function add_to_cart(Request $request)
    {

        $product = Product::find($request->product_id);

        Cart::updateOrCreate([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
        ], [
            'coupon_id' => $product->coupons ? $product->coupons->id : null,
            'quantity' => DB::raw('quantity + ' . $request->quantity),
            'price' => $product->final_price
        ]);
    }

    public function cart(Request $request)
    {
        return CartResource::collection(Cart::where('user_id', $request->user_id)->get());
    }

    public function add_to_user(Request $request)
    {
        Cart::where('user_id', $request->user_token)->update(['user_id' => $request->user_id]);

        return Cart::where('user_id', $request->user_id)->get();
    }

    public function verify_otp(Request $request)
    {
        $code = implode($request->number);
        $user = $request->user();

        $update = User::where('id', $user->id)->where('otp_code', $code)->update(['otp_verified_at' => now()]);

        if($update) {
            return now();
        }else {
            return null;
        }
    }

    public function check_user_wallet($id, $total)
    {
        $wallet = User::find($id)->wallet;

        if($wallet >= $total) {
            return 'Done';
        }else {
            return 'Error';
        }
    }

    public function purchase(Request $request)
    {
        // return $request->all();
        $stripeCharge = $request->user()->charge(
            $request->amount * 100, $request->payment_method_id
        );

        return $stripeCharge;
    }
}
