<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COMPROBANTE DE ABONO</title>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif;
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }


        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }

        #encabezado{
        text-align: center;
        margin-left: 35%;
        margin-right: 35%;
        font-size: 15px;
        }

        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        color: #FFFFFF;
        font-size: 20px;
        background:#D2691E;
        }

        section{
        clear: left;
        }

        #cliente{
        text-align: left;
        }

        #facliente{
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
        }

        #facliente thead{
        padding: 20px;
        background:#D2691E;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;
        }

        #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facvendedor thead{
        padding: 20px;
        background: #D2691E;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
        }

        #facproducto{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        text-align: center;
        font-size: 25px;
        }

        #facproducto thead{
        padding: 10px;
        background: #D2691E;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
        }


    </style>
    <body>
        @foreach ($credito as $c)
        <header>
            <!--<div id="logo">
                <img src="img/logo.png" alt="" id="imagen">
            </div>-->

            <div>

                <table id="datos">
                    <thead>
                        <tr>
                            <th id="">DATOS DEL COMPROBANTE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><p id="proveedor">Nombre: {{$c->nombre}}<br>
                            Dirección: {{$c->direccion}}<br>
                            Teléfono: {{$c->telefono}}<br>
                            NIT: {{$c->num_documento}}<br>
                            Lugar y Fecha: Jalapa, {{$fecha}}</</p></th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="fact">
                <p>COMPROBANTE-CREDITO<br>
            </div>
        </header>
        <br>

        @endforeach
        <br>

        <section>
            <div>
                <table id="facproducto">
                    <thead>
                        <tr id="fa">
                            <th>CANTIDAD A PAGAR </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($credito as $c)
                        <tr>
                            <td style="align="right"">Q{{$c->total}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <br>
        <footer>
            <!--puedes poner un mensaje aqui-->
            <div id="datos">
                <p id="encabezado">
                    <b>Repuestos Vimega</b><br>Sisventas
                </p>
            </div>
        </footer>
    </body>
</html>
