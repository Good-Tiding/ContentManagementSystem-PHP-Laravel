<?php

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function(){
    //we put the /admin in auth middleware because we cannot enter the admin page without login
    // and the same as /admin/post/create and admin/posts/store because the post creation in admin page
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
});

Route::middleware('auth','role:Admin')->group(function(){
Route::resource('admin/categories', App\Http\Controllers\CategoriesController::class);

//ما في داعي نساويها ريسورس لاني بس بحاجة الاندكس والديليت

});




