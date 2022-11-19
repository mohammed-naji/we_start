<?php

use App\Http\Controllers\RelationController;
use Illuminate\Support\Facades\Route;

Route::get('one-to-one', [RelationController::class, 'one_to_one']);
Route::get('one-to-many', [RelationController::class, 'one_to_many']);
Route::post('one-to-many', [RelationController::class, 'add_comment'])->name('add_comment');
Route::get('many-to-many', [RelationController::class, 'many_to_many']);
Route::post('many-to-many', [RelationController::class, 'many_to_many_data'])->name('many_to_many');
