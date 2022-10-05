<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use App\Ejercicio;
use App\ModoLibreLogs;
use Response;
use DB;

class apiModoLibreController extends Controller
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
      $exiteIntento = ModoLibreLogs::where("uuidIntento",$infoConversacion['uuidIntento'])->first();
      if($exiteIntento !== null){
        $exiteIntento->conversacion = $infoConversacion['conversacion'];
        $exiteIntento->mensajes = $infoConversacion['mensajes'];
        $exiteIntento->save();
      }
    }

}
