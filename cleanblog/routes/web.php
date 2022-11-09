<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // /posts/{post}
    Route::get('posts/trash', [PostController::class, 'trash'])->name('posts.trash');
    Route::get('posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore')->withTrashed();
    Route::get('posts/{post}/forcedelete', [PostController::class, 'forcedelete'])->name('posts.forcedelete')->withTrashed();
    Route::resource('posts', PostController::class);

});


// Route::fallback(function() {
//     return 'dddddd';
// });
