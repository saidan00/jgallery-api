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

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');
});

/* Albums */
// Route::get('albums', 'Api\AlbumsController@index');

// Get single album
// Route::get('albums/{id}', 'Api\AlbumsController@show');

Route::resource('albums', 'Api\AlbumsController');

Route::put('albums/updatePicturesOrderNumber/{id}', 'Api\AlbumsController@updatePicturesOrderNumber');

Route::resource('pictures', 'Api\PicturesController');
