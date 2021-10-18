@extends('principal')
@section('contenido')


<main class="main">

 <div class="card-body">

  <h2 class="text-center">Detalle de Egreso</h2><br/><br/><br/>


            <div class="form-group row">

                    <div class="col-md-4">

                        <label class="form-control-label" for="nombre">Cliente</label>

                        <p>{{$egreso->nombre}}</p>

                    </div>

                    <div class="col-md-4">

                    <label class="form-control-label" for="documento">Documento</label>

                    <p>{{$egreso->tipo_identificacion}}</p>

                    </div>

                    <div class="col-md-4">
                            <label class="form-control-label" for="num_egreso">Número Egreso</label>

                            <p>{{$egreso->num_egreso}}</p>
                    </div>

            </div>


            <br/><br/>

           <div class="form-group row border">

              <h3>Detalle de Egresos</h3>

              <div class="table-responsive col-md-12">
                <table id="detalles" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr class="bg-success">

                        <th>Producto</th>
                        <th>Precio Egreso</th>
                        <th>Cantidad</th>
                        <th>SubTotal</th>
                    </tr>
                </thead>

                <tfoot>


                    <tr>
                        <th  colspan="3"><p align="right">TOTAL:</p></th>
                        <th><p align="right">Q{{number_format($egreso->total,2)}}</p></th>
                    </tr>
                </tfoot>

                <tbody>

                   @foreach($detalles as $det)

                    <tr>

                      <td>{{$det->producto}}</td>
                      <td>Q{{$det->precio}}</td>
                      <td>{{$det->cantidad}}</td>
                      <td>Q{{number_format($det->cantidad*$det->precio,2)}}</td>


                    </tr>


                   @endforeach

                </tbody>


                </table>
              </div>

            </div>

    </div><!--fin del div card body-->
  </main>

@endsection
