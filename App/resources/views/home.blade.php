@extends('layouts.app')
@section('content')
<body id="bg-home">
  <nav class="navbar navbar-expand-md bg-header fixed-top p-0">
    <div class="col-md-2 offset-md-10 text-center">
      <ul class="navbar-nav justify-content-end mr-3" style="font-size: 1rem; color: white;">
        <!-- Authentication Links -->
        @auth
        <li class="nav-item dropdown">
          <spam class="nav-link" role="button">
          {{ Auth::user()->name }}
        </spam>
        </li>
        <li class="nav-item">
          <a style="color: white;"class="nav-link menu" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Salir <i class="fa fa-sign-out-alt"></i>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
          </form>
        </li>
        @endauth
      </ul>
    </div>
  </nav>
  <div id="home" class="h-100">
    <div class="textoPresentacion">
      <p style="font-size: 4rem;">Bienvenido {{ Auth::user()->name }}</p>
      <p style="font-size: 17PX;">
        Esta herramienta te ayudara aprender los conocimientos mas basicos del lenguaje de base datos
         mysql y el que podras utilizar en imnumerables ocasiones. Esta herramienta esta acompañada
         de la ayuda de nuestro bot disfruten por su viaje en esta herramienta.Esta herramienta esta acompañada
         de la ayuda de nuestro bot disfruten por su viaje en esta herramienta
      </p>
      <button type="button" class="botonSugerencia" name="button">Enviar sugerencia</button>
    </div>
    <div class="opcionesUsuario row">
      <div class="cajaOpciones col-4">
        <span class="m-auto">Ver ejercicios resueltos</span>
        <a class="m-auto" href="{{ action('EjercicioController@index', ['id' => 1]) }}">
          <i class="iconoHome fas fa-check"></i>
        </a>
      </div>
      <div class="cajaOpciones col-4">
        <span class="m-auto">ejercicio</span>
        <a  class="m-auto" href="{{ action('EjercicioController@index', ['id' => 2]) }}">
          <i class="iconoHome fas fa-check"></i>
        </a>
      </div>
      <div class="cajaOpciones col-3">
        <span class="m-auto">Ajuste</span>
        <a class="m-auto" href="{{ action('EjercicioController@index', ['id' => 3]) }}">
          <i class="iconoHome fas fa-check"></i>
        </a>
      </div>
    </div>
  </div>
</body>
@endsection
