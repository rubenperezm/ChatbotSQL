<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use App\Ejercicio;
use App\Logs;
use App\User;
use Session;
use Response;
use DB;
use Illuminate\Support\Facades\Config;

class EjercicioController extends Controller
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
    public function index($id)
    {
        //Session::put('lugarConversacion',0);
        $solucion = Ejercicio::find($id);
        $json = json_decode($solucion->enunciado);
        $enun = $json[0]->texto;
        $ejercicios = Ejercicio::select("*")->orderBy('dificultad')->get();
        $principiante = Ejercicio::where("dificultad",1)->get();
        $intermedios = Ejercicio::where("dificultad",2)->get();
        $todosPrincipiantes = false;
        $todosIntermedios = false;
        $flag = false;
        $ejerciciosResuelto = json_decode(auth()->user()->ejerciciosResueltos,true);
        //ranking de finalización de los ejercicios
        $completados = Logs::select("user_id","alias","logs.created_at")
          ->leftJoin('users','user_id', '=','users.id')
          ->where("completado",2)
          ->where("ejercicio_id",$id)
          ->where("esProfesor", '=', 0)
          ->orderBy("logs.created_at")
          ->get();
       $unique = $completados->unique('user_id');
       Debugbar::info($unique->all());

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

        if(auth()->user()->esProfesor ==  0){
          switch ($solucion->dificultad) {
            case 2:
              if(!$todosPrincipiantes) return redirect('admin/administracion');
              break;
            case 3:
              if(!$todosIntermedios) return redirect('admin/administracion');
              break;

            default:
              break;
          }
        }
        $mostrarTabla = false;
        $mostrarDatosTabla = false;
        if($ejerciciosResuelto != null){
          $mostrarTabla = true;
        }
        $ejerciciosSelect = Ejercicio::select("*")->where("solucionQuery","like","select%")->get();
        if($ejerciciosSelect != null && $ejerciciosResuelto != null){
          foreach ($ejerciciosSelect as $key => $ejercicio) {
            if (in_array($ejercicio->id, $ejerciciosResuelto)) {
              $mostrarDatosTabla = true;
              break;
            }
          }
        }

        return view('ejercicio.vistaEjercicio',[
           'completados' => $unique->all(),
           'solucion' => $solucion,
           'id' => $id,
           'enunciado' => $enun,
           'mostrarTabla' => $mostrarTabla,
           'mostrarDatosTabla' => $mostrarDatosTabla,
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

    public function comprobarTutorial(Request $request)
    {
      $tutorial = User::select("id","tutorial")->find(auth()->user()->id);
      if($tutorial->tutorial === 0 ){
        $tutorial->tutorial = 1;
        $tutorial->save();
        return Response::json(true);
      }
      else return Response::json(false);

    }

    public function ejercicioTerminado(Request $request)
    {
      $logIntento = Logs::where("uuidIntento",$request['uuid'])->first();
      $logIntento->completado = 2;
      $logIntento->save();
      $ejerciciosResuelto =  User::select("id","ejerciciosResueltos")->find(auth()->user()->id);
      $ejercicioRe =  json_decode($ejerciciosResuelto->ejerciciosResueltos,true);
      if($ejercicioRe == null) $ejercicioRe = array();
      if (!in_array($request->id, $ejercicioRe)) {
        array_push($ejercicioRe,$request->id);
        $ejerciciosResuelto->ejerciciosResueltos = json_encode($ejercicioRe);
        $ejerciciosResuelto->save();
      }
      $solucion = Ejercicio::select("solucionQuery")->find($request->id);
      return Response::json($solucion->solucionQuery);
    }

    public function ajaxFormularioQuery(Request $request)
    {
        $solucion = Ejercicio::find($request['id']);
        $solucionQuery = $solucion->solucionQuery;
        $stringUsuario = strtolower($request['query']);
        $stringUsuario   = trim($stringUsuario);
        $respuestaQuery = array();
        $mejoraConsulta = array();
        $stringUsuario = trim($stringUsuario, ';');
        $solucionQuery = trim($solucionQuery, ';');

        $mensajeSec = "No se contemplan este tipo de consultas para realizar este ejercicio";
        if(stripos($stringUsuario, 'show') !== false && stripos($stringUsuario,'show tables') === false){
          array_push($respuestaQuery ,array("query" => $mensajeSec,"conversacionBot" => "securityMess"));
          return Response::json($respuestaQuery);
        }
        $SecPass = explode(' ', $stringUsuario);
        if(stripos($SecPass[0], 'insert') !== false || stripos($SecPass[0], 'delete') !== false || stripos($SecPass[0], 'update') !== false
        || stripos($SecPass[0], 'on') !== false || stripos($SecPass[0], 'drop') !== false || stripos($SecPass[0], 'add') !== false
        || stripos($SecPass[0], 'alter') !== false || stripos($SecPass[0], 'rename') !== false || stripos($SecPass[0], 'truncate') !== false
        || stripos($SecPass[0], 'replace') !== false || stripos($SecPass[0], 'create') !== false || stripos($SecPass[0], 'use') !== false
        || stripos($SecPass[0], 'explain') !== false){
          array_push($respuestaQuery ,array("query" => $mensajeSec,"conversacionBot" => "securityMess"));
          return Response::json($respuestaQuery);
        }

        $logIntento = Logs::where("uuidIntento",$request['uuid'])->first();
        try {
         $users1 = DB::connection('mysql2')->select($stringUsuario);
         if(count($users1) !== 0){
           //array_push($mejoraConsulta, $users1);
          //array_push($respuestaQuery ,array('query' => $users1,'conversacionBot' => 'comprobacion_query laravel'));
          //array_push($respuestaQuery, $mejoraConsulta);
          //return Response::json($respuestaQuery);
          $users1 =cambiarCase($users1);
         }
         $sol1 = DB::connection('mysql2')->select($solucionQuery);
         if(count($sol1) !== 0){
          $sol1 = cambiarCase($sol1);
          }
         $users2 = DB::connection('mysql3')->select($stringUsuario);
         if(count($users2) !== 0){
          $users2 = cambiarCase($users2);
          }
         $sol2 = DB::connection('mysql3')->select($solucionQuery);
         if(count($sol2) !== 0){
          $sol2 = cambiarCase($sol2);
          }

          if($users1 == $sol1 && $users2 == $sol2){ //Consulta correcta
            array_push($respuestaQuery ,array("query" => $users1,"conversacionBot" => "finalConversacionCorrectolaravel"));
          }
          else{
            $arrayQueryUser = queryToArray($stringUsuario);
            $arraySolucion = queryToArray($solucionQuery);
            //Caso Solucion sea Describe
            if(array_key_exists('describe', $arrayQueryUser[0])){
              if(array_key_exists('describe', $arraySolucion[0])){
                array_push($mejoraConsulta,"La tabla no es correcta.");
                array_push($respuestaQuery ,array('query' => $users1,'conversacionBot' => 'comprobacion_query laravel'));
              }
              else{
                array_push($respuestaQuery ,array("query" => $users1,"conversacionBot" => "nadaLaravel"));  
              }
            }
          //Caso solucion sea show tables
            elseif(array_key_exists('show', $arrayQueryUser[0])){
                array_push($respuestaQuery ,array("query" => $users1,"conversacionBot" => "nadaLaravel"));  
            }
            else{//SELECT-------------------------------------------------------------------------
              $mensaje = false;
              array_push($respuestaQuery, array("query" => $users1, "conversacionBot" => "comprobacion_query laravel"));       
              if(selectsEnDescribeOShow($arraySolucion[0], $mejoraConsulta)){$mensaje = true;}
              elseif(comprobacionesUnion($stringUsuario, $solucionQuery, $arrayQueryUser, $arraySolucion, $mejoraConsulta)){$mensaje = true;}
              else{
                $selectUser = str_replace(" as ", " ", $arrayQueryUser[0]["select"]);
                $selectSol =  str_replace(" as ", " ", $arraySolucion[0]["select"]);
                $camposUser = getCampos($selectUser);
                $camposSol = getCampos($selectSol);
                if(comprobacionesSelect($selectUser,$selectSol,$camposUser,$camposSol, $mejoraConsulta)){$mensaje = true;}
                elseif(comprobacionesFrom($arrayQueryUser[0]['from'], $arraySolucion[0]['from'], $mejoraConsulta)){$mensaje = true;}
                elseif(array_key_exists('order by', $arraySolucion[0])){
                  if(!array_key_exists('order by', $arrayQueryUser[0])){
                    array_push($mejoraConsulta, "Recuerda ordenar tu consulta.");
                    $mensaje = true;
                  }
                  elseif(comprobacionesOrderBy($arrayQueryUser[0]['order by'], $arraySolucion[0]['order by'], $camposUser, $camposSol, $mejoraConsulta)){$mensaje = true;}
                }
                elseif(!$mensaje && array_key_exists('group by', $arraySolucion[0])){
                  if(!array_key_exists('group by', $arrayQueryUser[0])){
                    array_push($mejoraConsulta, "Recuerda que debes utilizar la cláusula group by.");
                    $mensaje = true;
                  }
                  elseif(comprobacionesGroupBy($arrayQueryUser[0]['group by'], $arraySolucion[0]['group by'], $camposUser, $camposSol, $mejoraConsulta)){$mensaje = true;}
                }
                if(!$mensaje && comprobacionesWhereHaving($users1, $users2, $sol1, $sol2, $mejoraConsulta)){$mensaje = true;}
                elseif(!$mensaje){
                  array_push($mejoraConsulta, "Tu consulta no es correcta. Revísala, e inténtalo de nuevo.");
                  $mensaje = true;
                }
              }   
            }  
          }
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
            $logIntento = new Logs;
            $logIntento->uuidIntento = $request['uuid'];
            $logIntento->user_id = auth()->user()->id;
            $logIntento->ejercicio_id = $request['id'];
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
          array_push($respuestaQuery ,array('query' => $ex->getMessage(),'conversacionBot' => $msg));
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
          $logIntento = new Logs;
          $logIntento->user_id = auth()->user()->id;
          $logIntento->ejercicio_id = $request['id'];
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
function queryToArray($query){
  $espaciado = function ($coincidencias)
  {
  return trim($coincidencias[1])." ".trim($coincidencias[2])." ".trim($coincidencias[3]);
  };
  $query =  preg_replace_callback(
    "/(\w|\s+|^|')([^\w&\s&^']+)(\s+|\w|'|$)/",
    $espaciado,
    $query);   
  //Subdividir por la unión
  $partesUnion = preg_split("/\sunion\s|\sunion\sall\s/i", $query);
  $res = array(); //Array de cada subconsulta del union
  $matches = array();
  $inicios = array();
  $finales = array();
  foreach($partesUnion as $parte){
    preg_match_all("/[^\^]\(\sselect/i", $parte, $matches, PREG_OFFSET_CAPTURE, 3);
    foreach($matches[0] as $m){
      $inicios[] = $m[1];

    }
      //Buscamos '(' y ')'
      for($com = 0; $com < count($inicios); $com++){
        $i = $inicios[$com] + 8; // AHORRAMOS EL '( SELECT'
        $contParentesis = 1;
        while($contParentesis !== 0){
          if($parte[$i] === '(') $contParentesis++;
          elseif($parte[$i] === ')') $contParentesis--;
          $i++;
        }
        $finales[] = $i;
        if($com !== count($inicios)-1 && $finales[count($finales)-1] > $inicios[$com + 1]){
          unset($inicios[$com + 1]);
          $inicios = array_values($inicios);
        }
      }
  
  preg_match_all("/(\s|^)(describe|show|select|from|where|group\sby|having|order\sby)(\s)/i", $parte, $matches2, PREG_OFFSET_CAPTURE);
  $particiones = array();
  $matches2 = $matches2[0];
  $a = 0;
  $modified = false;
  while($a < count($matches2)){
  $modified = false;
  for($i = 0; $i < count($inicios) && $matches2[$a][1] > $inicios[$i]; $i++){
        if($matches2[$a][1] < $finales[$i]){
          array_splice($matches2, $a, 1);
          $modified = true;
      }
    }
  if($modified === false){
      $a++;
  }
  }
  for($it = 0; $it < count($matches2); $it++){
  if($it+1 == count($matches2)){
  $particiones[strtolower(trim($matches2[$it][0]))] = strtolower(substr($parte, $matches2[$it][1]));
  }
  else{
  $particiones[strtolower(trim($matches2[$it][0]))] = strtolower(substr($parte, $matches2[$it][1], $matches2[$it+1][1]-$matches2[$it][1]));
  }


  }

  $res[] = $particiones;
  } 
return $res;

}


function selectsEnDescribeOShow($arraySolucion, &$mejoraConsulta){
  $v = false;
  //Primero comprobamos que no estemos haciendo un select para consultas simples (show/describe)
  if(array_key_exists('describe', $arraySolucion)||array_key_exists('show', $arraySolucion)){
    $v = true;
    array_push($mejoraConsulta, "Tienes ganas de consultas más complejas, pero este ejercicio es mucho más básico");              
  }
  return $v;
}

function comprobacionesUnion($stringUsuario, $solucionQuery, $arrayQueryUser, $arraySolucion, &$mejoraConsulta){
  $v = false;
  //Mismo numero de UNIONs
  if(count($arrayQueryUser) != count($arraySolucion)){
    $v = true;
    if(count($arraySolucion) > 1){
      if(count($arrayQueryUser) == 1){
        array_push($mejoraConsulta, "Intenta resolver este ejercicio usando la cláusula union.");
      }else{
        array_push($mejoraConsulta, "Estás usando un número distinto de cláusulas union al que deberías estar usando.");
      }
    }else{
      array_push($mejoraConsulta, "Intenta realizar este ejercicio sin usar la cláusula union.");
    }
  }
  elseif(substr_count($stringUsuario, 'union all') !== substr_count($solucionQuery, 'union all')){
    $v = true;
    array_push($mejoraConsulta, "Deberías revisar qué hace la cláusula union all.");
  }
  return $v;
}
function comprobacionesSelect($selectUser,$selectSol,$camposUser,$camposSol, &$mejoraConsulta){
  $v = false;
  if((stripos($selectSol, "distinct") !== false) !== (stripos($selectUser, "distinct") !== false)){
    array_push($mejoraConsulta, "Consulta para qué sirve la cláusula DISTINCT, y decide si es necesaria para este ejercicio.");  
    $v = true;
  }elseif(compruebaFunciones($camposSol, $camposUser, $mejoraConsulta)){$v = true;}
  elseif(stripos($selectSol, "'") !== false){
    if(stripos($selectUser, "'") === false){
      $v = true;
      array_push($mejoraConsulta, "Recuerda renombrar los campos del select.");
    }
    elseif(getCampos($selectUser) !== getCampos($selectSol)){
      $v = true;
      array_push($mejoraConsulta, "El renombramiento debe coincidir literalmente con el especificado en el enunciado.");
    }
  }elseif(stripos($selectUser, "'") !== false){
      $v = true;
      array_push($mejoraConsulta, "No debes renombrar los campos del select si el enunciado no lo dice explícitamente.");
  }
  else{
    if(count($camposUser) !== count($camposSol)){
      array_push($mejoraConsulta, "No seleccionas los campos correctos. Recuerda que deben de ir en el mismo orden que se pide en el enunciado.");
      $v  = true;
    }
    
  }
   return $v;
}

function compruebaFunciones($camposSol, $camposUser, &$mejoraConsulta){
  $v = false;
  for($i = 0; $i < count($camposSol) && !$v; $i++){
    $cSol  = preg_match('/\w+_\w+\)/', $camposSol[$i], $match);
    if(empty($match)){
      $cSol = $camposSol[$i];
    }else{
      $cSol = trim($match[0], ')');
    }
    $cUser = preg_match('/\w+_\w+\)/', $camposUser[$i], $match2);
    if(empty($match2)){
      $cUser = $camposUser[$i];
    }else{
      $cUser = trim($match2[0], ')');
    }

    if($cUser !== $cSol){
      array_push($mejoraConsulta, "No has seleccionado los campos correctamente.");
      $v = true;
    }elseif($camposUser[$i] !== $camposSol[$i]){
      array_push($mejoraConsulta, "Revisa las funciones usadas en el SELECT.");
      $v = true;
    }
  }
  return $v;
}
function comprobacionesOrderBy($arrayQueryUser, $arraySolucion, $camposUser, $camposSol, &$mejoraConsulta){
  $v = false;
  $arr1 = trim(str_replace('order by ' , '', $arrayQueryUser));
  $arr2 = trim(str_replace('order by ' , '', $arraySolucion));
  $arr1 = preg_split('/\s+,\s+/', preg_replace_callback('/\sasc\s?$/', function($coincidencias){ return " ";},$arr1));
  $arr2 = preg_split('/\s+,\s+/',preg_replace_callback('/\sasc\s?$/', function($coincidencias){ return " ";},$arr2));
  if(count($arr1) !== count($arr2)){
    $v = true;
    array_push($mejoraConsulta, "Se pide ordenar la consulta por un número distinto de campos al introducido.");
  }else{
    for($i = 0; $i < count($arr1) && $v === false; $i++){
      $arr1[$i] = trim($arr1[$i]);
      $arr2[$i] = trim($arr2[$i]);
      if(is_numeric($arr1[$i])){
        $a = $camposUser[intval($arr1[$i])-1];
      }else{
        $a = $arr1[$i];
      }
      if(is_numeric($arr2[$i])){
        $b = $camposSol[intval($arr2[$i])-1];
      }else{
        $b = $arr2[$i];
      }
      if($a !== $b){
        $v = true;
        array_push($mejoraConsulta, "Revisa los campos que usas para ordenar la consulta y comprueba si tienes que ordenar en orden ascendente o descendente con cada uno de ellos.");
      }
    }
  }
  return $v;
}

function comprobacionesGroupBy($arrayQueryUser, $arraySolucion, $camposUser, $camposSol, &$mejoraConsulta){
  $v = false;
  $arr1 = trim(str_replace('group by ' , '', $arrayQueryUser));
  $arr2 = trim(str_replace('group by ' , '', $arraySolucion));
  $arr1 = preg_split('/\s+,\s+/', $arr1);
  $arr2 = preg_split('/\s+,\s+/', $arr2);
  if(count($arr1) !== count($arr2)){
    $v = true;
    array_push($mejoraConsulta, "Se pide agrupar la consulta por un número distinto de campos al introducido.");
  }else{
    for($i = 0; $i < count($arr1) && $v === false; $i++){
      $arr1[$i] = trim($arr1[$i]);
      $arr2[$i] = trim($arr2[$i]);
      if(is_numeric($arr1[$i])){
        $a = $camposUser[intval($arr1[$i])-1];
      }else{
        $a = $arr1[$i];
      }
      if(is_numeric($arr2[$i])){
        $b = $camposSol[intval($arr2[$i])-1];
      }else{
        $b = $arr2[$i];
      }
      if($a !== $b){
        $v = true;
        array_push($mejoraConsulta, "Revisa los campos que usas para agrupar la consulta.");
      }
    }
  }
  return $v;
}

function comprobacionesWhereHaving($u1, $u2, $s1, $s2, &$mejoraConsulta){
  $v = false;
  if(count($u1) !== count($s1) || count($u2) !== count($s2)){
    array_push($mejoraConsulta, "Hay un error a la hora de filtrar. Revisa las cláusulas relacionadas.");
    $v = true;
  }
  return $v;
}
function comprobacionesFrom($arrayQueryUser, $arraySolucion, &$mejoraConsulta){
  $v = false;
  $a1 = getTablas($arrayQueryUser);
  $a2 = getTablas($arraySolucion);
  if(!empty(array_diff($a1, $a2)) || !empty(array_diff($a2, $a1))){
    array_push($mejoraConsulta, "No has seleccionado las tablas correctas.");
    $v = true;
  }else{
    if(stripos($arraySolucion, 'full') !== false){
      if(stripos($arrayQueryUser, 'full') === false){
        array_push($mejoraConsulta, "Debes hacer un full outer join.");
        $v = true;
      }
    }else{
      if(stripos($arrayQueryUser, 'full') !== false){
        array_push($mejoraConsulta, "No hace falta que hagas un full outer join para este ejercicio.");
        $v = true;
      }
    }
    if(!$v && (stripos($arraySolucion, 'left') !== false)){
      if(stripos($arrayQueryUser, 'left') === false){
        array_push($mejoraConsulta, "Debes combinar los registros de las tablas mediante un left outer join.");
        $v = true;
      }
    }
    if(!$v && (stripos($arraySolucion, 'right') !== false)){
      if(stripos($arrayQueryUser, 'right') === false){
        array_push($mejoraConsulta, "Debes combinar los registros de las tablas mediante un right outer join.");
        $v = true;
      }
    } 
    if(!$v && (stripos($arrayQueryUser, 'left') !== false || stripos($arrayQueryUser, 'right') !== false) && 
    (stripos($arraySolucion, 'left') === false || stripos($arraySolucion, 'right') === false)){
        array_push($mejoraConsulta, "No hace falta que hagas un left outer join o right outer join para este ejercicio.");
        $v = true;
    }
  }
  

  return $v;
}

function getTablas($str){
  preg_match_all('/clientes|ventas|articulos|pesos|proveedores|tiendas/', $str, $m);
  return $m[0];
}

function getCampos($str){
  $res = str_replace('select ', '', $str);
  $res = str_replace(' ', '', $str);
  $res = preg_replace_callback('/\'.+\',/', function($coincidencias){return ' ';}, $res);
  $res = preg_replace_callback('/\'.+\'/', function($coincidencias){return '';}, $res);
  $res = preg_replace_callback('/,/',function($coincidencias){return ' ';}, $res); //En caso de que no haya renombres
  //$res = preg_replace_callback('/\s+/', function($coincidencias){return ' ';}, $res);
  return explode(' ', $res);
}


function cambiarCase($q){
  $i = 0;
  $q2 = array();
  foreach($q as $key => $value){
    $aux = strtolower(json_encode($value, JSON_UNESCAPED_UNICODE));
    $q2[$i] = json_decode($aux, true);
    $i++;
  }
  return $q2;
}