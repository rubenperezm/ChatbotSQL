<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use App\Ejercicio;
use App\Logs;
use Response;
use DB;

class apiEjercicioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){}

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function storeConversacion(Request $request)
    {
      $infoConversacion = request()->json()->all();
      $exiteIntento = Logs::where("uuidIntento",$infoConversacion['uuidIntento'])->first();
      if($exiteIntento !== null){
        $exiteIntento->conversacion = $infoConversacion['conversacion'];
        $exiteIntento->mensajes = $infoConversacion['mensajes'];
        $exiteIntento->save();
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $ej = json_decode(Ejercicio::where('id', $id)->get(), true);
          $ay = json_decode($ej[0]['ayuda'], true);
          $ay2= array();
          foreach($ay as $key => $value){
            if ($value['texto'] === ''){
              unset($ay[$key]);
            }else{
              $ay2[str_replace(' by', '', str_replace('ayuda ', '', $value['parte']))] = $value['texto'];
            }
          }
          $ej[0]['ayuda'] = json_encode($ay2, JSON_UNESCAPED_UNICODE);
          return $ej;
    }

}