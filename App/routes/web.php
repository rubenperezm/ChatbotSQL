<?php

use App\Http\Middleware\esProfesor;


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

//Url para profesores
Route::get('/editarEjercicio', 'editarEjercicioController@index')->middleware(esProfesor::class);
Route::Post('/editarEjercicio/ajaxValidaQuery', 'editarEjercicioController@ajaxValidaQuery')->middleware(esProfesor::class);
Route::get('/editarEjercicio/crear', 'editarEjercicioController@crear')->middleware(esProfesor::class);
Route::get('/editarEjercicio/crearJsonEjercicio', 'editarEjercicioController@crearJsonEjercicio')->middleware(esProfesor::class);
//
Auth::routes();
