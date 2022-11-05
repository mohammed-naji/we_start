<?php

// use , namespace

// Route::get('uri', 'action');
// Route::post('uri', 'action');
// Route::put('uri', 'action');
// Route::patch('uri', 'action');
// Route::delete('uri', 'action');

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

// Route::match(['put', 'patch'], 'update', function() {
//     return 'Update file';
// });

// Route::any('privacy-policy', function() {
//     return 'Done';
// });

// Route::get('/', function() {
//     return 'Homepage - Get';
// });

// Route::post('/', function() {
//     return 'Homepage';
// });

// Route::put('/', function() {
//     return 'Homepage';
// });

// Route::patch('/', function() {
//     return 'Homepage';
// });

// Route::delete('/', function() {
//     return 'Homepage';
// });

// Route::get('abouttt', function() {
//     return 'About Us Page';
// });

// Route::get('/dddd', 'NewController@eeee');

// Route::get('/user/{name?}', function($name = null) {
//     return 'User ' . $name;
// });

// preg_match()

// Route::get('/user/{name}/{age}/{username}', function($name, $age, $username) {

//     return "Welcome $name your age is $age and username is $username";
// })->whereAlpha('name')->whereNumber('age')->whereAlphaNumeric('username');
// ->where('name', '[a-zA-Z]+');


// Route::get('contact-usssssssssssss', function() {
//     return 'aaaaa';
// })->name('contactpage');

// Route::view('test','welcome');

// include 'admin.php';

// home, about, contact, team, services

// $name = 'Ali';
// define('NAME', 'Ali');
// NAME

Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::get('/team', [SiteController::class, 'team'])->name('team');
Route::get('/services', [SiteController::class, 'services'])->name('services');
Route::get('/services/{id?}', [SiteController::class, 'services_single'])->name('services_single');

// Route::get('only-admin', AdminController::class);

// CRUD Application
// C => Create => INSERT
// R => Read => SELECT
// U => Update => UPDATE
// D => Delete => DELETE

// Create => GET, POST
// Read => all items GET, single item GET
// Update => GET, PUT
// Delete => DELETE

// Route::get('products', [ProductController::class, 'index'])->name('products.index');

// Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
// Route::post('products', [ProductController::class, 'store'])->name('products.store');

// Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');

// Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');

// Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Route::resource('products', ProductController::class)->except(
//     'show'
// );

// Route::resource('products', ProductController::class)->names([
//     'destroy' => 'delete_product'
// ]);
