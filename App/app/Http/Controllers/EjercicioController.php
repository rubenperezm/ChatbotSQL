<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use App\Ejercicio;
use App\User;
use Session;
use Response;
use DB;

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
        Session::put('lugarConversacion',0);
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
        Debugbar::info($ejerciciosResuelto);
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
        Debugbar::info($ejerciciosResuelto);
        Debugbar::info($todosPrincipiantes);
        Debugbar::info($todosIntermedios);

        return view('ejercicio.vistaEjercicio2',['id' => $id,'enunciado' => $enun, "ejercicios" => $ejercicios,'esPrincipiante' => $todosPrincipiantes,'esIntermedio' => $todosIntermedios,'ejerciciosResuelto' => $ejerciciosResuelto]);
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
      $ejerciciosResuelto =  User::select("id","ejerciciosResueltos")->find(auth()->user()->id);
      $ejercicioRe =  json_decode($ejerciciosResuelto->ejerciciosResueltos,true);
      if($ejercicioRe == null) $ejercicioRe = array();
      if (!in_array($request->idEjercicio, $ejercicioRe)) {
        array_push($ejercicioRe,$request->id);
        $ejerciciosResuelto->ejerciciosResueltos = json_encode($ejercicioRe);
        $ejerciciosResuelto->save();
      }
      return Response::json("success");
    }

    public function ajaxFormularioQuery(Request $request)
    {
        $solucion = Ejercicio::find($request['id']);
        Debugbar::info($solucion);
        $solucionQuery = $solucion->solucionQuery;
        $this->solucionLugar = lugarSolucion($solucionQuery);
        Debugbar::info(Session::get('lugarConversacion'));
        $respuestaQuery = array();
        $mejoraConsulta = array();
        try {
         $users = DB::connection('mysql2')->select($request['query']);
         if(esSolucionString($solucionQuery,$request['query']) || (soloFaltaOrderBy($solucionQuery,$request['query']) && Session::get('lugarConversacion') < 6)){
            Debugbar::info("pasaAsolucion");
           if(soloFaltaOrderBy($solucionQuery,$request['query'])){
             Debugbar::info("pasaAsolucionFaltaOder");
             //salto correcto having
             Session::put('lugarConversacion',6);
             array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_having_correcto laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
           }else{
             array_push($respuestaQuery ,array("query" => "lo has terminado","conversacionBot" => "finalConversacionCorrectolaravel"));
           }
         }else{
           if(compruebaPasoSiguiente($request['query'],$this->conversacion[Session::get('lugarConversacion')])){
             Debugbar::info("paso por aqui PasoSiguiente");
             if(comprueba($request['query'],$solucionQuery,$this->conversacion[Session::get('lugarConversacion')],$mejoraConsulta)){
               Debugbar::info("paso por aqui2 comprueba 2");
               //si avazamos a la siguiente pos de un select teniendo un groupby sin where tenemos que saltarnos el where
               if(groupBySinWhere($solucionQuery) && $this->conversacion[Session::get('lugarConversacion')] == "select"){
                 Debugbar::info("group sin where");
                 //lugar que ocupa tras ser un salto correcto de where
                 Session::put('lugarConversacion',4);
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_where_correcto laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
               }else{
                 Debugbar::info("group con where");
                 Session::put('lugarConversacion',Session::get('lugarConversacion')+1);
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "pasaSiguiente  laravel","lugarConversacion" => Session::get('lugarConversacion')+1)); //el +1 en el lugarConversacion es porque en la base de datos el 0 es el enunciado
               }
             }else{
               array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "comprobacion_query  laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
             }
           }else{
             if (stripos($request['query'], 'order by') !== false && Session::get('lugarConversacion') < 6 && 6 <= $this->solucionLugar) {
               Session::put('lugarConversacion',6);
               if(comprueba($request['query'],$solucionQuery,"order by",$mejoraConsulta)){
                 array_push($respuestaQuery ,array("query" => "lo has terminado","conversacionBot" => "finalConversacionCorrectolaravel"));
               }else{
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_order_parcial laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
               }
             }elseif(stripos($request['query'], 'where') === false && stripos($request['query'], 'select') !== false
             && stripos($request['query'], 'group by') === false && stripos($request['query'], 'having') === false && Session::get('lugarConversacion') < 2 && 2 <= $this->solucionLugar){
               Session::put('lugarConversacion',2);
               if(comprueba($request['query'],$solucionQuery,"select",$mejoraConsulta)){
                 if(groupBySinWhere($solucionQuery)){
                   Session::put('lugarConversacion',4);
                   array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_where_correcto laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
                 }else{
                   if(orderBySolo($solucionQuery)){
                     Session::put('lugarConversacion',6);
                     array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_having_correcto laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
                   }else{
                     Session::put('lugarConversacion',Session::get('lugarConversacion')+1);
                     array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_select_correcto laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
                   }
                 }
               }else{
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_select_parcial laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
               }
             }elseif (stripos($request['query'], 'show') !== false && Session::get('lugarConversacion') < 0 &&  0 <= $this->solucionLugar) {
               Session::put('lugarConversacion',0);
               array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_show_correcto","lugarConversacion" => Session::get('lugarConversacion')+1));
               Session::put('lugarConversacion',Session::get('lugarConversacion')+1);
             }elseif (stripos($request['query'], 'describe') !== false && Session::get('lugarConversacion') < 1 &&  1 <= $this->solucionLugar) {
               Session::put('lugarConversacion',1);
               if(comprueba($request['query'],$solucionQuery,"describe",$mejoraConsulta)){
                 Session::put('lugarConversacion',Session::get('lugarConversacion')+1);
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_describe_correcto laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
               }else{
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_describe_parcial laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
               }
             }elseif (stripos($request['query'], 'select') !== false && stripos($request['query'], 'where') !== false && stripos($request['query'], 'group by') === false && stripos($request['query'], 'having') === false
             && Session::get('lugarConversacion') < 3 && 3 <= $this->solucionLugar) {
               Session::put('lugarConversacion',3);
               if(comprueba($request['query'],$solucionQuery,"where",$mejoraConsulta)){
                 Session::put('lugarConversacion',Session::get('lugarConversacion')+1);
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_where_correcto laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
               }else{
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_where_parcial laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
               }
             }elseif (stripos($request['query'], 'group by') !== false && stripos($request['query'], 'having') === false && Session::get('lugarConversacion') < 4 && 4 <= $this->solucionLugar) {
               Session::put('lugarConversacion',4);
               $whereCase = "groupBySinWhere";
               if(stripos($request['query'], 'where') !== false) $whereCase = "groupByConWhere";
               if(comprueba($request['query'],$solucionQuery,$whereCase,$mejoraConsulta)){
                 if(stripos($request['query'], 'having') !== false){
                   Session::put('lugarConversacion',Session::get('lugarConversacion')+1);
                   array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_group_correcto laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
                 }else{
                   //si no existe ira directo al order by
                   Session::put('lugarConversacion',Session::get('lugarConversacion')+2);
                   array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_having_correcto laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
                 }
               }else{
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_group_parcial laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
               }
             }
             elseif (stripos($request['query'], 'group by') !== false && stripos($request['query'], 'having') !== false && Session::get('lugarConversacion') < 5 && 5 <= $this->solucionLugar) {
               Session::put('lugarConversacion',5);
               $whereCase = "havingSinWhere";
               if(stripos($request['query'], 'where') !== false) $whereCase = "havingConWhere";
               if(comprueba($request['query'],$solucionQuery,$whereCase,$mejoraConsulta)){
                 Session::put('lugarConversacion',Session::get('lugarConversacion')+1);
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_having_correcto laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
               }else{
                 array_push($respuestaQuery ,array("query" => $users,"conversacionBot" => "salto_having_parcial laravel","lugarConversacion" => Session::get('lugarConversacion')+1));
               }
             }
           }

           if(empty($respuestaQuery))array_push($respuestaQuery ,array("query" => $users));
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
          Debugbar::info();
          array_push($respuestaQuery ,array("query" => $ex->getMessage(),"conversacionBot" => $msg));
          return Response::json($respuestaQuery);
        }
        array_push($respuestaQuery,$mejoraConsulta);
        return Response::json($respuestaQuery);
    }

}

function groupBySinWhere($solucion){
  $solucion = strtolower($solucion);
  if(stripos($solucion, 'where') === false && stripos($solucion, 'group by') !== false) return true;
  else return false;
}
function orderBySolo($solucion){
  $solucion = strtolower($solucion);
  if(stripos($solucion, 'where') === false && stripos($solucion, 'group by') === false && stripos($solucion, 'order by') !== false) return true;
  else return false;
}

function soloFaltaOrderBy($solucion,$miString){
  $solucionRegister = DB::connection('mysql2')->select($solucion);
  $miStringRegister = DB::connection('mysql2')->select($miString);
  if(esSolucion($solucionRegister,$miStringRegister) && stripos($solucion, 'order by') !== false && stripos($miString, 'order by') === false) return true;
  else return false;
}

function esSolucionString($solucion,$miString){
  $solucionArray = DB::connection('mysql2')->select($solucion);
  $miStringArray = DB::connection('mysql2')->select($miString);
  if(stripos($solucion, 'order by') !== false){
    if(esSolucion($solucionArray,$miStringArray)){
      $mejoraConsulta = array();
      if(comprueba($miString,$solucion,"order by",$mejoraConsulta))return true;
      else return false;
    }else return false;
  }else return esSolucion($solucionArray,$miStringArray);
}

function esSolucion($solucion,$miString){
  Debugbar::info(count($solucion));
  Debugbar::info(count($miString));
  if(count($solucion) == count($miString)){
    $esIgual = true;
    foreach ($miString as $key => $value) {
      if (!compruebaRegistro($value,$solucion)){
         $esIgual = false;
      }
    }
  }else{
    return false;
  }
  if($esIgual) return true;
  else return false;
}

function compruebaRegistro($registroAComparar,$solucion){
  $existeCoincidencia = false;
  foreach ($solucion as $key => $value) {
    $diff = collect($value)->diffAssoc(collect($registroAComparar));
    //tiene que tener el mismo numero de registro
    if(empty($diff->all()) && collect($value)->count() == collect($registroAComparar)->count()) $existeCoincidencia = true;
  }
  if($existeCoincidencia) return true;
  else return false;
}


function comprueba($miString,$solucion,$tipoConsulta,&$mejoraConsulta){
  Debugbar::info("comprueba");
  Debugbar::info($tipoConsulta);
    switch ($tipoConsulta) {
      case 'select':
        if(compruebaTabla($miString,$solucion,"from") && compruebaCampos($miString,$solucion)) return true;
        else{
          if (!compruebaTabla($miString,$solucion,"from")) {
            array_push($mejoraConsulta,"Por lo que parece no has introducido el nombre de la tabla que es, repasa en que tabla estas mirando");
          }
          if (!compruebaCampos($miString,$solucion)) {
            array_push($mejoraConsulta,"Parece ser que los campos que has metido no son los indicados. Recuerda buscar solo en los campos necesarios para no consumir recursos innecesarios");
          }
          Debugbar::info("select mejora");
          Debugbar::info($mejoraConsulta);
          return false;
        }
        break;
      case 'show':
        return true;
        break;
      case 'where':
      Debugbar::info("compurebaWhere");
      Debugbar::info(compruebaFiltro($miString, $solucion));
      if(compruebaCampos($miString,$solucion) && compruebaTabla($miString, $solucion,"from") && compruebaFiltro($miString, $solucion)) return true;
      else{
        if (!compruebaTabla($miString,$solucion,"from")) {
          array_push($mejoraConsulta,"Por lo que parece no has introducido el nombre de la tabla que es, repasa en que tabla estas mirando");
        }
        if (!compruebaCampos($miString,$solucion)) {
          array_push($mejoraConsulta, "Parece ser que los campos que has metido no son los indicados. Recuerda buscar solo en los campos necesarios para no consumir recursos innecesarios");
        }
        if (!compruebaFiltro($miString,$solucion)) {
          array_push($mejoraConsulta,"Al parecer no has hecho un buen filtro en el where, revisa esos filtro si son los que necesitas para llegar a la solución");
        }
        Debugbar::info($mejoraConsulta);
        return false;
      }
        break;
      case 'describe':
        if(compruebaTabla($miString,$solucion,"describe")) return true;
        else {
          if (!compruebaTabla($miString,$solucion,"describe")) {
            array_push($mejoraConsulta,"Por lo que parece no has introducido el nombre de la tabla que es, repasa en que tabla estas mirando");
          }
          return false;
        }
        break;
      case 'groupBySinWhere':
        if(compruebaCampos($miString,$solucion) && compruebaTabla($miString, $solucion,"from") && compruebaCamposGroup($miString, $solucion)) return true;
        else{
          if (!compruebaTabla($miString,$solucion,"from")) {
            array_push($mejoraConsulta,"Por lo que parece no has introducido el nombre de la tabla que es, repasa en que tabla estas mirando");
          }
          if (!compruebaCampos($miString,$solucion)) {
            array_push($mejoraConsulta, "Parece ser que los campos que has metido no son los indicados. Recuerda buscar solo en los campos necesarios para no consumir recursos innecesarios");
          }
          if (!compruebaCamposGroup($miString,$solucion)) {
            array_push($mejoraConsulta,"FRASE A METER SI HAY ALGUN FALLO EN EL FILTRO GROUP BY");
          }
          return false;
        }
        break;
      case 'groupByConWhere':
        if(compruebaCampos($miString,$solucion) && compruebaTabla($miString, $solucion,"from") && compruebaFiltro($miString, $solucion) && compruebaCamposGroup($miString, $solucion)) return true;
        else{
          if (!compruebaTabla($miString,$solucion,"from")) {
            array_push($mejoraConsulta,"Por lo que parece no has introducido el nombre de la tabla que es, repasa en que tabla estas mirando");
          }
          if (!compruebaCampos($miString,$solucion)) {
            array_push($mejoraConsulta, "Parece ser que los campos que has metido no son los indicados. Recuerda buscar solo en los campos necesarios para no consumir recursos innecesarios");
          }
          if (!compruebaFiltro($miString,$solucion)) {
            array_push($mejoraConsulta,"Al parecer no has hecho un buen filtro en el where, revisa esos filtro si son los que necesitas para llegar a la solución");
          }
          if (!compruebaCamposGroup($miString,$solucion)) {
            array_push($mejoraConsulta,"FRASE A METER SI HAY ALGUN FALLO EN EL FILTRO GROUP BY");
          }
          return false;
        }
        break;
      case 'group by':
        if(compruebaCampos($miString,$solucion) && compruebaTabla($miString, $solucion,"from") && compruebaFiltro($miString, $solucion) && compruebaCamposGroup($miString, $solucion)) return true;
        else{
          if (!compruebaTabla($miString,$solucion,"from")) {
            array_push($mejoraConsulta,"Por lo que parece no has introducido el nombre de la tabla que es, repasa en que tabla estas mirando");
          }
          if (!compruebaCampos($miString,$solucion)) {
            array_push($mejoraConsulta, "Parece ser que los campos que has metido no son los indicados. Recuerda buscar solo en los campos necesarios para no consumir recursos innecesarios");
          }
          if (!compruebaFiltro($miString,$solucion)) {
            array_push($mejoraConsulta,"Al parecer no has hecho un buen filtro en el where, revisa esos filtro si son los que necesitas para llegar a la solución");
          }
          if (!compruebaCamposGroup($miString,$solucion)) {
            array_push($mejoraConsulta,"FRASE A METER SI HAY ALGUN FALLO EN EL FILTRO GROUP BY");
          }
          return false;
        }
        break;
      case 'havingConWhere':
      if(compruebaCampos($miString,$solucion) && compruebaTabla($miString, $solucion,"from") && compruebaFiltro($miString, $solucion) && compruebaCamposGroup($miString, $solucion) && compruebaFiltroHaving($miString, $solucion)) return true;
      else{
        if (!compruebaTabla($miString,$solucion,"from")) {
          array_push($mejoraConsulta,"Por lo que parece no has introducido el nombre de la tabla que es, repasa en que tabla estas mirando");
        }
        if (!compruebaCampos($miString,$solucion)) {
          array_push($mejoraConsulta, "Parece ser que los campos que has metido no son los indicados. Recuerda buscar solo en los campos necesarios para no consumir recursos innecesarios");
        }
        if (!compruebaFiltro($miString,$solucion)) {
          array_push($mejoraConsulta,"Al parecer no has hecho un buen filtro en el where, revisa esos filtro si son los que necesitas para llegar a la solución");
        }
        if (!compruebaCamposGroup($miString,$solucion)) {
          array_push($mejoraConsulta,"FRASE A METER SI HAY ALGUN FALLO EN EL FILTRO GROUP BY");
        }
        if (!compruebaFiltroHaving($miString,$solucion)) {
          array_push($mejoraConsulta,"FRASE A METER SI HAY ALGUN FALLO EN EL FILTRO HAVING");
        }

        return false;
        }
        break;
      case 'havingSinWhere':
      if(compruebaCampos($miString,$solucion) && compruebaTabla($miString, $solucion,"from") && compruebaFiltro($miString, $solucion) && compruebaFiltroGroup($miString, $solucion) && compruebaFiltroHaving($miString, $solucion)) return true;
      else{
        if (!compruebaTabla($miString,$solucion,"from")) {
          array_push($mejoraConsulta,"Por lo que parece no has introducido el nombre de la tabla que es, repasa en que tabla estas mirando");
        }
        if (!compruebaCampos($miString,$solucion)) {
          array_push($mejoraConsulta, "Parece ser que los campos que has metido no son los indicados. Recuerda buscar solo en los campos necesarios para no consumir recursos innecesarios");
        }
        if (!compruebaFiltroGroup($miString,$solucion)) {
          array_push($mejoraConsulta,"FRASE A METER SI HAY ALGUN FALLO EN EL FILTRO GROUP BY");
        }
        if (!compruebaFiltroHaving($miString,$solucion)) {
          array_push($mejoraConsulta,"FRASE A METER SI HAY ALGUN FALLO EN EL FILTRO HAVING");
        }

        return false;
        }
        break;
        case 'order by':
        if(compruebaCampos($miString,$solucion) && compruebaTabla($miString, $solucion,"from") && compruebaFiltro($miString, $solucion) && compruebaCamposGroup($miString, $solucion)
         && compruebaFiltrohaving($miString, $solucion) && compruebaCamposOrderby($miString, $solucion)) return true;
        else{
          if (!compruebaTabla($miString,$solucion,"from")) {
            array_push($mejoraConsulta,"Por lo que parece no has introducido el nombre de la tabla que es, repasa en que tabla estas mirando");
          }
          if (!compruebaCampos($miString,$solucion)) {
            array_push($mejoraConsulta, "Parece ser que los campos que has metido no son los indicados. Recuerda buscar solo en los campos necesarios para no consumir recursos innecesarios");
          }
          if (!compruebaFiltro($miString,$solucion)) {
            array_push($mejoraConsulta,"Al parecer no has hecho un buen filtro en el where, revisa esos filtro si son los que necesitas para llegar a la solución");
          }
          if (!compruebaCamposGroup($miString,$solucion)) {
            array_push($mejoraConsulta,"FRASE A METER SI HAY ALGUN FALLO EN EL FILTRO group");
          }
          if (!compruebaFiltrohaving($miString,$solucion)) {
            array_push($mejoraConsulta,"FRASE A METER SI HAY ALGUN FALLO EN EL FILTRO HAVING");
          }
          if (!compruebaCamposOrderby($miString,$solucion)) {
            array_push($mejoraConsulta,"FRASE A METER SI HAY ALGUN FALLO EN EL FILTRO order by");
          }
          return false;
          }
          break;

      default:
        return false;
        break;
    }
}

function compruebaPasoSiguiente($miString,$clausula){
  Debugbar::info($clausula);
  if($clausula === "select"){
    Debugbar::info($clausula);
    Debugbar::info(stripos($miString, 'where') === false && stripos($miString, 'select') !== false);
    if(stripos($miString, 'where') === false && stripos($miString, 'select') !== false) return true;
    else return false;
  }else{
    if(stripos($miString, $clausula)!== false) return true;
    else return false;
  }
}

function compruebaTabla($miString,$solucion,$tipoConsulta){


  $solucion = strtolower($solucion);
  $miString = strtolower($miString);

  $consultaSegmentada = explode($tipoConsulta, $miString);
  $consultaSeg = trim($consultaSegmentada[1]);
  $tablaConsulta = explode(' ', $consultaSeg);


  switch ($solucion) {
    case (stripos($solucion, 'describe') !== false):
      $solucionSegmentada = explode("describe", $solucion);
      $consultaSeg = trim($solucionSegmentada[1]);
      $tablaSolucion = explode(' ', $consultaSeg);
      break;
    case (stripos($solucion, 'from') !== false):
      $solucionSegmentada = explode("from", $solucion);
      $consultaSeg = trim($solucionSegmentada[1]);
      $tablaSolucion = explode(' ', $consultaSeg);
      break;
    default:
      return 99;
      break;
  }

  if($tablaConsulta[0] == $tablaSolucion[0]) return true;
  else return false;
}

function compruebaFiltroHaving($miString,$solucion){
  $solucion = strtolower($solucion);
  $miString = strtolower($miString);
  if(stripos($solucion, 'having') !== false){

    if(stripos($miString, 'having') === false){
      return false;
    }

    if(stripos($solucion, 'order by') !== false ){
      $solucionSegmentada = explode("order by", $solucion);
      $solucion = trim($solucionSegmentada[0]);
    }

    $miStringCollect = DB::connection('mysql2')->select($miString);
    $solucionCollect = DB::connection('mysql2')->select($solucion);
    Debugbar::info("compruebaFiltrohaving");
    Debugbar::info($miStringCollect);
    Debugbar::info($solucionCollect);

    if(count($solucionCollect) == count($miStringCollect)){
      $esIgual = true;
      foreach ($miStringCollect as $key => $value) {
        if (!compruebaRegistro($value,$solucionCollect)){
           $esIgual = false;
        }
      }
    }else{
      return false;
    }

    Debugbar::info($esIgual);

    if($esIgual) return true;
    else return false;
  }else{
    return true;
  }
}

function compruebaFiltro($miString,$solucion){
  $solucion = strtolower($solucion);
  $miString = strtolower($miString);
  if(stripos($solucion, 'where') !== false){

    if(stripos($miString, 'where') === false){
      return false;
    }

    if(stripos($solucion, 'group by') !== false ){
      $solucionSegmentada = explode("group by", $solucion);
      $solucion = trim($solucionSegmentada[0]);
    }else{
      if(stripos($solucion, 'order by') !== false ){
        $solucionSegmentada = explode("order by", $solucion);
        $solucion = trim($solucionSegmentada[0]);
      }
    }

    $miStringCollect = DB::connection('mysql2')->select($miString);
    $solucionCollect = DB::connection('mysql2')->select($solucion);
    Debugbar::info("compruebaFiltro");
    Debugbar::info($miStringCollect);
    Debugbar::info($solucionCollect);

    if(count($solucionCollect) == count($miStringCollect)){
      $esIgual = true;
      foreach ($miStringCollect as $key => $value) {
        if (!compruebaRegistro($value,$solucionCollect)){
           $esIgual = false;
        }
      }
    }else{
      return false;
    }

    Debugbar::info($esIgual);

    if($esIgual) return true;
    else return false;
  }else{
    return true;
  }
}

function compruebaCamposOrderby($miString,$solucion){
  $solucion = strtolower($solucion);
  $miString = strtolower($miString);
  $solucion = str_replace(";", "", $solucion);
  $miString = str_replace(";", "", $miString);
  if(stripos($solucion, 'order by') !== false){
    if(stripos($miString, 'order by') === false){
      return false;
    }

    $esIgual = true;
    $solucionSegmentada = explode("order by", $solucion);
    $consultaSolucionSeg = trim($solucionSegmentada[1]);
    $consultaSolucionSeg = explode(' ', $consultaSolucionSeg);

    $miStringSegmentado = explode("order by", $miString);
    $consultaMiStringSeg = trim($miStringSegmentado[1]);
    $consultaMiStringSeg = explode(' ', $consultaMiStringSeg);
    Debugbar::info($consultaSolucionSeg);
    Debugbar::info($consultaMiStringSeg);

    foreach ($consultaSolucionSeg as $key => $value) {
      if($consultaSolucionSeg[$key] !== $consultaMiStringSeg[$key]) $esIgual =  false;
    }
    Debugbar::info($esIgual);

    if($esIgual) return true;
    else return false;

  }else{
    return true;
  }
}

function compruebaCamposGroup($miString,$solucion){
  $solucion = strtolower($solucion);
  $miString = strtolower($miString);
  $solucion = str_replace(";", "", $solucion);
  $miString = str_replace(";", "", $miString);
  if(stripos($solucion, 'group by') !== false){

    if(stripos($solucion, 'group by') === false){
      return false;
    }

    $esIgual = true;

    $solucionSegmentada = explode("group by", $solucion);
    $consultaSolucionSeg = trim($solucionSegmentada[1]);
    if(stripos($consultaSolucionSeg, 'having') === false && stripos($consultaSolucionSeg, 'order by') !== false){
      $consultaSolucionSeg = explode("order by", $consultaSolucionSeg);
      $consultaSolucionSeg = trim($consultaSolucionSeg[0]);
      $consultaSolucionSeg = explode(' ', $consultaSolucionSeg);
    }else{
      if(stripos($consultaSolucionSeg, 'having') !== false ){
        $consultaSolucionSeg = explode("having", $consultaSolucionSeg);
        $consultaSolucionSeg = trim($consultaSolucionSeg[0]);
        $consultaSolucionSeg = explode(' ', $consultaSolucionSeg);
      }else{
        $consultaSolucionSeg = explode(' ', $consultaSolucionSeg);
      }
    }

    $miStringSegmentado = explode("group by", $miString);
    $consultaMiStringSeg = trim($miStringSegmentado[1]);
    if(stripos($consultaMiStringSeg, 'having') === false && stripos($consultaMiStringSeg, 'order by') !== false){
      $consultaMiStringSeg = explode("order by", $consultaMiStringSeg);
      $consultaMiStringSeg = trim($consultaMiStringSeg[0]);
      $consultaMiStringSeg = explode(' ', $consultaMiStringSeg);
    }else{
      if(stripos($consultaMiStringSeg, 'having') !== false ){
        $consultaMiStringSeg = explode("having", $consultaMiStringSeg);
        $consultaMiStringSeg = trim($consultaMiStringSeg[0]);
        $consultaMiStringSeg = explode(' ', $consultaMiStringSeg);
      }else{
        $consultaMiStringSeg = explode(' ', $consultaMiStringSeg);
      }
    }

    Debugbar::info($consultaSolucionSeg);
    Debugbar::info($consultaMiStringSeg);

    if(sizeof($consultaSolucionSeg) == sizeof($consultaMiStringSeg)){
      foreach ($consultaSolucionSeg as $key => $value) {
        if($consultaSolucionSeg[$key] !== $consultaMiStringSeg[$key]) $esIgual =  false;
      }
    }

    Debugbar::info($esIgual);

    if($esIgual) return true;
    else return false;

  }else{
    return true;
  }
}

function lugarSolucion($solucion){
  switch ($solucion) {
    case (stripos($solucion, 'show') !== false):
      return 0;
      break;
    case (stripos($solucion, 'describe') !== false):
      return 1;
      break;
    case (stripos($solucion, 'where') === false && stripos($solucion, 'group by') === false &&
      stripos($solucion, 'having') === false && stripos($solucion, 'order by') === false && stripos($solucion, 'select') !== false):
      return 2;
      break;
    case (stripos($solucion, 'select') !== false && stripos($solucion, 'group by') === false &&
      stripos($solucion, 'having') === false && stripos($solucion, 'order by') === false && stripos($solucion, 'where') !== false):
      return 3;
      break;
    case (stripos($solucion, 'select') !== false &&  stripos($solucion,'group by') !== false && stripos($solucion,'having') === false):
      return 4;
      break;
    case (stripos($solucion, 'select') !== false &&  stripos($solucion,'group by') !== false && stripos($solucion,'having') !== false):
      return 5;
      break;
    case (stripos($solucion, 'order by') !== false):
      return 6;
      break;

    default:
      return 99;
      break;
  }

}


function compruebaCampos($miString,$solucion){
  Debugbar::info("campos");
  $solucion = strtolower($solucion);
  $miString = strtolower($miString);
  if(stripos($miString, 'where') !== false){
    $miString = explode("where", $miString);
    $miString = trim($miString[0]);
  }else{
    if(stripos($miString, 'group by') !== false){
      $miString = explode("group by", $miString);
      $miString = trim($miString[0]);
    }else{
      if(stripos($miString, 'order by') !== false){
        $miString = explode("order by", $miString);
        $miString = trim($miString[0]);
      }
    }
  }
Debugbar::info($miString);


  $campos1 = DB::connection('mysql2')->select($miString);
  $campos2 = DB::connection('mysql2')->select($solucion);


  if(empty((array)$campos1)) return false;
  Debugbar::info($campos1);
  if(isset($campos1[0])){
    $nCamposConsulta = (array)$campos1[0];
    $NCamposConsulta = sizeof($nCamposConsulta);
  }
  if(isset($campos2[0])){
    $nCamposSolucion = (array)$campos2[0];
    $NCamposSolucion = sizeof($nCamposSolucion);
  }
  $diferentesCampos = array_diff_key($nCamposSolucion, $nCamposConsulta);
  if($NCamposConsulta == $NCamposSolucion && empty($diferentesCampos)) return true;
  else return false;

}
