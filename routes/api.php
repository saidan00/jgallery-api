<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Albums */
// Route::get('albums', 'Api\AlbumsController@index');

// Get single album
// Route::get('albums/{id}', 'Api\AlbumsController@show');

Route::resource('albums', 'Api\AlbumsController');

Route::resource('pictures', 'Api\PicturesController');
