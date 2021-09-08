<tr>
    <th>N° Horas</th>
    <th>Valor Mensual</th>
    <th>Dias Ausentados</th>
    <th>Total Pagar</th>
</tr>
<tr>
    <td>{{$solicitudContrato->contrato->numero_hora_pcc}}</td>
    <td>{{number_format($solicitudContrato->contrato->valor_mensual_pcc, 0, ',', '.')}}</td>
    <td>{{$solicitudContrato->contrato->dias_ausentados_pcc}}</td>
    <td style="background: lightgreen">{{number_format($solicitudContrato->contrato->total_pagar_pcc, 0, ',', '.')}}</td>
</tr>