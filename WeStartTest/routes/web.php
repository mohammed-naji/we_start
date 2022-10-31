<?php

// use , namespace

// Route::get('uri', 'action');
// Route::post('uri', 'action');
// Route::put('uri', 'action');
// Route::patch('uri', 'action');
// Route::delete('uri', 'action');

use Illuminate\Support\Facades\Route;

Route::match(['put', 'patch'], 'update', function() {
    return 'Update file';
});

Route::any('privacy-policy', function() {
    return 'Done';
});

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

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('home1', function() { return 'admin home1'; })->name('home1');
    Route::get('home2', function() { return 'admin home2'; })->name('home2');
    Route::get('home3', function() { return 'admin home3'; })->name('home3');
    Route::get('home4', function() { return 'admin home4'; })->name('home4');
    Route::get('home5', function() { return 'admin home5'; })->name('home5');
    Route::get('home6', function() { return 'admin home6'; })->name('home6');
    Route::get('home7', function() { return 'admin home7'; })->name('home7');
});

Route::get('contact-usssssssssssss', function() {
    return 'aaaaa';
})->name('contactpage');

// Route::view('test','welcome');

?>

<!-- <a href="route('contactpage')">Contact Us</a>
<a href="route('contactpage')">Contact Us</a>
<a href="route('contactpage')">Contact Us</a>
<a href="route('contactpage')">Contact Us</a>
<a href="route('contactpage')">Contact Us</a>
<a href="route('contactpage')">Contact Us</a>
<a href="route('contactpage')">Contact Us</a>
<a href="route('contactpage')">Contact Us</a>
<a href="route('contactpage')">Contact Us</a> -->
