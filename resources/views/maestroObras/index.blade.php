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

                       <h2>Listado de Maestros de obras</h2><br/>

                        <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#abrirmodal">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Maestro de Obras
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                            {!!Form::open(array('url'=>'maestroObras','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
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
                                    <th>id</th>
                                    <th>Maestro de Obras</th>
                                    <th>Número Documento</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Dirección</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>

                               @foreach($maestroObras as $maestro)

                                <tr>

                                    <td>{{$maestro->id}}</td>
                                    <td>{{$maestro->nombre}}</td>
                                    <td>{{$maestro->num_documento}}</td>
                                    <td>{{$maestro->telefono}}</td>
                                    <td>{{$maestro->email}}</td>
                                    <td>{{$maestro->direccion}}</td>

                                    <td>
                                        <button type="button" class="btn btn-info btn-md" data-id_maestroobras="{{$maestro->id}}" data-nombre="{{$maestro->nombre}}" data-num_documento="{{$maestro->num_documento}}" data-direccion="{{$maestro->direccion}}" data-telefono="{{$maestro->telefono}}" data-email="{{$maestro->email}}" data-toggle="modal" data-target="#abrirmodalEditar">
                                          <i class="fa fa-edit fa-2x"></i> Editar
                                        </button> &nbsp;
                                    </td>



                                </tr>

                                @endforeach

                            </tbody>
                        </table>

                            {{$maestroObras->render()}}

                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar maestro de obras</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">


                            <form action="{{route('maestroObras.store')}}" method="post" class="form-horizontal">

                                {{csrf_field()}}

                                @include('maestroObras.form')

                            </form>
                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->


             <!--Inicio del modal actualizar-->
             <div class="modal fade" id="abrirmodalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar maestro de obras</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">


                            <form action="{{route('maestroObras.update','test')}}" method="post" class="form-horizontal">

                                {{method_field('patch')}}
                                {{csrf_field()}}

                                <input type="hidden" id="id_maestroobras" name="id_maestroobras" value="">

                                @include('maestroObras.form')

                            </form>
                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->



        </main>

@endsection
