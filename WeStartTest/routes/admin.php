<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('home1', function() { return 'admin home1'; })->name('home1');
    Route::get('home2', function() { return 'admin home2'; })->name('home2');
    Route::get('home3', function() { return 'admin home3'; })->name('home3');
    Route::get('home4', function() { return 'admin home4'; })->name('home4');
    Route::get('home5', function() { return 'admin home5'; })->name('home5');
    Route::get('home6', function() { return 'admin home6'; })->name('home6');
    Route::get('home7', function() { return 'admin home7'; })->name('home7');
});
