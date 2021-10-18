@extends('principal')
@section('contenido')


<main class="main">

    <script type="text/javascript">
        function noenter() {
        return !(window.event && window.event.keyCode == 13); }
        </script>

 <div class="card-body">

 <h2>Agregar Ingreso</h2>

 <span><strong>(*) Campo obligatorio</strong></span><br/>

 <h3 class="text-center">LLenar el formulario</h3>

    <form id="formulario" action="{{route('ingreso.store')}}" method="POST">
    {{csrf_field()}}

            <div class="form-group row">

            <div class="col-md-8">

                <label class="form-control-label" for="nombre">Nombre del Proveedor</label>

                    <select class="form-control selectpicker" name="id_proveedor" id="id_proveedor" data-live-search="true">

                    <option value="0" disabled>Seleccione</option>

                    @foreach($proveedores as $prove)

                    <option value="{{$prove->id}}">{{$prove->nombre}}</option>

                    @endforeach

                    </select>

                </div>
            </div>

            <div class="form-group row">

                <div class="col-md-8">

                        <label class="form-control-label" for="documento">Transacción</label>

                        <select class="form-control" name="tipo_identificacion" id="tipo_identificacion" required>

                            <option value="0" disabled>Seleccione</option>
                            <option value="FACTURA">Ingreso</option>
                            <option value="RECIBO">Ingreso</option>


                        </select>
                </div>
            </div>


            <div class="form-group row">

                <div class="col-md-8">
                        <label class="form-control-label" for="num_ingreso">Número Transacción</label>

                        <input type="text" required id="num_ingreso" name="num_ingreso" class="form-control" placeholder="Ingrese el número ingreso" pattern="[0-9]{0,15}">
                </div>
            </div>

            <br/><br/>

            <div class="form-group row border">

                 <div class="col-md-8">

                        <label class="form-control-label" for="nombre">Producto</label>

                            <select class="form-control selectpicker" name="id_producto" id="id_producto" data-live-search="true">

                            <option value="0" selected>Seleccione</option>

                            @foreach($productos as $prod)

                            <option value="{{$prod->id}}">{{$prod->producto}}</option>

                            @endforeach

                            </select>

                </div>

            </div>

            <div class="form-group row">

                <div class="col-md-3">
                        <label class="form-control-label" for="cantidad">Cantidad </label>

                        <span><input type="number" onkeypress="return noenter()" id="cantidad" name="cantidad" class="form-control" value="0" onFocus="if (this.value=='0') this.value='';" pattern="[0-9]{0,15}"></span>
                </div>


                <div class="col-md-3">
                        <label class="form-control-label" for="precio_ingreso">Precio</label>

                        <input type="number" onkeypress="return noenter()" step="0.01" id="precio_ingreso" name="precio_ingreso" class="form-control" placeholder="Ingrese el estado del ingreso" pattern="[0-9]{0,15}">
                </div>

                <div class="col-md-3">
                    <label class="form-control-label" for="estado_ingreso">Revision </label>

                    <select class="form-control" name="estado_ingreso" id="estado_ingreso">

                        <option value="0" disabled>Seleccione</option>
                        <option value="CORRECTO">Correcto</option>
                        <option value="INCORRECTO">Incorrecto</option>


                    </select>
            </div>


                <div class="col-md-3">

                    <button type="button" id="agregar" class="btn btn-terceary"><i class="fa fa-plus fa-2x"></i> Agregar detalle</button>
                </div>


            </div>

            <br/><br/>

           <div class="form-group row border">

              <h3>Lista de Ingresos a Proveedores</h3>

              <div class="table-responsive col-md-12">
                <table id="detalles" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr class="bg-success">
                        <th>Eliminar</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Revisión</th>
                        <th>SubTotal</th>
                    </tr>
                </thead>

                <tfoot>


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

document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("formulario").addEventListener('submit', validarFormulario);
});

function validarFormulario(evento) {
  evento.preventDefault();
  var proveedor = document.getElementById('id_proveedor').value;
  if(proveedor.length == 0) {
    Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'No ha ingresado ningún proveedor',

                })
    return;
  }

  this.submit();
}

  $(document).ready(function(){

     $("#agregar").click(function(){

         agregar();
     });

  });

  var cont=0;
   total=0;
   subtotal=[];
   $("#guardar").hide();

     function agregar(){

          id_producto= $("#id_producto").val();
          producto= $("#id_producto option:selected").text();
          cantidad= $("#cantidad").val();
          precio_ingreso= $("#precio_ingreso").val();
          estado_ingreso= $("#estado_ingreso").val();



          if(id_producto !="" && cantidad!="" && cantidad>0 && precio_ingreso!=""){

             subtotal[cont]=cantidad*precio_ingreso;
             total= total+subtotal[cont];

             var fila= '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times fa-2x"></i></button></td> <td><input type="hidden" name="id_producto[]" value="'+id_producto+'">'+producto+'</td> <td><input type="number" id="precio_ingreso[]" name="precio_ingreso[]"  value="'+precio_ingreso+'"> </td>  <td><input type="number" name="cantidad[]" value="'+cantidad+'"> </td> <td><input type="text" id="estado_ingreso[]" name="estado_ingreso[]"  value="'+estado_ingreso+'"> </td>  <td>Q'+subtotal[cont]+' </td></tr>';
             cont++;
             limpiar();
             totales();

             evaluar();
             $('#detalles').append(fila);

            }else{

               // alert("Rellene todos los campos del detalle de la ingreso, revise los datos del producto");

                Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle de la ingresos',

                })

            }

     }


     function limpiar(){

        $("#cantidad").val("");
        $("#precio_ingreso").val("");
        $("#estado_ingreso").val("");


     }

     function totales(){

        $("#total").html("Q " + total.toFixed(2));

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
