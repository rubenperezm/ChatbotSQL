@extends('layouts.app')
@section('content')
<div class="container-fluid temaApp">
  <div class="card mt-4 mb-4" style="width:90%;margin:auto;background-color: white;">
    <div class="card-body">
      <h5 class="card-title" style="font-weight: bold;border-bottom: 1px solid #5aaf70; padding-bottom: 5px;">Stats - Exercises</h5>
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">  
        <li class="nav-item" style="margin-left: 5%">
          <a class="nav-link active" id="estadistica-tab" style="color:black;" data-toggle="pill" href="#estadistica" role="tab" aria-controls="estadistica" aria-selected="false">Logs</a>
        </li>
        <li class="nav-item mr-4">
          <a class="nav-link" id="intentos-tab" style="color:black;" data-toggle="pill" href="#intentos" role="tab" aria-controls="intentos" aria-selected="true">Stats (Exercises)</a>
        </li>
        <li class="nav-item">
          <button type="button" data-toggle="tooltip" data-placement="top" title="Menu" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
            <a href="{{ env('APP_URLP') }}/admin" data-toggle="tooltip" data-placement="top" title="Menu">
              <i class="fas fa-bars"></i> Main Menu
            </a>
          </button>
        </li>
        <li class="nav-item">
          <button type="button" data-toggle="tooltip" data-placement="top" title="Stats (Playground Mode)" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
            <a href="{{ env('APP_URLP') }}/prof/statsPlayground" data-toggle="tooltip" data-placement="top" title="Stats (Playground Mode)">
              <i class="fas fa-chart-line"></i> Stats (PG Mode)
            </a>
          </button>
        </li>
        <li class="nav-item">
          <button type="button" data-toggle="tooltip" data-placement="top" title="Start (Exercises)" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
            <a href="{{ env('APP_URLP') }}/prof/statsExercises" data-toggle="tooltip" data-placement="top" title="Stats (Exercises)">
              <i class="fas fa-chart-line"></i> Stats (Exercises)
            </a>
          </button>
        </li>
        <li class="nav-item">
          <button type="button" data-toggle="tooltip" data-placement="top" title="Exercises" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
            <a href="{{ env('APP_URLP') }}/prof" data-toggle="tooltip" data-placement="top" title="Exercises">
              <i class="fas fa-th-list"></i> Exercises
            </a>
          </button>
        </li>
        <li class="nav-item">
          <button type="button" data-toggle="tooltip" data-placement="top" title="Create exercise" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
            <a href="{{ url('prof/create') }}" data-toggle="tooltip" data-placement="top" title="Create exercise">
              <i class="fas fa-edit"></i> Create exercise
            </a>
          </button>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="estadistica" role="tabpanel" aria-labelledby="estadistica-tab">
          <div class="card temaAppTarjeta mb-4" style="width:90%;max-height: 300px;margin:auto;-webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
          -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
          box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.75);
          border-radius: 4px;">
          <div class="card-body" style="overflow-y: auto">
            <h5 class="card-title" style="    border-bottom: 1px solid #e9ecef !important;    padding-bottom: 5px;">Filters</h5>
            <form id="formBusq" class="form-usuario form-horizontal" autocomplete="off" action="{{ env('APP_URLP') }}/prof/statsExercises" method="get">
              <div class="row form-group col-md-12 mb-2" style="justify-content:center">
                <div class="col-md-3">
                  <label for="nombre" class='font-weight-bold'>Name</label>
                  <input type="text" class="form-control" name="nombre" id='inputName' placeholder="Name" value="">
                </div>
                <div class="col-md-3">
                  <label for="correo" class='font-weight-bold'>Email</label>
                  <input type="text" class="form-control" name="correo" id='inputEmail' placeholder="Email" value="">
                </div>
                <div class="col-md-3">
                  <label for="enunciado" class='font-weight-bold mayuscula'>Exercise</label>
                  <input type="text" class="form-control redondeado" name="enunciado" id='inputEnun' placeholder="Exercise" value="">
                </div>
              </div>
              <div class="row form-group col-md-12 mb-2" style="justify-content:center">
                <div class="col-md-3">
                  <label for="completado" class='font-weight-bold'>Status</label>
                  <select name="completado" id='inputCompl' class="form-control mb-2 ">
                    <option value="0" selected></option>
                    <option value="1">Not solved</option>
                    <option value="2">Solved</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="fechaini" class='font-weight-bold mayuscula'>Start Date</label>
                  <input type="date" class="form-control redondeado" name="fechaInicio" id='inputFechI' value="">
                </div>
                <div class="col-md-3">
                  <label for="fechafin" class='font-weight-bold mayuscula'>End Date</label>
                  <input type="date" class="form-control redondeado" name="fechaFin" id='inputFechF' value="">
                </div>
              </div>
              <div class='col-md-12'>
                <button class='btn botonDegradao float-right' style="color:white;">
                  <i class='fas fa-search'></i> Filter
                </button>
                <button type="button" id="export" data-toggle="tooltip" data-placement="top" title="Download CSV" class="btn botonDegradao float-right mr-2" style="color:white;" name="button2">
                  <a data-href="/prof/tasks" onclick="exportTasks(event.target);" data-toggle="tooltip" data-placement="top" title="Download CSV">
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
                    <th class="">Exercise</th>
                    <th class="">Solution</th>
                    <th class="">Status</th>
                    <th class="">Time</th>
                    <th class=""></th>
                  </tr>
                </thead>
                @foreach ($intentos as $i => $intento)
                <tbody>
                  <tr>
                    <td style="padding-left: 8px">
                      {{$intento['name']}}
                      <br>
                      {{$intento['email']}}
                    </td>
                    <td>{{json_decode($intento['enunciado'],true)[0]["texto"]}}</td>
                    <td>{{$intento['solucionQuery']}}</td>
                    <td>
                      @if($intento['completado'] == 1)
                      Not solved
                      @else
                      Solved
                      @endif
                    </td>
                    <td>
                      Start Time: {{$intento['created_at']}}
                      <br>
                      Last Action: {{$intento['updated_at']}}
                    </td>
                    <td>
                      <a class="verIntento" data-id="{{$intento['id']}}" href="#"><i class="fas fa-comments" style="color: green;"></i></a>
                      <a href="{{ env('APP_URLP') }}/prof/edit/{{$intento['ejercicio_id']}}"><i style="color: green;"class="fas fa-edit"></i></a></td>
                  </tr>
                </tbody>
                @endforeach
              </table>
              <div class="text-center mx-auto">
                {{$intentos->appends($_GET)->links()}}
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="tab-pane fade" id="intentos" role="tabpanel" aria-labelledby="intentos-tab">
        <div class="row mb-4">
          <div class="col-md-6 p-3">
            <canvas id="chartIntentos" style='height: 210px'></canvas>
          </div>
          <div class="col-md-6 m-auto">
            <div class="card temaAppTarjeta" style="width:90%;max-height: 400px;margin:auto;-webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
            box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.75);
            border-radius: 4px;">
            <div class="card-body" style="overflow-y: auto">
              <h5 class="card-title" style="    border-bottom: 1px solid #e9ecef !important;    padding-bottom: 5px;">Dropouts per exercise</h5>
              <div class="table-responsive mt-4" style="min-height:86%;" id="container">
                <table class="table table-sm table-striped table-principal"style=" color:black;">
                  <thead class="thead-dark">
                    <tr>
                      <th class="">Exercise</th>
                      <th class="">Solution</th>
                      <th class="">No. Dropouts</th>
                      <th class=""></th>
                    </tr>
                  </thead>
                  @foreach ($tasaAbandono as $i => $ejercicio)
                  <tbody>
                    <tr>
                      <td>{{$ejercicio['enunciado']}}</td>
                      <td>{{$ejercicio['query']}}</td>
                      <td>{{$ejercicio['media']}}</td>
                      <td><a href="{{ env('APP_URLP') }}/prof/edit/{{$ejercicio['id']}}"><i style="color: green;"class="fas fa-edit"></i></a></td>
                    </tr>
                  </tbody>
                  @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-md-6 m-auto">
          <div class="card temaAppTarjeta" style="width:90%;max-height: 400px;margin:auto;-webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
          -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
          box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.75);
          border-radius: 4px;">
          <div class="card-body" style="overflow-y: auto">
            <h5 class="card-title" style="    border-bottom: 1px solid #e9ecef !important;    padding-bottom: 5px;">Avg. Queries per Exercise</h5>
            <div class="table-responsive mt-4" style="min-height:86%;" id="container">
              <table class="table table-sm table-striped table-principal"style=" color:black;">
                <thead class="thead-dark">
                  <tr>
                    <th class="">Exercise</th>
                    <th class="">Solution</th>
                    <th class="">Avg. Queries</th>
                    <th class=""></th>
                  </tr>
                </thead>
                @foreach ($mediaCosulta as $i => $ejercicio)
                <tbody>
                  <tr>
                    <td>{{$ejercicio['enunciado']}}</td>
                    <td>{{$ejercicio['query']}}</td>
                    <td>{{$ejercicio['media']}}</td>
                    <td>
                      <a href="{{ env('APP_URLP') }}/prof/edit/{{$ejercicio['id']}}"><i style="color: green;"class="fas fa-edit"></i></a></td>
                  </tr>
                </tbody>
                @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 m-auto">
        <div class="card temaAppTarjeta" style="width:90%;max-height: 400px;margin:auto;-webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
        box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.75);
        border-radius: 4px;">
        <div class="card-body" style="overflow-y: auto">
          <h5 class="card-title" style="    border-bottom: 1px solid #e9ecef !important;    padding-bottom: 5px;">Avg. Errors per Exercise</h5>
          <div class="table-responsive mt-4" style="min-height:86%;" id="container">
            <table class="table table-sm table-striped table-principal"style="color:black;">
              <thead class="thead-dark">
                <tr>
                  <th class="">Exercise</th>
                  <th class="">Solution</th>
                  <th class="">Avg. Errors</th>
                  <th class=""></th>
                </tr>
              </thead>
              @foreach ($mediaErrores as $i => $ejercicio)
              <tbody>
                <tr>
                  <td>{{$ejercicio['enunciado']}}</td>
                  <td>{{$ejercicio['query']}}</td>
                  <td>{{$ejercicio['media']}}</td>
                  <td><a href="{{ env('APP_URLP') }}/prof/edit/{{$ejercicio['id']}}"><i style="color: green;"class="fas fa-edit"></i></a></td>
                </tr>
              </tbody>
              @endforeach
            </table>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<script>
$(document).ready(function(){
  Chart.pluginService.register({
    beforeDraw: function (chart, easing) {
      if (chart.config.options.chartArea && chart.config.options.chartArea.backgroundColor) {
        var ctx = chart.chart.ctx;
        var chartArea = chart.chartArea;

        ctx.save();
        ctx.fillStyle = chart.config.options.chartArea.backgroundColor;
        ctx.fillRect(chartArea.left, chartArea.top, chartArea.right - chartArea.left, chartArea.bottom - chartArea.top);
        ctx.restore();
      }
    }
  });

  var config = {
    type: 'line',
    data: {
      labels:<?php echo json_encode($label) ?>,
      borderColor : "#f9f5f4",
      datasets: [{
        data: <?php echo json_encode($data) ?>,
        borderColor: 'rgba(0,23,73,.80)',
        hoverBorderColor : "#000",
        fill: true,
        backgroundColor: 'rgba(124, 165, 255, .7)',
        hoverBackgroundColor: 'rgba(0,23,73,.80)',
        pointBackgroundColor: '#fff',
        pointBorderColor: 'rgba(0,23,73,80)'
      }]
    }, options: {
      title: {
        display: true,
        text: 'ATTEMPTS PER DAY',
        position: 'top',
        fontFamily: 'Roboto',
        fontStyle: 'bold',
        fontSize: 20
      },
      scales: {
        yAxes: [{
          display:true,
          ticks:{
            min : 0,
            max: <?php echo max($data) ?> + (5-(<?php echo max($data) ?> % 5)),
            stepSize : 5,
            fontColor : "#000",
            fontSize : 10
          },
          gridLines:{
            display: true,
            color: "#EEEDEC",
            lineWidth:1,
            zeroLineColor :"#EEEDEC",
          },
          stacked: true
        }],
        xAxes: [{
          ticks:{
            fontColor : "#000",
            fontSize : 10
          },
          gridLines:{
            color: "#fff",
            lineWidth:0
          }
        }]
      },
      responsive: true,
      legend: {
        display: false
      },
      chartArea: {
        backgroundColor: '#f9f5f4'
      }
    }
  };

  var ctx = document.getElementById("chartIntentos").getContext("2d");
  new Chart(ctx, config);
});



$('.verIntento').click(function(){
  var id= $(this).data("id");
  $.ajax({
      type:'get',
      url:'./ajaxExercise',
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
<script>
window.onload = function(event) {
  const urlparams = new URLSearchParams(window.location.search);

  $('#inputName').val(urlparams.get('nombre'));
  $('#inputEmail').val(urlparams.get('correo'));
  $('#inputEnun').val(urlparams.get('enunciado'));
  $('#inputCompl').val(urlparams.get('completado'));
  $('#inputFechI').val(urlparams.get('fechaInicio'));
  $('#inputFechF').val(urlparams.get('fechaFin'));
}

function exportTasks(_this) {
      window.location.href = 'tasks' + window.location.search;
}
</script>
@endsection
@endsection
