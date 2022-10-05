@extends('layouts.appAuth')
@section('content')
<div class="overlay" style="    position: absolute;
top: 50%;
position: fixed;
left: 50%;
min-width: 100%;
min-height: 100%;
width: auto;
height: auto;
transform: translateX(-50%) translateY(-50%);
z-index: 0;
background: url('../imagenes/p2.jpg');
"></div>
<div class="adminBlock" style="background: linear-gradient(-90deg,#86d27ced , #265037f2);">
  <div class="col-md-5" style="margin-top:16%;text-align:center;">
    <h1 class="mb-3" style="font-size: 2.5rem;color:white;">¡Sugerencias!</h1>
    <h5 class="mb-4" style="color:white;">Si has tenido alguna incidencia o crees que podemos mejorar en algún apartado, no dudes rellenar el formulario.</h5>
    <button type="button" class="btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
      <a href="{{ env('APP_URLP') }}/admin/administracion" data-toggle="tooltip" data-placement="top" title="menu">
      <i class="fas fa-bars"></i> Menu principal
      </a>
    </button>
  </div>
  <div class="col-md-7"  style="justify-content:center;">
    <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSfo_qehHurhJdtihfs546DWXxRmAPibiAEvB6m9YzaYNGcffA/viewform?embedded=true" style="height: 90%; width: 100%;
  margin-top: 2rem;
  " frameborder="0" marginheight="0" marginwidth="0">Cargando…</iframe>
  </div>
</div>
@section('scripts')
<script>

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


setTimeout(function(){
  $('.adminBlock').addClass("activeAdminBlock");
} , 1000);

</script>
@endsection
@endsection
