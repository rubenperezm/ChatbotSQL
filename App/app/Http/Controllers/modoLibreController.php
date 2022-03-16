<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use App\Ejercicio;
use App\ModoLibreLogs;
use App\User;
use Session;
use Response;
use DB;

class modoLibreController extends Controller
{

    public $conversacion,$solucionLugar,$solucionQuery;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth');
         $this->conversacion = array("show", "describe", "select", "where","group by","having","order by");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ejercicios = Ejercicio::select("*")->orderBy('dificultad')->get();
        $principiante = Ejercicio::where("dificultad",1)->get();
        $intermedios = Ejercicio::where("dificultad",2)->get();
        $todosPrincipiantes = false;
        $todosIntermedios = false;
        $flag = false;
        $ejerciciosResuelto = json_decode(auth()->user()->ejerciciosResueltos,true);

        if($ejerciciosResuelto != null){
          foreach ($principiante as $key => $ejercicio) {
            if (!in_array($ejercicio->id, $ejerciciosResuelto)) {
              $flag = true;
            }
          }
          if(!$flag){
            $todosPrincipiantes = true;
            $flag = false;
            foreach ($intermedios as $key => $ejercicio) {
              if (!in_array($ejercicio->id, $ejerciciosResuelto)) {
                $flag = true;
              }
            }
            if(!$flag)  $todosIntermedios = true;
          }
        }
  
        return view('ejercicio.modoLibre',[
           'mostrarTabla' => true,
           'mostrarDatosTabla' => true,
           "ejercicios" => $ejercicios,
           'esPrincipiante' => $todosPrincipiantes,
           'esIntermedio' => $todosIntermedios,
           'ejerciciosResuelto' => $ejerciciosResuelto]);
    }

    public function ajaxVerTabla(Request $request)
    {
      try {
       $verTabla = DB::connection('mysql2')->select($request->consulta);
      } catch(\Illuminate\Database\QueryException $ex){
        return Response::json($ex->getMessage());
      }
      return $verTabla;
    }
    
    public function ajaxFormularioQuery(Request $request)
    {
        $stringUsuario = $request['query'];
        $stringUsuario   = trim($stringUsuario);
        $respuestaQuery = array();
        $mejoraConsulta = array();
        $mensajeSec = "No se contemplan este tipo de consultas para realizar este ejercicio";
        if(stripos($stringUsuario, 'show databases') !== false){
          array_push($respuestaQuery ,array("query" => $mensajeSec,"conversacionBot" => "securityMess"));
          return Response::json($respuestaQuery);
        }
        $SecPass = explode(' ', $stringUsuario);
        if(stripos($SecPass[0], 'insert') !== false || stripos($SecPass[0], 'delete') !== false || stripos($SecPass[0], 'update') !== false
        || stripos($SecPass[0], 'on') !== false || stripos($SecPass[0], 'drop') !== false || stripos($SecPass[0], 'add') !== false
        || stripos($SecPass[0], 'alter') !== false || stripos($SecPass[0], 'rename') !== false || stripos($SecPass[0], 'truncate') !== false
        || stripos($SecPass[0], 'replace') !== false || stripos($SecPass[0], 'create') !== false || stripos($SecPass[0], 'use') !== false){
          array_push($respuestaQuery ,array("query" => $mensajeSec,"conversacionBot" => "securityMess"));
          return Response::json($respuestaQuery);
        }
        
        $logIntento = ModoLibreLogs::where("uuidIntento",$request['uuid'])->first();
        try {
         $users = DB::connection('mysql2')->select($stringUsuario);
         array_push($respuestaQuery ,array("query" => $users, "conversationBot" => ""));
        } catch(\Illuminate\Database\QueryException $ex){
          $respuestaQuery = array();
          $msg = "ErrorVialaravel";
          switch ($ex) {
            case stripos($ex, '1054') !== false:
              $msg = $msg." 1054";
              if(stripos($ex, 'where clause') !== false) $msg = $msg."where";
              else{
                if(stripos($ex, 'field') !== false) $msg = $msg."select";
                else if(stripos($ex, 'order clause') !== false) $msg = $msg."order";
              }
              break;
            case stripos($ex, '1064') !== false:
              $msg = $msg." 1064";
              break;
            case stripos($ex, '1146') !== false:
              $msg = $msg." 1146";
              break;
            case stripos($ex, '1055') !== false:
              $msg = $msg." 1055";
              break;
            case stripos($ex, '1140') !== false:
              $msg = $msg." 1140";
              break;
            case stripos($ex, '1054') !== false:
              $msg = $msg." 1054";
              break;

            default:
              break;
          }
          if($logIntento !== null){
            if($logIntento->errores != null){
              $errores = json_decode($logIntento->errores,true);
              array_push($errores,$ex->getMessage());
              $errores = json_encode($errores);
              $logIntento->errores = $errores;
            }else{
              $errores = array();
              array_push($errores,$ex->getMessage());
              $errores = json_encode($errores);
              $logIntento->errores = $errores;
            }
            if($logIntento->consultas != null){
              $consultas = json_decode($logIntento->consultas,true);
              array_push($consultas,$stringUsuario);
              $consultas = json_encode($consultas);
              $logIntento->consultas = $consultas;
            }else{
              $consultas = array();
              array_push($consultas,$stringUsuario);
              $consultas = json_encode($consultas);
              $logIntento->consultas = $consultas;
            }
            $logIntento->save();
          }else{
            $logIntento = new ModoLibreLogs;
            $logIntento->uuidIntento = $request['uuid'];
            $logIntento->user_id = auth()->user()->id;
            $errores = array();
            array_push($errores,$ex->getMessage());
            $errores = json_encode($errores);
            $logIntento->errores = $errores;
            $consultas = array();
            array_push($consultas,$stringUsuario);
            $consultas = json_encode($consultas);
            $logIntento->consultas = $consultas;
            $logIntento->save();
          }
          array_push($respuestaQuery ,array("query" => $ex->getMessage(),"conversacionBot" => $msg));
          return Response::json($respuestaQuery);
        }

        if($logIntento !== null){
          if($logIntento->consultas != null){
            $consultas = json_decode($logIntento->consultas,true);
            array_push($consultas,$stringUsuario);
            $consultas = json_encode($consultas);
            $logIntento->consultas = $consultas;
          }else{
            $consultas = array();
            array_push($consultas,$stringUsuario);
            $consultas = json_encode($consultas);
            $logIntento->consultas = $consultas;
          }
          $logIntento->save();
        }else{
          $logIntento = new ModoLibreLogs;
          $logIntento->user_id = auth()->user()->id;
          $logIntento->uuidIntento = $request['uuid'];
          $consultas = array();
          array_push($consultas,$stringUsuario);
          $consultas = json_encode($consultas);
          $logIntento->consultas = $consultas;
          $logIntento->save();
        }
        array_push($respuestaQuery,$mejoraConsulta);
        return Response::json($respuestaQuery);
    }

}

