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
          return Ejercicio::where('id', $id)->get();
    }

}
