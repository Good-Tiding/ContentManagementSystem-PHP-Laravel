<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;



Route::get('index', [CategoriesController::class, 'index'])->name('category.index');
Route::post('store', [CategoriesController::class, 'store'])->name('category.store');
Route::delete('destroy/{category}', [CategoriesController::class, 'destroy'])->name('category.destroy');
Route::get('show/{category}', [CategoriesController::class, 'show'])->name('category.show');
Route::get('/edit/{category}', [CategoriesController::class, 'edit'])->name('category.edit');
Route::put('update/{category}', [CategoriesController::class, 'update'])->name('category.update');
