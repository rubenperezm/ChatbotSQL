@extends('layouts.app')
@section('content')
<div class="container-fluid" style="background-color: #ece8e8;">
  <div class="card mt-4 mb-4" style="width:90%;margin:auto;background-color: white;">
    <div class="card-body">
      <h5 class="card-title" style="font-weight: bold;border-bottom: 1px solid #5aaf70; padding-bottom: 5px;">Ejercicios</h5>
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="estadistica-tab" style="color:black;" data-toggle="pill" href="#estadistica" role="tab" aria-controls="estadistica" aria-selected="false">Intentos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="intentos-tab" style="color:black;" data-toggle="pill" href="#intentos" role="tab" aria-controls="intentos" aria-selected="true">Estádisticas-ejercicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" style="color:black;"  href="{{ env('APP_URLP') }}/editarEjercicio" role="tab" aria-selected="false">Volver a ver los ejercicios</a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="estadistica" role="tabpanel" aria-labelledby="estadistica-tab">
          <div class="card" style="width:90%;max-height: 700px;margin:auto;overflow-y: scroll;-webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
          -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
          box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.75);
          border-radius: 4px;">
          <div class="card-body">
            <h5 class="card-title" style="    border-bottom: 1px solid #e9ecef !important;    padding-bottom: 5px;">Media de los errores por intento</h5>
            <div class="table-responsive mt-4" style="min-height:86%;" id="container">
              <table class="table table-sm table-striped table-principal"style="color:black;">
                <thead class="thead-dark">
                  <tr>
                    <th class="">Usuario</th>
                    <th class="">Ejercicio</th>
                    <th class="">Solución</th>
                    <th class="">Completado</th>
                    <th class="">Tiempos del intento</th>
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
                      Abandono
                      @else
                      Completado
                      @endif
                    </td>
                    <td>
                      Inicio intento: {{$intento['created_at']}}
                      <br>
                      Última Acción: {{$intento['updated_at']}}
                    </td>
                    <td><a href="{{ env('APP_URLP') }}/editarEjercicio/editar/{{$intentos['ejercicio_id']}}"><i style="color: green;"class="fas fa-edit"></i></a></td>
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
            <div class="card" style="width:90%;max-height: 400px;margin:auto;overflow-y: scroll;-webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
            box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.75);
            border-radius: 4px;">
            <div class="card-body">
              <h5 class="card-title" style="    border-bottom: 1px solid #e9ecef !important;    padding-bottom: 5px;">Abandono por ejercicio</h5>
              <div class="table-responsive mt-4" style="min-height:86%;" id="container">
                <table class="table table-sm table-striped table-principal"style=" color:black;">
                  <thead class="thead-dark">
                    <tr>
                      <th class="">Enunciados</th>
                      <th class="">Solución</th>
                      <th class="">Abandonos</th>
                      <th class=""></th>
                    </tr>
                  </thead>
                  @foreach ($tasaAbandono as $i => $ejercicio)
                  <tbody>
                    <tr>
                      <td>{{$ejercicio['enunciado']}}</td>
                      <td>{{$ejercicio['query']}}</td>
                      <td>{{$ejercicio['media']}}</td>
                      <td><a href="{{ env('APP_URLP') }}/editarEjercicio/editar/{{$ejercicio['id']}}"><i style="color: green;"class="fas fa-edit"></i></a></td>
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
          <div class="card" style="width:90%;max-height: 400px;margin:auto;overflow-y: scroll;-webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
          -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
          box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.75);
          border-radius: 4px;">
          <div class="card-body">
            <h5 class="card-title" style="    border-bottom: 1px solid #e9ecef !important;    padding-bottom: 5px;">Media de las consulta por intento</h5>
            <div class="table-responsive mt-4" style="min-height:86%;" id="container">
              <table class="table table-sm table-striped table-principal"style=" color:black;">
                <thead class="thead-dark">
                  <tr>
                    <th class="">Enunciados</th>
                    <th class="">Solución</th>
                    <th class="">Consultas-media</th>
                    <th class=""></th>
                  </tr>
                </thead>
                @foreach ($mediaCosulta as $i => $ejercicio)
                <tbody>
                  <tr>
                    <td>{{$ejercicio['enunciado']}}</td>
                    <td>{{$ejercicio['query']}}</td>
                    <td>{{$ejercicio['media']}}</td>
                    <td><a href="{{ env('APP_URLP') }}/editarEjercicio/editar/{{$ejercicio['id']}}"><i style="color: green;"class="fas fa-edit"></i></a></td>
                  </tr>
                </tbody>
                @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 m-auto">
        <div class="card" style="width:90%;max-height: 400px;margin:auto;overflow-y: scroll;-webkit-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 12px 3px rgba(0,0,0,0.75);
        box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.75);
        border-radius: 4px;">
        <div class="card-body">
          <h5 class="card-title" style="    border-bottom: 1px solid #e9ecef !important;    padding-bottom: 5px;">Media de los errores por intento</h5>
          <div class="table-responsive mt-4" style="min-height:86%;" id="container">
            <table class="table table-sm table-striped table-principal"style="color:black;">
              <thead class="thead-dark">
                <tr>
                  <th class="">Enunciados</th>
                  <th class="">Solución</th>
                  <th class="">Errores-media</th>
                  <th class=""></th>
                </tr>
              </thead>
              @foreach ($mediaErrores as $i => $ejercicio)
              <tbody>
                <tr>
                  <td>{{$ejercicio['enunciado']}}</td>
                  <td>{{$ejercicio['query']}}</td>
                  <td>{{$ejercicio['media']}}</td>
                  <td><a href="{{ env('APP_URLP') }}/editarEjercicio/editar/{{$ejercicio['id']}}"><i style="color: green;"class="fas fa-edit"></i></a></td>
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
        text: 'INTENTOS POR DÍA',
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
</script>
@endsection
@endsection
