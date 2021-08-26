<div id="programaQuinientosEspecialista">
    <div class="card-header">
        <h3 style="color:green" class="card-title"><strong>Programa 500 Especialista</strong></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                    <label for="numero_hora_pqe">N° de horas<span style="color:#FF0000";>*</span></label>
                    <select class="form-control" id="numero_hora_pqe" name="numero_hora_pqe">
                        <option value="">Seleccione Cantidad de Horas</option>
                        <option value="11" {{isset($solicitudContrato->contrato) && $solicitudContrato->contrato->numero_hora_pqe == 11 ? "selected" : ""}}>11</option>
                        <option value="22" {{isset($solicitudContrato->contrato) && $solicitudContrato->contrato->numero_hora_pqe == 22 ? "selected" : ""}}>22</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="meses_periodo_pqe">Meses del Periodo:<span style="color:#FF0000";>*</span></label>
                    <input type="number" class="form-control" id="meses_periodo_pqe" name="meses_periodo_pqe" value="{{$solicitudContrato->contrato->meses_periodo_pqe ?? ''}}" onchange="calcularMaxPrestaPeriodo();">
                </div>
                <div class="col-sm-3">
                    <label for="max_prestaciones_periodo_pqe">Max. prestaciones por periodo:</label>
                    <input type="number" class="form-control" id="max_prestaciones_periodo_pqe" name="max_prestaciones_periodo_pqe" readonly>
                </div>
                <div class="col-sm-3">
                    <label for="funciones_clinicas_pqe">Funciones Clinicas Anexas:<span style="color:#FF0000";>*</span></label>
                    <input type="number" class="form-control" id="funciones_clinicas_pqe" name="funciones_clinicas_pqe" value="{{$solicitudContrato->contrato->funciones_clinicas_pqe ?? ''}}" onchange="calcularMaxPrestaPeriodo();">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                    <label for="id_prestacion_pqe">Prestacion:<span style="color:#FF0000";>*</span></label>
                    <select class="form-control" id="id_prestacion_pqe" name="id_prestacion_pqe" onchange="valorPrestacionPqe();">
                        <option value="">Seleccione Prestacion</option>
                        @foreach ($prestaciones as $prestacion)
                            <option value="{{$prestacion->id}}" {{isset($solicitudContrato->contrato) && $solicitudContrato->contrato->id_prestacion_pqe == $prestacion->id ? "selected" : ""}}>{{$prestacion->tx_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="valor_prestacion_pqe">Valor por prestación:</label>
                    <input type="number" class="form-control" id="valor_prestacion_pqe" name="valor_prestacion_pqe" readonly>
                </div>
                <div class="col-sm-3">
                    <label for="max_prestaciones_mes_pqe">Max. prestaciones por mes:<span style="color:#FF0000";>*</span></label>
                    <input type="number" class="form-control" id="max_prestaciones_mes_pqe" name="max_prestaciones_mes_pqe" value="{{$solicitudContrato->contrato->max_prestaciones_mes_pqe ?? ''}}" onchange="calcularMaxPrestaPeriodo();">
                </div>
                <div class="col-sm-3">
                    <label for="total_pagar_pqe">Total a pagar:</label>
                    <input type="number" class="form-control" id="total_pagar_pqe" name="total_pagar_pqe" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-2 offset-sm-7">
                    <label for="total_pagar_mes_pqe">Total pagar por mes:</label>
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="total_pagar_mes_pqe" name="total_pagar_mes_pqe" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-2 offset-sm-7">
                    <label for="total_pagar_periodo_pqe">Total pagar periodo:</label>
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="total_pagar_periodo_pqe" name="total_pagar_periodo_pqe" readonly>
                </div>
            </div>
        </div>
    </div>
</div>