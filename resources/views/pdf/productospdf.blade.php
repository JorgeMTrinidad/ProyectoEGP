<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Productos</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.875rem;
            font-weight: normal;
            line-height: 1.5;
            color: #151b1e;
        }
        .table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #c2cfd6;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #c2cfd6;
        }
        .table-bordered thead th, .table-bordered thead td {
            border-bottom-width: 2px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #c2cfd6;
        }
        th, td {
            display: table-cell;
            vertical-align: inherit;
        }
        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: left;
        }
        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .izquierda{
            float:left;
        }
        .derecha{
            float:right;
        }
    </style>
</head>
<body>
    <div>
        <h3>Proyecto EGP<span class="derecha">{{now()}}</span></h3>
    </div>
    <div>
        <table id="datos">
            <thead>
                <tr>
                    <th id="">DATOS DEL MAESTRO DE OBRAS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><p id="proveedor">Nombre:_____________________________________ <br>
                    Código de empleado:__________________________</p></th>
                </tr>
            </tbody>
        </table>
    </div>
<br>
<br>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>Categoría</th>
                    <th>Producto</th>
                    <th>Código</th>
                    <th>Cantidad Solicitada</th>

                </tr>
            </thead>
            <tbody>
                @foreach($productos as $a)
                <tr>
                    <td>{{$a->nombre_categoria}}</td>
                    <td>{{$a->nombre}}</td>
                    <td>{{$a->codigo}}</td>
                    <td></td>

                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div>
            <table id="datos">
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <th><p id="proveedor">Firma Maestro de Obras:____________________________<br>
                            <br>
                            <br>
                            <br>
                        Firma Supervisor de Obras:_________________________</p></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
