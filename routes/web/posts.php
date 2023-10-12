
<?php

use Illuminate\Support\Facades\Route;

Route::get('blog/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('blog.post');
Route::middleware('auth')->group(function()
{
    Route::get('/index', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    Route::get('/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('/store', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::delete('/delete/{post}', [App\Http\Controllers\PostController::class, 'delete'])->name('post.delete');
    Route::get('/edit/{post}', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::put('/update/{post}', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    

});






    
