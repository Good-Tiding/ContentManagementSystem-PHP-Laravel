<?php

use Illuminate\Support\Facades\Route;


 
    Route::get('role/index', [App\Http\Controllers\RoleController::class, 'index'])->name('role.index');
    
    Route::post('role/store', [App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
    Route::delete('role {role}/delete', [App\Http\Controllers\RoleController::class, 'delete'])->name('role.delete');
    Route::get('/edit/role {role}', [App\Http\Controllers\RoleController::class, 'edit'])->name('role.edit');
    Route::put('/update/role {role}', [App\Http\Controllers\RoleController::class, 'update'])->name('role.update');
    Route::put('role {role}/attach/perm', [App\Http\Controllers\RoleController::class, 'attach'])->name('role.perm.attach');
    Route::put('role {role}/detach/perm', [App\Http\Controllers\RoleController::class, 'detach'])->name('role.perm.detach');

