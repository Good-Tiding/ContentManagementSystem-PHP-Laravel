

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware('auth')->group(function()
{

    Route::put('profile/{user}/update', [UserController::class, 'update'])->name('profile.update');
   
    Route::delete('/deleteuserimage/{user}', [UserController::class, 'deleteuserimage'])->name('user.deleteuserimage');
});

Route::middleware(['role:Admin','auth'])->group(function()
{
    Route::get('user{user}/attach/role/profile', [UserController::class, 'show_profile_role'])->name('user.profile.role.attach');
    Route::get('admin/users/index', [UserController::class, 'index'])->name('index.users');
    Route::put('user{user}/attach/role', [UserController::class, 'attach'])->name('user.role.attach');
    Route::put('user{user}/detach/role', [UserController::class, 'detach'])->name('user.role.detach');
    Route::get('admin/{user:slug}/profile', [UserController::class, 'show_admin_profile'])->name('profile.adminuser');
    Route::delete('/admin/user/delete/{user}', [UserController::class, 'delete'])->name('delete.user');
}); 

Route::middleware(['can:view,user','auth'])->group(function()
{
    //we pass the slug here because we want to make update in the same page and we are maybe updating the user name and we pass the user name in the route

    Route::get('user/{user:slug}/profile', [UserController::class, 'show_user_profile'])->name('profile.normaluser');
  
});