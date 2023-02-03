@extends('layouts.app')
@section('content')
<div class="navigation-wrapper">
  <div class="navigation-menu navSide" id="navSide">
    <ul class="listaNav">
      <li class="liNav"><a href="{{ url('admin')}}">Main Menu</a></li>
      <li class="liNav"><a href="{{ url('admin/contact')}}">Contact</a></li>
    </ul>
  </div>
</div>
<div class="col-md-3 p-0" id="bloqueSideBar">
  <div id="bloqueTablass" class="{{!$mostrarTabla ? 'd-none' : ''}}">
    <div id="bloqueTablas" class="pt-15">
      <h5 class="card-title tituloCardEjercicio" >Tables</h5>
      <div class="col-md-12 filaTabla">
        <div class="row">
          <div class="col-8">
            <span class="spanSugerencia pl-7" >Articles</span>
          </div>
          <div class="col-4 text-center">
            <a href="#" data-id="select * from articles" class="filaTablaBd verTabla {{!$mostrarDatosTabla ? 'd-none' : ''}}">
              <i class="fas fa-code"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-12 filaTabla">
        <div class="row">
          <div class="col-8">
            <span class="spanSugerencia pl-7">Customers</span>
          </div>
          <div class="col-4 text-center">
            <a href="#" data-id="select * from customers" class="filaTablaBd verTabla {{!$mostrarDatosTabla ? 'd-none' : ''}}">
              <i class="fas fa-code"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-12 filaTabla">
        <div class="row">
          <div class="col-8">
            <span class="spanSugerencia pl-7">Employees</span>
          </div>
          <div class="col-4 text-center">
            <a href="#" data-id="select * from employees" class="filaTablaBd verTabla {{!$mostrarDatosTabla ? 'd-none' : ''}}">
              <i class="fas fa-code"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-12 filaTabla">
        <div class="row">
          <div class="col-8">
            <span class="spanSugerencia pl-7">Countries</span>
          </div>
          <div class="col-4 text-center">
            <a href="#" data-id="select * from countries" class="filaTablaBd verTabla {{!$mostrarDatosTabla ? 'd-none' : ''}}">
              <i class="fas fa-code"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-12 filaTabla">
        <div class="row">
          <div class="col-8">
            <span class="spanSugerencia pl-7">Weights</span>
          </div>
          <div class="col-4 text-center">
            <a href="#" data-id="select * from weights" class="filaTablaBd verTabla {{!$mostrarDatosTabla ? 'd-none' : ''}}">
              <i class="fas fa-code"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-12 filaTabla">
          <div class="row">
            <div class="col-8">
              <span class="spanSugerencia pl-7">Providers</span>
            </div>
            <div class="col-4 text-center">
              <a href="#" data-id="select * from providers" class="filaTablaBd verTabla {{!$mostrarDatosTabla ? 'd-none' : ''}}">
                <i class="fas fa-code"></i></a>
              </div>
            </div>
          </div>          
              <div class="col-md-12 filaTabla">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia pl-7">Stores</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="select * from stores" class="filaTablaBd verTabla {{!$mostrarDatosTabla ? 'd-none' : ''}}">
                      <i class="fas fa-code"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 filaTabla">
                  <div class="row">
                    <div class="col-8">
                      <span class="spanSugerencia pl-7">Sales</span>
                    </div>
                    <div class="col-4 text-center">
                      <a href="#" data-id="select * from sales" class="filaTablaBd verTabla {{!$mostrarDatosTabla ? 'd-none' : ''}}">
                        <i class="fas fa-code"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <ul class="nav nav-pills mt-4 mb-3 justifyCenterC" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active font-weight-bold" id="ListaEjercicios-tab" data-toggle="pill" href="#ListaEjercicios" role="tab" aria-controls="ListaEjercicios" aria-selected="true">Exercises</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="ranking-tab font-weight-bold" data-toggle="pill" href="#ranking" role="tab" aria-controls="ranking" aria-selected="false">Ranking</a>
                </li>
              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="ListaEjercicios" role="tabpanel" aria-labelledby="ListaEjercicios-tab" style="width: 100%;">
                  <div class="mt-2 mb-4 cardBodyEnun cardEnunciado rounded cardListEjercicios">
                    <div class="card-header cabeceraAdministracion rounded">
                      <h5 class="card-header-title mb-3 text-white">Exercises</h5>
                    </div>
                    <div class="card-body px-0 text-center mb-2 pt-0 filaListaEjercicios" style="height:18rem">
                      <div class="col-md-12 px-0 selectedEjercicio tamañoCardListEjercicios">
                        <div class="col-md-10  px-0">
                          <div class="col-12  text-left">
                            <span class="spanSugerencia">
                              {{json_decode($solucion->enunciado,true)[0]["texto"]}}
                            </span>
                          </div>
                          @if($ejerciciosResuelto != null)
                          @if (in_array($solucion->id, $ejerciciosResuelto))
                          <div class="col-12  text-left">
                            <span  id="solucionBloque" class="completado">Solved - {{$solucion->solucionQuery}}</span>
                          </div>
                          @else
                          <div class="col-12  text-left">
                            <span id="solucionBloque" class="sinCompletar">Not Solved Yet</span>
                          </div>
                          @endif
                          @else
                          <div class="col-12  text-left">
                            <span id="solucionBloque" class="sinCompletar">Not solved yet</span>
                          </div>
                          @endif
                          <div class="col-12 text-left">
                            @switch($solucion->dificultad)
                            @case(1)
                            <span class="dificultadPrincipiante">●</span>
                            <span class="spanDificultadListaEjercicios"> Easy</span>
                            @break

                            @case(2)
                            <span class="dificultadIntermedio">●</span>
                            <span class="spanDificultadListaEjercicios"> Medium</span>
                            @break

                            @case(3)
                            <span class="dificultadAvanzado">●</span>
                            <span class="spanDificultadListaEjercicios"> Hard</span>
                            @break

                            @default
                            Difficulty not defined
                            @endswitch
                          </div>
                        </div>
                        <div class="col-md-2 m-auto">
                          @if(auth()->user()->esProfesor ==  0)
                          @switch($solucion->dificultad)
                          @case(1)
                          <a href="{{ env('APP_URLP') }}/exercise/{{$solucion->id}}" data-id="{{$solucion->id}}" data-toggle="tooltip" data-placement="top" title="Solve exercise"  class="añadirSugerencia permitirAccederEjercicio">
                            <i class="fas fa-laptop-code"></i>
                          </a>
                          @break

                          @case(2)
                          @if($esPrincipiante)
                          <a href="{{ env('APP_URLP') }}/exercise/{{$solucion->id}}" data-toggle="tooltip" data-placement="top" title="Solve exercise"  data-id="{{$solucion->id}}" class="añadirSugerencia permitirAccederEjercicio">
                            <i class="fas fa-laptop-code"></i>
                          </a>
                          @else
                          <a href="#" class="añadirSugerencia intermedioNoPermitir noPermitirAccederEjercicio">
                            <i class="fas fa-lock"></i>
                          </a>
                          @endif
                          @break

                          @case(3)
                          @if($esIntermedio)
                          <a href="{{ env('APP_URLP') }}/exercise/{{$solucion->id}}" data-toggle="tooltip" data-placement="top" title="Solve Exercise" data-id="{{$solucion->id}}" class="añadirSugerencia permitirAccederEjercicio">
                            <i class="fas fa-laptop-code"></i>
                          </a>
                          @else
                          <a href="#" class="añadirSugerencia avanzadoNoPermitir noPermitirAccederEjercicio">
                            <i class="fas fa-lock"></i>
                          </a>
                          @endif
                          @break

                          @default
                          Difficulty not defined
                          @endswitch
                          @else
                          <a href="{{ env('APP_URLP') }}/exercise/{{$solucion->id}}" data-id="{{$solucion->id}}" data-toggle="tooltip" data-placement="top" title="Solve exercise"  class="añadirSugerencia permitirAccederEjercicio">
                            <i class="fas fa-laptop-code"></i>
                          </a>
                          @endif
                        </div>
                      </div>

                      @foreach ($ejercicios as $i => $ejercicio)
                      @if($ejercicio->id != $id)
                      <div class="col-md-12 px-0 tamañoCardListEjercicios">
                        <div class="col-md-10  px-0">
                          <div class="col-12  text-left">
                            <span class="spanSugerencia">
                              {{json_decode($ejercicio->enunciado,true)[0]["texto"]}}
                            </span>
                          </div>
                          @if($ejerciciosResuelto != null)
                          @if (in_array($ejercicio->id, $ejerciciosResuelto))
                          <div class="col-12  text-left">
                            <span class="completadoEjercicio">Solved - {{$ejercicio->solucionQuery}}</span>
                          </div>
                          @else
                          <div class="col-12  text-left">
                            <span class="sinCompletarEjercicio">Not solved yet</span>
                          </div>
                          @endif
                          @else
                          <div class="col-12  text-left">
                            <span class="sinCompletarEjercicio">Not solved yet</span>
                          </div>
                          @endif
                          <div class="col-12 text-left">
                            @switch($ejercicio->dificultad)
                            @case(1)
                            <span class="dificultadPrincipiante">●</span>
                            <span class="spanDificultadListaEjercicios"> Easy</span>
                            @break

                            @case(2)
                            <span class="dificultadIntermedio">●</span>
                            <span class="spanDificultadListaEjercicios"> Medium</span>
                            @break

                            @case(3)
                            <span class="dificultadAvanzado">●</span>
                            <span class="spanDificultadListaEjercicios"> Hard</span>
                            @break

                            @default
                            Difficulty not defined
                            @endswitch
                          </div>
                        </div>
                        <div class="col-md-2 m-auto">
                          @if(auth()->user()->esProfesor ==  0)
                          @switch($ejercicio->dificultad)
                          @case(1)
                          <a href="{{ env('APP_URLP') }}/exercise/{{$ejercicio->id}}" data-id="{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Solve exercise"  class="añadirSugerencia permitirAccederEjercicio">
                            <i class="fas fa-laptop-code"></i>
                          </a>
                          @break

                          @case(2)
                          @if($esPrincipiante)
                          <a href="{{ env('APP_URLP') }}/exercise/{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Solve exercise"  data-id="{{$ejercicio->id}}" class="añadirSugerencia permitirAccederEjercicio">
                            <i class="fas fa-laptop-code"></i>
                          </a>
                          @else
                          <a href="#" class="añadirSugerencia intermedioNoPermitir noPermitirAccederEjercicio">
                            <i class="fas fa-lock"></i>
                          </a>
                          @endif
                          @break

                          @case(3)
                          @if($esIntermedio)
                          <a href="{{ env('APP_URLP') }}/exercise/{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Solve exercise" data-id="{{$ejercicio->id}}" class="añadirSugerencia permitirAccederEjercicio">
                            <i class="fas fa-laptop-code"></i>
                          </a>
                          @else
                          <a href="#" class="añadirSugerencia avanzadoNoPermitir noPermitirAccederEjercicio">
                            <i class="fas fa-lock"></i>
                          </a>
                          @endif
                          @break

                          @default
                          No tiene dificultad
                          @endswitch
                          @else
                          <a href="{{ env('APP_URLP') }}/exercise/{{$ejercicio->id}}" data-id="{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Solve exercise"  class="añadirSugerencia permitirAccederEjercicio">
                            <i class="fas fa-laptop-code"></i>
                          </a>
                          @endif
                        </div>
                      </div>
                      @endif
                      @endforeach
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade cardBodyEnun cardEnunciado rounded cardListEjercicios" id="ranking" role="tabpanel" aria-labelledby="ranking-tab">
                  <div class="card-header col-12 cabeceraAdministracion rounded inLFlex">
                    <div class="col-12">
                      <h5 class="card-header-title mb-3 text-white">Solved by</h5>
                    </div>
                  </div>
                  <div class="card-body text-left mb-2 structRankin filaListaEjercicios" style="overflow-y: auto">
                    @forelse($completados as $i => $completado)
                    <div class="col-md-12 filaTabla">
                      <div class="row">
                        <div class="col-12">
                          <span class="spanSugerencia pl-7"><span class="pr-4 textoRankin">{{$loop->iteration}}</span>  {{$completado->alias}}</span>
                        </div>
                      </div>
                    </div>
                    @empty
                    <div class="col-md-12 filaTabla">
                      <div class="row">
                        <div class="col-12">
                          <span class="spanSugerencia pl-7">Nobody has solved this exercise yet.</span>
                        </div>
                      </div>
                    </div>
                    @endforelse
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 p-0 temaApp" id="bloqueEjercicio">
              <span class="fa-stack fa-2x" id="sideBar">
                <i class="fas fa-circle fa-stack-2x burbujaS"></i>
                <i class="fas fa-bars fa-stack-1x burbujaI"></i>
              </span>
              <div class="mt-4 height-100">
                <div class="mt-2 mb-2 cardBodyEnun cardEnunciado rounded temaAppTarjeta cardListEjerciciosEnun">
                  <div class="card-body text-left mb-2">
                    <p class="card-text text-black pEnunciado">
                      <span class="span-Enunciado">Task to solve:</span> {{$enunciado}}
                    </p>
                  </div>
                </div>
                <div class="card temaAppTarjeta cardBloqueConsulta">
                  <div class="card-body" id="bloqueConsulta">
                    <div class="col-12 mb-2 px-0" ><textarea name="queryForm" class="form-control" id="formularioQuery"></textarea></div>
                      <div class="col-12 mt-2 px-0 text-right">
                        <button type="button" class="btn-outline-secondary botonDegradao text-white" name="button" value="query" id="botonQuery" onclick="formularioQuery();"><i class="fas fa-code"></i> RUN</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mt-2">
                  <div class="card temaAppTarjeta cardBloqueRespuesta" style="overflow-y: auto; overflow-x: auto">
                  <div class="card-body" style="max-height: 20rem">
                    <div class="card-title cardEstructura TituloBloqueRespuesta">
                        <h5 style="display:inline">Result-Set </h5>
                        <span id="nRows"></span>
                    </div>
                    <div class="table-responsive mt-4" style="min-height:86%;overflow-x: visible" id="container">
                      <table class="table table-sm table-striped table-principal tablaRespuesta">
                        <thead>
                          <tr id="queryContainer">
                          </tr>
                        </thead>
                        <tbody id="elementos">
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    <div class="col-md-3 p-0" id="bloqueIframe">
    <div class="cotainer-fluid  w-100 structuraBotHeader">
    <div class="fotoIframe">
    <img  id="fotoAvatar" src="{{ env('APP_URLP') }}/imagenes/botTfg.png" alt="">
  </div>
  <div class="nombreIframe">
  <label class="labelNombreBot">
    <span id="nombreAsistente">Datatron</span>
    <br>
    <span class="labelDisponibilidadBot">Available</span>
    <span class="fuentePunto">●</span>
  </label>
</div>
<div class="cerrarIframe">
  <i id="imgCerrar" class="fas fa-bars fuente-19"></i>
</div>

</div>
<div class="cotainer-fluid  w-100 bloqueChatbot">
  <iframe style="border: none;"class="botEjercicio" id="iframe" src="{{ env('APP_BOT') }}"></iframe>
</div>
</div>

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="ImageModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div>
    </div>
  </div>
</div>

@section('scripts')
<script>

function displayMessage (evt) {
  if(evt.data != ""){
    $('.imagepreview').attr('src', evt.data);
    $('#imagemodal').modal('show');
  }
}

if (window.addEventListener) {
  window.addEventListener("message", displayMessage, false);
}
else {
  window.attachEvent("onmessage", displayMessage);
}

function uuidv4() {
  return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
    (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
  );
}
var uuidIntento = uuidv4();

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


ComprobarTutorial();

function ComprobarTutorial() {
  $.ajax({
    type:'get',
    url:"../tutorial",
    dataType: 'json',
    success:function(data){
      if(data == true){
        $("#bloqueIframe").addClass("opacityTutorial");
        $("#bloqueEjercicio").addClass("opacityTutorial");
        var bloqueTutorial = document.createElement("div");
        bloqueTutorial.className = "cardBodyEnun cardEnunciado rounded bloqueSideTutorial"
        bloqueTutorial.setAttribute("id", "bloqueTutorial");
        document.getElementById("main").appendChild(bloqueTutorial);

        var headerBloqueTutorial = document.createElement("div");
        headerBloqueTutorial.className = "card-header cabeceraAdministracion rounded"
        headerBloqueTutorial.innerHTML = '<h5 class="card-header-title mb-3 text-white">Tutorial - Toma de contacto</h5>';
        document.getElementById("bloqueTutorial").appendChild(headerBloqueTutorial);

        var bodybloqueTutorial = document.createElement("div");
        bodybloqueTutorial.setAttribute("id", "bodybloqueTutorial");
        bodybloqueTutorial.className = "card-body text-center mb-2"
        bodybloqueTutorial.innerHTML = '<p class="card-text text-white" id="parrafoTutorial">Welcome to ChatbotSQL. I\'m going to explain you how this tool works. On the left, you can find all the exercises to solve, and a ranking of other users that have solved this exercise.<div class="col-12 mt-2 px-0 text-right"><button type="button" class="btn-outline-secondary botonDegradao text-white" id="tutorialEjercicio">Next</button></div></p>';
        document.getElementById("bloqueTutorial").appendChild(bodybloqueTutorial);

        $('#tutorialEjercicio').click(function(e) {
          $("#bloqueIframe").addClass("opacityTutorial");
          $("#bloqueEjercicio").removeClass("opacityTutorial");
          $("#bloqueSideBar").addClass("opacityTutorial");
          $("#bloqueTutorial").addClass("bloqueCenterTutorial");
          $("#bodybloqueTutorial").html('<p class="card-text text-white" id="parrafoTutorial">This is the most important part. Here we have to write our queries to solve the exercises. If you run the query, you will see the result-set of that query. In every exercise, our friend Datatron will help us.</p><div class="col-12 mt-2 px-0"><img src="{{ env("APP_URLP") }}/imagenes/fucionamiento.png" alt="" style="width: 450px;"></div><div class="col-12 mt-4 px-0 text-right"><button type="button" class="btn-outline-secondary botonDegradao text-white" onclick="tutorialIframe();">Next</button></div>');
        });
      }
    }
  });
}

function tutorialIframe(){
  $("#bloqueIframe").removeClass("opacityTutorial");
  $("#bloqueEjercicio").addClass("opacityTutorial");
  $("#bloqueSideBar").addClass("opacityTutorial");
  $("#bloqueTutorial").removeClass("bloqueCenterTutorial");
  $("#bloqueTutorial").addClass("bloqueIframeTutorial");
  $("#bodybloqueTutorial").html('<p class="card-text text-white" id="parrafoTutorial">This is Datatron. He will check our queries to give us some feedback. Moreover, if you need help, you can ask him for information or hints. If he\'s not able to help you, don\'t be hard with him, he\'s also learning every day! Try to start a conversation with him: Write "How do I start?" in the box.<div class="col-12 mt-2 px-0 text-right"><button type="button" class="btn-outline-secondary botonDegradao text-white" onclick="cerrarIframeTutorial();">Next</button></div></p>');
};

function cerrarIframeTutorial(){
  $("#bloqueIframe").removeClass("opacityTutorial");
  $("#bloqueEjercicio").removeClass("opacityTutorial");
  $("#bloqueSideBar").removeClass("opacityTutorial");
  $("#bloqueTutorial").addClass("d-none");
};

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


window.addEventListener('click',cerrarMenu, false);
function cerrarMenu(){
  if($("#navSide").hasClass("activeNav")){
    $("#navSide").addClass("removeActiveNav");
  }
}


$('#sideBar').click(function(e) {
  if($("#bloqueSideBar").hasClass("d-none")){
    $("#bloqueEjercicio").removeClass("col-md-9");
    $("#bloqueEjercicio").addClass("col-md-6");
    $("#bloqueSideBar").removeClass("d-none");
  }else{
    $("#bloqueSideBar").addClass("d-none");
    $("#bloqueEjercicio").removeClass("col-md-6");
    $("#bloqueEjercicio").addClass("col-md-9");
  }
});

$('#imgCerrar').click(function(e) {
  $("#navSide").removeClass("removeActiveNav");
  $("#navSide").removeClass("activeNav");
  $("#navSide").addClass("activeNav");
  event.preventDefault();
  event.stopImmediatePropagation();
});


var myCodeMirror = CodeMirror.fromTextArea(document.getElementById('formularioQuery'),{
  mode: "text/x-mysql",
  indentWithTabs: true,
  smartIndent: true,
  lineNumbers: true,
  tabSize:2,
  matchBrackets : true,
  autofocus: true,
  lineWrapping: true
});

$('#bloqueTablass').on('click', '#volverATabla',function() {
  $("#bloqueTablas").removeClass("d-none");
  $("#bloqueTablaRespuesta").remove();
});

$('.verTabla').click(function(e) {
  var consulta = $(this).data('id');
  $.ajax({
    type:'get',
    url:"../ajaxTable",
    data:{consulta:consulta},
    dataType: 'json',
    success:function(data){
      var keys = Object.keys(data[0]);
      $("#bloqueTablas").addClass("d-none");
      $("#bloqueTablaRespuesta").html("");
      string ="<div id='bloqueTablaRespuesta'><div style='position: absolute;right: 5%;text-align: center;background-color: #5aaf70;color: white;z-index: 10;width: 30px;'><i id='volverATabla' style='cursor:pointer;'class='fas fa-undo'></i></div><table class='table table-sm table-striped table-principal'style='text-align:center; color:white;'<thead><tr>"
      //$("#pills-profile").append()
      $.each(keys, function (index, value) {
        string = string +"<th>"+value+"</th>" ;
      });
      string = string + "</tr></thead><tbody>";
      $.each(data, function (i, fila) {
        string = string + "<tr>";
        $.each(fila, function (j, campo) {
          string = string + "<td>"+campo+"</td>";
        });
      });
      $("#bloqueTablass").append(string + "</tbody></table></div>");

    }
  });
});


window.onload=function() {
  var arrayInicio = new Array();
  arrayInicio[0] = "ejercicio basico laravel";
  arrayInicio[1] = <?php echo $id;?>;
  arrayInicio[2] = uuidIntento;
  var EjercicioBot = document.getElementById("iframe").contentWindow;
  EjercicioBot.postMessage(arrayInicio , "{{ env('APP_BOT') }}");
}

function vueltaMenu() {
  window.location.href = "{{ env('APP_URLP') }}/admin";
}

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function ejercicioTerminado(){
  var id =  <?php echo $id ?>;
  $.ajax({
    type:'get',
    url:"{{ env('APP_URLP') }}/finished",
    data:{id:id,uuid:uuidIntento},
    dataType: 'json',
    success:function(data){
      $("#bloqueIframe").addClass("opacityTutorial");
      $("#bloqueEjercicio").addClass("opacityTutorial");
      $("#bloqueTablass").addClass("opacityTutorial");
      document.getElementById("bloqueIframe").style['pointer-events'] = "none";
      document.getElementById("bloqueEjercicio").style['pointer-events'] = "none";
      document.getElementById("bloqueTablass").style['pointer-events'] = "none";
      var BloqueSolucion = document.createElement("div");
      BloqueSolucion.className = "cardBodyEnun cardEnunciado rounded BloqueSolucion"
      BloqueSolucion.setAttribute("id", "BloqueSolucion");
      document.getElementById("main").appendChild(BloqueSolucion);

      var headerBloqueSolucion = document.createElement("div");
      headerBloqueSolucion.className = "card-header cabeceraAdministracion rounded"
      headerBloqueSolucion.innerHTML = '<h5 class="card-header-title mb-3 text-white">Exercise solved</h5>';
      document.getElementById("BloqueSolucion").appendChild(headerBloqueSolucion);

      var bodyBloqueSolucion = document.createElement("div");
      bodyBloqueSolucion.setAttribute("id", "bodyBloqueSolucion");
      bodyBloqueSolucion.className = "card-body pb-0 text-center mb-2"
      bodyBloqueSolucion.innerHTML = '<h5 class="card-text text-white" id="parrafoTutorial">Congratulations! You have solved the exercise.</h5><div class="col-12 mt-4 px-0 text-right"><button type="button" class="btn-outline-secondary botonDegradao text-white" onclick="vueltaMenu()" style="width: 125px;">Main Menu</button></div>';
      document.getElementById("BloqueSolucion").appendChild(bodyBloqueSolucion);
      $('#solucionBloque').html("completado - " + data);
      if($("#solucionBloque").hasClass("sinCompletar")) $('#solucionBloque').removeClass("sinCompletar");
      $('#solucionBloque').addClass("completado");

    }
  });
}

//variable para no permitir dos query con la misma consulta
var queryAnterior = "";
function formularioQuery(){
  var query = myCodeMirror.getValue();
  query = query.replace(/-- .*\n?/g,"");
  query = query.replace(/\/\*.*\*\//g, "");
  query = query.split("\n").join(" ");
  query = query.split("\t").join(" ");
  query = query.trim()
  query = query.replace(/\s+/g, " ");
  var id =  <?php echo $id ?>;
  if(queryAnterior != query && query != ""){
    queryAnterior = query;
    var doc = myCodeMirror.getDoc();
    var line = doc.getLine(doc.lastLine());
    var pos = { line: doc.lastLine()};
    if(!line.endsWith(';')){
      doc.replaceRange(';', pos);
    }
    $.ajax({
      type:'POST',
      url:'./ajaxFormQuery',
      data:{query:query,id:id,uuid:uuidIntento},
      dataType: 'json',
      success:function(data){
        $("#queryContainer").html("");
        $("#elementos").html("");
        if(typeof data[0]['query'] === 'string'){
          if(data[0]['conversacionBot'] === 'securityMess'){
            $("#queryContainer").append(data[0]['query']);
          }else{
            $.toast({
              text: "You have an error in your query", // Text that is to be shown in the toast
              heading: 'Error', // Optional heading to be shown on the toast
              icon: 'error', // Type of toast icon
              showHideTransition: 'plain', // fade, slide or plain
              allowToastClose: true, // Boolean value true or false
              hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
              stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
              position: 'top-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values



              textAlign: 'left',  // Text alignment i.e. left, right or center
              loader: true,  // Whether to show loader or not. True by default
              loaderBg: '#a20101'  // Background color of the toast loader
            });

            var EjercicioBot = document.getElementById("iframe").contentWindow;
            EjercicioBot.postMessage(data[0]['conversacionBot'], "{{ env('APP_BOT') }}");
            $("#queryContainer").append(data[0]['query']);
            $("#nRows").text("");
            
          }
        }
        else{
          if (data[0]['conversacionBot'] === "comprobacion_query laravel") {
            $.toast({
              text: "This is a valid query, but it's not the solution for this exercise", // Text that is to be shown in the toast
              heading: 'Keep going!', // Optional heading to be shown on the toast
              icon: 'warning', // Type of toast icon
              showHideTransition: 'slide', // fade, slide or plain
              allowToastClose: true, // Boolean value true or false
              hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
              stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
              position: 'top-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
              textAlign: 'left',  // Text alignment i.e. left, right or center
              loader: true,  // Whether to show loader or not. True by default
              loaderBg: '#b1611c'  // Background color of the toast loader
            });
          }
          if(Object.entries(data[0]['query']).length !== 0){
            var keys = Object.keys(data[0]['query'][0]);
            $("#nRows").text("(" + Object.entries(data[0]['query']).length + " rows)");
            $.each(keys, function (index, value) {
              $("#queryContainer").append("<th>"+value.toUpperCase()+"</th>");
            });
            $.each(data[0]['query'], function (i, fila) {
              $("#elementos").append("<tr>");
              $.each(fila, function (j, campo) {
                $("#elementos").append("<td>"+campo+"</td>");
              });
            });
          }else{
            $("#queryContainer").append("Empty set");
          }

          if(data[0]['conversacionBot'] === "finalConversacionCorrectolaravel"){
            $.toast({
              text: "Congratulations, you have solved the exercise!", // Text that is to be shown in the toast
              heading: 'Correct!', // Optional heading to be shown on the toast
              icon: 'success', // Type of toast icon
              showHideTransition: 'slide', // fade, slide or plain
              allowToastClose: true, // Boolean value true or false
              hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
              stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
              position: 'top-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
              textAlign: 'left',  // Text alignment i.e. left, right or center
              loader: true,  // Whether to show loader or not. True by default
              loaderBg: '#25b516'  // Background color of the toast loader
            });
            ejercicioTerminado();
            var EjercicioBot = document.getElementById("iframe").contentWindow;
            EjercicioBot.postMessage(data[0]['conversacionBot'], "{{ env('APP_BOT') }}");
          }else{
            if(data[0]['conversacionBot'] !== 'nadaLaravel'){
              var arrayBot = new Array();
              //arrayBot[0] = data[0]['lugarConversacion'];
              arrayBot[1] = data[0]['conversacionBot'];
              arrayBot[2] = data[1];
              arrayBot[3] = <?php echo $id;?>;
              var EjercicioBot = document.getElementById("iframe").contentWindow;
              EjercicioBot.postMessage(arrayBot, "{{ env('APP_BOT') }}");
            }
          }
        }
      }
    });
  }
}
</script>
@endsection
@endsection
