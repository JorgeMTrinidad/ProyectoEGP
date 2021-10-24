@extends('principal')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="/">BACKEND - SISTEMA DE COMPRAS - VENTAS</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                       <h2>Listado de Ingresos</h2><br/>

                       <a href="ingreso/create">

                        <button class="btn btn-primary btn-lg" type="button">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Ingreso
                        </button>

                        </a>

                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-md-6">
                            {!! Form::open(array('url'=>'ingreso','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
                                <div class="input-group">

                                    <input type="text" name="buscarTexto" class="form-control" placeholder="Buscar texto" value="{{$buscarTexto}}">
                                    <button type="submit"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            {{Form::close()}}
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr class="bg-primary">

                                    <th>Ver Detalle</th>
                                    <th>Fecha Ingreso</th>
                                    <th>Número Ingreso</th>
                                    <th>Proveedor</th>
                                    <th>Tipo de identificación</th>
                                    <th>Ingresodor</th>
                                    <th>Total (Q)</th>
                                    @if(session('user_roll')!==1)
                                        <th>revisión</th>
                                    @endif
                                    <th>Estado</th>
                                    <th>Cambiar Estado</th>
                                    <th>Descargar Reporte</th>

                                </tr>
                            </thead>
                            <tbody>
                              @foreach($ingresos as $comp)
                                @php
                                  $data=App\DetalleIngreso::where('idingreso',$comp->id)->where('revision','=','INCORRECTO')->first();
                                  $auxiliarData=App\DetalleIngreso::where('idingreso',$comp->id)->where('revision','=','INCORRECTO')->first();
                                @endphp
                                @if(session('user_roll')!==1)
                                  {{$data=null}}
                                @endif
                                @if($data===null)
                                <tr>
                                      <td>
                                      <a href="{{URL::action('IngresoController@show',$comp->id)}}">
                                        <button type="button" class="btn btn-warning btn-md">
                                          <i class="fa fa-eye fa-2x"></i> Ver detalle
                                        </button> &nbsp;
                                      </a>
                                    </td>
                                      <td>{{$comp->fecha_ingreso}}</td>
                                      <td>{{$comp->num_ingreso}}</td>
                                      <td>{{$comp->proveedor}}</td>
                                      <td>{{$comp->tipo_identificacion}}</td>
                                      <td>{{$comp->nombre}}</td>
                                      <td>Q{{number_format($comp->total,2)}}</td>
                                      @if(session('user_roll')!==1)
                                        <td>
                                            @if($auxiliarData===null)
                                                CORRECTO
                                            @else
                                                INCORRECTO
                                            @endif
                                        </td>
                                      @endif
                                      <td>
                                        @if($comp->estado=="Registrado")
                                          <button type="button" class="btn btn-success btn-md">
                                            <i class="fa fa-check fa-2x"></i> Registrado
                                          </button>
                                        @else
                                          <button type="button" class="btn btn-danger btn-md">
                                            <i class="fa fa-check fa-2x"></i> Anulado
                                          </button>
                                        @endif
                                      </td>
                                      <td>
                                        @if($comp->estado=="Registrado")
                                          <button type="button" class="btn btn-danger btn-sm" data-id_ingreso="{{$comp->id}}" data-toggle="modal" data-target="#cambiarEstadoIngreso">
                                            <i class="fa fa-times fa-2x"></i> Anular Ingreso
                                          </button>
                                          @else
                                          <button type="button" class="btn btn-success btn-sm">
                                            <i class="fa fa-lock fa-2x"></i> Anulado
                                          </button>
                                        @endif
                                      </td>
                                      <td>
                                        <a href="{{url('pdfIngreso',$comp->id)}}" target="_blank">
                                            <button type="button" class="btn btn-info btn-sm">
                                              <i class="fa fa-file fa-2x"></i> Descargar PDF
                                            </button> &nbsp;
                                        </a>
                                    </td>
                                  </tr>
                                  @endif
                                @endforeach
                            </tbody>
                        </table>
                        {{$ingresos->render()}}
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
        <!-- Inicio del modal cambiar estado de ingreso -->
         <div class="modal fade" id="cambiarEstadoIngreso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado de Ingreso</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>

                    <div class="modal-body">
                        <form action="{{route('ingreso.destroy','test')}}" method="POST">
                          {{method_field('delete')}}
                          {{csrf_field()}}

                            <input type="hidden" id="id_ingreso" name="id_ingreso" value="">

                                <p>Estas seguro de cambiar el estado?</p>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-2x"></i>Cerrar</button>
                                <button type="submit" class="btn btn-success"><i class="fa fa-lock fa-2x"></i>Aceptar</button>
                            </div>

                         </form>
                    </div>
                    <!-- /.modal-content -->
                   </div>
                <!-- /.modal-dialog -->
             </div>
        </div>
    	<!-- Fin del modal Eliminar -->
    </main>
@endsection
