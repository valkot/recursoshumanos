@extends('adminlte::page')

@section('title', 'Lista de Solicitudes de Contratos')

@section('content_header')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">
            <i class="fa fa-exclamation-triangle"></i> {{ session()->get('error') }}
        </div>
    @endif
@stop

@section('content')
    <br>
	<div class="card card-info">
		<div class="card-header">
		    <h3 class="card-title">Lista de Solicitudes de Contratos</h3>
		</div>
		<div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <form class="form-horizontal">
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <input type="text" name="rut" class="form-control" id="rut" placeholder="Rut" value="{{request()->rut}}">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" value="{{request()->nombre}}">
                                </div>
                                <div class="col-sm-2">
                                    <select class="form-control" id="servicio_id" name="servicio_id" {{Auth::user()->perfil_id == 4 ? 'disabled' : ''}}>
                                        <option value="">Seleccione Servicio</option>
                                        @foreach ($servicios as $servicio)
                                            <option value={{$servicio->id}} {{request()->servicio_id == $servicio->id ? 'selected' : ''}}>{{$servicio->tx_descripcion}}</option>								
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <select class="select2 select2-hidden-accessible" id="estados" name="estados[]" multiple="" data-placeholder="Seleccione Estado(s)" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                        @foreach ($estados as $estado)
                                            <option value={{$estado->id}} {{isset(request()->estados) && in_array($estado->id, request()->estados) ? "selected" : ""}}>{{$estado->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="col-sm-2">
                                    <input type="text" name="tx_apellido_paterno" class="form-control" id="tx_apellido_paterno" placeholder="Apellido Paterno" value="{{request()->tx_apellido_paterno}}">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="tx_apellido_materno" class="form-control" id="tx_apellido_materno" placeholder="Apellido Materno" value="{{request()->tx_apellido_materno}}">
                                </div> --}}
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-info">Filtrar</button>
                                </div>
                                <div class="col-sm-2">
                                    <a href={{url('solicitudContrato/create')}} class="btn btn-success" type="button" title="Agregar Nueva Solicitud"><i class="fa fa-plus" style="color:white"></i></a>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Rut</th>
                                    <th>Servicio</th>
                                    <th>Especialidad</th>
                                    <th>Tipo de Contrato</th>
                                    <th>Fc. Inicio</th>
                                    <th>Estado</th>
                                    <th><i class="fa fa-cog"></i></th>
                                </thead>
                                <tbody>
                                    @foreach ($solicitudesContratos as $solicitudContrato)
                                        <tr>
                                            <td>{{$solicitudContrato->id}}</td>
                                            <td>{{$solicitudContrato->funcionario->nombre}}</td>
                                            <td>{{$solicitudContrato->funcionario->rut}}</td>
                                            <td>{{$solicitudContrato->servicio->tx_descripcion}}</td>
                                            <td>{{$solicitudContrato->especialidad->tx_descripcion}}</td>
                                            <td>{{$solicitudContrato->tipoContrato->nombre}}</td>
                                            <td>{{$solicitudContrato->fecha_inicio}}</td>
                                            <td><span class="badge {{$solicitudContrato->estado->class_laravel}}">{{$solicitudContrato->estado->nombre}}</span></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="solicitudContrato/{{$solicitudContrato->id}}" title="Ver Detalle" class="btn btn-secondary btn-xs"><i class="fa fa-file-pdf" style="color:white"></i></a>
                                                    @if($solicitudContrato->estado_id == 1)
                                                        <a href="solicitudContrato/{{$solicitudContrato->id}}/edit" title="Terminar Solicitud" class="btn btn-warning btn-xs"><i class="fa fa-edit" style="color:white"></i></a>
                                                        @if(Auth::user()->perfil_id < 4)
                                                            <a href="solicitudContratoEnviar/{{$solicitudContrato->id}}" title="Enviar" class="btn btn-primary btn-xs"><i class="fa fa-paper-plane" style="color:white"></i></a>
                                                        @endif
                                                        <a href="solicitudContratoAnular/{{$solicitudContrato->id}}" title="Anular" class="btn btn-danger btn-xs"><i class="fa fa-trash" style="color:white"></i></a>
                                                    @endif
                                                    @if($solicitudContrato->estado_id == 3)
                                                        <a href="solicitudContratoPdf/{{$solicitudContrato->id}}" title="Ver Contrato" class="btn btn-success btn-xs"><i class="fa fa-check" style="color:white"></i></a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $solicitudesContratos->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(".alert-success").fadeTo(20000, 500).slideUp(500, function(){
            $(".alert-success").slideUp(1000);
        });

        $(".alert-danger").fadeTo(20000, 5000).slideUp(500, function(){
            $(".alert-danger").slideUp(1000);
        });

        $('.select2').select2();
    </script>
@stop