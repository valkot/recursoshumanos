<div id="honorarioTurno">
    <div class="card-header">
        <h3 style="color:green" class="card-title"><strong>Honorario Turno</strong></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3 offset-sm-3">
                    <label>N° de horas</label>
                </div>
                <div class="col-sm-3">
                    <label>Valor hora</label>
                </div>
                <div class="col-sm-3">
                    <label>Valor Mensual</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                    <label>Diurno:<span style="color:#FF0000";>*</span></label>
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="numero_hora_diurno_ht" name="numero_hora_diurno_ht" value="{{$solicitudContrato->contrato->numero_hora_diurno_ht ?? ''}}" onchange="valorMensualDiurnoHt();">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="valor_hora_diurno_ht" name="valor_hora_diurno_ht" value="{{$solicitudContrato->contrato->valor_hora_diurno_ht ?? ''}}" onchange="valorMensualDiurnoHt();">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="valor_mensual_diurno_ht" name="valor_mensual_diurno_ht" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                    <label>Diurno Extra:</label>
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="numero_hora_extra_ht" name="numero_hora_extra_ht" value="{{$solicitudContrato->contrato->numero_hora_extra_ht ?? ''}}" onchange="valorMensualExtraHt();">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="valor_hora_extra_ht" name="valor_hora_extra_ht" value="{{$solicitudContrato->contrato->valor_hora_extra_ht ?? ''}}" onchange="valorMensualExtraHt();">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="valor_mensual_extra_ht" name="valor_mensual_extra_ht" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                    <label>Festivo/Nocturno:</label>
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="numero_hora_festivo_ht" name="numero_hora_festivo_ht" value="{{$solicitudContrato->contrato->numero_hora_festivo_ht ?? ''}}" onchange="valorMensualFestivoHt();">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="valor_hora_festivo_ht" name="valor_hora_festivo_ht" value="{{$solicitudContrato->contrato->valor_hora_festivo_ht ?? ''}}" onchange="valorMensualFestivoHt();">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="valor_mensual_festivo_ht" name="valor_mensual_festivo_ht" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3 offset-sm-6">
                    <label>Valor Total:</label>
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="valor_total_ht" name="valor_total_ht" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                    <label>Días Ausentados:</label>
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="dias_ausentados_ht" name="dias_ausentados_ht" value="{{$solicitudContrato->contrato->dias_ausentados_ht ?? '0'}}" onchange="totalPagarHt();">
                </div>
                <div class="col-sm-3">
                    <label>Total a pagar:</label>
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="total_pagar_ht" name="total_pagar_ht" readonly>
                </div>
            </div>
        </div>
    </div>
</div>