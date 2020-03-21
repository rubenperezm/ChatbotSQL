<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\refrescarLogsController;
use Debugbar;
use App\Ejercicio;
use Session;
use Response;
use DB;

class editarEjercicioController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $ApiController = new refrescarLogsController;
        $api = $ApiController->index();
        $todosEjercicios = Ejercicio::all();
        return view('ejercicio.mostrarEjercicio', ['todosEjercicios' => $todosEjercicios]);
    }

    public function crear(Request $request)
    {
        return view('ejercicio.crearEjercicio');
    }

    public function crearJsonEjercicio(Request $request)
    {
      $enunciados = array();
      array_push($enunciados ,array("parte" => "enunciado","texto" => $request->get('enunciado')));
      if($request->get('showEnunciado') != null){
        array_push($enunciados ,array("parte" => "show","texto" => $request->get('showEnunciado')));
      }
      if($request->get('describeEnunciado') != null){
        array_push($enunciados ,array("parte" => "describe","texto" => $request->get('describeEnunciado')));
      }
      if($request->get('selectEnunciado') != null){
        array_push($enunciados ,array("parte" => "select","texto" => $request->get('selectEnunciado')));
      }
      if($request->get('whereEnunciado') != null){
        array_push($enunciados ,array("parte" => "where","texto" => $request->get('whereEnunciado')));
      }

      $pistas = array();
      if($request->get('showPista') != null){
        array_push($pistas ,array("parte" => "ayuda show","texto" => $request->get('showPista')));
      }
      if($request->get('describePista') != null){
        array_push($pistas ,array("parte" => "ayuda describe","texto" => $request->get('describePista')));
      }
      if($request->get('selectPista') != null){
        array_push($pistas ,array("parte" => "ayuda select","texto" => $request->get('selectPista')));
      }
      if($request->get('wherePista') != null){
        array_push($pistas ,array("parte" => "ayuda where","texto" => $request->get('wherePista')));
      }

      $nuevoEjercicio = new Ejercicio;
      $nuevoEjercicio->solucionQuery = $request->get('query');
      $nuevoEjercicio->enunciado = json_encode($enunciados);
      $nuevoEjercicio->ayuda = json_encode($pistas);
      $nuevoEjercicio->save();

      return redirect()->action('editarEjercicioController@index');
    }

    public function ajaxValidaQuery(Request $request)
    {
        $respuestaQuery = array();
        try {
         $users = DB::connection('mysql2')->select($request['query']);
         if(stripos($request['query'], 'where') === false && stripos($request['query'], 'select')!== false){
          $tabla = compruebaTabla($request['query'],"from");
          array_push($respuestaQuery ,array("query" => $users,"clausula" => "select","tabla" => $tabla));
         }elseif (stripos($request['query'], 'show') !== false) {
           array_push($respuestaQuery ,array("query" => $users,"clausula" => "show"));
         }elseif (stripos($request['query'], 'describe') !== false) {
           $tabla = compruebaTabla($request['query'],"describe");
           array_push($respuestaQuery ,array("query" => $users,"clausula" => "describe","tabla" => $tabla));
         }elseif (stripos($request['query'], 'select') !== false && stripos($request['query'], 'where') !== false) {
           $tabla = compruebaTabla($request['query'],"from");
           array_push($respuestaQuery ,array("query" => $users,"clausula" => "where","tabla" => $tabla));
         }
        } catch(\Illuminate\Database\QueryException $ex){
          array_push($respuestaQuery ,array("query" => $ex->getMessage()));
          return Response::json($respuestaQuery);
        }
      //  array_push($respuestaQuery ,array("query" => $users));
        return Response::json($respuestaQuery);
    }

}


function compruebaTabla($miString,$tipoConsulta){
  $consultaSegmentada = explode($tipoConsulta, $miString);
  $consultaSeg = trim($consultaSegmentada[1]);
  $tablaConsulta = explode(' ', $consultaSeg);
  Debugbar::info($tablaConsulta);
  return $tablaConsulta[0];
}
