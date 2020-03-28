@extends('layouts.app')
@section('content')
<div class="container-fluid" style="background-color: #ece8e8;">
  <div class="card mt-4 mb-4" style="width:90%;margin:auto;background-color: white;">
    <div class="card-body">
      <h5 class="card-title" style="font-weight: bold;border-bottom: 1px solid #5aaf70; padding-bottom: 5px;">Ejercicios</h5>
      <div class="col-12 mb-1 float-right"><a type="button" style="    font-weight: bold;
    border: 1px solid #000000;
    padding-bottom: 5px;
    background-color: green;
    font-size: 12px;
    text-transform: uppercase;"class="btn btn-sm btn-secondary float-right" href="{{ url('editarEjercicio/crear') }}"> <i class="fas fa-plus"></i> crear ejercicio</a></div>
      <div class="row">
        @foreach ($todosEjercicios as $i => $ejercicio)
        <div class="col-md-6 mt-2 mb-2">
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
              <a href="http://localhost/TFG/App/public/editarEjercicio/{{$ejercicio->id}}"><i style="color: green;"class="fas fa-edit"></i></a>
              <i  class="fas fa-trash-alt borrarEsteEjercicio" style="cursor: pointer;color: #9a0000;"data-id="{{$ejercicio->id}}"></i>
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
