<div id="honorarioSumaAlzada">
    <div class="card-header">
        <h3 style="color:green" class="card-title"><strong>Honorario Suma Alzada</strong></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                    <label for="numero_hora_hsa">N° de horas<span style="color:#FF0000";>*</span></label>
                    <select class="form-control" id="numero_hora_hsa" name="numero_hora_hsa">
                        <option value="">Seleccione Cantidad de Horas</option>
                        <option value="11" {{isset($solicitudContrato->contrato) && $solicitudContrato->contrato->numero_hora_hsa == 11 ? "selected" : ""}}>11</option>
                        <option value="22" {{isset($solicitudContrato->contrato) && $solicitudContrato->contrato->numero_hora_hsa == 22 ? "selected" : ""}}>22</option>
                        <option value="33" {{isset($solicitudContrato->contrato) && $solicitudContrato->contrato->numero_hora_hsa == 33 ? "selected" : ""}}>33</option>
                        <option value="44" {{isset($solicitudContrato->contrato) && $solicitudContrato->contrato->numero_hora_hsa == 44 ? "selected" : ""}}>44</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="valor_mensual_hsa">Valor Mensual<span style="color:#FF0000";>*</span></label>
                    <input type="number" class="form-control" id="valor_mensual_hsa" name="valor_mensual_hsa" value="{{$solicitudContrato->contrato->valor_mensual_hsa ?? ''}}" onchange="totalPagarHsa();">
                </div>
                <div class="col-sm-3">
                    <label>Días Ausentados:</label>
                    <input type="number" class="form-control" id="dias_ausentados_hsa" name="dias_ausentados_hsa" value="{{$solicitudContrato->contrato->dias_ausentados_hsa ?? ''}}" onchange="totalPagarHsa();" value="0">
                </div>
                <div class="col-sm-3">
                    <label>Total a pagar:</label>
                    <input type="number" class="form-control" id="total_pagar_hsa" name="total_pagar_hsa" readonly>
                </div>
            </div>
        </div>
    </div>
</div>