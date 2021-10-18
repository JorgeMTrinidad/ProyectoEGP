@extends('principal')
@section('contenido')


<main class="main">

 <div class="card-body">

 <h2>Agregar Egreso</h2>

 <span><strong>(*) Campo obligatorio</strong></span><br/>

 <h3 class="text-center">LLenar el formulario</h3>

    <form action="{{route('egreso.store')}}" method="POST">
    {{csrf_field()}}

            <div class="form-group row">

            <div class="col-md-8">

                <label class="form-control-label" for="nombre">Nombre del Cliente</label>

                    <select class="form-control selectpicker" name="id_maestroobras" id="id_maestroobras" data-live-search="true" required>

                    <option value="0" disabled>Seleccione</option>

                    @foreach($maestrosobras as $mae)

                    <option value="{{$mae->id}}">{{$mae->nombre}}</option>

                    @endforeach

                    </select>

                </div>
            </div>

            <div class="form-group row">

                <div class="col-md-8">

                        <label class="form-control-label" for="documento">Documento</label>

                        <select class="form-control" name="tipo_identificacion" id="tipo_identificacion" required>

                            <option value="0" disabled>Seleccione</option>
                            <option value="PICKINGLIST">Picking List</option>


                        </select>
                </div>
            </div>


            <div class="form-group row">

                <div class="col-md-8">
                        <label class="form-control-label" for="num_egreso">Número Egreso</label>

                        <input type="text" id="num_egreso" required name="num_egreso" class="form-control" placeholder="Ingrese el número egreso" pattern="[0-9]{0,15}">
                </div>
            </div>

            <br/><br/>

            <div class="form-group row border">

                 <div class="col-md-8">

                        <label class="form-control-label" for="nombre">Producto</label>

                            <select class="form-control selectpicker" name="id_producto" id="id_producto" data-live-search="true" required>

                            <option value="0" selected>Seleccione</option>

                            @foreach($productos as $prod)

                            <option value="{{$prod->id}}_{{$prod->stock}}_{{$prod->precio_venta}}">{{$prod->producto}}</option>

                            @endforeach

                            </select>

                </div>

            </div>

            <div class="form-group row">

                <div class="col-md-2">
                        <label class="form-control-label" for="cantidad">Cantidad</label>

                        <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Ingrese cantidad" pattern="[0-9]{0,15}">
                </div>

                <div class="col-md-2">
                        <label class="form-control-label" for="stock">Stock</label>

                        <input type="number" disabled id="stock" name="stock" class="form-control" placeholder="Ingrese el stock" pattern="[0-9]{0,15}">
                </div>

                <div class="col-md-2">
                        <label class="form-control-label" for="precio_egreso">Precio Egreso</label>

                        <input type="number" disabled id="precio_egreso" name="precio_egreso" class="form-control" placeholder="Ingrese precio de egreso" >
                </div>

                <div class="col-md-2">
                        <label class="form-control-label" for="Revisión">Revisión</label>

                        <select class="form-control" name="estado_egreso" id="estado_egreso" required>

                            <option value="0" disabled>Seleccione</option>
                            <option value="CORRECTO">Correcto</option>
                            <option value="INCORRECTO">Incorrecto</option>

                        </select>
                </div>

                <div class="col-md-4">

                    <button type="button" id="agregar" class="btn btn-primary"><i class="fa fa-plus fa-2x"></i> Agregar detalle</button>
                </div>


            </div>

            <br/><br/>

           <div class="form-group row border">

              <h3>Lista de Egresos a Clientes</h3>

              <div class="table-responsive col-md-12">
                <table id="detalles" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr class="bg-success">
                        <th>Eliminar</th>
                        <th>Producto</th>
                        <th>Precio Egreso (Q)</th>
                        <th>Revisión</th>
                        <th>Cantidad</th>
                        <th>SubTotal (Q)</th>
                    </tr>
                </thead>

                <tfoot>
                   <!--<th>Total</th>
                   <th></th>
                   <th></th>
                   <th></th>
                   <th></th>
                   <th><h4 id="total">Q 0.00</h4><input type="hidden" name="total_egreso" id="total_egreso">  </th>-->

                    <tr>
                        <th  colspan="5"><p align="right">TOTAL:</p></th>
                        <th><p align="right"><span id="total">Q 0.00</span> </p></th>
                    </tr>


                    <tr>
                        <th  colspan="5"><p align="right">TOTAL PAGAR:</p></th>
                        <th><p align="right"><span align="right" id="total_pagar_html">Q 0.00</span> <input type="hidden" name="total_pagar" id="total_pagar"></p></th>
                    </tr>

                </tfoot>

                <tbody>
                </tbody>


                </table>
              </div>

            </div>

            <div class="modal-footer form-group row" id="guardar">

            <div class="col-md">
               <input type="hidden" name="_token" value="{{csrf_token()}}">

                <button type="submit" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Registrar</button>

            </div>

            </div>

         </form>

    </div><!--fin del div card body-->
  </main>

@push('scripts')
 <script>

  $(document).ready(function(){

     $("#agregar").click(function(){

         agregar();
     });

  });

   var cont=0;
   total=0;
   subtotal=[];
   $("#guardar").hide();
   $("#id_producto").change(mostrarValores);

     function mostrarValores(){

         datosProducto = document.getElementById('id_producto').value.split('_');
         $("#precio_egreso").val(datosProducto[2]);
         $("#stock").val(datosProducto[1]);

     }

     function agregar(){

         datosProducto = document.getElementById('id_producto').value.split('_');

         id_producto= datosProducto[0];
         producto= $("#id_producto option:selected").text();
         cantidad= $("#cantidad").val();
         estado_egreso= $("#estado_egreso").val();
         precio_egreso= $("#precio_egreso").val();
         stock= $("#stock").val();

          if(id_producto !="" && cantidad!="" && cantidad>0  && estado_egreso!="" && precio_egreso!=""){

                if(parseInt(stock)>=parseInt(cantidad)){

                    /*subtotal[cont]=(cantidad*precio_egreso)-estado_egreso;
                    total= total+subtotal[cont];*/

                    subtotal[cont]=(cantidad*precio_egreso);
                    total= total+subtotal[cont];

                    var fila= '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times fa-2x"></i></button></td> <td><input type="hidden" name="id_producto[]" value="'+id_producto+'">'+producto+'</td> <td><input type="number" name="precio_egreso[]" value="'+parseFloat(precio_egreso).toFixed(2)+'"> </td> <td><input type="number" name="cantidad[]" value="'+cantidad+'"> </td> <td><input type="text" name="estado_egreso[]" value="'+estado_egreso+'"> </td> <td>Q'+parseFloat(subtotal[cont]).toFixed(2)+'</td></tr>';
                    cont++;
                    limpiar();
                    totales();
                    /*$("#total").html("Q " + total.toFixed(2));
                    $("#total_egreso").val(total.toFixed(2));*/
                    evaluar();
                    $('#detalles').append(fila);

                } else{

                    //alert("La cantidad a vender supera el stock");

                    Swal.fire({
                    type: 'error',
                    //title: 'Oops...',
                    text: 'La cantidad a vender supera el stock',

                    })
                }

            }else{

                //alert("Rellene todos los campos del detalle de la egreso");

                Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle de la egreso',

                })

            }

     }


     function limpiar(){

        $("#cantidad").val("");
        $("#estado_egreso").val("0");
        $("#precio_egreso").val("");

     }

     function totales(){

        $("#total").html("Q " + total.toFixed(2));
        //$("#total_egreso").val(total.toFixed(2));

        total_pagar=total;
        $("#total_pagar_html").html("Q " + total_pagar.toFixed(2));
        $("#total_pagar").val(total_pagar.toFixed(2));
      }


     function evaluar(){

         if(total>0){

           $("#guardar").show();

         } else{

           $("#guardar").hide();
         }
     }

     function eliminar(index){

        total=total-subtotal[index];
        total_pagar_html = total;

        $("#total").html("Q" + total);
        $("#total_pagar_html").html("Q" + total_pagar_html);
        $("#total_pagar").val(total_pagar_html.toFixed(2));

        $("#fila" + index).remove();
        evaluar();
     }

 </script>
@endpush

@endsection
