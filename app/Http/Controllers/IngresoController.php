<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingreso;
use App\DetalleIngreso;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;


class IngresoController extends Controller
{

    public function index(Request $request){

        if($request){

            $sql=trim($request->get('buscarTexto'));
            $ingresos=Ingreso::join('proveedores','ingresos.idproveedor','=','proveedores.id')
            ->join('users','ingresos.idusuario','=','users.id')
            ->join('detalle_ingresos','ingresos.id','=','detalle_ingresos.idingreso')
             ->select('ingresos.id','ingresos.tipo_identificacion',
             'ingresos.num_ingreso','ingresos.fecha_ingreso',
             'ingresos.estado','ingresos.total','proveedores.nombre as proveedor','users.nombre')
            ->where('ingresos.num_ingreso','LIKE','%'.$sql.'%')
            ->orderBy('ingresos.id','desc')
            ->groupBy('ingresos.id','ingresos.tipo_identificacion',
            'ingresos.num_ingreso','ingresos.fecha_ingreso',
            'ingresos.estado','ingresos.total','proveedores.nombre','users.nombre')
            ->paginate(8);


            return view('ingreso.index',["ingresos"=>$ingresos,"buscarTexto"=>$sql]);

            //return $ingresos;
        }


     }

        public function create(){

             /*listar las proveedores en ventana modal*/
             $proveedores=DB::table('proveedores')->get();

             /*listar los productos en ventana modal*/
             $productos=DB::table('productos as prod')
             ->select(DB::raw('CONCAT(prod.codigo," ",prod.nombre) AS producto'),'prod.id')
             ->where('prod.condicion','=','1')->get();

             return view('ingreso.create',["proveedores"=>$proveedores,"productos"=>$productos]);

        }

         public function store(Request $request){

         //dd($request->all());

             try{

                 DB::beginTransaction();

                 $mytime= Carbon::now('America/Costa_Rica');

                 $ingreso = new Ingreso();
                 $ingreso->idproveedor = $request->id_proveedor;
                 $ingreso->idusuario = \Auth::user()->id;
                 $ingreso->tipo_identificacion = $request->tipo_identificacion;
                 $ingreso->num_ingreso = $request->num_ingreso;
                 $ingreso->fecha_ingreso = $mytime->toDateString();
                 $ingreso->total = $request->total_pagar;
                 $ingreso->estado = 'Registrado';
                 $ingreso->save();

                 $id_producto=$request->id_producto;
                 $cantidad=$request->cantidad;
                 $precio=$request->precio_ingreso;
                 $revision=$request->estado_ingreso;




                 //Recorro todos los elementos
                 $cont=0;

                  while($cont < count($id_producto)){

                     $detalle = new DetalleIngreso();
                     /*enviamos valores a las propiedades del objeto detalle*/
                     /*al idingreso del objeto detalle le envio el id del objeto ingreso, que es el objeto que se ingresó en la tabla ingresos de la bd*/
                     $detalle->idingreso = $ingreso->id;
                     $detalle->idproducto = $id_producto[$cont];
                     $detalle->cantidad = $cantidad[$cont];
                     $detalle->precio = $precio[$cont];
                     $detalle->revision = $revision[$cont];

                     $detalle->save();
                     $cont=$cont+1;
                 }

                 DB::commit();

             } catch(Exception $e){

                 DB::rollBack();
             }

             return Redirect::to('ingreso');
         }

         public function show($id){

             //dd($id);

             /*mostrar ingreso*/

             //$id = $request->id;
             $ingreso = Ingreso::join('proveedores','ingresos.idproveedor','=','proveedores.id')
             ->join('detalle_ingresos','ingresos.id','=','detalle_ingresos.idingreso')
             ->select('ingresos.id','ingresos.tipo_identificacion',
             'ingresos.num_ingreso','ingresos.fecha_ingreso',
             'ingresos.estado',DB::raw('sum(detalle_ingresos.cantidad*precio) as total'),'proveedores.nombre')
             ->where('ingresos.id','=',$id)
             ->orderBy('ingresos.id', 'desc')
             ->groupBy('ingresos.id','ingresos.tipo_identificacion',
             'ingresos.num_ingreso','ingresos.fecha_ingreso',
             'ingresos.estado','proveedores.nombre')
             ->first();

             /*mostrar detalles*/
             $detalles = DetalleIngreso::join('productos','detalle_ingresos.idproducto','=','productos.id')
             ->select('detalle_ingresos.cantidad','detalle_ingresos.revision','detalle_ingresos.precio','productos.nombre as producto')
             ->where('detalle_ingresos.idingreso','=',$id)
             ->orderBy('detalle_ingresos.id', 'desc')->get();

             return view('ingreso.show',['ingreso' => $ingreso,'detalles' =>$detalles]);
         }

         public function destroy(Request $request){


                 $ingreso = Ingreso::findOrFail($request->id_ingreso);
                 $ingreso->estado = 'Anulado';
                 $ingreso->save();
                 return Redirect::to('ingreso');

     }

         public function pdf(Request $request,$id){

             $ingreso = Ingreso::join('proveedores','ingresos.idproveedor','=','proveedores.id')
             ->join('users','ingresos.idusuario','=','users.id')
             ->join('detalle_ingresos','ingresos.id','=','detalle_ingresos.idingreso')
             ->select('ingresos.id','ingresos.tipo_identificacion',
             'ingresos.num_ingreso','ingresos.created_at',DB::raw('sum(detalle_ingresos.cantidad*precio) as total'),
             'ingresos.estado','proveedores.nombre','proveedores.tipo_documento','proveedores.num_documento',
             'proveedores.direccion','proveedores.email','proveedores.telefono','users.usuario')
             ->where('ingresos.id','=',$id)
             ->orderBy('ingresos.id', 'desc')
             ->groupBy('ingresos.id','ingresos.tipo_identificacion',
             'ingresos.num_ingreso','ingresos.created_at',
             'ingresos.estado','proveedores.nombre','proveedores.tipo_documento','proveedores.num_documento',
             'proveedores.direccion','proveedores.email','proveedores.telefono','users.usuario')
             ->take(1)->get();

             $detalles = DetalleIngreso::join('productos','detalle_ingresos.idproducto','=','productos.id')
             ->select('detalle_ingresos.cantidad','detalle_ingresos.revision','detalle_ingresos.precio',
             'productos.nombre as producto')
             ->where('detalle_ingresos.idingreso','=',$id)
             ->orderBy('detalle_ingresos.id', 'desc')->get();

             $numingreso=Ingreso::select('num_ingreso')->where('id',$id)->get();

             $pdf= \PDF::loadView('pdf.ingreso',['ingreso'=>$ingreso,'detalles'=>$detalles]);
             return $pdf->download('ingreso-'.$numingreso[0]->num_ingreso.'.pdf');
         }


}
