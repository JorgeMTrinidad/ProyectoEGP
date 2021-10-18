<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;

class ProductoController extends Controller
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
            $productos=DB::table('productos as p')
            ->join('categorias as c','p.idcategoria','=','c.id')
            ->select('p.id','p.idcategoria','p.nombre','p.precio_venta','p.codigo','p.stock','p.condicion','c.nombre as categoria')
            ->where('p.nombre','LIKE','%'.$sql.'%')
            ->orwhere('c.nombre','LIKE','%'.$sql.'%')
            ->orwhere('p.codigo','LIKE','%'.$sql.'%')
            ->orderBy('p.id','desc')
            ->paginate(5);

            $productos->appends(['buscarTexto' => $request->get('buscarTexto')]);

            /*listar las categorias en ventana modal*/
            $categorias=DB::table('categorias')
            ->select('id','nombre','descripcion')
            ->where('condicion','=','1')->get();

            return view('producto.index',["productos"=>$productos,"categorias"=>$categorias,"buscarTexto"=>$sql]);

            //return $productos;
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
        $producto= new Producto();
        $producto->idcategoria = $request->id;
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->marca = $request->marca;
        $producto->por_sug = $request->por_sug;
        $producto->por_max = $request->por_max;
        $producto->por_min = $request->por_min;
        $producto->precio_costo = $request->precio_costo;
        $producto->max_existencia = $request->max_existencia;
        $producto->min_existencia = $request->min_existencia;
        $producto->max_existencia2 = $request->max_existencia2;
        $producto->min_existencia2 = $request->min_existencia2;
        $producto->stock = $request->stock;
        $producto->stock2 = $request->stock2;
        $producto->condicion = '1';


        $producto->save();
        return Redirect::to("producto");
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
        $producto= Producto::findOrFail($request->id_producto);
        $producto->idcategoria = $request->id;
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->marca = $request->marca;
        $producto->por_sug = $request->por_sug;
        $producto->por_max = $request->por_max;
        $producto->por_min = $request->por_min;
        $producto->precio_costo = $request->precio_costo;
        $producto->max_existencia = $request->max_existencia;
        $producto->min_existencia = $request->min_existencia;
        $producto->max_existencia2 = $request->max_existencia2;
        $producto->min_existencia2 = $request->min_existencia2;
        $producto->stock = $request->stock;
        $producto->stock2 = $request->stock2;
        $producto->condicion = '1';


        $producto->save();
        return Redirect::to("producto");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
            $producto= Producto::findOrFail($request->id_producto);

            if($producto->condicion=="1"){

                $producto->condicion= '0';
                $producto->save();
                return Redirect::to("producto");

            } else{

                $producto->condicion= '1';
                $producto->save();
                return Redirect::to("producto");

            }
    }

       public function listarPdf(){


            $productos = Producto::select('productos.id','productos.idcategoria','productos.codigo','productos.nombre',
            'productos.marca','categorias.nombre as nombre_categoria','productos.stock','productos.marca',
            'productos.condicion','productos.min_existencia','productos.max_existencia')
            ->join('categorias','productos.idcategoria','=','categorias.id')
            ->whereColumn('productos.stock','<=','productos.min_existencia')
            ->orderBy('productos.nombre', 'desc')->get();


            $cont=Producto::count();

            $pdf= \PDF::loadView('pdf.productospdf',['productos'=>$productos,'cont'=>$cont]);
            return $pdf->download('Multiservicios-Vimega-Jal.pdf');

    }

    public function listarPdf2(){


        $productos2 = Producto::select('productos.id','productos.idcategoria','productos.codigo','productos.nombre',
        'productos.marca','categorias.nombre as nombre_categoria','productos.stock2','productos.marca',
        'productos.condicion','productos.min_existencia2','productos.max_existencia2')
        ->join('categorias','productos.idcategoria','=','categorias.id')
        ->whereColumn('productos.stock2','<=','productos.min_existencia2')
        ->orderBy('productos.nombre', 'desc')->get();


        $cont=Producto::count();

        $pdf= \PDF::loadView('pdf.productospdf2',['productos2'=>$productos2,'cont'=>$cont]);
        return $pdf->download('Multiservicios-Vimega-Monj.pdf');

}
}
