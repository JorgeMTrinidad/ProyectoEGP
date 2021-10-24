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
                        @if(session('user_roll')!==1)
                            <th>revisión</th>
                        @endif
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
                      @if(session('user_roll')!==1)
                        <td>
                            @if($det->revision=='CORRECTO')
                            <button type="button" class="btn btn-success btn-md" onclick="event.preventDefault(); document.getElementById('revision-correct-form{{$det->id}}').submit();">
                                <form id="revision-correct-form{{$det->id}}" action="{{route('revision',$det->id)}}" method="POST" style="display: none;">
                                    {{csrf_field()}}
                                    <input type="hidden" name="revision" value="INCORRECTO">
                                </form>
                                <i class="fa fa-check fa-2x"></i> Correct
                            </button>
                            @else
                            <button type="button" class="btn btn-danger btn-md" onclick="event.preventDefault(); document.getElementById('revision-incorrect-form{{$det->id}}').submit();">
                            <form id="revision-incorrect-form{{$det->id}}" action="{{route('revision',$det->id)}}" method="POST" style="display: none;">
                                <input type="hidden" name="revision" value="CORRECTO">
                                {{csrf_field()}}
                            </form>
                                <i class="fa fa-times fa-2x"></i> Incorrect
                            </button>
                            @endif
                        </td>
                      @endif
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
