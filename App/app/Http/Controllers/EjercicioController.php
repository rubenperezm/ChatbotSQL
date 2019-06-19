<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use App\Ejercicio;
use Session;
use Response;
use DB;

class EjercicioController extends Controller
{

    public $conversacion;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth');
         $this->conversacion = array("show", "describe", "select", "where");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        Session::put('lugarConversacion',0);
        return view('ejercicio',['id' => $id]);
    }

    public function ajaxFormularioQuery(Request $request)
    {
        $respuestaQuery  = array();
        Debugbar::info($request['query']);
        try {
         $users = DB::select($request['query']);
         if(strnatcasecmp($request['query'],"select * from prueba where id=1")== 0){

           array_push($respuestaQuery ,array("query" => "lo has terminado","conversacionBot" => "finalConversacionCorrectolaravel"));
         }else{
           if(stripos($request['query'], $this->conversacion[Session::get('lugarConversacion')]) !== false){
             if(comprueba($request['query'],"select * from prueba where id=1",$this->conversacion[Session::get('lugarConversacion')])){
               Session::put('lugarConversacion',Session::get('lugarConversacion')+1);
               array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "pasaSiguiente  laravel","lugarConversacion" => Session::get('lugarConversacion')+1)); //el +1 en el lugarConversacion es porque en la base de datos el 0 es el enunciado
             }else{
               array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "Regular  laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
             }
           }else{
             if(stripos($request['query'], 'where') === false && stripos($request['query'], 'select') !== false && Session::get('lugarConversacion') < 2){
               Session::put('lugarConversacion',2);
               if(comprueba($request['query'],"select * from prueba where id=1","select")){
                 Session::put('lugarConversacion',Session::get('lugarConversacion')+1);
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_select_correcto laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
               }else{
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_select_parcial","lugarConversacion" => Session::get('lugarConversacion')+1));
               }
             }elseif (stripos($request['query'], 'show') !== false && Session::get('lugarConversacion') < 0) {
               Session::put('lugarConversacion',0);
               array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_show_correcto","lugarConversacion" => Session::get('lugarConversacion')+1));
               Session::put('lugarConversacion',Session::get('lugarConversacion')+1);
             }elseif (stripos($request['query'], 'describe') !== false && Session::get('lugarConversacion') < 1) {
               Session::put('lugarConversacion',1);
               if(comprueba($request['query'],"select * from prueba where id=1","describe")){
                 Session::put('lugarConversacion',Session::get('lugarConversacion')+1);
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_describe_correcto","lugarConversacion" => Session::get('lugarConversacion')+1));
               }else{
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_describe_parcial","lugarConversacion" => Session::get('lugarConversacion')+1));
               }
             }elseif (stripos($request['query'], 'select') !== false && stripos($request['query'], 'where') !== false && Session::get('lugarConversacion') < 3) {
               Session::put('lugarConversacion',3);
               if(comprueba($request['query'],"select * from prueba where id=1","where")){
                 Session::put('lugarConversacion',Session::get('lugarConversacion')+1);
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_where_correcto","lugarConversacion" => Session::get('lugarConversacion')+1));
               }else{
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_where_parcial","lugarConversacion" => Session::get('lugarConversacion')+1));
               }
             }
           }

           if(empty($respuestaQuery))array_push($respuestaQuery ,array("query" => $users));
         }

        } catch(\Illuminate\Database\QueryException $ex){
          $respuestaQuery = array();
          array_push($respuestaQuery ,array("query" => $ex->getMessage(),"conversacionBot" => "ErrorVialaravel"));
          return Response::json($respuestaQuery);
        }
        Debugbar::info($respuestaQuery);
        return Response::json($respuestaQuery);
    }

}


function comprueba($miString,$solucion,$tipoConsulta){
    switch ($tipoConsulta) {
      case 'select':
        if(compruebaTabla($miString,$solucion,"from") && compruebaCampos($miString,$solucion)) return true;
        else return false;
        break;
      case 'show':
        return true;
        break;
      case 'where':
      if(compruebaCampos($miString,$solucion)&& compruebaTabla($miString, $solucion,"from") && compruebaFiltro($miString, $solucion))return true;
      else return false;
        break;
      case 'describe':
        if(compruebaTabla($miString,$solucion,"describe")) return true;
        else return false;
        break;
      default:
        return false;
        break;
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
