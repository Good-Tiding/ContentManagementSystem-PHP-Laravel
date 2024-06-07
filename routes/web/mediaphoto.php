
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaPhotoController;


Route::get('mediaphoto', [MediaPhotoController::class,'index'])->name('mediaphoto.index');
//Route::get('admin/mediaphoto/upload', ['as'=>'mediaphoto.upload','uses'=>'App\Http\Controllers\MediaPhotoController::class']);
Route::get('mediaphoto/upload', [MediaPhotoController::class,'upload'])->name('mediaphoto.upload');
Route::post('mediaphoto/store', [MediaPhotoController::class,'store'])->name('mediaphoto.store');
/* Route::delete('admin/mediaphoto/destroy/{photo}', [App\Http\Controllers\MediaPhotoController::class,'destroy'])->name('mediaphoto.destroy'); */
Route::delete('mediaphoto/destroyAllchecked', [MediaPhotoController::class,'destroychecked'])->name('mediaphoto.deletechecked');