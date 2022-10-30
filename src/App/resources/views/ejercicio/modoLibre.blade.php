@extends('layouts.app')
@section('content')
<div class="navigation-wrapper">
  <div class="navigation-menu navSide" id="navSide">
    <ul class="listaNav">
      <li class="liNav"><a href="{{ url('admin/administracion')}}">Main Menu</a></li>
      <li class="liNav"><a href="{{ url('admin/contacto')}}">Contact</a></li>
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
            <a href="#" data-id="select * from articulos" class="filaTablaBd verTabla {{!$mostrarDatosTabla ? 'd-none' : ''}}">
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
            <a href="#" data-id="select * from clientes" class="filaTablaBd verTabla {{!$mostrarDatosTabla ? 'd-none' : ''}}">
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
            <a href="#" data-id="select * from empleados" class="filaTablaBd verTabla {{!$mostrarDatosTabla ? 'd-none' : ''}}">
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
            <a href="#" data-id="select * from paises" class="filaTablaBd verTabla {{!$mostrarDatosTabla ? 'd-none' : ''}}">
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
            <a href="#" data-id="select * from pesos" class="filaTablaBd verTabla {{!$mostrarDatosTabla ? 'd-none' : ''}}">
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
              <a href="#" data-id="select * from proveedores" class="filaTablaBd verTabla {{!$mostrarDatosTabla ? 'd-none' : ''}}">
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
                    <a href="#" data-id="select * from tiendas" class="filaTablaBd verTabla {{!$mostrarDatosTabla ? 'd-none' : ''}}">
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
                      <a href="#" data-id="select * from ventas" class="filaTablaBd verTabla {{!$mostrarDatosTabla ? 'd-none' : ''}}">
                        <i class="fas fa-code"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--<ul class="nav nav-pills mt-4 mb-3 justifyCenterC" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active font-weight-bold" id="ListaEjercicios-tab" data-toggle="pill" href="#ListaEjercicios" role="tab" aria-controls="ListaEjercicios" aria-selected="true">Ejercicios</a>
                </li>
              </ul>-->
              <div class="tab-content" id="pills-tabContent" style="margin-top: 4rem">
                <div class="tab-pane fade show active" id="ListaEjercicios" role="tabpanel" aria-labelledby="ListaEjercicios-tab" style="width: 100%;">
                  <div class="mt-2 mb-4 cardBodyEnun cardEnunciado rounded cardListEjercicios">
                    <div class="card-header cabeceraAdministracion rounded">
                      <h5 class="card-header-title mb-3 text-white">Exercises</h5>
                    </div>
                    <div class="card-body px-0 text-center mb-2 pt-0 filaListaEjercicios" style="height:18rem">
                      @foreach ($ejercicios as $i => $ejercicio)
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
                          <a href="{{ env('APP_URLP') }}/ejercicio/{{$ejercicio->id}}" data-id="{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Solve exercise"  class="añadirSugerencia permitirAccederEjercicio">
                            <i class="fas fa-laptop-code"></i>
                          </a>
                          @break

                          @case(2)
                          @if($esPrincipiante)
                          <a href="{{ env('APP_URLP') }}/ejercicio/{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Solve exercise"  data-id="{{$ejercicio->id}}" class="añadirSugerencia permitirAccederEjercicio">
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
                          <a href="{{ env('APP_URLP') }}/ejercicio/{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Solve exercise" data-id="{{$ejercicio->id}}" class="añadirSugerencia permitirAccederEjercicio">
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
                          <a href="{{ env('APP_URLP') }}/ejercicio/{{$ejercicio->id}}" data-id="{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Solve exercise"  class="añadirSugerencia permitirAccederEjercicio">
                            <i class="fas fa-laptop-code"></i>
                          </a>
                          @endif
                        </div>
                      </div>
                      @endforeach
                    </div>
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
                      <span class="span-Enunciado">Playground Mode
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
                <div class="mt-2">
                  <div class="card temaAppTarjeta cardBloqueRespuesta" style="overflow-y: auto; overflow-x: auto">
                    <div class="card-body" style="max-height: 21rem">
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
    url:"../ajaxVerTabla",
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
  arrayInicio[0] = "modoLibre laravel";
  arrayInicio[1] = 0;
  arrayInicio[2] = uuidIntento;
  var EjercicioBot = document.getElementById("iframe").contentWindow;
  EjercicioBot.postMessage(arrayInicio , "{{ env('APP_BOT') }}");
}

function vueltaMenu() {
  window.location.href = "{{ env('APP_URLP') }}/admin/administracion";
}

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


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
  var id =  0;
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
      url:'modoLibre/ajaxFormularioQuery',
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
              text: "Parece que tu consulta no es correcta", // Text that is to be shown in the toast
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
          
          if(Object.entries(data[0]['query']).length !== 0){
            var keys = Object.keys(data[0]['query'][0]);
            $("#nRows").text("(" + Object.entries(data[0]['query']).length + " filas)");
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
        }
      }
    });
  }
}
</script>
@endsection
@endsection