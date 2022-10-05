@extends('layouts.app')
@section('content')
<div class="container-fluid temaApp">
  <div class="card mt-4 mb-4" style="width:90%;margin:auto;background-color: white;">
    <div class="card-body">
      <h5 class="card-title" style="font-weight: bold;border-bottom: 1px solid #5aaf70; padding-bottom: 5px;">Ejercicios</h5>
      <div class="col-12 mb-3 float-right" style="margin-right: 5%">
        <button type="button" data-toggle="tooltip" data-placement="top" title="Editar perfil" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a  href="{{ url('editarEjercicio/crear') }}" data-toggle="tooltip" data-placement="top" title="crear ejercicio">
            <i class="fas fa-edit"></i> Crear Ejercicio
          </a>
        </button>
        <button type="button" data-toggle="tooltip" data-placement="top" title="Editar perfil" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a  href="{{ url('editarEjercicio') }}" data-toggle="tooltip" data-placement="top" title="ver ejercicios">
            <i class="fas fa-th-list"></i> Menú Ejercicios
          </a>
        </button>
        <button type="button" data-toggle="tooltip" data-placement="top" title="Editar perfil" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a href="{{ env('APP_URLP') }}/editarEjercicio/estadistica" data-toggle="tooltip" data-placement="top" title="estadísticas ejercicios">
            <i class="fas fa-chart-line"></i> Est. Ejercicios
          </a>
        </button>
        <button type="button" data-toggle="tooltip" data-placement="top" title="intentos modo libre" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a href="{{ env('APP_URLP') }}/editarEjercicio/estadisticamlibre" data-toggle="tooltip" data-placement="top" title="estadísticas modo libre">
            <i class="fas fa-chart-line"></i> Est. Modo Libre
          </a>
        </button>
        <button type="button" data-toggle="tooltip" data-placement="top" title="Editar perfil" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a href="{{ env('APP_URLP') }}/admin/administracion" data-toggle="tooltip" data-placement="top" title="volver al menú">
            <i class="fas fa-bars"></i> Menú Principal
          </a>
        </button>
      </div>
      <div class="row" style="margin-top: 100px;">
        @foreach ($todosEjercicios as $i => $ejercicio)
        <div class="col-md-6 mb-2">
          <div class="col-md-12 pt-2" style="background-color: #eaeaea;
          border-top-right-radius: 10px;
          border-top-left-radius: 10px;">
          <div class="col-12">
            <span style="    font-size: 15px;
            font-weight: bold;">{{json_decode($ejercicio->enunciado,true)[0]["texto"]}}</span>
          </div>
          <div class="col-12">
            <span style="font-size: 12px;
            color: green;">{{$ejercicio['solucionQuery']}} - {{$ejercicio['created_at']}}</span>
          </div>
          <div class="col-12">
            @switch($ejercicio->dificultad)
            @case(1)
            <span style="color:#00b900;">●</span>
            <span style="font-size: 12px;color: #928888;"> Principiante</span>
            @break

            @case(2)
            <span style="color:#ff9816;">●</span>
            <span style="font-size: 12px;color: #928888;"> Intermedio</span>
            @break

            @case(3)
            <span style="color:red;">●</span>
            <span style="font-size: 12px;color: #928888;"> Avanzado</span>
            @break

            @default
            No tiene dificultad
            @endswitch
          </div>
        </div>
        <div class="col-md-12 text-right" style="background-color: #eaeaea;
        border-bottom-right-radius: 10px;
        border-bottom-left-radius: 10px;">
        <a href="{{ env('APP_URLP') }}/ejercicio/{{$ejercicio->id}}" class="m-1" data-id="{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Ejecutar Ejercicio" style="color: #6ead7f;
        font-size: 23px;"><i class="fas fa-laptop-code"></i></a>
        <a href="{{ env('APP_URLP') }}/editarEjercicio/editar/{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Editar ejercicio" class="m-1"><i style="color: green;"class="fas fa-edit"></i></a>
        <i  data-toggle="tooltip" data-placement="top" title="Eliminar ejercicio" class="fas fa-trash-alt borrarEsteEjercicio m-1" style="cursor: pointer;color: #9a0000;"data-id="{{$ejercicio->id}}"></i>
      </div>
    </div>
    @endforeach
  </div>
</div>
</div>
</div>
@section('scripts')
<script>
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})


$(document).on('click', '.borrarEsteEjercicio', function(){
  var id = $(this).data('id');
  swalWithBootstrapButtons.fire({
    title: "¿Estás seguro?",
    text: "No podrás revertir los cambios!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Borrar!',
    cancelButtonText: 'No, cancelar!',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      var ejercicioEliminado = $(this).parent().parent();
      $.ajax({
        type:'get',
        url:'./editarEjercicio/eliminarEjercicio',
        data:{id:id},
        dataType: 'json',
        success:function(data){
          ejercicioEliminado.remove();
          swalWithBootstrapButtons.fire(
            'Borrado!',
            'El ejercicio ha sido borrado',
            'success'
          )
        }
      });
    } else if (
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire(
        'Cancelado',
        'No se ha borrado nada',
        'error'
      )
    }
  })
});
</script>
@endsection
@endsection
