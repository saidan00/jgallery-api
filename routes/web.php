<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\PicturesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get(/users/{id}, function($id) {
  return $id;
})
*/

// Route::get('/{vue_capture?}', function () {
//  return view('index');
// })->where('vue_capture', '[\/\w\.-]*');

// Route::get('/', function () {
//   return view('welcome');
// });

// Route::resource('albums', 'AlbumsController');
// Route::post('albums/update_data', 'AlbumsController@update_data')->name('albums.update_data');

// Route::post('pictures/add_data', 'PicturesController@add_data')->name('pictures.add_data');
// Route::post('pictures/update_data', 'PicturesController@update_data')->name('pictures.update_data');
// Route::post('pictures/delete_data', 'PicturesController@delete_data')->name('pictures.delete_data');

// Auth::routes();

Route::get('/', [AlbumsController::class, 'index']);
Route::get('/albums', [AlbumsController::class, 'index'])->name('albums');

Route::group(['prefix' => 'albums'], function ($router) {
    Route::get('/create', [AlbumsController::class, 'create'])->name('albums-create');
    Route::get('/edit/{id}', [AlbumsController::class, 'edit'])->name('albums-edit');
    Route::get('/{id}', [AlbumsController::class, 'show'])->name('albums-show');
    Route::post('/store', [AlbumsController::class, 'store'])->name('albums-store');
    Route::post('/update/{id}', [AlbumsController::class, 'update']);
    Route::post('/delete/{id}', [AlbumsController::class, 'destroy']);
});

Route::group(['prefix' => 'pictures'], function ($router) {
    Route::post('/create-many', [PicturesController::class, 'createMany']);
    Route::get('/edit/{pictureId}', [PicturesController::class, 'edit'])->name('pictures-edit');
    Route::post('/update/{albumId}/{pictureId}', [PicturesController::class, 'update']);
    Route::post('/update-order/{id}', [PicturesController::class, 'updatePictureOrderNumber']);
    Route::post('/delete/{pictureId}', [PicturesController::class, 'destroy']);
});
