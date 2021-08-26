<tr>
    <td></td>
    <th>N° Horas</th>
    <th>Valor Hora</th>
    <th>Valor Mensual</th>
</tr>
<tr>
    <th>Diurno</th>
    <td>{{$solicitudContrato->contrato->numero_hora_diurno_ht}}</td>
    <td>{{number_format($solicitudContrato->contrato->valor_hora_diurno_ht, 0, ',', '.')}}</td>
    <td>{{number_format($solicitudContrato->contrato->valor_mensual_diurno_ht, 0, ',', '.')}}</td>
</tr>
<tr>
    <th>Diurno Extra</th>
    <td>{{$solicitudContrato->contrato->numero_hora_extra_ht}}</td>
    <td>{{number_format($solicitudContrato->contrato->valor_hora_extra_ht, 0, ',', '.')}}</td>
    <td>{{number_format($solicitudContrato->contrato->valor_mensual_extra_ht, 0, ',', '.')}}</td>
</tr>
<tr>
    <th>Festivo/Nocturno</th>
    <td>{{$solicitudContrato->contrato->numero_hora_festivo_ht}}</td>
    <td>{{number_format($solicitudContrato->contrato->valor_hora_festivo_ht, 0, ',', '.')}}</td>
    <td>{{number_format($solicitudContrato->contrato->valor_mensual_festivo_ht, 0, ',', '.')}}</td>
</tr>
<tr>
    <th colspan="3">Total</th>
    <td style="background: lightgreen">{{number_format($solicitudContrato->contrato->valor_total_ht, 0, ',', '.')}}</td>
</tr>
<tr>
    <th>Dias Ausentados</th>
    <td>{{$solicitudContrato->contrato->dias_ausentados_ht}}</td>
    <th>Total Pagar</th>
    <td style="background: lightgreen">{{number_format($solicitudContrato->contrato->total_pagar_ht, 0, ',', '.')}}</td>
</tr>