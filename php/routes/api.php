<?php

use Illuminate\Http\Request;

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
Route::middleware('cors')->group(function () {

  Route::post('/register', 'API\RegisterController@register');
  Route::post('/login', 'API\RegisterController@login');


  Route::middleware('auth:api')->group(function () {
    Route::resource('posts/shipcrews', 'API\ShipCrewPostController');
    Route::resource('ships', 'API\ShipController');
    Route::post('/logout', 'API\RegisterController@logOut');
  });

});


