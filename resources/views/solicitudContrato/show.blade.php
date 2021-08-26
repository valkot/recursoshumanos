<html>
    <head>
        @include('PDF.style')
        <title>Solicitud de Contrato</title>
    </head>
    <body>
        @include('PDF.encabezado')
        <h2 align="center">Solicitud de Contrato</h2>
        <table id="tabla">
            <tr>
                <th colspan="3" style="background: blanchedalmond">Datos del Funcionario</th>
            </tr>
            <tr>
                <th>Nombre</th>
                <th>Rut</th>
                <th>Sexo</th>
            </tr>
            <tr>
                <td>{{$solicitudContrato->funcionario->nombre}}</td>
                <td>{{$solicitudContrato->funcionario->rut}}</td>
                <td>{{$solicitudContrato->funcionario->sexo->tx_descripcion}}</td>
            </tr>
            <tr>
                <th colspan="2">Dirección</th>
                <th>Comuna</th>
            </tr>
            <tr>
                <td colspan="2">{{$solicitudContrato->funcionario->tx_direccion}}</td>
                <td>{{$solicitudContrato->funcionario->comuna->tx_descripcion}}</td>
            </tr>
        </table>
        <br>
        <table id="tabla">
            <tr>
                <th colspan="4" style="background: blanchedalmond">Datos del Contrato</th>
            </tr>
            <tr>
                <th>Servicio</th>
                <th>Especialidad</th>
                <th>Fecha Inicio</th>
                <th>Fecha Termino</th>
            </tr>
            <tr>
                <td>{{$solicitudContrato->servicio->tx_descripcion}}</td>
                <td>{{$solicitudContrato->especialidad->tx_descripcion}}</td>
                <td>{{$solicitudContrato->fecha_inicio}}</td>
                <td>{{$solicitudContrato->fecha_termino}}</td>
            </tr>
        </table>
        <br>
        <table id="tabla">
            <tr>
                <th colspan="4" style="background: blanchedalmond">{{$solicitudContrato->tipoContrato->nombre}}</th>
            </tr>
            @include('tipoContrato.'.$solicitudContrato->tipoContrato->carpeta.'.pdf')
        </table>
    </body>
</html>