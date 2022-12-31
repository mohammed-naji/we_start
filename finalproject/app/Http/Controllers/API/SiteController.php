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
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Exception;

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
        $user = $request->user;
        // return ;

        if($request->type == 'cards') {
            $stripeCharge = $request->user()->charge(
                $request->amount * 100, $request->payment_method_id
            );
        }

        // return $stripeCharge;
        $types = ['cash', 'wallet', 'points'];

        if((isset($stripeCharge) && $stripeCharge->status == 'succeeded') || in_array($request->type, $types)) {

            $proccess = 'completed';
            if($request->type == 'cash') {
                $proccess = 'processing';
            }
            DB::beginTransaction();
            try {

            // Check the payment type and increament or decrement point and wallet
            if($request->type == 'wallet') {
                $request->user()->decrement('wallet', $request->amount);
            }

            if($request->type == 'points') {
                $request->user()->decrement('points', $request->amount * 100);
            }

            if($request->type == 'cards') {
                $request->user()->increment('points', ceil($request->amount / 100));
            }

            // Create Order
            $order = Order::create([
                'user_id' => $request->user()->id,
                'status' => $proccess, // ffffff
                'total' => $request->amount,
                'address' => json_encode([
                    'country' => $user['country'],
                    'city' => $user['city'],
                    'street' => $user['street'],
                    'zipcode' => $user['zipcode'],
                ], JSON_UNESCAPED_UNICODE)
            ]);

            foreach($request->user()->carts as $cart) {
                OrderItem::create([
                    'product_id' => $cart->product_id,
                    'user_id' => $cart->user_id,
                    'coupon_id' => $cart->coupons,
                    'order_id' => $order->id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->price
                ]);

                $cart->product()->decrement('quantity', $cart->quantity);

                $cart->delete();
            }

            // Add carts to order items table

            // decrease product quantity

            // delete carts

            // create payment record
            if($request->type != 'cash') {
                Payment::create([
                    'user_id' => $request->user()->id,
                    'order_id' => $order->id,
                    'total' => $request->amount,
                    'transaction_id' => isset($stripeCharge) ? $stripeCharge->id : ''
                ]);
            }

            // return success code

            DB::commit();
            }catch(Exception $e) {
                DB::rollBack();
                return $this->msg(0, $e->getMessage(), 404);
            }

            return $this->msg(1, 'Payment Done Successfully', 200);

        }else {
            return $this->msg(0, 'Payment Faild', 200);
        }

        // return var_dump($stripeCharge->status);

    }

    public function account_charge(Request $request)
    {
        $stripeCharge = $request->user()->charge(
            $request->amount * 100, $request->payment_method_id
        );

        if($stripeCharge->status == 'succeeded') {
            $request->user()->increment('wallet', $request->amount);
            return $this->msg(1, 'Account Charged', 200);
        }else {
            return $this->msg(0, 'Error', 500);
        }
    }
}
