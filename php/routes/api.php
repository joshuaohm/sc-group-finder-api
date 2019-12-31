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
    Route::get('posts/shipcrews/user/{id}', 'API\ShipCrewPostController@getUsersPosts');
    Route::post('posts/shipcrews/position', 'API\ShipCrewPostController@requestPosition');
    Route::get('/locations/children/{id}/{type}', 'API\LocationController@showChildrenOfType');
    Route::get('/locations/children/{id}', 'API\LocationController@showChildren');
    Route::get('/locations/type/{id}', 'API\LocationController@showType');
    Route::resource('locations', 'API\LocationController');
    Route::get('/manufacturers', 'API\ShipController@getAllManufacturers');
    Route::post('/logout', 'API\RegisterController@logOut');
    Route::post('/logincheck', 'API\RegisterController@loginCheck');
  });
});
