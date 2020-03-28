@extends('layouts.app')
@section('content')
<div class="container-fluid">
  <a type="button" class="btn btn-sm btn-secondary" href="{{ url('editarEjercicio/crear') }}">crear ejercicio</a>
  <div>
      <table class="table table-sm table-striped table-principal">
        <thead class="thead-dark">
            <tr>
              <th class="text-center">Ejercicio</th>
              <th class="text-center">Enunciados</th>
              <th class="text-center">Ayudas</th>
              <th class="text-center">Solución</th>
              <th class="text-center">Fecha creación</th>
            </tr>
          </thead>
          @foreach ($todosEjercicios as $i => $ejercicio)
              <tbody>
                <tr>
                  <td>{{$ejercicio['id']}}</td>
                  <td>{{$ejercicio['enunciado']}}</td>
                  <td>{{$ejercicio['ayuda']}}</td>
                  <td>{{$ejercicio['solucionQuery']}}</td>
                  <td>{{$ejercicio['created_at']}}</td>
                </tr>
          </tbody>
          @endforeach
        </table>
    </div>
</div>
@section('scripts')
<script>

</script>
@endsection
@endsection
