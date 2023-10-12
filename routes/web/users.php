

<?php

use Illuminate\Support\Facades\Route;
Route::middleware('auth')->group(function()
{

    Route::put('profile/{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('profile.update');
    Route::delete('/admin/user/delete/{user}', [App\Http\Controllers\UserController::class, 'delete'])->name('delete.user');
});

Route::middleware(['role:Admin','auth'])->group(function()
{

    Route::get('admin/users/index', [App\Http\Controllers\UserController::class, 'index'])->name('index.users');
    Route::put('user{user}/attach/role', [App\Http\Controllers\UserController::class, 'attach'])->name('user.role.attach');
    Route::put('user{user}/detach/role', [App\Http\Controllers\UserController::class, 'detach'])->name('user.role.detach');
    Route::get('admin/{user}/profile', [App\Http\Controllers\UserController::class, 'show_admin_profile'])->name('profile.adminuser');
    
}); 

Route::middleware(['can:view,user','auth'])->group(function()
{

    Route::get('user/{user}/profile', [App\Http\Controllers\UserController::class, 'show_user_profile'])->name('profile.normaluser');
  
});