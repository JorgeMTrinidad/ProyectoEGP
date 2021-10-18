<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compra;
use App\DetalleCompra;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;


class CompraController extends Controller
{

    public function index(Request $request){

        if($request){

            $sql=trim($request->get('buscarTexto'));
            $compras=Compra::join('proveedores','compras.idproveedor','=','proveedores.id')
            ->join('users','compras.idusuario','=','users.id')
            ->join('detalle_compras','compras.id','=','detalle_compras.idcompra')
             ->select('compras.id','compras.tipo_identificacion',
             'compras.num_compra','compras.fecha_compra',
             'compras.estado','compras.total','proveedores.nombre as proveedor','users.nombre')
            ->where('compras.tipo_identificacion','LIKE','%'.$sql.'%')
            ->orwhere('compras.num_compra','LIKE','%'.$sql.'%')
            ->orderBy('compras.id','desc')
            ->groupBy('compras.id','compras.tipo_identificacion',
            'compras.num_compra','compras.fecha_compra',
            'compras.estado','compras.total','proveedores.nombre','users.nombre')
            ->paginate(8);


            return view('compra.index',["compras"=>$compras,"buscarTexto"=>$sql]);

            //return $compras;
        }


     }

        public function create(){

             /*listar las proveedores en ventana modal*/
             $proveedores=DB::table('proveedores')->get();

             /*listar los productos en ventana modal*/
             $productos=DB::table('productos as prod')
             ->select(DB::raw('CONCAT(prod.codigo," ",prod.nombre," ",prod.marca) AS producto'),'prod.id')
             ->where('prod.condicion','=','1')->get();

             return view('compra.create',["proveedores"=>$proveedores,"productos"=>$productos]);

        }

         public function store(Request $request){

         //dd($request->all());

             try{

                 DB::beginTransaction();

                 $mytime= Carbon::now('America/Costa_Rica');

                 $compra = new Compra();
                 $compra->idproveedor = $request->id_proveedor;
                 $compra->idusuario = \Auth::user()->id;
                 $compra->tipo_identificacion = $request->tipo_identificacion;
                 $compra->num_compra = $request->num_compra;
                 $compra->fecha_compra = $mytime->toDateTimeString();
                 $compra->total = $request->total_pagar;
                 $compra->subJ = $request->total_pagarJ;
                 $compra->subM = $request->total_pagarM;
                 $compra->estado = 'Registrado';
                 $compra->save();

                 $id_producto=$request->id_producto;
                 $cantidad=$request->cantidad;
                 $cantidad2=$request->cantidad2;
                 $precio=$request->precio_compra;
                 $precio_sug=$request->precio_sug;
                 $precio_min=$request->precio_min;
                 $precio_max=$request->precio_max;



                 //Recorro todos los elementos
                 $cont=0;

                  while($cont < count($id_producto)){

                     $detalle = new DetalleCompra();
                     /*enviamos valores a las propiedades del objeto detalle*/
                     /*al idcompra del objeto detalle le envio el id del objeto compra, que es el objeto que se ingresó en la tabla compras de la bd*/
                     $detalle->idcompra = $compra->id;
                     $detalle->idproducto = $id_producto[$cont];
                     $detalle->cantidad = $cantidad[$cont];
                     $detalle->cantidad2 = $cantidad2[$cont];
                     $detalle->precio = $precio[$cont];
                     $detalle->precio_sug = $precio_sug[$cont];
                     $detalle->precio_min = $precio_min[$cont];
                     $detalle->precio_max = $precio_max[$cont];
                     $detalle->save();
                     $cont=$cont+1;
                 }

                 DB::commit();

             } catch(Exception $e){

                 DB::rollBack();
             }

             return Redirect::to('compra');
         }

         public function show($id){

             //dd($id);

             /*mostrar compra*/

             //$id = $request->id;
             $compra = Compra::join('proveedores','compras.idproveedor','=','proveedores.id')
             ->join('detalle_compras','compras.id','=','detalle_compras.idcompra')
             ->select('compras.id','compras.tipo_identificacion',
             'compras.num_compra','compras.fecha_compra',
             'compras.estado',DB::raw('sum((detalle_compras.cantidad+detalle_compras.cantidad2)*precio) as total'),'proveedores.nombre')
             ->where('compras.id','=',$id)
             ->orderBy('compras.id', 'desc')
             ->groupBy('compras.id','compras.tipo_identificacion',
             'compras.num_compra','compras.fecha_compra',
             'compras.estado','proveedores.nombre')
             ->first();

             /*mostrar detalles*/
             $detalles = DetalleCompra::join('productos','detalle_compras.idproducto','=','productos.id')
             ->select('detalle_compras.cantidad','detalle_compras.cantidad2','detalle_compras.precio','productos.nombre as producto','productos.marca')
             ->where('detalle_compras.idcompra','=',$id)
             ->orderBy('detalle_compras.id', 'desc')->get();

             return view('compra.show',['compra' => $compra,'detalles' =>$detalles]);
         }

         public function destroy(Request $request){


                 $compra = Compra::findOrFail($request->id_compra);
                 $compra->estado = 'Anulado';
                 $compra->save();
                 return Redirect::to('compra');

     }

         public function pdf(Request $request,$id){

             $compra = Compra::join('proveedores','compras.idproveedor','=','proveedores.id')
             ->join('users','compras.idusuario','=','users.id')
             ->join('detalle_compras','compras.id','=','detalle_compras.idcompra')
             ->select('compras.id','compras.tipo_identificacion',
             'compras.num_compra','compras.created_at',DB::raw('sum(detalle_compras.cantidad+detalle_compras.cantidad2*precio) as total'),
             'compras.estado','proveedores.nombre','proveedores.tipo_documento','proveedores.num_documento',
             'proveedores.direccion','proveedores.email','proveedores.telefono','users.usuario')
             ->where('compras.id','=',$id)
             ->orderBy('compras.id', 'desc')
             ->groupBy('compras.id','compras.tipo_identificacion',
             'compras.num_compra','compras.created_at',
             'compras.estado','proveedores.nombre','proveedores.tipo_documento','proveedores.num_documento',
             'proveedores.direccion','proveedores.email','proveedores.telefono','users.usuario')
             ->take(1)->get();

             $detalles = DetalleCompra::join('productos','detalle_compras.idproducto','=','productos.id')
             ->select('detalle_compras.cantidad','detalle_compras.cantidad2','detalle_compras.precio',
             'productos.nombre as producto','productos.marca')
             ->where('detalle_compras.idcompra','=',$id)
             ->orderBy('detalle_compras.id', 'desc')->get();

             $numcompra=Compra::select('num_compra')->where('id',$id)->get();

             $pdf= \PDF::loadView('pdf.compra',['compra'=>$compra,'detalles'=>$detalles]);
             return $pdf->download('compra-'.$numcompra[0]->num_compra.'.pdf');
         }


}
