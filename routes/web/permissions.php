<?php

use Illuminate\Support\Facades\Route;


 
    Route::get('perm/index', [App\Http\Controllers\PermissionController::class, 'index'])->name('perm.index');
    Route::post('perm/store', [App\Http\Controllers\PermissionController::class, 'store'])->name('perm.store');
    Route::delete('perm/delete/{perm}', [App\Http\Controllers\PermissionController::class, 'delete'])->name('perm.delete');
    Route::get('/edit/perm {perm}', [App\Http\Controllers\PermissionController::class, 'edit'])->name('perm.edit');
    Route::put('/update/perm {perm}', [App\Http\Controllers\PermissionController::class, 'update'])->name('perm.update');



