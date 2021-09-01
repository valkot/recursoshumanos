<tr>
    <th>Prestacion</th>
    <th>Valor</th>
    <th>Maximo Mensual</th>
    <th>Total</th>
</tr>
@foreach ($solicitudContrato->prestaciones as $prestacion)
    <tr>
        <td>{{$prestacion->prestacion->tx_nombre}}</td>
        <td>{{$prestacion->valor}}</td>
        <td>{{$prestacion->maximo_mes}}</td>
        <td>{{$prestacion->total}}</td>
    </tr>    
@endforeach
<tr>
    <th colspan="3">Monto Final</th>
    <th>{{array_sum($solicitudContrato->prestaciones->pluck('total')->toArray())}}</th>
</tr>