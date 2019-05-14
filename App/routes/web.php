<?php

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

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('home')->group(function () {
  Route::get('/', 'HomeController@index');

});

Route::prefix('ejercicio')->group(function () {
  Route::get('/{id}', 'EjercicioController@index', function ($id) {});
  Route::Post('ajaxFormularioQuery', 'EjercicioController@ajaxFormularioQuery');
});
Auth::routes();
