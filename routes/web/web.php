<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;

use App\Http\Controllers\CommentsRepliesController;
use App\Http\Controllers\PostCommentsController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Route;



Route::get('/attach role to user', function(){
    $user=User::find(18);
    $user->roles()->attach(1);
});


//Auth::routes();


Route::get('/', [HomeController::class, 'index'])->name('home');


    Route::middleware('auth')->group(function()
    {
    
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::resource('auth/comments/replies',CommentsRepliesController::class);
  
    Route::resource('auth/comments', PostCommentsController::class);

   });

    Route::middleware(['role:Admin','auth'])->group(function()
    {

    Route::patch('comments/approveunapprove/{comment}', [PostCommentsController::class, 'ApproveUnApprove'])->name('comments.approve.unapprove');

    }); 
  











