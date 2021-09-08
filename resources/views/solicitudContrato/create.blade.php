@extends('adminlte::page')

@section('title', 'Solicitud de Contrato')

@section('content')
    <br>
    <div class="card">
        <form role="form" class="form-horizontal" id="form" method="POST" action="{{action('SolicitudContratoController@store')}}">
            {{ csrf_field() }}
            <input type="hidden" id="funcionario_id" name="funcionario_id" value="{{$solicitudContrato->funcionario_id ?? ''}}"/>
            <input type="hidden" id="id_solicitud" name="id_solicitud" value="{{$solicitudContrato->id ?? ''}}"/>
            <input type="hidden" id="id_contrato" name="id_contrato" value="{{$solicitudContrato->contrato->id ?? ''}}"/>
            <input type="hidden" id="id_tipo_especialidad" name="id_tipo_especialidad"/>
            <input type="hidden" id="especialidad_id" name="especialidad_id"/>
            <div class="card-header">
                <h3 style="color:green" class="card-title"><strong>Datos Funcionario</strong></h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="rut">Rut<span style="color:#FF0000";>*</span></label>
                            <input type="text" class="form-control" id="rut" name="rut" onblur="getPerson($(this).val());" value="{{$solicitudContrato->funcionario->rut ?? ''}}" required>
                        </div>
                        <div class="col-sm-3">
                            <label for="tx_nombres">Nombre<span style="color:#FF0000";>*</span></label>
                            <input type="text" class="form-control" id="tx_nombres" name="tx_nombres" value="{{$solicitudContrato->funcionario->tx_nombres ?? ''}}" required>
                        </div>
                        <div class="col-sm-3">
                            <label for="tx_apellido_paterno">A. Paterno<span style="color:#FF0000";>*</span></label>
                            <input type="text" class="form-control" id="tx_apellido_paterno" name="tx_apellido_paterno" value="{{$solicitudContrato->funcionario->tx_apellido_paterno ?? ''}}" required>
                        </div>
                        <div class="col-sm-3">
                            <label for="tx_apellido_materno">A. Materno<span style="color:#FF0000";>*</span></label>
                            <input type="text" class="form-control" id="tx_apellido_materno" name="tx_apellido_materno" value="{{$solicitudContrato->funcionario->tx_apellido_materno ?? ''}}" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="id_sexo">Sexo<span style="color:#FF0000";>*</span></label>
                            <select class="form-control" id="id_sexo" name="id_sexo" required>
                                <option value="">Seleccione</option>
                                @foreach ($sexos as $sexo)
                                    <option value="{{$sexo->id}}" {{isset($solicitudContrato->funcionario) && $solicitudContrato->funcionario->id_sexo == $sexo->id ? "selected" : ""}}>{{$sexo->tx_descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="tx_direccion">Direccion<span style="color:#FF0000";>*</span></label>
                            <input type="text" class="form-control" id="tx_direccion" name="tx_direccion" value="{{$solicitudContrato->funcionario->tx_direccion ?? ''}}" required>
                        </div>
                        <div class="col-sm-3">
                            <label for="id_comuna">Comuna<span style="color:#FF0000";>*</span></label>
                            <select class="form-control" id="id_comuna" name="id_comuna" required>
                                <option value="">Seleccione Comuna</option>
                                @foreach ($comunas as $comuna)
                                    <option value={{$comuna->cd_comuna}} {{isset($solicitudContrato->funcionario) && $solicitudContrato->funcionario->id_comuna == $comuna->cd_comuna ? "selected" : ""}}>{{$comuna->tx_descripcion}}</option>								
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header">
                <h3 style="color:green" class="card-title"><strong>Datos del Contrato</strong></h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="tipo_contrato_id">Tipo de Contrato<span style="color:#FF0000";>*</span></label>
                            <select class="form-control" id="tipo_contrato_id" name="tipo_contrato_id" onchange="tipoContrato($(this).val());" {{isset($solicitudContrato) ? "disabled" : ""}} required>
                                <option value="">Seleccione Tipo de Contrato</option>
                                @foreach ($tiposContratos as $tipoContrato)
                                    <option value={{$tipoContrato->id}} {{isset($solicitudContrato) && $solicitudContrato->tipoContrato->id == $tipoContrato->id ? "selected" : ""}}>{{$tipoContrato->nombre}}</option>								
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="servicio_id">Servicio<span style="color:#FF0000";>*</span></label>
                            <select class="form-control" id="servicio_id" name="servicio_id" {{Auth::user()->perfil_id == 4 ? 'disabled' : ''}} required>
                                <option value="">Seleccione Servicio</option>
                                @foreach ($servicios as $servicio)
                                    <option value={{$servicio->id}} {{(isset($solicitudContrato) && $solicitudContrato->servicio_id == $servicio->id) || (Auth::user()->perfil_id == 4 && Auth::user()->servicio_id == $servicio->id) ? "selected" : ""}}>{{$servicio->tx_descripcion}}</option>								
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="id_tipo_profesion">Tipo de Especialidad/Profesión<span style="color:#FF0000";>*</span></label>
                            <select class="form-control" id="id_tipo_profesion" name="id_tipo_profesion" onchange="tipoEspecialidad($(this).val());" onclick="idEspecialidad($(this).val(), 3);">
                                <option value="">Seleccione Tipo Profesión</option>
                                @foreach ($titulosProfesionales as $tituloProfesional)
                                    <option value={{$tituloProfesional->id}}>{{$tituloProfesional->tx_descripcion}}</option>								
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3" id="especialidadMedica">
                            <label for="id_especialidad_medica">Especialidad Medica<span style="color:#FF0000";>*</span></label>
                            <select class="form-control" id="id_especialidad_medica" name="id_especialidad_medica" onchange="idEspecialidad($(this).val(), 1);">
                                <option value="">Seleccione Especialidad Medica</option>
                                @foreach ($especialidadesMedicas as $especialidadMedica)
                                    <option value={{$especialidadMedica->id}}>{{$especialidadMedica->tx_descripcion}}</option>								
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3" id="especialidadOdontologica">
                            <label for="id_especialidad_odontologica">Especialidad Odontologica<span style="color:#FF0000";>*</span></label>
                            <select class="form-control" id="id_especialidad_odontologica" name="id_especialidad_odontologica" onchange="idEspecialidad($(this).val(), 2);">
                                <option value="">Seleccione Especialidad Odontologica</option>
                                @foreach ($especialidadesOdontologicas as $especialidadOdontologica)
                                    <option value={{$especialidadOdontologica->id}}>{{$especialidadOdontologica->tx_descripcion}}</option>								
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="fc_inicio">Fecha de Inicio<span style="color:#FF0000";>*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" class="form-control" id="fc_inicio" name="fc_inicio" onchange="validarFechaContrato($(this).val(), $('#fc_termino').val());" value="{{$solicitudContrato->fc_inicio ?? ''}}" required>
                            </div>	
                        </div>
                        <div class="col-sm-3">
                            <label for="fc_termino">Fecha de Termino<span style="color:#FF0000";>*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" class="form-control" id="fc_termino" name="fc_termino" onchange="validarFechaContrato($('#fc_inicio').val(), $(this).val());" value="{{$solicitudContrato->fc_termino ?? ''}}" required>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
            @include('tipoContrato.honorarioTurno.formulario')
            @include('tipoContrato.honorarioSumaAlzada.formulario')
            @include('tipoContrato.programaChileCrece.formulario')
            @include('tipoContrato.programaQuinientosEspecialista.formulario')
            @include('tipoContrato.programaTresTresMilHoras.formulario')
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-info" onclick="guardar();">Guardar</button>
            </div>
        </form>
    </div>
@stop

@section('js')
    <script>
        $("body").addClass("sidebar-collapse");

        function guardar(){
            $("#tipo_contrato_id").css('display','').attr('disabled', false);
        }

        function getPerson(rut){
            $.getJSON("{{action('GetController@getDatosRut')}}?rut="+rut,
                function(data){
                    if(data.error != null){
                        alert(data.error);
                        $("#rut").val(null);
                    }else{
                        $("#funcionario_id").val(data.funcionario_id);
                        $("#rut").val(data.rut);
                        $("#tx_nombres").val(data.tx_nombres);
                        $("#tx_apellido_paterno").val(data.tx_apellido_paterno);
                        $("#tx_apellido_materno").val(data.tx_apellido_materno);
                        $("#id_sexo").val(data.id_sexo);
                        $("#tx_direccion").val(data.tx_direccion);
                        $("#id_comuna").val(data.id_comuna);
                    }
                }
            )
        }

        function tipoEspecialidad(bo){
            var medica = document.getElementById("especialidadMedica");
            medica.style.display = "none";
            var odontologica = document.getElementById("especialidadOdontologica");
            odontologica.style.display = "none";
            $("#id_especialidad_medica").css('display','').attr('disabled', true);
            $("#id_especialidad_medica").css('display','').attr('required', false);
            $("#id_especialidad_odontologica").css('display','').attr('disabled', true);
            $("#id_especialidad_odontologica").css('display','').attr('required', false);
            if(bo == 1 || bo == 32){
                medica.style.display = "block";
                $("#id_especialidad_medica").css('display','').attr('disabled', false);
                $("#id_especialidad_medica").css('display','').attr('required', true);
            }else if(bo == 2){
                odontologica.style.display = "block";
                $("#id_especialidad_odontologica").css('display','').attr('disabled', false);
                $("#id_especialidad_odontologica").css('display','').attr('required', true);
            }
        }

        function idEspecialidad(especialidad_id, id_tipo_especialidad, edit){
            $("#id_tipo_especialidad").val(id_tipo_especialidad);
            $("#especialidad_id").val(especialidad_id);
        }

        function tipoContrato(bo){
            var honorarioTurno = document.getElementById("honorarioTurno");
            honorarioTurno.style.display = "none";
            var honorarioSumaAlzada = document.getElementById("honorarioSumaAlzada");
            honorarioSumaAlzada.style.display = "none";
            var programaChileCrece = document.getElementById("programaChileCrece");
            programaChileCrece.style.display = "none";
            var programaQuinientosEspecialista = document.getElementById("programaQuinientosEspecialista");
            programaQuinientosEspecialista.style.display = "none";
            var programaTresTresMilHoras = document.getElementById("programaTresTresMilHoras");
            programaTresTresMilHoras.style.display = "none";
            $("#numero_hora_diurno_ht").css('display','').attr('disabled', true);
            $("#numero_hora_diurno_ht").css('display','').attr('required', false);
            $("#valor_hora_diurno_ht").css('display','').attr('disabled', true);
            $("#valor_hora_diurno_ht").css('display','').attr('required', false);
            $("#valor_mensual_diurno_ht").css('display','').attr('disabled', true);
            $("#valor_mensual_diurno_ht").css('display','').attr('required', false);
            $("#numero_hora_hsa").css('display','').attr('disabled', true);
            $("#numero_hora_hsa").css('display','').attr('required', false);
            $("#valor_mensual_hsa").css('display','').attr('disabled', true);
            $("#valor_mensual_hsa").css('display','').attr('required', false);
            $("#numero_hora_pcc").css('display','').attr('disabled', true);
            $("#numero_hora_pcc").css('display','').attr('required', false);
            $("#valor_mensual_pcc").css('display','').attr('disabled', true);
            $("#valor_mensual_pcc").css('display','').attr('required', false);
            if(bo == 1){
                honorarioTurno.style.display = "block";
                $("#numero_hora_diurno_ht").css('display','').attr('disabled', false);
                $("#numero_hora_diurno_ht").css('display','').attr('required', true);
                $("#valor_hora_diurno_ht").css('display','').attr('disabled', false);
                $("#valor_hora_diurno_ht").css('display','').attr('required', true);
                $("#valor_mensual_diurno_ht").css('display','').attr('disabled', false);
                $("#valor_mensual_diurno_ht").css('display','').attr('required', true);
            }
            if(bo == 2){
                honorarioSumaAlzada.style.display = "block";
                $("#numero_hora_hsa").css('display','').attr('disabled', false);
                $("#numero_hora_hsa").css('display','').attr('required', true);
                $("#valor_mensual_hsa").css('display','').attr('disabled', false);
                $("#valor_mensual_hsa").css('display','').attr('required', true);
            }
            if(bo == 3){
                programaChileCrece.style.display = "block";
                $("#numero_hora_pcc").css('display','').attr('disabled', false);
                $("#numero_hora_pcc").css('display','').attr('required', true);
                $("#valor_mensual_pcc").css('display','').attr('disabled', false);
                $("#valor_mensual_pcc").css('display','').attr('required', true);
            }
            if(bo == 4){
                programaQuinientosEspecialista.style.display = "block";
                $("#numero_hora_pqe").css('display','').attr('disabled', false);
                $("#numero_hora_pqe").css('display','').attr('required', true);
                $("#meses_periodo_pqe").css('display','').attr('disabled', false);
                $("#meses_periodo_pqe").css('display','').attr('required', true);
                $("#max_prestaciones_periodo_pqe").css('display','').attr('disabled', false);
                $("#max_prestaciones_periodo_pqe").css('display','').attr('required', true);
            }
            if(bo == 5){
                programaTresTresMilHoras.style.display = "block";
            }
        }

        function validarFechaContrato(fc_inicio, fc_termino){           
            if(fc_inicio > fc_termino){
                $("#fc_termino").val(null);
            }
        }

        tipoEspecialidad();
        tipoContrato();

        // Honorario Turno
        function valorHonorarioTurno() {
            var tarifa_ht = document.getElementById("tarifa_ht").value;
            $("#valor_hora_diurno_ht").val(tarifa_ht);

            var numero_hora_diurno_ht = document.getElementById("numero_hora_diurno_ht").value;
            var valor_hora_diurno_ht = document.getElementById("valor_hora_diurno_ht").value;
            $("#valor_mensual_diurno_ht").val(numero_hora_diurno_ht*valor_hora_diurno_ht);

            var numero_hora_extra_ht = document.getElementById("numero_hora_extra_ht").value;
            var valor_hora_extra_ht = document.getElementById("valor_hora_extra_ht").value;
            $("#valor_mensual_extra_ht").val(numero_hora_extra_ht*valor_hora_extra_ht);

            var numero_hora_festivo_ht = document.getElementById("numero_hora_festivo_ht").value;
            var valor_hora_festivo_ht = document.getElementById("valor_hora_festivo_ht").value;
            $("#valor_mensual_festivo_ht").val(numero_hora_festivo_ht*valor_hora_festivo_ht);

            var valor_mensual_diurno_ht = document.getElementById("valor_mensual_diurno_ht").value;
            var valor_mensual_extra_ht = document.getElementById("valor_mensual_extra_ht").value;
            var valor_mensual_festivo_ht = document.getElementById("valor_mensual_festivo_ht").value;
            $("#valor_total_ht").val(Number(valor_mensual_diurno_ht)+Number(valor_mensual_extra_ht)+Number(valor_mensual_festivo_ht));

            var dias_ausentados_ht = document.getElementById("dias_ausentados_ht").value;
            var valor_mensual_diurno_ht = document.getElementById("valor_mensual_diurno_ht").value;
            var valor_mensual_extra_ht = document.getElementById("valor_mensual_extra_ht").value;
            var valor_mensual_festivo_ht = document.getElementById("valor_mensual_festivo_ht").value;
            $("#total_pagar_ht").val(((Number(valor_mensual_diurno_ht)/30)*(30-Number(dias_ausentados_ht)))+Number(valor_mensual_extra_ht)+Number(valor_mensual_festivo_ht));
        }
        valorHonorarioTurno();

        // Honorario Suma Alzada
        function valorHonorarioSumaAlzada(){
            var valor_mensual_hsa = document.getElementById("tipo_honorario_hsa").value;
            $("#valor_mensual_hsa").val(valor_mensual_hsa);
            var dias_ausentados_hsa = document.getElementById("dias_ausentados_hsa").value;
            $("#total_pagar_hsa").val(((Number(valor_mensual_hsa)/30)*(30-Number(dias_ausentados_hsa))));
        }
        valorHonorarioSumaAlzada();

        // Programa Chile Crece
        function valorProgramaChileCrece(){
            var valor_mensual_pcc = document.getElementById("tipo_honorario_pcc").value;
            $("#valor_mensual_pcc").val(valor_mensual_pcc);
            var dias_ausentados_pcc = document.getElementById("dias_ausentados_pcc").value;
            $("#total_pagar_pcc").val(((Number(valor_mensual_pcc)/30)*(30-Number(dias_ausentados_pcc))));
        }
        valorProgramaChileCrece();

        // Programa 500 Especialista
        function valorPrestacionPqe(){
            var id_prestacion_pqe = document.getElementById("id_prestacion_pqe").value;
            $.getJSON("{{action('GetController@getValorPrestacion')}}?id_prestacion="+id_prestacion_pqe,
                function(data){
                    $("#valor_prestacion_pqe").val(data.valor);
                    calcularMaxPrestaPeriodoPqe();
                }
            )
        }

        function calcularMaxPrestaPeriodoPqe(){
            var meses_periodo_pqe = document.getElementById("meses_periodo_pqe").value;
            var max_prestaciones_mes_pqe = document.getElementById("max_prestaciones_mes_pqe").value;
            $("#max_prestaciones_periodo_pqe").val(meses_periodo_pqe*max_prestaciones_mes_pqe);
            calcularPagoPqe();
        }

        function calcularPagoPqe(){
            var max_prestaciones_mes_pqe = document.getElementById("max_prestaciones_mes_pqe").value;
            var valor_prestacion_pqe = document.getElementById("valor_prestacion_pqe").value;
            $("#total_pagar_pqe").val(max_prestaciones_mes_pqe*valor_prestacion_pqe);
            calcularPagoTotalPqe();
        }

        function calcularPagoTotalPqe(){
            var total_pagar_pqe = document.getElementById("total_pagar_pqe").value;
            var funciones_clinicas_pqe = document.getElementById("funciones_clinicas_pqe").value;
            $("#total_pagar_mes_pqe").val(Number(total_pagar_pqe)+Number(funciones_clinicas_pqe));
            calcularPagoTotalPeriodoPqe();
        }

        function calcularPagoTotalPeriodoPqe(){
            var total_pagar_mes_pqe = document.getElementById("total_pagar_mes_pqe").value;
            var meses_periodo_pqe = document.getElementById("meses_periodo_pqe").value;
            $("#total_pagar_periodo_pqe").val(total_pagar_mes_pqe*meses_periodo_pqe);
        }

        // Programa 33mil Horas
        // function valorPrestacion(){
        //     var id_prestacion_pqe = document.getElementById("id_prestacion_ptmh").value;
        //     console.log(id_prestacion_pqe);
        // }
        function valorPrestacionPtmh(){
            var id_prestacion_ptmh = document.getElementById("id_prestacion_ptmh").value;
            $.getJSON("{{action('GetController@getValorPrestacion')}}?id_prestacion="+id_prestacion_ptmh,
                function(data){
                    $("#valor_prestacion_ptmh").val(data.valor);
                    // calcularMaxPrestaPeriodoPqe();
                }
            )
        }

        function agregarPrestacionPtmh(params) {
            var id_prestacion_ptmh = document.getElementById("id_prestacion_ptmh").value;
            var valor_prestacion_ptmh = document.getElementById("valor_prestacion_ptmh").value;
            var max_prestaciones_mes_ptmh = document.getElementById("max_prestaciones_mes_ptmh").value;
            if(id_prestacion_ptmh == '' || valor_prestacion_ptmh == '' || max_prestaciones_mes_ptmh == ''){
                alert('Debe completar todos los datos');
            }else{
                $.getJSON("{{action('SolicitudContratoController@solicitudContratoAgregarPrestacion')}}?id_prestacion_ptmh="+id_prestacion_ptmh+"&max_prestaciones_mes_ptmh="+max_prestaciones_mes_ptmh,
                function(data){
                    generar_tabla_lista_prestaciones();
                })
                $("#id_prestacion_ptmh").val(null);
                $("#valor_prestacion_ptmh").val(null);
                $("#max_prestaciones_mes_ptmh").val(null);                
            }
        }

        function eliminarPrestacion(key){
            $.getJSON("{{action('SolicitudContratoController@solicitudContratoAgregarPrestacion')}}?key="+key,
				function(data){
					generar_tabla_lista_prestaciones();
				})
        }

        function generar_tabla_lista_prestaciones(){
            let tablaOperados= '<div class="card-body"><div class="col-12 table-responsive"><table class="table table-striped"><thead>';
                tablaOperados+="<th>Prestación</th>";
                tablaOperados+="<th>Valor</th>";
                tablaOperados+="<th>Max. por Mes</th>";
                tablaOperados+="<th>Total</th>";
                tablaOperados+="<th>Eliminar</th>";
                var total = 0;
                $.getJSON("{{action('SolicitudContratoController@solicitudContratoAgregarPrestacion')}}",
                function(data){
                    data.forEach(function(element, key) {
                        tablaOperados+="<tr><td>"+element.tx_nombre+"</td>";  
                        tablaOperados+="<td>"+element.valor+"</td>";
                        tablaOperados+="<td>"+element.max+"</td>";
                        tablaOperados+="<td>"+element.total+"</td>";
                        tablaOperados+='<td><a class="btn btn-danger btn-xs" style="color:white" onclick="eliminarPrestacion('+key+')" title="Eliminar" target="_blank"><i class="fa fa-trash" style="color:white"></i></a></td>';
                        tablaOperados+="</tr>";
                        total = total + element.total;
                    });
                    
                    tablaOperados+="<th>Monto Final</th>";
                    tablaOperados+="<th></th>";
                    tablaOperados+="<th></th>";
                    tablaOperados+="<th>"+total+"</th>";
                    tablaOperados+="<th></th>";
                    tablaOperados+="</table>";   
				    document.getElementById('prestaciones').innerHTML = tablaOperados;
                })
        }

        @if(isset($solicitudContrato))
            var id_tipo_contrato = @json($solicitudContrato->tipoContrato->id);
            var especialidad_id = @json($solicitudContrato->especialidad_id);
            var especialidad_type = @json($solicitudContrato->tipoEspecialidad->id);

            switch (especialidad_type) {
                case 1:
                    $("#id_tipo_profesion").val(1);
                    tipoEspecialidad(1);
                    $("#id_especialidad_medica").val(especialidad_id);
                    break;

                case 2:
                    $("#id_tipo_profesion").val(2);
                    tipoEspecialidad(2);
                    $("#id_especialidad_odontologica").val(especialidad_id);
                    break;

                case 3:
                    tipoEspecialidad(especialidad_id);
                    $("#id_tipo_profesion").val(especialidad_id);
                    break;
            
                default:
                    break;
            }
            idEspecialidad(especialidad_id, especialidad_type, 1);
            tipoContrato(id_tipo_contrato);

            valorMensualDiurnoHt();
            valorMensualExtraHt();
            valorMensualFestivoHt();
            valorTotalHt();
            totalPagarHt();

            totalPagarHsa();

            valorPrestacionPqe();
        @endif
    </script>    
@endsection