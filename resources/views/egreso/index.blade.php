@extends('principal')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="/">SISTEMA DE INGRESOS - EGRESOS</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                       <h2>Listado de Egresos</h2><br/>
                       @if(session('user_roll')!==3)
                       <a href="egreso/create">

                        <button class="btn btn-primary btn-lg" type="button">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Egreso
                        </button>

                        </a>

                        <a href="/files/Conformidad.pdf" target="_blank">
                            <button type="button" class="btn btn-success btn-lg">
                                <i class="fa fa-file fa-2x"></i>&nbsp;&nbsp;Conformidad

                            </button>
                        </a>
                        @endif

                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-md-6">
                            {!! Form::open(array('url'=>'egreso','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
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
                                    <th>Fecha Egreso</th>
                                    <th>Número Egreso</th>
                                    <th>M.Obras</th>
                                    <th>Tipo de Transacción</th>
                                    <th>Usuario</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    @if(session('user_roll')!==3)
                                    <th>Cambiar Estado</th>
                                    <th>Documento</th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody>

                              @foreach($egresos as $eg)

                                <tr>
                                    <td>

                                     <a href="{{URL::action('EgresoController@show',$eg->id)}}">
                                       <button type="button" class="btn btn-warning btn-md">
                                         <i class="fa fa-eye fa-2x"></i> Ver detalle
                                       </button> &nbsp;

                                     </a>
                                   </td>

                                    <td>{{$eg->fecha_egreso}}</td>
                                    <td>{{$eg->num_egreso}}</td>
                                    <td>{{$eg->maestroobras}}</td>
                                    <td>{{$eg->tipo_identificacion}}</td>
                                    <td>{{$eg->nombre}}</td>
                                    <td>Q{{number_format($eg->total,2)}}</td>
                                    <td>

                                      @if($eg->estado=="Registrado")
                                        <button type="button" class="btn btn-success btn-md">

                                          <i class="fa fa-check fa-2x"></i> Registrado
                                        </button>

                                      @else

                                        <button type="button" class="btn btn-danger btn-md">

                                          <i class="fa fa-check fa-2x"></i> Anulado
                                        </button>

                                       @endif

                                    </td>

                                    @if(session('user_roll')!==3)
                                    <td>

                                       @if($eg->estado=="Registrado")

                                        <button type="button" class="btn btn-danger btn-sm" data-id_egreso="{{$eg->id}}" data-toggle="modal" data-target="#cambiarEstadoEgreso">
                                            <i class="fa fa-times fa-2x"></i> Anular Egreso
                                        </button>

                                        @else

                                         <button type="button" class="btn btn-success btn-sm">
                                            <i class="fa fa-lock fa-2x"></i> Anulado
                                        </button>

                                        @endif

                                    </td>

                                    <td>

                                        <a href="{{url('pdfEgreso',$eg->id)}}" target="_blank">

                                           <button type="button" class="btn btn-info btn-sm">

                                             <i class="fa fa-file fa-2x"></i> Picking List
                                           </button> &nbsp;

                                        </a>

                                    </td>
                                    @endif
                                </tr>

                                @endforeach

                            </tbody>
                        </table>

                        {{$egresos->render()}}

                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>


        <!-- Inicio del modal cambiar estado de egreso -->
         <div class="modal fade" id="cambiarEstadoEgreso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado de Egreso</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>

                    <div class="modal-body">
                        <form action="{{route('egreso.destroy','test')}}" method="POST">
                          {{method_field('delete')}}
                          {{csrf_field()}}

                            <input type="hidden" id="id_egreso" name="id_egreso" value="">

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
            <!-- Fin del modal Eliminar -->


        </main>
@endsection
