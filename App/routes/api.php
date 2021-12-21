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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['cors']], function () {
  //Route::resource('ejercicio', 'EjercicioController');
  Route::get('/apiEjercicio/store','apiEjercicioController@store')->name('store');
  Route::post('/apiEjercicio/storeConversacion/','apiEjercicioController@storeConversacion')->name('storeConversacion');
  Route::get('/apiEjercicio/show/{id}','apiEjercicioController@show')->name('show');
});
