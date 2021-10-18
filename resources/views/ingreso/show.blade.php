@extends('principal')
@section('contenido')


<main class="main">

 <div class="card-body">

  <h2 class="text-center">Detalle de Ingreso</h2><br/><br/><br/>


            <div class="form-group row">

                    <div class="col-md-4">

                        <label class="form-control-label" for="nombre">Proveedor</label>

                        <p>{{$ingreso->nombre}}</p>

                    </div>

                    <div class="col-md-4">

                    <label class="form-control-label" for="documento">Documento</label>

                    <p>{{$ingreso->tipo_identificacion}}</p>

                    </div>

                    <div class="col-md-4">
                            <label class="form-control-label" for="num_ingreso">Número Ingreso</label>

                            <p>{{$ingreso->num_ingreso}}</p>
                    </div>

            </div>


            <br/><br/>

           <div class="form-group row border">

              <h3>Detalle de Ingresos</h3>

              <div class="table-responsive col-md-12">
                <table id="detalles" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr class="bg-success">

                        <th>Producto</th>
                        <th>Precio (Q)</th>
                        <th>Cantidad</th>
                        <th>Revision</th>
                        <th>SubTotal (Q)</th>
                    </tr>
                </thead>

                <tfoot>

                   <!--<th><h2>TOTAL</h2></th>
                   <th></th>
                   <th></th>
                   <th><h4 id="total">${{$ingreso->total}}</h4></th>-->

                    <tr>
                        <th  colspan="4"><p align="right">TOTAL:</p></th>
                        <th><p align="right">Q{{number_format($ingreso->total,2)}}</p></th>
                    </tr>


                    <tr>
                        <th  colspan="4"><p align="right">TOTAL PAGAR:</p></th>
                        <th><p align="right">Q{{number_format($ingreso->total+($ingreso->total*20/100),2)}}</p></th>
                    </tr>

                </tfoot>

                <tbody>

                   @foreach($detalles as $det)

                    <tr>

                      <td>{{$det->producto}}</td>
                      <td>${{$det->precio}}</td>
                      <td>{{$det->cantidad}}</td>
                      <td>{{$det->revision}}</td>
                      <td>${{number_format($det->cantidad*$det->precio,2)}}</td>


                    </tr>


                   @endforeach

                </tbody>


                </table>
              </div>

            </div>


    </div><!--fin del div card body-->
  </main>

@endsection
