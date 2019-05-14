<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use App\Ejercicio;
use Response;
use DB;

class EjercicioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth');
         $lugarConversación = 0;
         $conversacion = array("show", "describe", "select", "where");

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        return view('ejercicio',['id' => $id]);
    }

    public function ajaxFormularioQuery(Request $request)
    {

        Debugbar::info($request['query']);
        try {
         $users = DB::select($request['query']);
         Debugbar::info($users);
         if(stripos($request['query'], 'where') === false && stripos($request['query'], 'select') !== false && $lugarConversación = 2){//error porque lugar Conversacion no esta definido
           $lugarConversación = 2;
           if(compruebaTabla($request['query'],"select * from prueba where id=1", "from") && compruebaCampos($request['query'], "select * from prueba where id=1")){//Comprueba que este totalmente correcto, es este caso solo miramos tabla y campos
             $lugarConversación++;
             return Response::json($users);
           }else{

           }
         }elseif (stripos($request['query'], 'show') !== false && $lugarConversación = 0) {
           $lugarConversación = 0;
           return Response::json($users);
         }elseif (stripos($request['query'], 'describe') !== false && $lugarConversación = 1) {
           $lugarConversación = 1;
           if(compruebaTabla($request['query'],"select * from prueba where id=1", "describe")){//Comprueba con la query respuesta
             $lugarConversación++;
             return Response::json($users);
           }else{

           }
         }elseif (stripos($request['query'], 'select') !== false && stripos($request['query'], 'where') !== false && $lugarConversación < 3) {
           $lugarConversación = 3;
           if(compruebaCampos($request['query'],"select * from prueba where id=1","from")
             && compruebaTabla($request['query'], "select * from prueba where id=1")
              && compruebaFiltro($request['query'], "select * from prueba where id=1")){//Comprueba que este totalmente correcto, es este caso solo miramos tabla y campos
             $lugarConversación++;
             return Response::json($users);
           }else{

           }
         }
        } catch(\Illuminate\Database\QueryException $ex){
          return Response::json($ex->getMessage());
        }

        return Response::json($users);
    }

}


function compruebaTabla($miString,$solucion,$tipoConsulta){

  $consultaSegmentada = explode($tipoConsulta, $miString);
  $consultaSeg = trim($consultaSegmentada[1]);
  $tablaConsulta = explode(' ', $consultaSeg);

  $solucionSegmentada = explode('from', $solucion);
  $consultaSeg = trim($solucionSegmentada[1]);
  $tablaSolucion = explode(' ', $consultaSeg);

  if($tablaConsulta[0] == $tablaSolucion[0]) return true;
  else return false;
}

function compruebaFiltro($miString,$solucion){

  $campos1 = DB::select($miString);
  $campos2 = DB::select($solucion);

  if(isset($campos1)){
    $nFilasConsulta = sizeof($campos1);
  }

  if(isset($campos2)){
    $nFilasSolucion = sizeof($campos2);
  }

  if($nFilasConsulta == $nFilasSolucion) return true;
  else return false;

}

function compruebaCampos($miString,$solucion){

  $campos1 = DB::select($miString);
  $campos2 = DB::select($solucion);

  if(isset($campos1[0])){
    $nCamposConsulta = (array)$campos1[0];
    $nCamposConsulta = sizeof($nCamposConsulta);
  }

  if(isset($campos2[0])){
    $nCamposSolucion = (array)$campos2[0];
    $nCamposSolucion = sizeof($nCamposSolucion);
  }

  if($nCamposConsulta == $nCamposSolucion) return true;
  else return false;

}
