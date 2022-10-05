<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Debugbar;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class botApiController extends Controller
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

/* Función que realiza una llamada a nuestra api, recoge sus datos y los deja almacenados en en un array
/ que utilizaran los modelos para guardarlos en su tabla en la base de datos.
*/
    public function index(){
        $client = new Client();
        $logsArray = array();
        $problema = "";
        try{
          $res = $client->request('GET','https://api.eu-gb.assistant.watson.cloud.ibm.com/v2/assistants/4a940d18-797a-4420-ab03-afef92ba43e4/logs?version=2020-09-29&export=true&include_count=true&page_limit=5000&include_audit=true',[
              //'auth' => [env('API_USERNAME') , env('API_PASSWORD')]]);
              'auth' => [env('ASSISTANT_IAM_APIKEY')]]);
          $res = json_decode($res->getBody(), true);
          //Recorremos el array para obtener cada log y lo guardarlo en nuestro array con el dato formateado listo para pasarselo al modelo
          foreach ($res['logs'] as $i => $d)  {
            $logsArray[$i]['idWorkspace'] = $d['assistant_id'];
            $logsArray[$i]['request_timestamp'] = formatDate($d['request_timestamp']);
            $logsArray[$i]['response_timestamp'] = formatDate($d['response_timestamp']);
            $logsArray[$i]['log_id'] = $d['log_id'];
            $logsArray[$i]['conversation_id'] = $d['response']['session_id'];

            if(isset($d['request']['input']['text']))
               $logsArray[$i]['textoPregunta'] = $d['request']['input']['text'];
            else $logsArray[$i]['textoPregunta'] = "";

            if(isset($d['response']['output']['text']))
              $logsArray[$i]['textoRespuesta'] = json_encode($d['response']['output']['text']);
            else  $logsArray[$i]['textoRespuesta'] = json_encode((object)array());

            if(!isset($d['response']['intents'][0])){
              $logsArray[$i]['IntencionSeleccionada'] = json_encode((object)array());
              $logsArray[$i]['ConfianzaSeleccionada'] = 0;
            }else{
              $logsArray[$i]['IntencionSeleccionada'] = json_encode($d['response']['intents'][0]['intent']);
              $logsArray[$i]['ConfianzaSeleccionada'] = $d['response']['intents'][0]['confidence'];
            }
            $logsArray[$i]['IntencionesCandidatas'] = json_encode($d['response']['intents']);

            if(isset($d['response']['output']['error'])){
              $logsArray[$i]['error'] = $d['response']['output']['error'];
            }else $logsArray[$i]['error'] = "";

            if(isset($d['response']['output']['debug']['log_messages'][0])){
              $logsArray[$i]['mensajeLog'] = $d['response']['output']['debug']['log_messages'][0]['level'];
            }else $logsArray[$i]['mensajeLog'] = "";

            $logsArray[$i]['jsonLog'] = json_encode($d);
          }

          // ordenamos los array de manera que los mas antiguos queden los primero para peder el orden en la subida a la base de datos.
          usort($logsArray, function($a, $b) {
              return $a['request_timestamp'] > $b['request_timestamp'];
          });

        }catch(\Exception $e){
          if($e->getCode() == 429){
            $problema ="Tienes que esperar para volver a recargar logs";
          }
        }


        return ['array' => $logsArray, 'string' => $problema];

      }
}
