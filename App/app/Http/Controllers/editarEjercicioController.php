<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\refrescarLogsController;
use Debugbar;
use Carbon\Carbon;
use App\Ejercicio;
use App\Logs;
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
    return view('ejercicio.crearEjercicio', ["query" => "",
    "clausulas" => ""]);
  }

  public function estadistica(Request $request)
  {

    //intentos por dia
    $fechaInicio = Carbon::now()->subDays(7)->toDateTimeString();
    $fechaFin = Carbon::now()->toDateTimeString();
    $intentosPorDia = Logs::select(DB::raw('count(*) AS intentos'),DB::raw('date(created_at) as dia'))
          ->CreatedAt($fechaInicio,$fechaFin)
          ->groupBy(DB::raw('date(created_at)'))
          ->get();

    $label = array();
    $data = array();
    for ($i=0; $i <7 ; $i++) {
      if($i == 0){
        $label[$i] = Carbon::parse(Carbon::now())->format('d-m');
      }else {
        $label[$i] = Carbon::parse(Carbon::now()->subDays($i))->format('d-m');
      }
      $data[$i] = 0;
      foreach ($intentosPorDia as $key => $intento) {
        if($label[$i] == Carbon::parse($intento->dia)->format('d-m')){
            $data[$i] = $intento->intentos;
        }
      }
    }


    $ejerciciosIds = Logs::select("ejercicio_id")
          ->groupBy("ejercicio_id")
          ->get();

    $arrayAbandonos = array();
    $arrayNumeroIntentos = array();
    $arrayNumeroErrores = array();

    //Recorriendo los distintos ejercicios para los que se han hecho INTENTOS
    foreach ($ejerciciosIds as $key => $ejercicio) {
      //Buscamos la todos los intentos de cada ejercicio
      $ejercicioId = Logs::select("*")
            ->where("ejercicio_id","=",$ejercicio->ejercicio_id)
            ->get();
      $totalIntentosEjercicio = count($ejercicioId);
      $arrayNumeroIntentos[$ejercicio->ejercicio_id] = 0;
      $arrayNumeroErrores[$ejercicio->ejercicio_id] = 0;

      //Ahora recorremos todos los intentos de los ejercicio de manera especifica sumando los todos los errores e intentos
      foreach ($ejercicioId as $key => $ejer) {
        if($ejer->errores != null){
          $arrayErrores = json_decode($ejer->errores,true);
          $numeroE = count($arrayErrores);
        }else{
          $numeroE = 0;
        }
        if($ejer->consultas != null){
          $arrayConsulta = json_decode($ejer->consultas,true);
          $numeroI = count($arrayConsulta);
        }else{
          $numeroI = 0;
        }
        $arrayNumeroErrores[$ejercicio->ejercicio_id] = $arrayNumeroErrores[$ejercicio->ejercicio_id] + $numeroE;
        $arrayNumeroIntentos[$ejercicio->ejercicio_id] = $arrayNumeroIntentos[$ejercicio->ejercicio_id] + $numeroI;
      }
      //Divimos el total de erroes y consultas por el total de intentos para obtener ambas medias
      $arrayNumeroErrores[$ejercicio->ejercicio_id] = $arrayNumeroErrores[$ejercicio->ejercicio_id]/$totalIntentosEjercicio;
      $arrayNumeroIntentos[$ejercicio->ejercicio_id] = $arrayNumeroIntentos[$ejercicio->ejercicio_id]/$totalIntentosEjercicio;
    }
    arsort($arrayNumeroErrores);
    arsort($arrayNumeroIntentos);


    //Abandono por usuario

    $abandonos = Logs::select("ejercicio_id","user_id","completado")
          ->groupBy("ejercicio_id","user_id","completado")
          ->having("completado","=",1)
          ->get();

    foreach ($abandonos as $key => $value) {
      if (isset($arrayAbandonos[$value->ejercicio_id])){
        $arrayAbandonos[$value->ejercicio_id]++;
      }else{
        $arrayAbandonos[$value->ejercicio_id] = 1;
      }
    }
    arsort($arrayAbandonos);

    $mediaErrores = array();
    foreach ($arrayNumeroErrores as $key => $value) {
        $ejecicio = Ejercicio::select("enunciado","solucionQuery")->find($key);
        $err= array(
            "id"=> $key,
            "enunciado"=>json_decode($ejecicio->enunciado,true)[0]["texto"],
            "query"=> $ejecicio->solucionQuery,
            "media"=>$value
        );
        array_push($mediaErrores,$err);
    }

    $mediaCosulta = array();
    foreach ($arrayNumeroIntentos as $key => $value) {
      $ejecicio = Ejercicio::select("enunciado","solucionQuery")->find($key);
      $con= array(
          "id"=> $key,
          "enunciado"=>json_decode($ejecicio->enunciado,true)[0]["texto"],
          "query"=> $ejecicio->solucionQuery,
          "media"=>$value
      );
      array_push($mediaCosulta,$con);
    }

    $tasaAbandono = array();
    foreach ($arrayAbandonos as $key => $value) {
      $ejecicio = Ejercicio::select("enunciado","solucionQuery")->find($key);
      $err= array(
          "id"=> $key,
          "enunciado"=>json_decode($ejecicio->enunciado,true)[0]["texto"],
          "query"=> $ejecicio->solucionQuery,
          "media"=>$value
      );
      array_push($tasaAbandono,$err);
    }


    $intentos = Logs::select("ejercicio_id","user_id","enunciado","solucionQuery","consultas","logs.created_at","logs.updated_at","mensajes","errores","conversacion","completado","name","email")
          ->leftJoin('users','user_id', '=','users.id')
          ->leftJoin('ejercicio','ejercicio_id', '=','ejercicio.id')
          ->orderBy('logs.created_at','desc')
          ->paginate(10);

    Debugbar::info($intentos);
    $datos = array(
        'intentos'          => $intentos,
        'tasaAbandono'      => $tasaAbandono,
        'mediaErrores'      => $mediaErrores,
        'mediaCosulta'      => $mediaCosulta,
        'label'             => array_reverse($label),
        'data'              => array_reverse($data)
    );
    return view('ejercicio.estadistica', $datos);
  }


  public function editar($id)
  {
    $Ejercicio = Ejercicio::find($id);
    $esShow = false;
    $clausulaArray = array();
    Debugbar::info($Ejercicio);
    $users = DB::connection('mysql2')->select($Ejercicio->solucionQuery);
    Debugbar::info($users);
    if(stripos($Ejercicio->solucionQuery, 'where') !== false){
      array_push($clausulaArray ,"where");
    }
    if(stripos($Ejercicio->solucionQuery, 'show') !== false){
      array_push($clausulaArray ,"show");
      $esShow =  true;
    }
    if(stripos($Ejercicio->solucionQuery, 'describe') !== false){
      array_push($clausulaArray ,"describe");
    }
    if(stripos($Ejercicio->solucionQuery, 'select') !== false){
      array_push($clausulaArray ,"select");
    }
    if(stripos($Ejercicio->solucionQuery, 'order by') !== false){
      array_push($clausulaArray ,"order by");
    }
    if(stripos($Ejercicio->solucionQuery, 'group by') !== false){
      array_push($clausulaArray ,"group by");
    }
    if(stripos($Ejercicio->solucionQuery, 'having') !== false){
      array_push($clausulaArray ,"having");
    }
    if(!$esShow){
      if(stripos($Ejercicio->solucionQuery, 'describe') !== false){
        $tabla = compruebaTabla($Ejercicio->solucionQuery,"describe");
      }else{
        $tabla = compruebaTabla($Ejercicio->solucionQuery,"from");
      }
    }
    return view('ejercicio.crearEjercicio', [
    'Ejercicio' => $Ejercicio,
    "query" => $users,
    "clausulas" => $clausulaArray,
    "enunciado" => json_decode($Ejercicio->enunciado,true),
    "ayuda" => json_decode($Ejercicio->ayuda,true)]);
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
    $nuevoEjercicio->solucionQuery = strtolower($request->get('query'));
    $nuevoEjercicio->dificultad = $request->get('dificultad');
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
