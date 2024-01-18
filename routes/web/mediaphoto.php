
<?php
use Illuminate\Support\Facades\Route;


Route::get('admin/mediaphoto', [App\Http\Controllers\MediaPhotoController::class,'index'])->name('mediaphoto.index');
//Route::get('admin/mediaphoto/upload', ['as'=>'mediaphoto.upload','uses'=>'App\Http\Controllers\MediaPhotoController::class']);
Route::get('admin/mediaphoto/upload', [App\Http\Controllers\MediaPhotoController::class,'upload'])->name('mediaphoto.upload');
Route::post('admin/mediaphoto/store', [App\Http\Controllers\MediaPhotoController::class,'store'])->name('mediaphoto.store');
Route::delete('admin/mediaphoto/destroy/{photo}', [App\Http\Controllers\MediaPhotoController::class,'destroy'])->name('mediaphoto.destroy');
Route::delete('admin/mediaphoto/destroychecked/{photo}', [App\Http\Controllers\MediaPhotoController::class,'destroychecked'])->name('mediaphoto.deletechecked');