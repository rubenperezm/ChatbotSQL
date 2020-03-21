<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use DateTime;
use Debugbar;
use App\Mensajes;
use App\Conversaciones;
use App\Http\Controllers\Controller;
use App\Http\Controllers\botApiController;
use GuzzleHttp\Client;

class refrescarLogsController extends Controller
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

    public static function index(){
      $ApiController = new botApiController;
      $api = $ApiController->index();
      //Recorremos cada log sacado de la api ya formateado
      foreach ($api['array'] as $i => $d) {
        $id = Mensajes::select('log_id')->where('log_id' , $d['log_id'])->first();
        //Comprabamos que es que no se encuentra ya guardado.
        if(is_null($id)){
          $numMensajes = Conversaciones::select('mensajes')->where('conversation_id' , $d['conversation_id'])->first();
          if(is_null($numMensajes)){
            $data = 0;
          }else{
            $data= json_decode(json_encode($numMensajes), true);
            $data  = $data['mensajes'];
          }

          $cont = 0;
          if($d['textoPregunta'] != "") $cont++;
          $cont++;
          $data = $data + $cont;

          $conversaciones = Conversaciones::updateOrCreate(
             ['conversation_id' => $d['conversation_id']],
             [
               'mensajes' => $data,
               'idWorkspace' => $d['idWorkspace'],
               'request_timestamp' => $d['request_timestamp'],
               'response_timestamp' => $d['response_timestamp'],
               'conversation_id' => $d['conversation_id'],
             ]
         );

         $id = Conversaciones::select('id')->where('conversation_id' , $d['conversation_id'])->first();
         $data= json_decode(json_encode($id), true);

         $mensajes = Mensajes::updateOrCreate(
            ['log_id' => $d['log_id']],
            [
              'request_timestamp' => $d['request_timestamp'],
              'response_timestamp' => $d['response_timestamp'],
              'log_id' => $d['log_id'],
              'conver_id' => $data['id'],
              'textoPregunta' => $d['textoPregunta'],
              'textoRespuesta' => $d["textoRespuesta"],
              'IntencionSeleccionada' => $d['IntencionSeleccionada'],
              'confianza' => $d['ConfianzaSeleccionada'],
              'IntencionesCandidatas' => $d['IntencionesCandidatas'],
              'error' => $d['error'],
              'mensajeLog' => $d['mensajeLog'],
              'jsonLog' => $d["jsonLog"]
            ]
          );
        }
      }


     return redirect('editarEjercicio');


    }

}


function FormatDate($fecha) {
  $date = new DateTime($fecha);
  return $date->format('Y-m-d H:i:s');
}
