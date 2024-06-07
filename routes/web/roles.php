<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

 
    Route::get('role/index', [RoleController::class, 'index'])->name('role.index');
    
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
    Route::delete('role/{role}/delete', [RoleController::class, 'delete'])->name('role.delete');
    Route::get('edit/role/{role}', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('update/role/{role}', [RoleController::class, 'update'])->name('role.update');
    Route::put('role/{role}/attach/perm', [RoleController::class, 'attach'])->name('role.perm.attach');
    Route::put('role/{role}/detach/perm', [RoleController::class, 'detach'])->name('role.perm.detach');
