<div id="programaChileCrece">
    <div class="card-header">
        <h3 style="color:green" class="card-title"><strong>Honorario Suma Alzada</strong></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-2">
                    <label for="numero_hora_pcc">N° de horas<span style="color:#FF0000";>*</span></label>
                    <select class="form-control" id="numero_hora_pcc" name="numero_hora_pcc">
                        <option value="">Seleccione Cantidad de Horas</option>
                        <option value="11" {{isset($solicitudContrato->contrato) && $solicitudContrato->contrato->numero_hora_pcc == 11 ? "selected" : ""}}>11</option>
                        <option value="22" {{isset($solicitudContrato->contrato) && $solicitudContrato->contrato->numero_hora_pcc == 22 ? "selected" : ""}}>22</option>
                        <option value="33" {{isset($solicitudContrato->contrato) && $solicitudContrato->contrato->numero_hora_pcc == 33 ? "selected" : ""}}>33</option>
                        <option value="44" {{isset($solicitudContrato->contrato) && $solicitudContrato->contrato->numero_hora_pcc == 44 ? "selected" : ""}}>44</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label for="tipo_honorario_pcc">Tipo Honorario<span style="color:#FF0000";>*</span></label>
                    <select class="form-control" id="tipo_honorario_pcc" name="tipo_honorario_pcc" onchange="valorProgramaChileCrece();">
                        <option value="">Seleccione Tipo Profesión</option>
                        @foreach ($tarifasProgramaChileCrece as $tarifaProgramaChileCrece)
                            <option value={{$tarifaProgramaChileCrece->valor}} {{isset($solicitudContrato->contrato) && $solicitudContrato->contrato->valor_mensual_pcc == $tarifaProgramaChileCrece->valor ? "selected" : ""}}>{{$tarifaProgramaChileCrece->nombre}}</option>								
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="valor_mensual_pcc">Valor Mensual<span style="color:#FF0000";>*</span></label>
                    <input type="number" class="form-control" id="valor_mensual_pcc" name="valor_mensual_pcc" value="{{$solicitudContrato->contrato->valor_mensual_pcc ?? ''}}" onchange="valorProgramaChileCrece();">
                </div>
                <div class="col-sm-2">
                    <label>Días Ausentados:</label>
                    <input type="number" class="form-control" id="dias_ausentados_pcc" name="dias_ausentados_pcc" value="{{$solicitudContrato->contrato->dias_ausentados_pcc ?? ''}}" onchange="valorProgramaChileCrece();" value="0">
                </div>
                <div class="col-sm-3">
                    <label>Total a pagar:</label>
                    <input type="number" class="form-control" id="total_pagar_pcc" name="total_pagar_pcc" readonly>
                </div>
            </div>
        </div>
    </div>
</div>