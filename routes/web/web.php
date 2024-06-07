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

Route::get('/attach permission to role', function(){
    $permi=Permission::find(1);
    $permi->roles()->attach(1);
    });

/* Route::get('/attach permission to userbb', function(){
    $user=User::find(8);
    $user->permissions()->attach(1);
    }); */
//or
Route::get('/attach permission to user', function(){
    $permi=Permission::find(1);
    $permi->users()->attach(18);
    });

Auth::routes();

//هاد بيتساوى لما ساوي خطوات اللوغن 
Route::get('/', [HomeController::class, 'index'])->name('home');

//Route::get('/search', [HomeController::class, 'search'])->name('search');
//Route::get('/search', [PostController::class, 'search'])->name('search');

Route::middleware('auth')->group(function(){
    //we put the /admin in auth middleware because we cannot enter the admin page without login
    // and the same as /admin/post/create and admin/posts/store because the post creation in admin page
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
   
    Route::resource('auth/comments', PostCommentsController::class);
    // Separate route for approving comments
     Route::patch('comments/approveunapprove/{comment}', [PostCommentsController::class, 'ApproveUnApprove'])->name('comments.approve.unapprove');
    ///Route::resource('auth/comments/{comment}/edit', PostCommentsController::class);
    Route::resource('auth/comments/replies',CommentsRepliesController::class);
  //  auth/comments/replies/{reply}/edit
});



/* Route::middleware('auth','role:Admin')->group(function(){
    Route::resource('admin/categories', CategoriesController::class);
   

//ما في داعي نساويها ريسورس لاني بس بحاجة الاندكس والديليت

}); */


/* Route::middleware('auth')->group(function(){
    Route::resource('home/categories', CategoriesController::class);
}); */






