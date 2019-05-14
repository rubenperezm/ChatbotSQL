@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
      <td><a href="{{ action('EjercicioController@index', ['id' => 1]) }}"> ejericicio 1</a></td>
    </div>
</div>
@endsection
