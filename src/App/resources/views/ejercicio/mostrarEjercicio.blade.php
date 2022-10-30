@extends('layouts.app')
@section('content')
<div class="container-fluid temaApp">
  <div class="card mt-4 mb-4" style="width:90%;margin:auto;background-color: white;">
    <div class="card-body">
      <h5 class="card-title" style="font-weight: bold;border-bottom: 1px solid #5aaf70; padding-bottom: 5px;">Exercises</h5>
      <div class="col-12 mb-3 float-right" style="margin-right: 5%">
        <button type="button" data-toggle="tooltip" data-placement="top" title="Create exercises" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a  href="{{ url('editarEjercicio/crear') }}" data-toggle="tooltip" data-placement="top" title="Create exercises">
            <i class="fas fa-edit"></i> Create Exercise
          </a>
        </button>
        <button type="button" data-toggle="tooltip" data-placement="top" title="Exercises" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a  href="{{ url('editarEjercicio') }}" data-toggle="tooltip" data-placement="top" title="Exercises">
            <i class="fas fa-th-list"></i> Exercises
          </a>
        </button>
        <button type="button" data-toggle="tooltip" data-placement="top" title="Stats (Exercises)" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a href="{{ env('APP_URLP') }}/editarEjercicio/estadistica" data-toggle="tooltip" data-placement="top" title="Stats (Exercises)">
            <i class="fas fa-chart-line"></i> Stats (Exercises)
          </a>
        </button>
        <button type="button" data-toggle="tooltip" data-placement="top" title="Stats (Playground Mode)" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a href="{{ env('APP_URLP') }}/editarEjercicio/estadisticamlibre" data-toggle="tooltip" data-placement="top" title="Stats (Playground Mode)">
            <i class="fas fa-chart-line"></i> Stats (PG Mode)
          </a>
        </button>
        <button type="button" data-toggle="tooltip" data-placement="top" title="Menu" class="m-1 float-right btn-outline-secondary text-white botonDegradao botonMenuContacto" name="button">
          <a href="{{ env('APP_URLP') }}/admin/administracion" data-toggle="tooltip" data-placement="top" title="Menu">
            <i class="fas fa-bars"></i> Main Menu
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
            <span style="font-size: 12px;color: #928888;"> Easy</span>
            @break

            @case(2)
            <span style="color:#ff9816;">●</span>
            <span style="font-size: 12px;color: #928888;"> Medium</span>
            @break

            @case(3)
            <span style="color:red;">●</span>
            <span style="font-size: 12px;color: #928888;"> Hard</span>
            @break

            @default
            Difficulty not defined
            @endswitch
          </div>
        </div>
        <div class="col-md-12 text-right" style="background-color: #eaeaea;
        border-bottom-right-radius: 10px;
        border-bottom-left-radius: 10px;">
        <a href="{{ env('APP_URLP') }}/ejercicio/{{$ejercicio->id}}" class="m-1" data-id="{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Solve exercise" style="color: #6ead7f;
        font-size: 23px;"><i class="fas fa-laptop-code"></i></a>
        <a href="{{ env('APP_URLP') }}/editarEjercicio/editar/{{$ejercicio->id}}" data-toggle="tooltip" data-placement="top" title="Modify exercise" class="m-1"><i style="color: green;"class="fas fa-edit"></i></a>
        <i  data-toggle="tooltip" data-placement="top" title="Delete exercise" class="fas fa-trash-alt borrarEsteEjercicio m-1" style="cursor: pointer;color: #9a0000;"data-id="{{$ejercicio->id}}"></i>
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
    title: "¿Are you sure?",
    text: "You can't undo this action!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Delete!',
    cancelButtonText: 'No, cancel!',
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
            'Deleted!',
            'The exercise has been deleted',
            'success'
          )
        }
      });
    } else if (
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire(
        'Canceled',
        'Nothing has been deleted',
        'error'
      )
    }
  })
});
</script>
@endsection
@endsection
