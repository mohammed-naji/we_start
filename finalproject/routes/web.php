<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\NotifyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Models\Category;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())->middleware('auth')->group(function() {
    Route::prefix('/admin')->name('admin.')->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
        Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
        Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
        Route::get('/admins', [AdminController::class, 'admins'])->name('admins');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings', [AdminController::class, 'settings_data']);

        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::post('add-new-image', [ProductController::class, 'add_image'])->name('add_image');
        Route::resource('coupons', CouponController::class);
        Route::resource('roles', RoleController::class);

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

Route::view('/', 'welcome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('send-sms', [NotifyController::class, 'send_sms']);

// malqumbuz@gmail.com
