@extends('layouts.app')
@section('content')
<div class="container-fluid temaApp">
  <div class="card mt-4 mb-4" style="width:90%;margin:auto;background-color: white;">
    <div class="card-body">
      <h5 class="card-title" style="font-weight: bold;border-bottom: 1px solid #5aaf70; padding-bottom: 5px;">Stats - Playground Mode</h5>
      <div class="col-12 mb-3 float-right" style="margin-right: 5%">
        <button type="button" data-toggle="tooltip" data-placement="top" title="Create exercise" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a  href="{{ url('editarEjercicio/crear') }}" data-toggle="tooltip" data-placement="top" title="Create exercise">
            <i class="fas fa-edit"></i> Create Exercise
          </a>
        </button>
        <button type="button" data-toggle="tooltip" data-placement="top" title="Exercises" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a  href="{{ url('editarEjercicio') }}" data-toggle="tooltip" data-placement="top" title="Exercises">
            <i class="fas fa-th-list"></i> Exercises
          </a>
        </button>
        <button type="button" data-toggle="tooltip" data-placement="top" title="Stats (Exercises)" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a href="{{ env('APP_URLP') }}/editarEjercicio/estadistica" data-toggle="tooltip" data-placement="top" title="Stats (Exercises)">
            <i class="fas fa-chart-line"></i> Stats (Exercises)
          </a>
        </button>
        <button type="button" data-toggle="tooltip" data-placement="top" title="Stats (Playground Mode)" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a href="{{ env('APP_URLP') }}/editarEjercicio/estadisticamlibre" data-toggle="tooltip" data-placement="top" title="Stats (Playground Mode)">
            <i class="fas fa-chart-line"></i> Stats (PG Mode)
          </a>
        </button>
        <button type="button" data-toggle="tooltip" data-placement="top" title="Menu" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a href="{{ env('APP_URLP') }}/admin/administracion" data-toggle="tooltip" data-placement="top" title="Menu">
            <i class="fas fa-bars"></i> Main Menu
          </a>
        </button>
      </div>
      <div class="tab-pane" id="mlibre" role="tabpanel">
        <div class="card temaAppTarjeta mb-4" style="width:90%;max-height: 300px;margin:auto;-webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
        box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.75);
        border-radius: 4px;">
        <div class="card-body" style="overflow-y: auto">
          <h5 class="card-title" style="    border-bottom: 1px solid #e9ecef !important;    padding-bottom: 5px;">Filters</h5>
          <form class="form-usuario form-horizontal" autocomplete="off" action="{{ env('APP_URLP') }}/editarEjercicio/estadisticamlibre" method="get">
            <div class="row form-group col-md-12" style="justify-content: center">
              <div class="col-md-3">
                <label for="nombre" class='font-weight-bold'>Name</label>
                <input type="text" class="form-control" name="nombre" id="inputName" placeholder="Username" value="">
              </div>
              <div class="col-md-3">
                <label for="correo" class='font-weight-bold'>Email</label>
                <input type="text" class="form-control" name="correo" id="inputEmail" placeholder="Email" value="">
              </div>
              <div class="col-md-3">
                <label for="fechaini" class='font-weight-bold mayuscula'>Start Date</label>
                <input type="date" class="form-control redondeado" name="fechaInicio" id="inputFechI" placeholder="dd/mm/aaaa">
              </div>
              <div class="col-md-3">
                <label for="fechafin" class='font-weight-bold mayuscula'>End Date</label>
                <input type="date" class="form-control redondeado" name="fechaFin" id="inputFechF" placeholder="dd/mm/aaaa">
              </div>
            </div>
            <div class='col-md-12'>
              <button class='btn botonDegradao float-right' style="color:white;">
                <i class='fas fa-search'></i> Filter
              </button>
              <button type="button" id="export" data-toggle="tooltip" data-placement="top" title="Download CSV" class="btn botonDegradao float-right mr-2" style="color:white;" name="button2">
                <a data-href="/editarEjercicio/tasksml" onclick="exportTasks(event.target);" data-toggle="tooltip" data-placement="top" title="Download CSV">
                  <i class='fas fa-file-export'></i> Export
                </a>
              </button>
            </div>
          </form>
        </div>
        </div>
        <div class="card temaAppTarjeta" style="width:90%;max-height: 600px;margin:auto;-webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
        box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.75);
        border-radius: 4px;">
        <div class="card-body" style="overflow-y: auto">
          <h5 class="card-title" style="    border-bottom: 1px solid #e9ecef !important;    padding-bottom: 5px;">Logs</h5>
          <div class="table-responsive mt-4" style="min-height:86%;" id="container">
            <table class="table table-sm table-striped table-principal"style="color:black;">
              <thead class="thead-dark">
                <tr>
                  <th class="">User</th>
                  <th class="">Time</th>
                  <th class=""></th>
                </tr>
              </thead>
              @foreach ($intentosML as $i => $intento)
              <tbody>
                <tr>
                  <td style="padding-left: 8px">
                    {{$intento['name']}}
                    <br>
                    {{$intento['email']}}
                  </td>
                  <td>
                    Inicio intento: {{$intento['created_at']}}
                    <br>
                    Última Acción: {{$intento['updated_at']}}
                  </td>
                  <td>
                    <a class="verIntentoML" data-id="{{$intento['id']}}" href="#"><i class="fas fa-comments" style="color: green;"></i></a>
                  </td>
                </tr>
              </tbody>
              @endforeach
            </table>
            <div class="text-center mx-auto">
              {{$intentosML->appends($_GET)->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Pop Up para mostrar DATOS del INTENTO-->
<div class="modal fade" id="modalConversacion" tabindex="-1" role="dialog" aria-labelledby="modalConversacionLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Logs</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body" id="modalConversacionBody" style="display:inline-flex;">
      <div class="col-md-6">
        <div class="col-12 mb-4">
          <h5 class="card-title boderTitle colorGreen">Queries</h5>
          <div class="col-12" id="bloqueConsulta">

          </div>
        </div>
        <div class="col-12 mt-2">
          <h5 class="card-title boderTitle colorGreen">Errors</h5>
          <div class="col-12" id="bloqueErrores">

          </div>

        </div>
      </div>
      <div class="col-md-6">
        <h5 class="card-title boderTitle colorGreen">Conversation</h5>
        <div class="col-12" id="bloqueConversacion">

        </div>
      </div>
    </div>
  </div>
</div>
@section('scripts')
<script>
$('.verIntentoML').click(function(){
  var id= $(this).data("id");
  $.ajax({
      type:'get',
      url:'./ajaxMostrarModoLibre',
      data:{id:id},
      dataType: 'json',
      success:function(data){
        $("#bloqueErrores").html("");
        $("#bloqueConsulta").html("");
        $("#bloqueConversacion").html("");

        if(typeof data.conversacion === 'string'){
            $("#bloqueConversacion").html("<span>"+data.conversacion+"</span>");
        }else{
          $.each(data.conversacion, function (index, value) {
            if(typeof value['mensajeUsuario'] === 'undefined'){
              $("#bloqueConversacion").append("<div align='left' style='color:#46646E;padding: 0.3rem;'>"+value['mensajeWatson']+"</div>");
            }
            else{
              $("#bloqueConversacion").append("<div align='right' style='color:#0096A2;padding: 0.3rem;'>"+value['mensajeUsuario']+"</div>");
            }
          });
        }

        if(typeof data.consultas === 'string'){
              $("#bloqueConsulta").html("<span>"+data.consultas+"</span>");
        }else{
          $.each(data.consultas, function (index, value) {
              $("#bloqueConsulta").append("<div class='boderTitle'>"+value+"</div>");
          });
        }
        if(typeof data.errores === 'string'){
              $("#bloqueErrores").html("<span>"+data.errores+"</span>");
        }else{
          $.each(data.errores, function (index, value) {
              $("#bloqueErrores").append("<div class='boderTitle'>"+value+"</div>");
          });
        }

       $("#modalConversacion").modal();
      }
  });
});
$('.pagination').addClass("justify-content-center");

</script>
</script>
<script>
window.onload = function(event) {
  const urlparams = new URLSearchParams(window.location.search);

  $('#inputName').val(urlparams.get('nombre'));
  $('#inputEmail').val(urlparams.get('correo'));
  $('#inputFechI').val(urlparams.get('fechaInicio'));
  $('#inputFechF').val(urlparams.get('fechaFin'));
}

function exportTasks(_this) {
  window.location.href = 'tasksml' + window.location.search;
}
</script>
@endsection
@endsection
