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


Route::prefix('exercise')->group(function () {
  Route::get('/{id}', 'EjercicioController@index', function ($id) {});
  Route::Post('ajaxFormQuery', 'EjercicioController@ajaxFormularioQuery');
});


Route::prefix('admin')->group(function () {
  Route::get('/', 'adminController@administracion');
  Route::get('/contact', 'adminController@contacto');
  Route::post('/editProfile', 'adminController@editarPerfil');
});

Route::prefix('playground')->group(function(){
  Route::get('/', 'modoLibreController@index');
  Route::Post('ajaxFormQuery', 'modoLibreController@ajaxFormularioQuery');
});


Route::get('ajaxTable', 'EjercicioController@ajaxVerTabla');
Route::get('tutorial', 'EjercicioController@comprobarTutorial');
Route::get('finished', 'EjercicioController@ejercicioTerminado');

//Url para profesores
Route::get('/prof/delete', 'editarEjercicioController@eliminarEjercicio', function ($id) {});
Route::get('/prof/edit/{id}', 'editarEjercicioController@editar', function ($id) {});
Route::get('/prof', 'editarEjercicioController@index')->middleware(esProfesor::class);
Route::get('/prof/statsExercises', 'editarEjercicioController@estadistica')->middleware(esProfesor::class);
Route::get('/prof/ajaxExercise', 'editarEjercicioController@ajaxMostrarIntento')->middleware(esProfesor::class);
Route::get('/prof/ajaxPlayground', 'editarEjercicioController@ajaxMostrarModoLibre')->middleware(esProfesor::class);
Route::Post('/prof/ajaxValidaQuery', 'editarEjercicioController@ajaxValidaQuery')->middleware(esProfesor::class);
Route::get('/prof/create', 'editarEjercicioController@crear')->middleware(esProfesor::class);
Route::get('/prof/createJsonExercise', 'editarEjercicioController@crearJsonEjercicio')->middleware(esProfesor::class);
Route::get('/prof/statsPlayground', 'editarEjercicioController@estadisticamlibre')->middleware(esProfesor::class);
Route::get('/prof/tasks', 'editarEjercicioController@exportCsv')->middleware(esProfesor::class);;
Route::get('/prof/tasksml', 'editarEjercicioController@exportCsvMl')->middleware(esProfesor::class);;

//
//Auth::routes(['register' => false]); //Dejamos el registro deshabilitado (grupo alumnos cerrado, para abrir a usuarios externos quitar lo que va entre [])
Auth::routes();