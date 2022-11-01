@extends('layouts.appAuth')
@section('content')
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
background: url('../imagenes/p2.jpg');
"></div>
<div class="adminBlock" style="height: auto; min-height: 100%">
  <div class="col-md-5 m-auto">
    <div style="
    margin: auto;
    width: 90%;
    margin-bottom: 4rem;
    color: white;
"><h1 class="mb-3" style="font-size: 2.5rem;">Welcome @if(auth()->user()->esProfesor ==  1) Professor @endif {{auth()->user()->name}}!</h1>
           <h4 class="mb-4">Here you will find your profile data and the list of available exercises with which you will be able to learn how to solve <strong>SQL</strong> queries, always with my help..</h4>
           @if(auth()->user()->esProfesor ==  1)
           <a href="{{ env('APP_URLP') }}/prof/statsExercises" class="enlaceIcon"data-toggle="tooltip" data-placement="top" title="Stats"><i class="fas fa-chart-line"></i></a>
           <a href="{{ env('APP_URLP') }}/prof" class="enlaceIcon"data-toggle="tooltip" data-placement="top" title="Exercises"><i class="fas fa-th-list"></i></a>
           @endif
           <a href="{{ env('APP_URLP') }}/admin/contact" class="enlaceIcon"data-toggle="tooltip" data-placement="top" title="Contact"><i class="fas fa-envelope"></i></a>
           <a href="https://github.com/rubenperezm/ChatbotSQL" target="_blank" class="enlaceIcon"data-toggle="tooltip" data-placement="top" title="Github Repository"><i class="fab fa-github"></i></a>
           <a class="enlaceIcon infoProyecto" data-toggle="tooltip" data-placement="top" title="Info"><i class="fas fa-info"></i></a>
    </div>
    <div class="mt-4 mb-4 cardBodyEnun cardEnunciado rounded" style="width: 90%;
    margin: auto;
    background-color: #1d1d1d;
    -webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    box-shadow: 1px 1px 9px -1px rgba(86, 84, 84, 0.7)">
      <div class="card-header col-12 cabeceraAdministracion rounded" style="display:inline-flex;">
        <div class="col-6">
          <h5 class="card-header-title mb-3 text-white">My profile </h5>
        </div>
        <div class="col-6 text-right">
          <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                   Logout <i class="fa fa-sign-out-alt"></i>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </div>
      <div class="card-body text-center mb-2">
        <form id="editarPerfil" action="{{asset('admin/editProfile')}}" method="post">
          @csrf
          <div class="col-12 mb-4 form__group field text-left">
            <input type="input" class="form__field text-white" value="{{$usuario->email}}"placeholder="email" name="email" id='email' required/>
            {!!$errors->first('email','<small class="errores" style="color:red;">:message</small>')!!}
            <label for="email" class="form__label">Email</label>
          </div>
          <div class="col-12 mb-4 form__group field text-left">
            <input type="input" class="form__field text-white" value="{{$usuario->name}}"placeholder="nombre" name="nombre" id='nombre' required/>
            {!!$errors->first('nombre','<small class="errores"  style="color:red;">:message</small>')!!}
            <label for="nombre" class="form__label">Username</label>
          </div>
          <div class="col-12 mb-4 form__group field text-left">
            <input type="input" class="form__field text-white" value="{{$usuario->alias}}"placeholder="alias" name="alias" id='alias'/>
            {!!$errors->first('alias','<small class="errores"  style="color:red;">:message</small>')!!}
            <label for="alias" class="form__label">Public Name</label>
          </div>
          <div class="col-12 mt-2 px-0 text-right">
            <button type="button" onclick="
                document.getElementById('editarPerfil').submit();" data-toggle="tooltip" data-placement="top" title="Editar perfil" class="btn-outline-secondary text-white botonDegradao" name="button"><i class="fas fa-edit"></i> Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <div class="col-md-7 m-auto">
  <div class="mt-4 mb-4 cardBodyEnun cardEnunciado rounded" style=" width: 90%;
    margin: auto;
    background-color: #1d1d1d;
    -webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    box-shadow: 1px 1px 9px -1px rgba(86, 84, 84, 0.7)">
      <div class="card-header cabeceraAdministracion rounded">
          <h5 class="card-header-title mb-3 text-white">Playground Mode</h5>
      </div>
      <div class="card-body pt-1 px-0 text-center mb-2" style="overflow-y: auto; max-height: 180px;">
        <div class="col-md-12 px-0" style="display:inline-flex;min-height: 4rem;border-bottom: 2px #3a3a3a;padding-top: 4px;border-bottom-style: solid;">
          <div class="col-md-10  px-0">
            <div class="col-12  text-left">
              <span class="spanSugerencia text-white">Unlimited queries to our database</span>
            </div>
            <div class="col-12  text-left">
              <span style="font-size: 12px;color: #ff8300;">NEW</span>
            </div> 
          </div>
          <div class="col-md-2 m-auto">
            <a href="{{ env('APP_URLP') }}/playground" data-toggle="tooltip" data-placement="top" title="Play" class="añadirSugerencia" style="color: #6ead7f;
font-size: 23px;"><i class="fas fa-laptop-code"></i></a>
        </div>
        </div>
      </div>
    </div>
    <div class="mt-4 mb-4 cardBodyEnun cardEnunciado rounded" style=" width: 90%;
    margin: auto;
    background-color: #1d1d1d;
    -webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    box-shadow: 1px 1px 9px -1px rgba(86, 84, 84, 0.7)">
      <div class="card-header cabeceraAdministracion rounded">
          <h5 class="card-header-title mb-3 text-white">Easy</h5>
      </div>
      <div class="card-body pt-1 px-0 text-center mb-2" style="overflow-y: auto;
max-height: 180px;">
        @foreach ($principiante as $i => $ejercicio)
        <div class="col-md-12 px-0" style="display:inline-flex;border-bottom: 2px #3a3a3a;padding-top: 4px;border-bottom-style: solid;">
          <div class="col-md-10  px-0">
            <div class="col-12  text-left">
              <span class="spanSugerencia text-white">{{json_decode($ejercicio->enunciado,true)[0]["texto"]}}</span>
            </div>
            @if($ejerciciosResuelto != null)
              @if (in_array($ejercicio->id, $ejerciciosResuelto))
              <div class="col-12  text-left">
                <span style="font-size: 12px;color: #13c100;">Solved - {{$ejercicio->solucionQuery}}</span>
              </div>
              @else
              <div class="col-12  text-left">
                  <span style="font-size: 12px;color: #928888;">Not solved yet</span>
              </div>
              @endif
            @else
            <div class="col-12  text-left">
                <span style="font-size: 12px;color: #928888;">Not solved yet</span>
            </div>
            @endif
            <div class="col-12 text-left">
              @switch($ejercicio->dificultad)
                  @case(1)
                  <span style="color:#00b900;">●</span>
                  <span style="font-size: 12px;color: #928888;"> Easy</span>
                      @break

                  @case(2)
                  <span style="color:#ff9816;">●</span>
                  <span style="font-size: 12px;color: #928888;"> Medium</span>
                      @break

                  @case(3)
                  <span style="color:red;">●</span>
                  <span style="font-size: 12px;color: #928888;"> Hard</span>
                      @break

                  @default
                      Difficulty not defined
              @endswitch
             </div>
          </div>
          <div class="col-md-2 m-auto">
            <a href="{{ env('APP_URLP') }}/exercise/{{$ejercicio->id}}" data-id="{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Play" class="añadirSugerencia" style="color: #6ead7f;
font-size: 23px;"><i class="fas fa-laptop-code"></i></a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <div class="mt-4 mb-4 cardBodyEnun cardEnunciado rounded" style="width: 90%;
    margin: auto;
    background-color: #1d1d1d;
    -webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    box-shadow: 1px 1px 9px -1px rgba(86, 84, 84, 0.7)">
      <div class="card-header cabeceraAdministracion rounded">
          <h5 class="card-header-title mb-3 text-white">Medium</h5>
      </div>
      <div class="card-body pt-1 px-0 text-center mb-2" style="overflow-y: auto;
max-height: 180px;">
        @foreach ($intermedios as $i => $ejercicio)
        <div class="col-md-12 px-0" style="display:inline-flex;border-bottom: 2px #3a3a3a;padding-top: 4px;border-bottom-style: solid;">
          <div class="col-md-10  px-0">
            <div class="col-12  text-left">
              <span class="spanSugerencia text-white">{{json_decode($ejercicio->enunciado,true)[0]["texto"]}}</span>
            </div>
            @if($ejerciciosResuelto != null)
              @if (in_array($ejercicio->id, $ejerciciosResuelto))
              <div class="col-12  text-left">
                <span style="font-size: 12px;color: #13c100;">Solved - {{$ejercicio->solucionQuery}}</span>
              </div>
              @else
              <div class="col-12  text-left">
                  <span style="font-size: 12px;color: #928888;">Not solved yet</span>
              </div>
              @endif
            @else
            <div class="col-12  text-left">
                <span style="font-size: 12px;color: #928888;">Not solved yet</span>
            </div>
            @endif
            <div class="col-12 text-left">
              @switch($ejercicio->dificultad)
                  @case(1)
                  <span style="color:#00b900;">●</span>
                  <span style="font-size: 12px;color: #928888;"> Easy</span>
                      @break

                  @case(2)
                  <span style="color:#ff9816;">●</span>
                  <span style="font-size: 12px;color: #928888;"> Medium</span>
                      @break

                  @case(3)
                  <span style="color:red;">●</span>
                  <span style="font-size: 12px;color: #928888;"> Hard</span>
                      @break

                  @default
                      Difficulty not defined
              @endswitch
             </div>
          </div>
          <div class="col-md-2 m-auto">
            @if(auth()->user()->esProfesor ==  0)
              @if($esPrincipiante)
                <a href="{{ env('APP_URLP') }}/exercise/{{$ejercicio->id}}" data-id="{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Play" class="añadirSugerencia" style="color: #6ead7f;
                font-size: 23px;"><i class="fas fa-laptop-code"></i></a>
              @else
                <a href="#" class="añadirSugerencia intermedioNoPermitir" style="color:grey; font-size: 23px;"><i class="fas fa-lock"></i></a>
              @endif
            @else
              <a href="{{ env('APP_URLP') }}/exercise/{{$ejercicio->id}}" data-id="{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Play"  class="añadirSugerencia" style="color: #6ead7f;
              font-size: 23px;"><i class="fas fa-laptop-code"></i></a>
            @endif

          </div>
        </div>
        @endforeach
      </div>
    </div><div class="mt-4 mb-4 cardBodyEnun cardEnunciado rounded" style="width: 90%;
    margin: auto;
    background-color: #1d1d1d;
    -webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
    box-shadow: 1px 1px 9px -1px rgba(86, 84, 84, 0.7)">
      <div class="card-header cabeceraAdministracion rounded">
          <h5 class="card-header-title mb-3 text-white">Hard</h5>
      </div>
      <div class="card-body pt-1 px-0 text-center mb-2" style="overflow-y: auto;
max-height: 180px;">
        @foreach ($avanzao as $i => $ejercicio)
        <div class="col-md-12 px-0" style="display:inline-flex;border-bottom: 2px #3a3a3a;padding-top: 4px;border-bottom-style: solid;">
          <div class="col-md-10  px-0">
            <div class="col-12  text-left">
              <span class="spanSugerencia text-white">{{json_decode($ejercicio->enunciado,true)[0]["texto"]}}</span>
            </div>
            @if($ejerciciosResuelto != null)
              @if (in_array($ejercicio->id, $ejerciciosResuelto))
              <div class="col-12  text-left">
                <span style="font-size: 12px;color: #13c100;">Solved - {{$ejercicio->solucionQuery}}</span>
              </div>
              @else
              <div class="col-12  text-left">
                  <span style="font-size: 12px;color: #928888;">Not solved yet</span>
              </div>
              @endif
            @else
            <div class="col-12  text-left">
                <span style="font-size: 12px;color: #928888;">Not solved yet</span>
            </div>
            @endif
            <div class="col-12 text-left">
              @switch($ejercicio->dificultad)
                  @case(1)
                  <span style="color:#00b900;">●</span>
                  <span style="font-size: 12px;color: #928888;"> Easy</span>
                      @break

                  @case(2)
                  <span style="color:#ff9816;">●</span>
                  <span style="font-size: 12px;color: #928888;"> Medium</span>
                      @break

                  @case(3)
                  <span style="color:red;">●</span>
                  <span style="font-size: 12px;color: #928888;"> Hard</span>
                      @break

                  @default
                      Difficulty not defined
              @endswitch
             </div>
          </div>
          <div class="col-md-2 m-auto">
          @if(auth()->user()->esProfesor ==  0)
            @if($esIntermedio)
              <a href="{{ env('APP_URLP') }}/exercise/{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Play" data-id="{{$ejercicio->id}}" class="añadirSugerencia" style="color: #6ead7f;
              font-size: 23px;"><i class="fas fa-laptop-code"></i></a>
            @else
              <a href="#" class="añadirSugerencia intermedioNoPermitir" style="color:grey; font-size: 23px;"><i class="fas fa-lock"></i></a>
            @endif
          @else
            <a href="{{ env('APP_URLP') }}/exercise/{{$ejercicio->id}}" data-id="{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Play"  class="añadirSugerencia" style="color: #6ead7f;
            font-size: 23px;"><i class="fas fa-laptop-code"></i></a>
          @endif
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<!-- POP UP INFORMACION-->
<div class="modal fade" id="informacion" tabindex="-1" role="dialog" aria-labelledby="informacion" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ChatbotSQL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalConversacionBody">
        <div class="imgs" style="display:flex; justify-content: space-around">
          <img src="/imagenes/GNU.png" alt="By CoreUI - [1], CC BY 4.0, https://commons.wikimedia.org/w/index.php?curid=85767589" width="100" height="100">
          <img src="/imagenes/UCA.png" alt="Logo Universidad de Cádiz" width="250" height="100">
        </div>
        <div class="parrafada" style="text-align: center">
          <br>
          <p>
          This project has been funded in the call of 
          Teaching Innovation of the University of Cádiz 2021/22 “Proyecto 
          de Innovación Docente de la UCA" (code sol-202100203360-tra).<br>
            Participants in this project:<br>
          </p>
          <p>
          <div style= "display:inline-block; justify-content:space-around">
              <ul style="display: flex; padding: 0 0; list-style: none;">
                <li style="width: 250px;">Antonio Balderas</li> 
                <li style="width: 250px;">Andrés Muñoz</li>
                <li style="width: 250px;">Juan Francisco Cabrera</li>
              </ul>
              <ul style="display: flex; padding: 0 0; list-style: none;">
                <li style="width: 250px;">Daniel Mejías</li>
                <li style="width: 250px;">Manuel Palomo</li>
                <li style="width: 250px;">Rubén Pérez</li>
              </ul>
            </div>
          </p>
        </div> 
      </div>
    </div>
  </div>
</div>
@section('scripts')
<script>
$('.infoProyecto').click(function(){
  document.getElementById("informacion").tabIndex = 0;
  $('#informacion').modal();
});


$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


$('.intermedioNoPermitir').click(function(e) {
  Swal.fire({
  icon: 'warning',
  text: 'You must solve all easy exercises before you can solve medium exercises.',
  heightAuto: false
})
});

$('.avanzadoNoPermitir').click(function(e) {
  Swal.fire({
  icon: 'warning',
  text: 'You must solve all medium exercises before you can solve hard exercises.',
  heightAuto: false
})
});

setTimeout(function(){
  $('.adminBlock').addClass("activeAdminBlock");
} , 1000);

</script>
@endsection
@endsection
