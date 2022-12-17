<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/v1/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {

    Route::post('/contact', [SiteController::class, 'contact']);

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/home-categories', [SiteController::class, 'home_categories']);

    Route::get('/products', [SiteController::class, 'products']);
    Route::get('/products/{slug}', [SiteController::class, 'product']);
    Route::get('/cart', [SiteController::class, 'cart']);
    Route::post('/add-to-cart', [SiteController::class, 'add_to_cart']);
    Route::post('/assign-cart-to-user', [SiteController::class, 'add_to_user']);
    Route::post('/verify-otp', [SiteController::class, 'verify_otp'])->middleware('auth:api');
});
