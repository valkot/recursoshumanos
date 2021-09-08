@extends('adminlte::page')

@section('title', 'Lista de Tipos de Contratos')

@include('alert.notificacion')

@section('content')
    <br>
	<div class="card card-info">
		<div class="card-header">
		    <h3 class="card-title">Lista de Tipos de Contratos</h3>
		</div>
		<div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <form class="form-horizontal">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" value="{{request()->nombre}}">
                            </div>
                            <div class="col-sm-1 offset-sm-8">
                                <button type="submit" class="btn btn-info">Filtrar</button>
                            </div>
                            <div class="col-sm-1">
                                <a href={{url('tipoContrato/create')}} class="btn btn-success" type="button" title="Agregar Nuevo Contrato"><i class="fa fa-plus" style="color:white"></i></a>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th><i class="fa fa-cog"></i></th>
                            </thead>
                            <tbody>
                                @foreach ($tiposContratos as $tipoContrato)
                                    <tr>
                                        <td>{{$tipoContrato->id}}</td>
                                        <td>{{$tipoContrato->nombre}}</td>
                                        <td>{{isset($tipoContrato->deleted_at) ? 'Inactivo' : 'Activo'}}</td>
                                        <td>
                                            <form action="{{ route('tipoContrato.destroy',$tipoContrato->id) }}" method="POST">
                                                <div class="btn-group">
                                                    <a href={{url("tipoContrato/".$tipoContrato->id."/edit")}} title="Editar" class="btn btn-warning btn-xs"><i class="fa fa-edit" style="color:white"></i></a>
                                                    @if (!isset($tipoContrato->deleted_at))
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('¿Esta seguro de dejar inactivo el contrato {{$tipoContrato->nombre}}?');" title="Desactivar" type="submit" class="btn btn-danger btn-xs"><i class="fa fa-ban" style="color:white"></i></button>
                                                    @else
                                                        <a href={{url("tipoContratoActivar/".$tipoContrato->id)}} title="Activar" class="btn btn-success btn-xs"><i class="fa fa-ban" style="color:white"></i></a>
                                                    @endif
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $tiposContratos->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        @include('alert.script')
    </script>
@stop