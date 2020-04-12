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
      /*  $ApiController = new refrescarLogsController;
        $api = $ApiController->index();*/
        $todosEjercicios = Ejercicio::all();
        return view('ejercicio.mostrarEjercicio', ['todosEjercicios' => $todosEjercicios]);
    }

    public function crear(Request $request)
    {
        return view('ejercicio.crearEjercicio');
    }

    public function editar($id)
    {
        $Ejercicio = Ejercicio::find($id);
        return view('ejercicio.editarEjercicio', ['Ejercicio' => $Ejercicio]);
    }

    public function eliminarEjercicio(Request $request){
       $listaBots = Ejercicio::find($request->id)->delete();
       return Response::json("success");
    }

    public function crearJsonEjercicio(Request $request)
    {
      $enunciados = array();
      array_push($enunciados ,array("parte" => "enunciado","texto" => $request->get('enunciado')));
      if($request->get('showEnunciado') != null){
        array_push($enunciados ,array("parte" => "show","texto" => $request->get('showEnunciado')));
      }else{
        array_push($enunciados ,array("parte" => "show","texto" => ""));
      }
      if($request->get('describeEnunciado') != null){
        array_push($enunciados ,array("parte" => "describe","texto" => $request->get('describeEnunciado')));
      }else{
        array_push($enunciados ,array("parte" => "describe","texto" => ""));
      }
      if($request->get('selectEnunciado') != null){
        array_push($enunciados ,array("parte" => "select","texto" => $request->get('selectEnunciado')));
      }else{
        array_push($enunciados ,array("parte" => "select","texto" => ""));
      }
      if($request->get('whereEnunciado') != null){
        array_push($enunciados ,array("parte" => "where","texto" => $request->get('whereEnunciado')));
      }else{
        array_push($enunciados ,array("parte" => "where","texto" => ""));
      }
      if($request->get('groupEnunciado') != null){
        array_push($enunciados ,array("parte" => "group","texto" => $request->get('groupEnunciado')));
      }else{
        array_push($enunciados ,array("parte" => "group","texto" => ""));
      }
      if($request->get('havingEnunciado') != null){
        array_push($enunciados ,array("parte" => "having","texto" => $request->get('havingEnunciado')));
      }else{
        array_push($enunciados ,array("parte" => "having","texto" => ""));
      }
      if($request->get('orderEnunciado') != null){
        array_push($enunciados ,array("parte" => "order","texto" => $request->get('orderEnunciado')));
      }else{
        array_push($enunciados ,array("parte" => "order","texto" => ""));
      }

      $pistas = array();
      if($request->get('showPista') != null){
        array_push($pistas ,array("parte" => "ayuda show","texto" => $request->get('showPista')));
      }else{
        array_push($pistas ,array("parte" => "ayuda show","texto" => ""));
      }
      if($request->get('describePista') != null){
        array_push($pistas ,array("parte" => "ayuda describe","texto" => $request->get('describePista')));
      }else{
        array_push($pistas ,array("parte" => "ayuda describe","texto" => ""));
      }
      if($request->get('selectPista') != null){
        array_push($pistas ,array("parte" => "ayuda select","texto" => $request->get('selectPista')));
      }else{
        array_push($pistas ,array("parte" => "ayuda select","texto" => ""));
      }
      if($request->get('wherePista') != null){
        array_push($pistas ,array("parte" => "ayuda where","texto" => $request->get('wherePista')));
      }else{
        array_push($pistas ,array("parte" => "ayuda where","texto" => ""));
      }
      if($request->get('groupPista') != null){
        array_push($pistas ,array("parte" => "ayuda group by","texto" => $request->get('groupPista')));
      }else{
        array_push($pistas ,array("parte" => "ayuda group by","texto" => ""));
      }
      if($request->get('havingPista') != null){
        array_push($pistas ,array("parte" => "ayuda having","texto" => $request->get('havingPista')));
      }else{
        array_push($pistas ,array("parte" => "ayuda having","texto" => ""));
      }
      if($request->get('orderPista') != null){
        array_push($pistas ,array("parte" => "ayuda order by","texto" => $request->get('orderPista')));
      }else{
        array_push($pistas ,array("parte" => "ayuda order by","texto" => ""));
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
        $esShow = false;
        $clausulaArray = array();
        try {
         $users = DB::connection('mysql2')->select($request['query']);
         if(stripos($request['query'], 'where') !== false){
          array_push($clausulaArray ,"where");
         }
         if(stripos($request['query'], 'show') !== false){
          array_push($clausulaArray ,"show");
          $esShow =  true;
         }
         if(stripos($request['query'], 'describe') !== false){
          array_push($clausulaArray ,"describe");
         }
         if(stripos($request['query'], 'select') !== false){
          array_push($clausulaArray ,"select");
         }
         if(stripos($request['query'], 'order by') !== false){
          array_push($clausulaArray ,"order by");
         }
         if(stripos($request['query'], 'group by') !== false){
          array_push($clausulaArray ,"group by");
         }
         if(stripos($request['query'], 'having') !== false){
          array_push($clausulaArray ,"having");
         }
         if(!$esShow){
           if(stripos($request['query'], 'describe') !== false){
            $tabla = compruebaTabla($request['query'],"describe");
          }else{
            $tabla = compruebaTabla($request['query'],"from");
          }
         }
         array_push($respuestaQuery ,array("query" => $users,"clausula" => $clausulaArray ,"tabla" => $tabla));
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
