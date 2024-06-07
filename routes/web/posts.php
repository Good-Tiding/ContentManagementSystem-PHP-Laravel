
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('blog/{post:slug}', [PostController::class, 'show'])->name('blog.post');



Route::middleware('auth')->group(function()
{
  /*   Route::get('/show/{post}', [PostController::class, 'show'])->name('post.show'); */
    Route::get('/index', [PostController::class, 'index'])->name('post.index');
   
    Route::get('/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/store', [PostController::class, 'store'])->name('post.store');
    Route::delete('/delete/{post}', [PostController::class, 'delete'])->name('post.delete');
    Route::delete('/deletepostimage/{post}', [PostController::class, 'deletepostimage'])->name('post.deletepostimage');
    Route::get('/edit/{post}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/update/{post}', [PostController::class, 'update'])->name('post.update');
    

});






    
