@extends('adminlte::page')

@section('title', 'Valores del Especialista')

@section('content')
    <br>
    <div class="card">
        <form role="form" class="form-horizontal" id="form" method="POST" action="{{action('RangoController@store')}}">
            {{ csrf_field() }}
            <input type="hidden" id="id" name="id" value="{{$rango->id ?? ''}}"/>
            <input type="hidden" id="id_tipo_especialidad" name="id_tipo_especialidad"/>
            <input type="hidden" id="especialidad_id" name="especialidad_id"/>
            <div class="card-header">
                <h3 style="color:green" class="card-title"><strong>Rango</strong></h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="servicio_id">Servicio<span style="color:#FF0000";>*</span></label>
                            <select class="form-control" id="servicio_id" name="servicio_id" onclick="asignarValor();" required>
                                <option value="">Seleccione Servicio</option>
                                @foreach ($servicios as $servicio)
                                    <option value={{$servicio->id}}>{{$servicio->tx_descripcion}}</option>								
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="id_tipo_profesion">Tipo de Especialidad/Profesión<span style="color:#FF0000";>*</span></label>
                            <select class="form-control" id="id_tipo_profesion" name="id_tipo_profesion" onchange="tipoEspecialidad($(this).val());" onclick="idEspecialidad($(this).val(), 3);" required>
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
                            <label for="diurno">Diurno<span style="color:#FF0000";>*</span></label>
                            <input type="number" class="form-control" id="diurno" name="diurno" required>
                        </div>
                        <div class="col-sm-3">
                            <label for="extra">Extra<span style="color:#FF0000";>*</span></label>
                            <input type="number" class="form-control" id="extra" name="extra" required>
                        </div>
                        <div class="col-sm-3">
                            <label for="festivo">Festivo<span style="color:#FF0000";>*</span></label>
                            <input type="number" class="form-control" id="festivo" name="festivo" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-info">Guardar</button>
            </div>
        </form>
    </div>
@stop

@section('js')
    <script>
        $("body").addClass("sidebar-collapse");

        function tipoEspecialidad(bo){
            var medica = document.getElementById("especialidadMedica");
            medica.style.display = "none";
            var odontologica = document.getElementById("especialidadOdontologica");
            odontologica.style.display = "none";
            $("#id_especialidad_medica").css('display','').attr('disabled', true);
            $("#id_especialidad_medica").css('display','').attr('required', false);
            $("#id_especialidad_odontologica").css('display','').attr('disabled', true);
            $("#id_especialidad_odontologica").css('display','').attr('required', false);
            if(bo == 1){
                medica.style.display = "block";
                $("#id_especialidad_medica").css('display','').attr('disabled', false);
                $("#id_especialidad_medica").css('display','').attr('required', true);
            }else if(bo == 2){
                odontologica.style.display = "block";
                $("#id_especialidad_odontologica").css('display','').attr('disabled', false);
                $("#id_especialidad_odontologica").css('display','').attr('required', true);
            }
        }

        function idEspecialidad(especialidad_id, id_tipo_especialidad){
            $("#id_tipo_especialidad").val(id_tipo_especialidad);
            $("#especialidad_id").val(especialidad_id);
        }

        tipoEspecialidad();
        tipoContrato();
    </script>    
@endsection