@extends('layouts.appAuth')
@section('content')
<div class="overlay" style="    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background-color: #000000;
    opacity: .7;
    z-index: 1;
    "></div>
<div class="overlay" style="    position: absolute;
top: 50%;
position: fixed;
left: 50%;
min-width: 100%;
min-height: 100%;
width: auto;
height: auto;
transform: translateX(-50%) translateY(-50%);
z-index: 0;
    background: url('imagenes/p2.jpg');
    "></div>
 <div class="masthead" style="position: relative;
    overflow: hidden;
    padding-bottom: 3rem;
    z-index: 2;height: 100%;
    min-height: 0;
    width: 42.5rem;
    padding-bottom: 0;">
   <div class="masthead-bg" style="position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    width: 100%;
    min-height: 35rem;
    height: 100%;
    transform: skewY(4deg);
    transform-origin: bottom right;
    min-height: 0;
    transform: skewX(-8deg);
    transform-origin: top right;
    background: linear-gradient(-90deg, #0f1313, #53714f75);
"></div>
   <div class="container h-100">
     <div class="row h-100">
       <div class="col-12 my-auto">
         <div class="masthead-content text-white py-5 py-md-0" style="padding-left: 3rem;
    padding-right: 10rem;">
           <h1 class="mb-3" style="font-size: 3rem;">Accede a nuestra plataforma!</h1>
           <h4 class="mb-4" style="font-size: 1rem;">Si estás buscando aprender el lenguaje de gestión de Bases de Datos más conocido, esta es tu plataforma. Además, es totalmente <strong>gratuito</strong>. ¡Solo necesitas ganas de aprender y de dedicarle un rato!</h4>
             <form method="POST" action="{{ route('register') }}">
                 @csrf
                 <div class="form-group row">
                   <label for="name" class="col-md-12 col-form-label text-md-left" style="font-weight: bold;
  font-size: 1.1rem;
  text-transform: capitalize;
">Nombre usuario</label>
                     <div class="col-md-11">
                         <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus style="max-height:2rem">

                         @if ($errors->has('name'))
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('name') }}</strong>
                             </span>
                         @endif
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="email" class="col-md-12 col-form-label text-md-left" style="font-weight: bold;
    font-size: 1.1rem;
    text-transform: capitalize;
">Dirección de correo</label>
                     <div class="col-md-11">
                         <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="max-height:2rem">

                         @if ($errors->has('email'))
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('email') }}</strong>
                             </span>
                         @endif
                     </div>
                 </div>

                 <div class="form-group row">
                     <label for="password" class="col-md-12 col-form-label text-md-left" style="font-weight: bold;
    font-size: 1.1rem;
    text-transform: capitalize;
}">Contraseña</label>

                     <div class="col-md-9">
                         <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="current-password" style="max-height:2rem">

                         @if ($errors->has('password'))
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('password') }}</strong>
                             </span>
                         @endif
                     </div>
                 </div>
                 <div class="form-group row">
                   <label for="password-confirm" class="col-md-12 col-form-label text-md-left" style="font-weight: bold;
  font-size: 1.1rem;
  text-transform: capitalize;
}">Confirmar contraseña</label>

                     <div class="col-md-9">
                         <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="max-height:2rem">
                     </div>
                 </div>

                 <div class="form-group row mb-0">
                     <div class="col-md-11">
                         <button type="submit" class="btn btn-primary">
                             Regístrate
                         </button>
                     </div>
                 </div>
             </form>
         </div>
       </div>
     </div>
   </div>
 </div>

 <div class="social-icons" style="    margin: 0;
    position: absolute;
    right: 2.5rem;
    bottom: 2rem;
    z-index: 2;
    width: auto;">
   <ul class="list-unstyled text-center mb-0" style="padding-left: 0;
    list-style: none;">
     <li class="list-unstyled-item" style="display: block;
    margin-left: 0;
    margin-right: 0;
    ">
       <a href="#" style="transition: all .2s ease-in-out;
    font-size: 2rem;
    line-height: 4rem;
    height: 4rem;
    width: 4rem;
    color: white;

">
         <i class="fab fa-twitter"></i>
       </a>
     </li>
     <li class="list-unstyled-item">
       <a href="#" style="transition: all .2s ease-in-out;
    font-size: 2rem;
    line-height: 4rem;
    height: 4rem;
    width: 4rem;
    color: white;
">
         <i class="fab fa-facebook-f"></i>
       </a>
     </li>
     <li class="list-unstyled-item">
       <a href="#" style="transition: all .2s ease-in-out;
    font-size: 2rem;
    line-height: 4rem;
    height: 4rem;
    width: 4rem;
    color: white;
">
         <i class="fab fa-instagram"></i>
       </a>
     </li>
   </ul>
 </div>
@endsection
