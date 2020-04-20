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
<div class="adminBlock" style="background: linear-gradient(-90deg,#6c7b6ade , #0f1313f2);">
  <div class="col-md-5" style="margin-top:16%;text-align:center;">
    <h1 class="mb-3" style="font-size: 3.5rem;color:white;">¡Bienvenido {{auth()->user()->name}}!</h1>
    <h3 class="mb-4" style="color:white;">Aquí encontrarás tus datos de perfil y la lista de ejercicios disponibles con los que podrás ir aprendiendo ómo resolver una consulta <strong>MySQL</strong>, siempre con mi ayuda</h3>
    <button type="button" onclick="
        document.getElementById('editarPerfil').submit();" data-toggle="tooltip" data-placement="top" title="Editar perfil" class="btn-outline-secondary text-white botonDegradao" name="button"><i class="fas fa-edit"></i> Editar</button>
  </div>
  <div class="col-md-7"  style="justify-content:center;">
    <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSf7B7dUL544R0Xlg5snaf3Rr-MbPuqKYRxrbPmp528Qmz9qKA/viewform?embedded=true" style="height: 90%; width: 100%;
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
