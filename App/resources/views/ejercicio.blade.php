@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="mb-4">
                <div class="row">
                  <div class="col-9"><input type="text" name="queryForm"  class="form-control" id="formularioQuery"></div>
                  <div class="col-3"><input class="form-control bg-dark btn-outline-secondary text-white" type="button" value="query" id="botonQuery" onclick="formularioQuery();"></div>
                </div>
            </div>
            <div class="mt-4 h-100" style=" border: 3px solid black;" id="container">
              <table class="table table-sm table-striped table-principal"style="text-align:center;">
                <thead class="thead-dark">
                  <tr id="queryContainer">
                  </tr>
                </thead>
                <tbody id="elementos">
                </tbody>
              </table>
            </div>
        </div>
        <div class="col-md-5">
            <div class="cotainer-fluid  w-100" style="height: 700px;">
              <iframe class="botEjercicio"id="iframe" src="http://localhost:3000"></iframe>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>

    window.onload=function() {
      var EjercicioBot = document.getElementById("iframe").contentWindow;
      EjercicioBot.postMessage("ejercicio "+<?php echo $id;?>+" laravel", "http://localhost:3000");
    }


    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    function formularioQuery(){
      var query = $('#formularioQuery').val();
      $.ajax({
          type:'POST',
          url:'./ajaxFormularioQuery',
          data:{query:query},
          dataType: 'json',
          success:function(data){
            $("#queryContainer").html("");
            $("#elementos").html("");
            console.log(data)
            if(typeof data[0]['query'] === 'string'){
              console.log(data[0]['conversacionBot']);
              var EjercicioBot = document.getElementById("iframe").contentWindow;
              EjercicioBot.postMessage(data[0]['conversacionBot'], "http://localhost:3000");
              $("#queryContainer").append(data[0]['query']);
            }
            else{
              console.log(data[0]);
              var keys = Object.keys(data[0]['query'][0]);
              $.each(keys, function (index, value) {
                $("#queryContainer").append("<th>"+value+"</th>");
              });
              $.each(data[0]['query'], function (i, fila) {
                $("#elementos").append("<tr>");
                $.each(fila, function (j, campo) {
                  $("#elementos").append("<td>"+campo+"</td>");
                });
              });
              var arrayBot = new Array();
              arrayBot[0] = data[0]['lugarConversacion'];
              arrayBot[1] = data[0]['conversacionBot'];
              console.log(arrayBot)
              var EjercicioBot = document.getElementById("iframe").contentWindow;
              EjercicioBot.postMessage(arrayBot, "http://localhost:3000");

            }
          }
      });
    }
</script>
@endsection
@endsection
