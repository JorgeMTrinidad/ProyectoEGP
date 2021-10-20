@extends('principal')
@section('contenido')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <main class="main">

        <div class="card-body">

            <h2 class="text-center">Detalle de Ingreso</h2><br /><br /><br />


            <div class="form-group row">

                <div class="col-md-4">

                    <label class="form-control-label" for="nombre">Proveedor</label>

                    <p>{{ $ingreso->nombre }}</p>

                </div>

                <div class="col-md-4">

                    <label class="form-control-label" for="documento">Documento</label>

                    <p>{{ $ingreso->tipo_identificacion }}</p>

                </div>

                <div class="col-md-4">
                    <label class="form-control-label" for="num_ingreso">Número Ingreso</label>

                    <p>{{ $ingreso->num_ingreso }}</p>
                </div>

            </div>


            <br /><br />

            <div class="form-group row border">

                <h3>Detalle de Ingresos</h3>

                <div class="table-responsive col-md-12" id="table_detail">
                    <table id="detalles" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr class="bg-success">

                                <th>Producto</th>
                                <th>Precio (Q)</th>
                                <th>Cantidad</th>

                                <th>SubTotal (Q)</th>

                            </tr>
                        </thead>

                        <tfoot>

                            <!--<th><h2>TOTAL</h2></th>
                                                           <th></th>
                                                           <th></th>
                                                           <th><h4 id="total">${{ $ingreso->total }}</h4></th>-->

                            <tr>
                                <th colspan="4">
                                    <p align="right">TOTAL:</p>
                                </th>
                                <th>
                                    <p align="right">Q{{ number_format($ingreso->total, 2) }}</p>
                                </th>
                            </tr>


                            <tr>
                                <th colspan="4">
                                    <p align="right">TOTAL PAGAR:</p>
                                </th>
                                <th>
                                    <p align="right">
                                        Q{{ number_format($ingreso->total + ($ingreso->total * 20) / 100, 2) }}</p>
                                </th>
                            </tr>

                        </tfoot>

                        <tbody id="id_table">

                            @foreach ($detalles as $det)

                                <tr>

                                    <td>{{ $det->producto }}</td>
                                    <td>${{ $det->precio }}</td>
                                    <td>{{ $det->cantidad }}</td>
                                    <td>Q{{ number_format($det->cantidad * $det->precio, 2) }}</td>

                                    </td>
                                </tr>

                            @endforeach


                        </tbody>


                    </table>
                    <button type="submit" id="actualizar" class="btn btn-success"><i class="fa fa-save fa-2x"></i>
                        Registrar</button>

                    <button id="pushed" class="btn btn-success">
                        pushed
                    </button>
                </div>

            </div>


        </div>
        <!--fin del div card body-->
    </main>
    @push('scripts')
        <script>
            $(function() {
                $('#pushed').click(e => {
                    console.log(e);
                })
            })

            $(document).ready(function() {

                $("#actualizar").click(function(event) {
                    debugger
                    console.log(1)
                    actualizar(event);
                });

                $('#pushed').click(e => {
                    console.log(e);
                })

            });



            let Details = [];


            function actualizar(events) {

                debugger
                $('#table_detail > table > tbody > tr').each(function() {

                    let data = {};
                    $(this).children('td').each((index, e, val) => {
                        switch (index) {
                            case 0:
                                data.product = $(e).html()
                                break;
                            case 1:
                                data.price = $(e).html()
                                break;
                            case 2:
                                data.quantity = $(e).html()
                                break;
                            case 3:
                                data.revition = $(e).html()
                                break;
                            case 4:
                                data.subTotal = $(e).html()
                                break;
                            case 5:
                                data.revitionOk = $(e).find('option:selected').text()
                                break;
                            default:
                                break;
                        }


                    })
                    Details.push(data)
                })


                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    url: '/update/algo',
                    type: 'PUT',
                    data: JSON.stringify({
                        data: Details
                    }),
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
                Details = [];
            }
        </script>
    @endpush
@endsection
