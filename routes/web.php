<?php

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

Route::get('/{vue_capture?}', function () {
 return view('index');
})->where('vue_capture', '[\/\w\.-]*');

// Route::get('/', function () {
//   return view('welcome');
// });

// Route::resource('albums', 'AlbumsController');
// Route::post('albums/update_data', 'AlbumsController@update_data')->name('albums.update_data');

// Route::post('pictures/add_data', 'PicturesController@add_data')->name('pictures.add_data');
// Route::post('pictures/update_data', 'PicturesController@update_data')->name('pictures.update_data');
// Route::post('pictures/delete_data', 'PicturesController@delete_data')->name('pictures.delete_data');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
