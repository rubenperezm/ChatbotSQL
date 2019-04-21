<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use Response;
use DB;

class EjercicioController extends Controller
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
    public function index()
    {
        return view('ejercicio');
    }

    public function ajaxFormularioQuery(Request $request)
    {
        Debugbar::info($request['query']);
        try {
         $users = DB::select($request['query']);
        } catch(\Illuminate\Database\QueryException $ex){
          return Response::json($ex->getMessage());
        }

        return Response::json($users);
    }
}
