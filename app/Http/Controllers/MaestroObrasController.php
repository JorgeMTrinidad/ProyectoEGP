<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MaestroObras;
use Illuminate\Support\Facades\Redirect;
use DB;

class MaestroObrasController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        if($request){

            $sql=trim($request->get('buscarTexto'));
            $maestroObras=DB::table('maestrosobras')
            ->where('nombre','LIKE','%'.$sql.'%')
            ->orwhere('num_documento','LIKE','%'.$sql.'%')
            ->orderBy('id','desc')
            ->paginate(3);
            return view('maestroObras.index',["maestroObras"=>$maestroObras,"buscarTexto"=>$sql]);
            //return $maestrosobras;
        }

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $maestroObras= new MaestroObras();
        $maestroObras->nombre = $request->nombre;
        $maestroObras->num_documento = $request->num_documento;
        $maestroObras->telefono = $request->telefono;
        $maestroObras->email = $request->email;
        $maestroObras->direccion = $request->direccion;
        $maestroObras->save();
        return Redirect::to("maestroObras");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $value = $request->all();
        print_r($value);

        $maestroObras= MaestroObras::findOrFail($request->id_maestroobras);
        $maestroObras->nombre = $request->nombre;
        $maestroObras->num_documento = $request->num_documento;
        $maestroObras->telefono = $request->telefono;
        $maestroObras->email = $request->email;
        $maestroObras->direccion = $request->direccion;
        $maestroObras->save();
        return Redirect::to("maestroObras");
    }

}
