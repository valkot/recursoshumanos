<tr>
    <th>N° Horas</th>
    <th>Meses Periodo</th>
    <th>Max. Prestaciones por Periodo</th>
    <th>Funciones Clinicas Anexas</th>
</tr>
<tr>
    <td>{{$solicitudContrato->contrato->numero_hora_pqe}}</td>
    <td>{{$solicitudContrato->contrato->meses_periodo_pqe}}</td>
    <td>{{$solicitudContrato->contrato->max_prestaciones_periodo_pqe}}</td>
    <td>{{number_format($solicitudContrato->contrato->funciones_clinicas_pqe, 0, ',', '.')}}</td>
</tr>
<tr>
    <th>Prestación</th>
    <th>Valor por Prestación</th>
    <th>Max. Prestaciones por Mes</th>
    <th>Total a Pagar</th>
</tr>
<tr>
    <td>{{$solicitudContrato->contrato->prestacion->tx_nombre}}</td>
    <td>{{number_format($solicitudContrato->contrato->valor_prestacion_pqe, 0, ',', '.')}}</td>
    <td>{{$solicitudContrato->contrato->max_prestaciones_mes_pqe}}</td>
    <td>{{number_format($solicitudContrato->contrato->total_pagar_pqe, 0, ',', '.')}}</td>
</tr>
<tr>
    <th colspan="3">Total Pagar por Mes</th>
    <td style="background: lightgreen">{{number_format($solicitudContrato->contrato->total_pagar_mes_pqe, 0, ',', '.')}}</td>
</tr>
<tr>
    <th colspan="3">Total Pagar por Periodo</th>
    <td style="background: lightgreen">{{number_format($solicitudContrato->contrato->total_pagar_periodo_pqe, 0, ',', '.')}}</td>
</tr>