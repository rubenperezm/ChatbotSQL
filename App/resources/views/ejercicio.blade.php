@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="mb-4">
                <div class="row">
                  <div class="col-9"><input type="text" name="queryForm"  class="form-control" id="formularioQuery"></div>
                  <div class="col-3"><input class="form-control bg-dark btn-outline-secondary text-white" type="button" value="query" id="botonQuery" onclick="hola();"></div>
                </div>
            </div>
            <div class="mt-4 h-100" id="hola" style=" border: 3px solid black;">

            </div>
        </div>
        <div class="col-md-5">
            <div class="cotainer-fluid  w-100" style="height: 700px;">

            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    console.log("hols");

    function hola(){
      console.log("hola");
      var query = $('#formularioQuery').val();
      $.ajax({
          type:'POST',
          url:'./ejercicio/ajaxFormularioQuery',
          data:{query:query},
          dataType: 'json',
          success:function(data){
            console.log("afsdsa");
              console.log(data);
          }
      });
    }
    $("#botonQuery").click(function(){
console.log("hola");
    });


</script>
@endsection
@endsection
