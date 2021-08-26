<div id="programaTresTresMilHoras">
    <div class="card-header">
        <h3 style="color:green" class="card-title"><strong>Programa 33 mil Horas</strong></h3>
    </div>
    <div class="card-body">
        {{-- <div class="form-group">
            <div class="row">
                <div class="col-sm-3 offset-sm-3">
                    <label for="meses_periodo_ptmh">Meses del Periodo:<span style="color:#FF0000";>*</span></label>
                    <input type="number" class="form-control" id="meses_periodo_ptmh" name="meses_periodo_ptmh" onchange="calcularMaxPrestaPeriodo();">
                </div>
                <div class="col-sm-3">
                    <label for="max_prestaciones_periodo_ptmh">Max. prestaciones por periodo:</label>
                    <input type="number" class="form-control" id="max_prestaciones_periodo_ptmh" name="max_prestaciones_periodo_ptmh" readonly>
                </div>
            </div>
        </div> --}}
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                    <label for="id_prestacion_ptmh">Prestacion:<span style="color:#FF0000";>*</span></label>
                </div>
                <div class="col-sm-3">
                    <label for="valor_prestacion_ptmh">Valor por prestación:</label>
                </div>
                <div class="col-sm-3">
                    <label for="max_prestaciones_mes_ptmh">Max. prestaciones por mes:<span style="color:#FF0000";>*</span></label>
                </div>
                <div class="col-sm-3">
                    <label for="total_pagar_ptmh">Total a pagar:</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                    <select class="form-control" id="id_prestacion_ptmh" name="id_prestacion_ptmh[]" onchange="valorPrestacion();">
                        <option value="">Seleccione Prestacion</option>
                        @foreach ($prestaciones as $prestacion)
                            <option value="{{$prestacion->id}}">{{$prestacion->tx_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="valor_prestacion_ptmh[]" name="valor_prestacion_ptmh[]">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="max_prestaciones_mes_ptmh[]" name="max_prestaciones_mes_ptmh[]" onchange="calcularMaxPrestaPeriodo();">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="total_pagar_ptmh[]" name="total_pagar_ptmh[]">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                    <select class="form-control" id="id_prestacion_ptmh" name="id_prestacion_ptmh[]" onchange="valorPrestacion();">
                        <option value="">Seleccione Prestacion</option>
                        @foreach ($prestaciones as $prestacion)
                            <option value="{{$prestacion->id}}">{{$prestacion->tx_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="valor_prestacion_ptmh[]" name="valor_prestacion_ptmh[]">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="max_prestaciones_mes_ptmh[]" name="max_prestaciones_mes_ptmh[]" onchange="calcularMaxPrestaPeriodo();">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="total_pagar_ptmh[]" name="total_pagar_ptmh[]">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                    <select class="form-control" id="id_prestacion_ptmh" name="id_prestacion_ptmh[]" onchange="valorPrestacion();">
                        <option value="">Seleccione Prestacion</option>
                        @foreach ($prestaciones as $prestacion)
                            <option value="{{$prestacion->id}}">{{$prestacion->tx_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="valor_prestacion_ptmh[]" name="valor_prestacion_ptmh[]">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="max_prestaciones_mes_ptmh[]" name="max_prestaciones_mes_ptmh[]" onchange="calcularMaxPrestaPeriodo();">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="total_pagar_ptmh[]" name="total_pagar_ptmh[]">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                    <select class="form-control" id="id_prestacion_ptmh" name="id_prestacion_ptmh[]" onchange="valorPrestacion();">
                        <option value="">Seleccione Prestacion</option>
                        @foreach ($prestaciones as $prestacion)
                            <option value="{{$prestacion->id}}">{{$prestacion->tx_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="valor_prestacion_ptmh[]" name="valor_prestacion_ptmh[]">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="max_prestaciones_mes_ptmh[]" name="max_prestaciones_mes_ptmh[]" onchange="calcularMaxPrestaPeriodo();">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="total_pagar_ptmh[]" name="total_pagar_ptmh[]">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                    <select class="form-control" id="id_prestacion_ptmh" name="id_prestacion_ptmh[]" onchange="valorPrestacion();">
                        <option value="">Seleccione Prestacion</option>
                        @foreach ($prestaciones as $prestacion)
                            <option value="{{$prestacion->id}}">{{$prestacion->tx_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="valor_prestacion_ptmh[]" name="valor_prestacion_ptmh[]">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="max_prestaciones_mes_ptmh[]" name="max_prestaciones_mes_ptmh[]" onchange="calcularMaxPrestaPeriodo();">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="total_pagar_ptmh[]" name="total_pagar_ptmh[]">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                    <select class="form-control" id="id_prestacion_ptmh" name="id_prestacion_ptmh[]" onchange="valorPrestacion();">
                        <option value="">Seleccione Prestacion</option>
                        @foreach ($prestaciones as $prestacion)
                            <option value="{{$prestacion->id}}">{{$prestacion->tx_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="valor_prestacion_ptmh[]" name="valor_prestacion_ptmh[]">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="max_prestaciones_mes_ptmh[]" name="max_prestaciones_mes_ptmh[]" onchange="calcularMaxPrestaPeriodo();">
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="total_pagar_ptmh[]" name="total_pagar_ptmh[]">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-2 offset-sm-7">
                    <label for="total_pagar_mes_ptmh">Total pagar por mes:</label>
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="total_pagar_mes_ptmh" name="total_pagar_mes_ptmh" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-2 offset-sm-7">
                    <label for="total_pagar_periodo_ptmh">Total pagar periodo:</label>
                </div>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="total_pagar_periodo_ptmh" name="total_pagar_periodo_ptmh" readonly>
                </div>
            </div>
        </div>
    </div>
</div>