@extends('layouts.app')
@section('content')
<div class="row h-100">
    <div class="col-md-8 h-100 p-0" style="background-color: #171717;">
        <div class="mb-4" style="height:10%;">
            <div class="row p-4">
              <div class="col-9"><input type="text" name="queryForm"  class="form-control" id="formularioQuery"></div>
              <div class="col-3"><input style="background-color: #00B4A0;"class="form-control btn-outline-secondary text-white" type="button" value="query" id="botonQuery" onclick="formularioQuery();"></div>
            </div>
        </div>
        <div class="table-responsive mt-4" style="min-height:86%;" id="container">
          <table class="table table-sm table-striped table-principal"style="text-align:center; color:white;">
            <thead>
              <tr id="queryContainer">
              </tr>
            </thead>
            <tbody id="elementos">
            </tbody>
          </table>
        </div>
    </div>
    <div class="col-md-4 p-0" style="border-left-style: inset; border-left-color: #00B4A0;">
        <div class="cotainer-fluid  w-100" style="padding-top: 1rem;
    background-color: #252525;
    height: 10%;
    color: #37e1bbcf;
    text-align: center;
    font-size: 1.3rem;
">
          <p> {{$enunciado}}</p>
        </div>
        <div class="cotainer-fluid  w-100" style="background-color: #252525; height:90%">
          <iframe style="border: none;"class="botEjercicio"id="iframe" src="http://localhost:3000"></iframe>
        </div>
    </div>
</div>
@section('scripts')
<script>

    window.onload=function() {
      var arrayInicio = new Array();
      arrayInicio[0] = "ejercicio basico laravel";
      arrayInicio[1] = <?php echo $id;?>;
      var EjercicioBot = document.getElementById("iframe").contentWindow;
      EjercicioBot.postMessage(arrayInicio , "http://localhost:3000");
    }


    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    function formularioQuery(){
      var query = $('#formularioQuery').val();
      var id =  <?php echo $id ?>;
      $.ajax({
          type:'POST',
          url:'./ajaxFormularioQuery',
          data:{query:query,id:id},
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
              arrayBot[2] = data[1];
              arrayBot[3] = <?php echo $id;?>;
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
