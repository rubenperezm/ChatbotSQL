<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\refrescarLogsController;
use Debugbar;
use App\Ejercicio;
use App\User;
use Session;
use Response;
use DB;
use Illuminate\Support\Facades\Config;

class adminController extends Controller
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
    public function administracion(Request $request)
    {
        $principiante = Ejercicio::where("dificultad",1)->get();
        $intermedios = Ejercicio::where("dificultad",2)->get();
        $avanzao = Ejercicio::where("dificultad",3)->get();
        $usuario=auth()->user();
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
        Debugbar::info($todosPrincipiantes);
        Debugbar::info($todosIntermedios);
        return view('ejercicio.administracion', ['principiante' => $principiante,'intermedios' => $intermedios,
        'avanzao' => $avanzao, "usuario" => $usuario, "esPrincipiante" => $todosPrincipiantes, "esIntermedio" => $todosIntermedios,'ejerciciosResuelto' => $ejerciciosResuelto]);
    }

    public function contacto(Request $request)
    {
        return view('ejercicio.contacto');
    }

    public function editarPerfil(Request $request)
    {
        $request->validate([
          'alias'     => ['required','string', 'max:255'],
          'nombre'          => ['required', 'string', 'max:255'],
          'email'         => ['required', 'string', 'email', 'max:255']
        ]);

        if($request->alias == ""){
          $alias = "Anonymous User";
        }else{
          $alias = $request->alias;
        }

        $usuario = User::find(auth()->user()->id);
        $usuario->name = $request->nombre;
        $usuario->email = $request->email;
        $usuario->alias = $alias;
        $usuario->update();

        return redirect('admin');
    }

}
