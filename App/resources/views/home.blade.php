@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="mb-4">
              <form method="get" id="formularioQuery"  accept-charset="UTF-8">
                <div class="row">
                  <div class="col-9"><input type="text" name="queryForm"  class="form-control"></div>
                  <div class="col-3"><button class="form-control bg-dark btn-outline-secondary text-white" type="submit">formular</button></div>
                </div>
              </form>
            </div>
            <div class="mt-4 h-100" style=" border: 3px solid black;">

            </div>
        </div>
        <div class="col-md-5">
            <div class="cotainer-fluid  w-100" style="height: 700px;">

            </div>
        </div>
    </div>
</div>
@endsection
