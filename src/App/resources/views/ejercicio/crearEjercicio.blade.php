@extends('layouts.app')
@section('content')
<div class="container-fluid temaApp">
  <div class="card mt-4 mb-4" style="width:90%;margin:auto;background-color: white;">
    <div class="card-body">
      <h5 class="card-title" style="font-weight: bold;border-bottom: 1px solid #5aaf70; padding-bottom: 5px;">Tables</h5>
      <div class="col-12 mb-3 float-right" style="margin-right: 5%">
        <button type="button" data-toggle="tooltip" data-placement="top" title="Editar perfil" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a  href="{{ url('prof/create') }}" data-toggle="tooltip" data-placement="top" title="Create exercise">
            <i class="fas fa-edit"></i> Create exercise
          </a>
        </button>
        <button type="button" data-toggle="tooltip" data-placement="top" title="Editar perfil" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a  href="{{ url('prof') }}" data-toggle="tooltip" data-placement="top" title="Exercises">
            <i class="fas fa-th-list"></i> Exercises
          </a>
        </button>
        <button type="button" data-toggle="tooltip" data-placement="top" title="Editar perfil" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a href="{{ env('APP_URLP') }}/prof/statsExercises" data-toggle="tooltip" data-placement="top" title="Stats (Exercises)">
            <i class="fas fa-chart-line"></i> Stats (Exercises)
          </a>
        </button>
        <button type="button" data-toggle="tooltip" data-placement="top" title="intentos modo libre" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a href="{{ env('APP_URLP') }}/prof/statsPlayground" data-toggle="tooltip" data-placement="top" title="Stats (Playground Mode)">
            <i class="fas fa-chart-line"></i> Stats (PG Mode)
          </a>
        </button>
        <button type="button" data-toggle="tooltip" data-placement="top" title="Editar perfil" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a href="{{ env('APP_URLP') }}/admin" data-toggle="tooltip" data-placement="top" title="Menu">
            <i class="fas fa-bars"></i> Main Menu
          </a>
        </button>
      </div>
      <div class="col-12" style="display:inline-flex;">
        <div class="col-4" id="tablas" role="tablist" aria-orientation="vertical">
          <div class="col-9 mt-2 mb-2 botonVerTabla" data-id="select * from customers">Customers</div>
          <div class="col-9 mt-2 mb-2 botonVerTabla" data-id="select * from articles">Articles</div>
          <div class="col-9 mt-2 mb-2 botonVerTabla" data-id="select * from employees">Employees</div>
          <div class="col-9 mt-2 mb-2 botonVerTabla" data-id="select * from countries">Countries</div>
          <div class="col-9 mt-2 mb-2 botonVerTabla" data-id="select * from weights">Weights</div>
          <div class="col-9 mt-2 mb-2 botonVerTabla" data-id="select * from providers">Providers</div>
          <div class="col-9 mt-2 mb-2 botonVerTabla" data-id="select * from stores">Stores</div>
          <div class="col-9 mt-2 mb-2 botonVerTabla" data-id="select * from sales">Sales</div>
        </div>
        <div class="col-8" id="bloqueTablaRespuesta" style="max-height:400px;overflow-y:auto;">

        </div>
      </div>
    </div>
  </div>
  <div class="card mt-4 mb-4" style="width:90%;margin:auto;background-color: white;">
    <div class="card-body">
      <h5 class="card-title" style="font-weight: bold;border-bottom: 1px solid #5aaf70; padding-bottom: 5px;">Create</h5>
      <form action="{{action('editarEjercicioController@crearJsonEjercicio')}}" method="get" class="mt-3 mb-3">
        <div class="col-12 " style="display: inline-flex;padding-bottom: 2rem;">
          <div class="col-5" style="background-color: #f3f3f3;
    border-radius: 5px;">
              <div class="col-12 mb-4 form__group field">
                <input type="input" class="form__field" placeholder="enunciado" name="enunciado" value="<?php if(isset($enunciado[0]["texto"])){echo($enunciado[0]["texto"]);}?>" id='enunciado' required />
                {!!$errors->first('enunciado','<small class="errores">:message</small>')!!}
                <label for="enunciado" class="form__label">Exercise</label>
              </div>
            <div class="form-group">
              <label class="mb-1"style="font-weight:bold;">Solution Query</label>
              <input type="hidden" name="idEjercicio" id="idEjercicio" value="<?php if(isset($id)){echo($id);}?>">
              <input type="hidden" name="query" id="query" value="<?php if(isset($Ejercicio->solucionQuery)){echo($Ejercicio->solucionQuery);}?>">
              <textarea name="queryForm" class="form-control" id="formularioQuery"></textarea>
              <div class="col-12 mb-4 form__group field">
                @if(isset($Ejercicio->dificultad))
                  <select name="dificultad" class="form-control" id="dificultad">
                    <option value="1" {{$Ejercicio->dificultad == 1 ? 'selected' : ''}}>Easy</option>
                    <option value="2" {{$Ejercicio->dificultad == 2 ? 'selected' : ''}}>Medium</option>
                    <option value="3" {{$Ejercicio->dificultad == 3 ? 'selected' : ''}}>Hard</option>
                  </select>
                @else
                  <select name="dificultad" class="form-control" id="dificultad">
                    <option value="1">Easy</option>
                    <option value="2">Medium</option>
                    <option value="3">Hard</option>
                  </select>
                @endif
              </div>
              <div class="col-12 mt-3 px-0 text-right">
                <button type="button" style="    background-color: #5aaf70;
        border-color: white;
        border-radius: 7%;font-weight: bold;" class="btn-outline-secondary text-white" name="button" value="query" id="botonQuery" onclick="formularioQueryCrear();"><i class="fas fa-code"></i> RUN</button>
              </div>
            </div>

          </div>
          <div class="col-7" id="container" style="max-height:400px;overflow-y:auto;">
            <table class="table table-sm table-striped table-principal"style="text-align:center; color:black;">
              <thead>
                <tr id="queryContainer">
                </tr>
              </thead>
              <tbody id="elementos">
              </tbody>
            </table>
          </div>
        </div>
        <div class="row d-none" id="cuerpoEnvio"style="padding-top: 2rem;">
          <div class="col-md-12">
            <h5>Customizing hints:</h5>
            <span><em>Italic</em> :  &lt;em&gt; italic_text &lt;/em&gt;</span>
            <br>
            <span><strong>Bold</strong> :  &lt;strong&gt; bold_text &lt;/strong&gt;</span>
            <br>
            <span><u>Underline</u> :  &lt;u&gt; underlined_text &lt;/u&gt;</span>
            <br>
            <span><span style="color:green;">Colours</span> :  &lt;span sytle="color:#XXXXXX"&gt; coloured_text &lt;/span&gt;</span>
            <br>
            <span>Hyperlink : &lt;a href='url' target='_blank'&gt; hyperlink &lt;/a&gt; </span>
          </div>
          <!--<div class="col-sm-6">
            <div class="col-12 mb-4 form__group field d-none" id="showEnun">
              <input type="input" class="form__field" placeholder="showEnunciado" name="showEnunciado" id='showEnunciado'  />
              {!!$errors->first('showEnunciado','<small class="errores">:message</small>')!!}
              <label for="showEnunciado" class="form__label">Enunciado de la cláusula show</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="describeEnun">
              <input type="input" class="form__field" placeholder="describeEnunciado" name="describeEnunciado" id='describeEnunciado'  />
              {!!$errors->first('describeEnunciado','<small class="errores">:message</small>')!!}
              <label for="describeEnunciado" class="form__label">Enunciado de la cláusula describe</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="selectEnun">
              <input type="input" class="form__field" placeholder="selectEnunciado" name="selectEnunciado" id='selectEnunciado'  />
              {!!$errors->first('describeEnunciado','<small class="errores">:message</small>')!!}
              <label for="selectEnunciado" class="form__label">Enunciado de la cláusula select</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="whereEnun">
              <input type="input" class="form__field" placeholder="whereEnunciado" name="whereEnunciado" id='whereEnunciado'  />
              {!!$errors->first('whereEnunciado','<small class="errores">:message</small>')!!}
              <label for="whereEnunciado" class="form__label">Enunciado de la cláusula where</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="groupEnun">
              <input type="input" class="form__field" placeholder="groupEnunciado" name="groupEnunciado" id='groupEnunciado' />
              {!!$errors->first('groupEnunciado','<small class="errores">:message</small>')!!}
              <label for="groupEnunciado" class="form__label">Enunciado de la cláusula group</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="havingEnun">
              <input type="input" class="form__field" placeholder="havingEnunciado" name="havingEnunciado" id='havingEnunciado' />
              {!!$errors->first('havingEnunciado','<small class="errores">:message</small>')!!}
              <label for="havingEnunciado" class="form__label">Enunciado de la cláusula having</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="orderEnun">
              <input type="input" class="form__field" placeholder="orderEnunciado" name="orderEnunciado" id='orderEnunciado' />
              {!!$errors->first('orderEnunciado','<small class="errores">:message</small>')!!}
              <label for="orderEnunciado" class="form__label">Enunciado de la cláusula order by</label>
            </div>
          </div>-->
          <div class="col-sm-12">
            <div class="col-12 mb-4 form__group field d-none" id="showPistas">
              <input type="input" class="form__field" placeholder="showPista" name="showPista" id='showPista' />
              {!!$errors->first('showPista','<small class="errores">:message</small>')!!}
              <label for="showPista" class="form__label">Hint: Show</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="describePistas">
              <input type="input" class="form__field" placeholder="describePista" name="describePista" id='describePista' />
              {!!$errors->first('describePista','<small class="errores">:message</small>')!!}
              <label for="describePista" class="form__label">Hint: Describe</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="selectPistas">
              <input type="input" class="form__field" placeholder="selectPista" name="selectPista" id='selectPista' />
              {!!$errors->first('selectPista','<small class="errores">:message</small>')!!}
              <label for="selectPista" class="form__label">Hint: Select</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="fromPistas">
              <input type="input" class="form__field" placeholder="fromPista" name="fromPista" id='fromPista' />
              {!!$errors->first('fromPista','<small class="errores">:message</small>')!!}
              <label for="fromPista" class="form__label">Hint: From</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="wherePistas">
              <input type="input" class="form__field" placeholder="wherePista" name="wherePista" id='wherePista' />
              {!!$errors->first('wherePista','<small class="errores">:message</small>')!!}
              <label for="wherePista" class="form__label">Hint: Where</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="groupPistas">
              <input type="input" class="form__field" placeholder="groupPista" name="groupPista" id='groupPista' />
              {!!$errors->first('groupPista','<small class="errores">:message</small>')!!}
              <label for="groupPista" class="form__label">Hint: Group by</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="havingPistas">
              <input type="input" class="form__field" placeholder="havingPista" name="havingPista" id='havingPista' />
              {!!$errors->first('havingPista','<small class="errores">:message</small>')!!}
              <label for="havingPista" class="form__label">Hint: Having</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="orderPistas">
              <input type="input" class="form__field" placeholder="orderPista" name="orderPista" id='orderPista' />
              {!!$errors->first('orderPista','<small class="errores">:message</small>')!!}
              <label for="orderPista" class="form__label">Hint: Order by</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="joinPistas">
              <input type="input" class="form__field" placeholder="joinPista" name="joinPista" id='joinPista' />
              {!!$errors->first('joinPista','<small class="errores">:message</small>')!!}
              <label for="joinPista" class="form__label">Hint: Join</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="unionPistas">
              <input type="input" class="form__field" placeholder="unionPista" name="unionPista" id='unionPista' />
              {!!$errors->first('unionPista','<small class="errores">:message</small>')!!}
              <label for="unionPista" class="form__label">Hint: Union</label>
            </div>
            <div class="col-12 mb-4 form__group field d-none" id="anidadaPistas">
              <input type="input" class="form__field" placeholder="anidadaPista" name="anidadaPista" id='anidadaPista' />
              {!!$errors->first('anidadaPista','<small class="errores">:message</small>')!!}
              <label for="anidadaPista" class="form__label">Hint: Nested Query</label>
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
  <div class="col-12">

  </div>
</div>
@section('scripts')
<script>

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


var value="<?php if(isset($enunciado[0]["texto"])){echo($enunciado[0]["texto"]);}?>"
if (value != ""){
  query = <?php if(isset($query)){echo json_encode($query);} ?>;

  if(Object.entries(query).length !== 0){
    var keys = Object.keys(query[0]);
    $.each(keys, function (index, value) {
      $("#queryContainer").append("<th>"+value+"</th>");
    });
    $.each(query, function (i, fila) {
      $("#elementos").append("<tr>");
      $.each(fila, function (j, campo) {
        $("#elementos").append("<td>"+campo+"</td>");
      });
    });
  }else{
      $("#queryContainer").append("No se ha encontrado ningún registro con estas condiciones");
  }
  $('#formEnvio').removeClass("d-none");
  $('#cuerpoEnvio').removeClass("d-none");

  var existeShow = false;
  var existeDescribe = false;

  clausulas = <?php if(isset($clausulas)){echo json_encode($clausulas);} ?>

  //$('#showEnun').removeClass("d-none");
  //$('#showEnunciado').val("<?php if(isset($enunciado[1]["texto"])){echo($enunciado[1]["texto"]);} ?>");
  //$('#showEnunciado').prop('required',true);
  //$('#showPistas').removeClass("d-none");
  //$('#showPista').prop('required',true);
  //$('#showPista').val("<?php if(isset($ayuda[0]["texto"])){echo($ayuda[0]["texto"]);} ?>");
  $.each(clausulas, function (index, value) {
    switch (value) {
      case "show":
      existeShow = true;
      break;
      case "describe":
      existeDescribe = true;
      //$('#describeEnun').removeClass("d-none");
      //$('#describeEnunciado').val("<?php if(isset($enunciado[2]["texto"])){echo($enunciado[2]["texto"]);} ?>");
      //$('#describeEnunciado').prop('required',true);
      $('#describePistas').removeClass("d-none");
      $('#describePista').prop('required',true);
      $('#describePista').val("<?php if(isset($ayuda[1]["texto"])){echo($ayuda[1]["texto"]);} ?>");
      break;
      case "select":
      //$('#selectEnun').removeClass("d-none");
      //$('#selectEnunciado').val("<?php if(isset($enunciado[3]["texto"])){echo($enunciado[3]["texto"]);} ?>");
      //$('#selectEnunciado').prop('required',true);
      $('#selectPistas').removeClass("d-none");
      $('#selectPista').prop('required',true);
      $('#selectPista').val("<?php if(isset($ayuda[2]["texto"])){echo($ayuda[2]["texto"]);} ?>");
      break;
      case "where":
      //$('#whereEnun').removeClass("d-none");
      //$('#whereEnunciado').val("<?php if(isset($enunciado[4]["texto"])){echo($enunciado[4]["texto"]);} ?>");
      //$('#whereEnunciado').prop('required',true);
      $('#wherePistas').removeClass("d-none");
      $('#wherePista').prop('required',true);
      $('#wherePista').val("<?php if(isset($ayuda[3]["texto"])){echo($ayuda[3]["texto"]);} ?>");
      break;
      case "group by":
      //$('#groupEnun').removeClass("d-none");
      //$('#groupEnunciado').val("<?php if(isset($enunciado[5]["texto"])){echo($enunciado[5]["texto"]);} ?>");
      //$('#groupEnunciado').prop('required',true);
      $('#groupPistas').removeClass("d-none");
      $('#groupPista').prop('required',true);
      $('#groupPista').val("<?php if(isset($ayuda[4]["texto"])){echo($ayuda[4]["texto"]);} ?>");
      break;
      case "having":
      //$('#havingEnun').removeClass("d-none");
      //$('#havingEnunciado').val("<?php if(isset($enunciado[6]["texto"])){echo($enunciado[6]["texto"]);} ?>");
      //$('#havingEnunciado').prop('required',true);
      $('#havingPistas').removeClass("d-none");
      $('#havingPista').prop('required',true);
      $('#havingPista').val("<?php if(isset($ayuda[5]["texto"])){echo($ayuda[5]["texto"]);} ?>");
      break;
      case "order by":
      //$('#orderEnun').removeClass("d-none");
      //$('#orderEnunciado').val("<?php if(isset($enunciado[7]["texto"])){echo($enunciado[7]["texto"]);} ?>");
      //$('#orderEnunciado').prop('required',true);
      $('#orderPistas').removeClass("d-none");
      $('#orderPista').prop('required',true);
      $('#orderPista').val("<?php if(isset($ayuda[6]["texto"])){echo($ayuda[6]["texto"]);} ?>");
      break;
      case "union":
      $('#unionPistas').removeClass("d-none");
      $('#unionPista').prop('required',true);
      $('#unionPista').val("<?php if(isset($ayuda[7]["texto"])){echo($ayuda[7]["texto"]);} ?>");
      break;
      case "anidada":
      $('#anidadaPistas').removeClass("d-none");
      $('#anidadaPista').prop('required',true);
      $('#anidadaPista').val("<?php if(isset($ayuda[8]["texto"])){echo($ayuda[8]["texto"]);} ?>");
      break;
      case "join":
      $('#joinPistas').removeClass("d-none");
      $('#joinPista').prop('required',true);
      $('#joinPista').val("<?php if(isset($ayuda[9]["texto"])){echo($ayuda[9]["texto"]);} ?>");
      break;
      case "from":
      $('#fromPistas').removeClass("d-none");
      $('#fromPista').prop('required',true);
      $('#fromPista').val("<?php if(isset($ayuda[10]["texto"])){echo($ayuda[10]["texto"]);} ?>");
      break;
      default:
    }
  });

  /*if(!existeShow  && !existeDescribe){
    //$('#describeEnun').removeClass("d-none");
    //$('#describeEnunciado').val("<?php if(isset($enunciado[2]["texto"])){echo($enunciado[2]["texto"]);} ?>");
    //$('#describeEnunciado').prop('required',true);
    $('#describePistas').removeClass("d-none");
    $('#describePista').prop('required',true);
    $('#describePista').val("<?php if(isset($ayuda[1]["texto"])){echo($ayuda[1]["texto"]);} ?>");
  }*/

  myCodeMirror.setValue("<?php if(isset($Ejercicio->solucionQuery)){echo($Ejercicio->solucionQuery);} ?>");

}


$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$('.botonVerTabla').click(function(e) {
  $( ".botonVerTablaSelected" ).each(function( i ) {
    $(this).removeClass("botonVerTablaSelected");
  });
  $(this).addClass("botonVerTablaSelected");
  var consulta = $(this).data('id');
  $.ajax({
    type:'get',
    url:"{{ env('APP_URLP') }}/ajaxTable",
    data:{consulta:consulta},
    dataType: 'json',
    success:function(data){
      var keys = Object.keys(data[0]);
      $("#bloqueTablaRespuesta").html("");
      string ="<table class='table table-sm table-striped table-principal'style='text-align:center; color:black;'<thead><tr>"
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
      $("#bloqueTablaRespuesta").append(string + "</tbody></table>");

    }
  });
});


function formularioQueryCrear(){
  var query = myCodeMirror.getValue();
  query = query.split("\n").join(" ");
  query = query.split("\t").join(" ");
  query = query.trim()
  query = query.replace(/\s+/g, " ");
  $("#query").val(query);

  var id = {{$id}};

  if(id != -1){
    url = '../ajaxValidaQuery'
  }else{
    url = './ajaxValidaQuery'
  }

  $.ajax({
      type:'POST',
      url: url,
      data:{query:query},
      dataType: 'json',
      success:function(data){
        $("#queryContainer").html("");
        $("#elementos").html("");

        $('#formEnvio').addClass("d-none");
        $('#cuerpoEnvio').addClass("d-none");

        //$('#showEnun').addClass("d-none");
        //$('#showEnunciado').val("");
        //$('#showEnunciado').prop('required',false);
        $('#showPistas').addClass("d-none");
        $('#showPista').val("");
        $('#showPista').prop('required',false);

        //$('#describeEnun').addClass("d-none");
        //$('#describeEnunciado').val("");
        //$('#describeEnunciado').prop('required',false);
        $('#describePistas').addClass("d-none");
        $('#describePista').val("");
        $('#describePista').prop('required',false);

        //$('#selectEnun').addClass("d-none");
        //$('#selectEnunciado').val("");
        //$('#selectEnunciado').prop('required',false);
        $('#selectPistas').addClass("d-none");
        $('#selectPista').val("");
        $('#selectPista').prop('required',false);


        //$('#whereEnun').addClass("d-none");
        //$('#whereEnunciado').val("");
        //$('#whereEnunciado').prop('required',false);
        $('#wherePistas').addClass("d-none");
        $('#wherePista').val("");
        $('#wherePista').prop('required',false);

        //$('#groupEnun').addClass("d-none");
        //$('#groupEnunciado').val("");
        //$('#groupEnunciado').prop('required',false);
        $('#groupPistas').addClass("d-none");
        $('#groupPista').val("");
        $('#groupPista').prop('required',false);

        //$('#havingEnun').addClass("d-none");
        //$('#havingEnunciado').val("");
        //$('#havingEnunciado').prop('required',false);
        $('#havingPistas').addClass("d-none");
        $('#havingPista').val("");
        $('#havingPista').prop('required',false);

        //$('#orderEnun').addClass("d-none");
        //$('#orderEnunciado').val("");
        //$('#orderEnunciado').prop('required',false);
        $('#orderPistas').addClass("d-none");
        $('#orderPista').val("");
        $('#orderPista').prop('required',false);

        $('#unionPistas').addClass("d-none");
        $('#unionPista').val("");
        $('#unionPista').prop('required',false);

        $('#anidadaPistas').addClass("d-none");
        $('#anidadaPista').val("");
        $('#anidadaPista').prop('required',false);

        $('#joinPistas').addClass("d-none");
        $('#joinPista').val("");
        $('#joinPista').prop('required',false);

        $('#fromPistas').addClass("d-none");
        $('#fromPista').val("");
        $('#fromPista').prop('required',false);

        if(typeof data[0]['query'] === 'string'){
          $("#queryContainer").append(data[0]['query']);
        }
        else{
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

          var existeShow = false;
          var existeDescribe = false;

          //show siempre se muestra
          //$('#showEnun').removeClass("d-none");
          //$('#showEnunciado').val("Escribe la consulta necesaria para mostrar las diferentes tablas en nuestra base dato, e identificar la que estamos buscando");
          //$('#showEnunciado').prop('required',true);
          //$('#showPistas').removeClass("d-none");
          //$('#showPista').prop('required',true);
          //$('#showPista').val("Debes escribir la consulta show seguido de tables para ver todas las tablas de la base de datos");
          $.each(data[0]['clausula'], function (index, value) {
            switch (value) {
              case "show":
              existeShow = true;
              $('#showPistas').removeClass("d-none");
              $('#showPista').prop('required',true);
              $('#showPista').val("To see all the tables, you can run this statement: SHOW TABLES.");
              
              break;
              case "describe":
              existeDescribe = true;
              //$('#describeEnun').removeClass("d-none");
              //$('#describeEnunciado').val("Ahora que sabemos las tablas de las que se componen nuestra base datos, tienes que ver como esta compuesta la tabla que buscamos");
              //$('#describeEnunciado').prop('required',true);
              $('#describePistas').removeClass("d-none");
              $('#describePista').prop('required',true);
              $('#describePista').val("Use DESCRIBE command and the name of a table to show the structure of that table.");
              break;
              case "select":
              //$('#selectEnun').removeClass("d-none");
              //$('#selectEnunciado').val("Ahora que conocemos los campos de los que se componen nuestra tabla tenemos que escoger aquellos que necesitamos");
              //$('#selectEnunciado').prop('required',true);
              $('#selectPistas').removeClass("d-none");
              $('#selectPista').prop('required',true);
              $('#selectPista').val("Use the SELECT statement to select data from the database.");
              break;
              case "where":
              //$('#whereEnun').removeClass("d-none");
              //$('#whereEnunciado').val("Ahora que conocemos los campos de los que se componen nuestra tabla tenemos que escoger aquellos que necesitamos");
              //$('#whereEnunciado').prop('required',true);
              $('#wherePistas').removeClass("d-none");
              $('#wherePista').prop('required',true);
              $('#wherePista').val("You should use the WHERE clause to filter the query.");
              break;
              case "group by":
              //$('#groupEnun').removeClass("d-none");
              //$('#groupEnunciado').val("Ahora necesitas agrupar el resultado");
              //$('#groupEnunciado').prop('required',true);
              $('#groupPistas').removeClass("d-none");
              $('#groupPista').prop('required',true);
              $('#groupPista').val("Consider using 'GROUP BY' to group the rows.");
              break;
              case "having":
              //$('#havingEnun').removeClass("d-none");
              //$('#havingEnunciado').val("Ya lo tienes agrupados ahora necesitas aplicarle un filtro a esas agrupaciones");
              //$('#havingEnunciado').prop('required',true);
              $('#havingPistas').removeClass("d-none");
              $('#havingPista').prop('required',true);
              $('#havingPista').val("You need to use the HAVING clause to filter the results.");
              break;
              case "order by":
              //$('#orderEnun').removeClass("d-none");
              //$('#orderEnunciado').val("Ahora tienes que ordenar el resultado obtenido");
              //$('#orderEnunciado').prop('required',true);
              $('#orderPistas').removeClass("d-none");
              $('#orderPista').prop('required',true);
              $('#orderPista').val("Sort the result-set with the ORDER BY statement.");
              break;
              case "union":
              $('#unionPistas').removeClass("d-none");
              $('#unionPista').prop('required',true);
              $('#unionPista').val("Try to solve this exercise using UNION");
              break;
              case "anidada":
              $('#anidadaPistas').removeClass("d-none");
              $('#anidadaPista').prop('required',true);
              $('#anidadaPista').val("Try to solve this exercise using a nested query.");
              break;
              case "join":
              $('#joinPistas').removeClass("d-none");
              $('#joinPista').prop('required',true);
              $('#joinPista').val("Use the JOIN statement to combine rows from two or more tables.");
              break;
              case "from":
              $('#fromPistas').removeClass("d-none");
              $('#fromPista').prop('required',true);
              $('#fromPista').val("Specify the tables with 'FROM'");
              break;
              default:
              console.log('Lo lamentamos, por el momento no disponemos de ' + expr + '.');
            }
          });
          /*
          if(!existeShow  && !existeDescribe){
            $('#describeEnun').removeClass("d-none");
            $('#describeEnunciado').val("Ahora que sabemos las tablas de las que se componen nuestra base datos, tienes que ver como esta compuesta la tabla que buscamos");
            $('#describeEnunciado').prop('required',true);
            $('#describePistas').removeClass("d-none");
            $('#describePista').prop('required',true);
            $('#describePista').val("Debes usar la clausula describe para conocer los campos de la tabla que buscas");
          }*/
        }
      }
  });
}
</script>
@endsection
@endsection
