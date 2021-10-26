<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Egreso;
use App\DetalleEgreso;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;
use Auth;

class EgresoController extends Controller
{

    public function index(Request $request){

        if($request){

            $sql=trim($request->get('buscarTexto'));
            $egresos=Egreso::join('maestrosobras','egresos.idmaestroobras','=','maestrosobras.id')
            ->join('users','egresos.idusuario','=','users.id')
            ->join('detalle_egresos','egresos.id','=','detalle_egresos.idegreso')
             ->select('egresos.id','egresos.tipo_identificacion',
             'egresos.num_egreso','egresos.fecha_egreso',
             'egresos.estado','egresos.total','maestrosobras.nombre as maestroobras','users.nombre')
            ->where('egresos.tipo_identificacion','LIKE','%'.$sql.'%')
            ->orwhere('maestrosobras.nombre','LIKE','%'.$sql.'%')
            ->orwhere('egresos.num_egreso','LIKE','%'.$sql.'%')
            ->orwhere('users.nombre','LIKE','%'.$sql.'%')
            ->orderBy('egresos.id','desc')
            ->groupBy('egresos.id','egresos.tipo_identificacion',
            'egresos.num_egreso','egresos.fecha_egreso',
            'egresos.estado','egresos.total','maestrosobras.nombre','users.nombre')
            ->paginate(8);


            return view('egreso.index',["egresos"=>$egresos,"buscarTexto"=>$sql]);
            //return $egresos;
        }


     }

        public function create(){

             /*listar las maestrosobras en egresona modal*/
             $maestrosobras=DB::table('maestrosobras')->get();

             /*listar los productos en egresona modal*/
             $productos=DB::table('productos')
             ->select(DB::raw('CONCAT(codigo," ",nombre) AS producto'),'id','stock','precio_venta')
             ->where('condicion','=','1')
             ->where('stock','>','0')
             ->groupBy('producto','id','stock','precio_venta')
             ->get();


             return view('egreso.create',["maestrosobras"=>$maestrosobras,"productos"=>$productos]);

        }

         public function store(Request $request){


             try{

                 DB::beginTransaction();
                 $mytime= Carbon::now('America/Guatemala');

                 $egreso = new Egreso();
                 $egreso->idmaestroobras = $request->id_maestroobras;
                 $egreso->idusuario = Auth::user()->id;
                 $egreso->tipo_identificacion = $request->tipo_identificacion;
                 $egreso->fecha_egreso = $mytime->toDateString();
                 $egreso->total=$request->total_pagar;
                 $egreso->estado = 'Registrado';
                 $egreso->save();

                 $id_producto=$request->id_producto;
                 $cantidad=$request->cantidad; // aca solo llega un campo cantidad 2
                 $precio=$request->precio_egreso;
                 $revision=$request->estado_egreso;


                 $cont=0;

                  while($cont < count($id_producto)){

                     $detalle = new DetalleEgreso();
                     /*enviamos valores a las propiedades del objeto detalle*/
                     /*al idcompra del objeto detalle le envio el id del objeto egreso, que es el objeto que se ingresó en la tabla egresos de la bd*/
                     /*el id es del registro de la egreso*/
                     $detalle->idegreso = $egreso->id;
                     $detalle->idproducto = $id_producto[$cont];

                     $detalle->cantidad = $cantidad[$cont]; //cantidad
                     $detalle->precio = $precio[$cont];
                     $detalle->revision = $revision[$cont];
                     $detalle->save();
                     $cont=$cont+1;
                 }

                 DB::commit();

             } catch(Exception $e){

                 DB::rollBack();
             }

             return Redirect::to('egreso');
         }

         public function show($id){

             //dd($id);
             //dd($request->all());

             /*mostrar egreso*/

             //$id = $request->id;
             $egreso = Egreso::join('maestrosobras','egresos.idmaestroobras','=','maestrosobras.id')
             ->join('detalle_egresos','egresos.id','=','detalle_egresos.idegreso')
             ->select('egresos.id','egresos.tipo_identificacion',
             'egresos.num_egreso','egresos.fecha_egreso',
             'egresos.estado','maestrosobras.nombre',
             DB::raw('sum(detalle_egresos.cantidad*precio) as total')
             )
             ->where('egresos.id','=',$id)
             ->orderBy('egresos.id', 'desc')
             ->groupBy('egresos.id','egresos.tipo_identificacion',
             'egresos.num_egreso','egresos.fecha_egreso',
             'egresos.estado','maestrosobras.nombre')
             ->first();

             /*mostrar detalles*/
             $detalles = DetalleEgreso::join('productos','detalle_egresos.idproducto','=','productos.id')
             ->select('detalle_egresos.cantidad','detalle_egresos.revision','detalle_egresos.precio','productos.nombre as producto')
             ->where('detalle_egresos.idegreso','=',$id)
             ->orderBy('detalle_egresos.id', 'desc')->get();

             return view('egreso.show',['egreso' => $egreso,'detalles' =>$detalles]);
         }

         public function destroy(Request $request){

             $egreso = Egreso::findOrFail($request->id_egreso);
             $egreso->estado = 'Anulado';
             $egreso->save();
             return Redirect::to('egreso');

        }

         public function pdf(Request $request,$id){

             $egreso = Egreso::join('maestrosobras','egresos.idmaestroobras','=','maestrosobras.id')
             ->join('users','egresos.idusuario','=','users.id')
             ->join('detalle_egresos','egresos.id','=','detalle_egresos.idegreso')
             ->select('egresos.id','egresos.tipo_identificacion',
             'egresos.num_egreso','egresos.fecha_egreso',
             'egresos.estado',DB::raw('sum(detalle_egresos.cantidad*precio) as total'),'maestrosobras.nombre','maestrosobras.num_documento',
             'maestrosobras.direccion','maestrosobras.num_documento','maestrosobras.email','maestrosobras.telefono','users.usuario')
             ->where('egresos.id','=',$id)
             ->orderBy('egresos.id', 'desc')
             ->groupBy('egresos.id','egresos.tipo_identificacion',
             'egresos.num_egreso','egresos.fecha_egreso',
             'egresos.estado','maestrosobras.nombre','maestrosobras.num_documento',
             'maestrosobras.direccion','maestrosobras.email','maestrosobras.telefono','users.usuario')
             ->take(1)->get();

             $detalles = DetalleEgreso::join('productos','detalle_egresos.idproducto','=','productos.id')
             ->select('detalle_egresos.cantidad','detalle_egresos.revision','detalle_egresos.precio',
             'productos.nombre as producto')
             ->where('detalle_egresos.idegreso','=',$id)
             ->orderBy('detalle_egresos.id', 'desc')->get();

             $numegreso=Egreso::select('num_egreso')->where('id',$id)->get();

             foreach($egreso as $date){
                $fecha = $date->fecha_egreso;
            }
             $pdf= \PDF::loadView('pdf.egreso',['egreso'=>$egreso,'detalles'=>$detalles,'fecha'=>$fecha]);
             return $pdf->download('egreso-'.$numegreso[0]->num_egreso.'.pdf');
         }


}
