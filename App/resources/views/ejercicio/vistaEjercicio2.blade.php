@extends('layouts.app')
@section('content')
    <div class="col-md-3 p-0" style="background-color: #f5f5f5;">
        <div class="card mt-4 mb-4" style="width:90%;margin:auto;background-color: #e4e4e4;">
          <div class="card-body">
            <h5 class="card-title" style="font-weight: bold;border-bottom: 1px solid #5aaf70; padding-bottom: 5px;">Enunciado</h5>
            <span>{{$enunciado}}</span>
          </div>
        </div>
        <ul class="nav nav-pills mt-2 mb-3" id="pills-tab" style="justify-content: center;"role="tablist">
          <li class="nav-item">
            <a class="nav-link active" style="font-weight: bold; "id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Ejercicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" style="font-weight: bold;" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Tablas</a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="width: 90%;
    margin: auto;">
            <div  style="    background-color: #e4e4e4;
                padding-top: 12px;
    color: black;
    max-height: 450px;
    font-weight: bold;
    margin-top: 1.6rem;
    overflow-y: scroll;">
              @foreach ($ejercicios as $i => $ejercicio)
              <div class="col-md-12">
                <div class="col-md-12">
                  <span class="spanSugerencia" style="color: #006f1d;">{{$i+1}}# </span>
                  <span class="spanSugerencia">{{json_decode($ejercicio->enunciado,true)[0]["texto"]}}</span>
                </div>
                <div class="col-md-12 text-right">
                  <a href="#" data-id="{{$ejercicio->id}}" class="añadirSugerencia" style="color: #006f1d;">Resolver</a>
                </div>
                <div class="col-md-12 m-0 p-0"><hr class="separacionSugerencia m-2" style="    border-top: 2px solid rgb(255, 255, 255);"></div>
              </div>
              @endforeach
            </div>
          </div>
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" style="width: 90%;
    margin: auto;">
            <div  style="    background-color: #e4e4e4;
                padding-top: 12px;
    color: black;
    max-height: 602px;
    font-weight: bold;
    margin-top: 1.6rem;
    overflow-y: scroll;">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia" style="padding-left: 7px;">Artículos</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="{{$ejercicio->id}}" class="añadirSugerencia" style="color: #006f1d;">Ver</a>
                  </div>
                </div>
                <div class="col-md-12 m-0 p-0"><hr class="separacionSugerencia m-2" style="    border-top: 2px solid rgb(255, 255, 255);"></div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia" style="padding-left: 7px;">Clientes</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="{{$ejercicio->id}}" class="añadirSugerencia" style="color: #006f1d;">Ver</a>
                  </div>
                </div>
                <div class="col-md-12 m-0 p-0"><hr class="separacionSugerencia m-2" style="    border-top: 2px solid rgb(255, 255, 255);"></div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia" style="padding-left: 7px;">Pesos</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="{{$ejercicio->id}}" class="añadirSugerencia" style="color: #006f1d;">Ver</a>
                  </div>
                </div>
                <div class="col-md-12 m-0 p-0"><hr class="separacionSugerencia m-2" style="    border-top: 2px solid rgb(255, 255, 255);"></div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia" style="padding-left: 7px;">Proveedores</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="{{$ejercicio->id}}" class="añadirSugerencia" style="color: #006f1d;">Ver</a>
                  </div>
                </div>
                <div class="col-md-12 m-0 p-0"><hr class="separacionSugerencia m-2" style="    border-top: 2px solid rgb(255, 255, 255);"></div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia" style="padding-left: 7px;">Suministro</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="{{$ejercicio->id}}" class="añadirSugerencia" style="color: #006f1d;">Ver</a>
                  </div>
                </div>
                <div class="col-md-12 m-0 p-0"><hr class="separacionSugerencia m-2" style="    border-top: 2px solid rgb(255, 255, 255);"></div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia" style="padding-left: 7px;">TblUsuarios</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="{{$ejercicio->id}}" class="añadirSugerencia" style="color: #006f1d;">Ver</a>
                  </div>
                </div>
                <div class="col-md-12 m-0 p-0"><hr class="separacionSugerencia m-2" style="    border-top: 2px solid rgb(255, 255, 255);"></div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia" style="padding-left: 7px;">Tiendas</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="{{$ejercicio->id}}" class="añadirSugerencia" style="color: #006f1d;">Ver</a>
                  </div>
                </div>
                <div class="col-md-12 m-0 p-0"><hr class="separacionSugerencia m-2" style="    border-top: 2px solid rgb(255, 255, 255);"></div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-8">
                    <span class="spanSugerencia" style="padding-left: 7px;">Ventas</span>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#" data-id="{{$ejercicio->id}}" class="añadirSugerencia" style="color: #006f1d;">Ver</a>
                  </div>
                </div>
                <div class="col-md-12 m-0 p-0"><hr class="separacionSugerencia m-2" style="    border-top: 2px solid rgb(255, 255, 255);"></div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-6 h-100 p-0" style="background-color: #ece8e8;">
      <div class=" mt-4" style="height:35%;">
        <div class="card" style="width:90%;margin:auto;">
          <div class="card-body">
            <div class="col-12 mb-2 px-0" ><textarea name="queryForm" class="form-control" id="formularioQuery"></textarea></div>
            <div class="col-12 mt-2 px-0 text-right">
              <button type="button" style="    background-color: #5aaf70;
    border-color: white;
    border-radius: 7%;font-weight: bold;" class="btn-outline-secondary text-white" name="button" value="query" id="botonQuery" onclick="formularioQuery();"><i class="fas fa-code"></i> EJECUTAR</button>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-3" style="height:50%;">
        <div class="card" style="width:90%;max-height: 400px;margin:auto;overflow-y: scroll;">
          <div class="card-body">
            <h5 class="card-title" style="    border-bottom: 1px solid #e9ecef !important;    padding-bottom: 5px;">Resultado Query</h5>
            <div class="table-responsive mt-4" style="min-height:86%;" id="container">
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
        </div>
      </div>
    </div>
    <div class="col-md-3 p-0" style="">
        <div class="cotainer-fluid  w-100" style="padding-top: 0.3rem;
    background-color: #a0e2b1;
    height: 8%;
    border-bottom: white;
    border-bottom-style: inset;
">
       <div class="fotoIframe" style="width: 25%;
       height: 44.5px;
       justify-content: center;
       float: left;
       display: inline-block;">
           <img  id="fotoAvatar" src="http://localhost/TFG/App/public/imagenes/18.jpg" alt="" style="width: 43px;
    height: 43px;
           display: block;
           margin-left: auto;
           margin-top: 0.3rem;
           margin-right: auto;
           border-radius: 50%;">
       </div>
       <div class="nombreIframe" style="text-align: left;
       width: 60%;
       float: left;
       height: 43.4px;
       display: inline-block;
       font-family: sans-serif !important;">
         <label class="labelNombreBot" style="text-align: left;
         display: inline-block;
         color: black;
         line-height: 1.2;
         font-size: 12px !important;
         margin: 0px;
         font-weight: bold !important;
         padding-top: 13.5px;
         letter-spacing: 0;"><span id="nombreAsistente" style="font-size: 13px;
    font-weight: bold;">Bot Ayuda</span><br>
         <span class="labelDisponibilidadBot" style="font-size: 10px !important;
         margin: 0px;
         margin-bottom: 0px;
         font-weight: normal;">Disponible ahora </span><span class="fuentePunto" style="font-size: 11px;
         color: #12c112;">●</span></label>
       </div>
       <div class="cerrarIframe" style="padding-top: 11px;
       padding-right: 8px;
       width: 10%;
       float: right;
       display: inline-block;">
                   <img id="imgCerrar" style="height: 24px !important;
                   display: block;
                   float: right;
                   cursor: pointer;
                   margin: auto;"   src="http://dev.almaintelligence.com:8888/stylesAndScripts/version2/img/cruz.png">
                 </div>
        </div>
        <div class="cotainer-fluid  w-100" style="background-color: #ccdad0;
    height: 92%;">
          <iframe style="border: none;"class="botEjercicio"id="iframe" src="http://localhost:3000"></iframe>
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
		autofocus: true
});


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
      var query = myCodeMirror.getValue();
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
