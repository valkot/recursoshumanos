@extends('adminlte::page')

@section('title', 'Lista de Tipos de Contratos')

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
		    <h3 class="card-title">Lista de Rangos</h3>
		</div>
		<div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <form class="form-horizontal">
                            <div class="form-group row">
                                {{-- <div class="col-sm-2">
                                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" value="{{request()->nombre}}">
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-info">Filtrar</button>
                                </div> --}}
                                <div class="col-sm-2 offset-sm-10">
                                    <a href={{url('rango/create')}} class="btn btn-success" type="button" title="Agregar Nueva Solicitud"><i class="fa fa-plus" style="color:white"></i></a>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead style="font-size:12px">
                                    <th>ID</th>
                                    <th>Especialidad</th>
                                    <th>Servicio</th>
                                    <th>Diurno</th>
                                    <th>Extra</th>
                                    <th>Festivo</th>
                                    <th><i class="fa fa-cog"></i></th>
                                </thead>
                                <tbody>
                                    @foreach ($rangos as $rango)
                                        <tr style="font-size:12px">
                                            <td>{{$rango->id}}</td>
                                            <td>{{$rango->especialidad->tx_descripcion}}</td>
                                            <td>{{$rango->servicio->tx_descripcion}}</td>
                                            <td>{{$rango->valor->diurno}}</td>
                                            <td>{{$rango->valor->extra}}</td>
                                            <td>{{$rango->valor->festivo}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href={{url("rango/".$rango->id."/edit")}} title="Editar" class="btn btn-warning btn-xs"><i class="fa fa-edit" style="color:white"></i></a>
                                                    {{-- <form action="{{ route('paciente.destroy',$paciente->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('¿Esta seguro de eliminar este paciente?');" type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash" style="color:white"></i></button>
                                                    </form> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $rangos->appends(request()->query())->links() }}
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
    </script>
@stop