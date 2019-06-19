@extends('layouts.app')
@section('content')
<div class="container row">
  <div class="col-2">
    <a href="{{ action('EjercicioController@index', ['id' => 1]) }}"> Ver ejercicios resueltos</a>
  </div>
  <div class="col-2">
    <a href="{{ action('EjercicioController@index', ['id' => 1]) }}"> ejericicio 1</a>
  </div>
  <div class="col-4 justify-content-center text-center">
    <a href="{{ action('EjercicioController@index', ['id' => 1]) }}"> ejericicio 1</a>
  </div>
  <div class="col-2">
    <a href="{{ action('EjercicioController@index', ['id' => 1]) }}"> ejericicio 1</a></td>
  </div>
  <div class="col-2">
    <a href="{{ action('EjercicioController@index', ['id' => 1]) }}"> Enviar sugerencia o problema</a>
  </div>
</div>
@endsection
