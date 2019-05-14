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
      EjercicioBot.postMessage("ejercicio "+<?php echo $id;?>, "http://localhost:3000");
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
            if(typeof data === 'string'){
              $("#queryContainer").append(data);
            }
            else{
              var keys = Object.keys(data[0]);
              $.each(keys, function (index, value) {
                $("#queryContainer").append("<th>"+value+"</th>");
              });
              $.each(data, function (i, fila) {
                $("#elementos").append("<tr>");
                $.each(fila, function (j, campo) {
                  $("#elementos").append("<td>"+campo+"</td>");
                });
              });
            }
          }
      });
    }
</script>
@endsection
@endsection
