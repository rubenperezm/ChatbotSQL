@extends('layouts.app')
@section('content')
<div class="container-fluid">
  <div class="col-12">
    <iframe class="w-100" src="http://localhost/phpMyAdmin" style="height:700px;"></iframe>
    <form action="{{action('editarEjercicioController@crearJsonEjercicio')}}" method="get" class="mt-3 mb-3 text-center">
      <div class="row" style="padding-bottom: 2rem;">
        <div class="col-5">
          <div class="form-group">
            <label>Enunciado del ejercicio</label>
            <input type="text" name="enunciado" class="form-control" required>
            {!!$errors->first('enunciado','<small class="errores">:message</small>')!!}
          </div>
          <div class="form-group">
            <label>Query de la solución</label>
            <div class="row">
              <div class="col-9"><input id="query" type="text" name="query" class="form-control" required>
              {!!$errors->first('query','<small class="errores">:message</small>')!!}
              </div>
              <div class="col-3"><input class="form-control bg-dark btn-outline-secondary text-white" type="button" value="query" id="botonQuery" onclick="formularioQuery();"></div>
            </div>
          </div>
        </div>
        <div class="col-6 offset-sm-1 mt-4 h-100" style=" border: 3px solid black;" id="container">
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
      <div class="row d-none" id="cuerpoEnvio"style="padding-top: 2rem;">
        <div class="col-sm-6">
          <div class="form-group d-none" id="showEnun">
            <label>Enunciado de la cláusula show</label>
            <input type="text" id="showEnunciado" name="showEnunciado" class="form-control" >
            {!!$errors->first('enunciado','<small class="errores">:message</small>')!!}
          </div>
          <div class="form-group d-none" id="describeEnun">
            <label>Enunciado de la cláusula desribe</label>
            <input type="text" id="describeEnunciado" name="describeEnunciado" class="form-control" >
            {!!$errors->first('enunciado','<small class="errores">:message</small>')!!}
          </div>
          <div class="form-group d-none" id="selectEnun">
            <label>Enunciado de la cláusula select</label>
            <input type="text" id="selectEnunciado" name="selectEnunciado" class="form-control" >
            {!!$errors->first('query','<small class="errores">:message</small>')!!}
          </div>
          <div class="form-group d-none" id="whereEnun">
            <label>Enunciado de la cláusula where</label>
            <input type="text" id="whereEnunciado" name="whereEnunciado" class="form-control" >
            {!!$errors->first('query','<small class="errores">:message</small>')!!}
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group d-none" id="showPistas">
            <label>Pista de la cláusula show</label>
            <input type="text" id="showPista" name="showPista" class="form-control" >
            {!!$errors->first('enunciado','<small class="errores">:message</small>')!!}
          </div>
          <div class="form-group d-none" id="describePistas">
            <label>Pista de la cláusula desribe</label>
            <input type="text" id="describePista" name="describePista" class="form-control" >
            {!!$errors->first('enunciado','<small class="errores">:message</small>')!!}
          </div>
          <div class="form-group d-none" id="selectPistas">
            <label>Pista de la cláusula select</label>
            <input type="text" id="selectPista" name="selectPista" class="form-control" >
            {!!$errors->first('query','<small class="errores">:message</small>')!!}
          </div>
          <div class="form-group d-none" id="wherePistas">
            <label>Pista de la cláusula where</label>
            <input type="text" id="wherePista" name="wherePista" class="form-control" >
            {!!$errors->first('query','<small class="errores">:message</small>')!!}
          </div>
        </div>
      </div>
      <div class="row d-none" id="formEnvio">
        <div class="col-12">
          <div class="form-group">
            <input type="submit" class="btn btn-dark col-2 mt-3">
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@section('scripts')
<script>
$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
function formularioQuery(){
  var query = $('#query').val();
  $.ajax({
      type:'POST',
      url:'./ajaxValidaQuery',
      data:{query:query},
      dataType: 'json',
      success:function(data){
        $("#queryContainer").html("");
        $("#elementos").html("");

        $('#formEnvio').addClass("d-none");
        $('#cuerpoEnvio').addClass("d-none");

        $('#showEnun').addClass("d-none");
        $('#showEnunciado').val("");
        $('#showEnunciado').prop('required',false);
        $('#showPistas').addClass("d-none");
        $('#showPista').val("");
        $('#showPista').prop('required',false);

        $('#describeEnun').addClass("d-none");
        $('#describeEnunciado').val("");
        $('#describeEnunciado').prop('required',false);
        $('#describePistas').addClass("d-none");
        $('#describePista').val("");
        $('#describePista').prop('required',false);

        $('#selectEnun').addClass("d-none");
        $('#selectEnunciado').val("");
        $('#selectEnunciado').prop('required',false);
        $('#selectPistas').addClass("d-none");
        $('#selectPista').val("");
        $('#selectPista').prop('required',false);


        $('#whereEnun').addClass("d-none");
        $('#whereEnunciado').val("");
        $('#whereEnunciado').prop('required',false);
        $('#wherePistas').addClass("d-none");
        $('#wherePista').val("");
        $('#wherePista').prop('required',false);

        console.log(data)
        if(typeof data[0]['query'] === 'string'){
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

          $('#formEnvio').removeClass("d-none");
          $('#cuerpoEnvio').removeClass("d-none");

          switch (data[0]['clausula']) {
            case 'show':
              $('#showEnun').removeClass("d-none");
              $('#showEnunciado').val("Escribe la consulta necesaria para mostrar las diferentes tablas en nuestra base dato, e identificar la que estamos buscando");
              $('#showEnunciado').prop('required',true);
              $('#showPistas').removeClass("d-none");
              $('#showPista').prop('required',true);
              $('#showPista').val("Debes escribir la consulta show seguido de tables para ver todas las tablas de la base de datos");
              break;
            case 'describe':
              $('#showEnun').removeClass("d-none");
              $('#showEnunciado').val("Escribe la consulta necesaria para mostrar las diferentes tablas en nuestra base dato, e identificar la que estamos buscando");
              $('#showEnunciado').prop('required',true);
              $('#showPistas').removeClass("d-none");
              $('#showPista').prop('required',true);
              $('#showPista').val("Debes escribir la consulta show seguido de tables para ver todas las tablas de la base de datos");

              $('#describeEnun').removeClass("d-none");
              $('#describeEnunciado').val("Ahora que sabemos las tablas de las que se componen nuestra base datos, tienes que ver como esta compuesta la tabla que buscamos");
              $('#describeEnunciado').prop('required',true);
              $('#describePistas').removeClass("d-none");
              $('#describePista').prop('required',true);
              $('#describePista').val("debes usar la clausula describe para conocer los campos de la tabla que buscas");
              break;

            case 'select':
              $('#showEnun').removeClass("d-none");
              $('#showEnunciado').val("Escribe la consulta necesaria para mostrar las diferentes tablas en nuestra base dato, e identificar la que estamos buscando");
              $('#showEnunciado').prop('required',true);
              $('#showPistas').removeClass("d-none");
              $('#showPista').prop('required',true);
              $('#showPista').val("Debes escribir la consulta show seguido de tables para ver todas las tablas de la base de datos");

              $('#describeEnun').removeClass("d-none");
              $('#describeEnunciado').val("Ahora que sabemos las tablas de las que se componen nuestra base datos, tienes que ver como esta compuesta la tabla que buscamos");
              $('#describeEnunciado').prop('required',true);
              $('#describePistas').removeClass("d-none");
              $('#describePista').prop('required',true);
              $('#describePista').val("debes usar la clausula describe para conocer los campos de la tabla que buscas");

              $('#selectEnun').removeClass("d-none");
              $('#selectEnunciado').val("Ahora que conocemos los campos de los que se componen nuestra tabla tenemos que escoger aquellos que necesitamos");
              $('#selectEnunciado').prop('required',true);
              $('#selectPistas').removeClass("d-none");
              $('#selectPista').prop('required',true);
              $('#selectPista').val("con la consulta select busca solo aquellos campos que necesites");
              break;
            case 'where':
              $('#showEnun').removeClass("d-none");
              $('#showEnunciado').val("Escribe la consulta necesaria para mostrar las diferentes tablas en nuestra base dato, e identificar la que estamos buscando");
              $('#showEnunciado').prop('required',true);
              $('#showPistas').removeClass("d-none");
              $('#showPista').prop('required',true);
              $('#showPista').val("Debes escribir la consulta show seguido de tables para ver todas las tablas de la base de datos");

              $('#describeEnun').removeClass("d-none");
              $('#describeEnunciado').val("Ahora que sabemos las tablas de las que se componen nuestra base datos, tienes que ver como esta compuesta la tabla que buscamos");
              $('#describeEnunciado').prop('required',true);
              $('#describePistas').removeClass("d-none");
              $('#describePista').prop('required',true);
              $('#describePista').val("debes usar la clausula describe para conocer los campos de la tabla que buscas");

              $('#selectEnun').removeClass("d-none");
              $('#selectEnunciado').val("Ahora que conocemos los campos de los que se componen nuestra tabla tenemos que escoger aquellos que necesitamos");
              $('#selectEnunciado').prop('required',true);
              $('#selectPistas').removeClass("d-none");
              $('#selectPista').prop('required',true);
              $('#selectPista').val("con la consulta select busca solo aquellos campos que necesites");

              $('#whereEnun').removeClass("d-none");
              $('#whereEnunciado').val("Ahora que conocemos los campos de los que se componen nuestra tabla tenemos que escoger aquellos que necesitamos");
              $('#whereEnunciado').prop('required',true);
              $('#wherePistas').removeClass("d-none");
              $('#wherePista').prop('required',true);
              $('#wherePista').val("con la consulta select busca solo aquellos campos que necesites");
              break;
            default:
              console.log('Lo lamentamos, por el momento no disponemos de ' + expr + '.');
          }

        }
      }
  });
}
</script>
@endsection
@endsection
