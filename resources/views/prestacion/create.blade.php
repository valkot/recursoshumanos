@extends('adminlte::page')

@section('title', 'Crear Prestacion')

@section('css')
    <link href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <br>
    <div class="card">
        <form role="form" class="form-horizontal" id="form" method="POST" action="{{action('PrestacionFuncionarioController@store')}}">
            {{ csrf_field() }}
            <input type="hidden" id="id" name="id" value="{{$prestacion->id ?? ''}}"/>
            <div class="card-header">
                <h3 style="color:green" class="card-title"><strong>Prestacion</strong></h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="tx_nombre">Nombre<span style="color:#FF0000";>*</span></label>
                            <input type="text" class="form-control" id="tx_nombre" name="tx_nombre" value="{{$prestacion->tx_nombre ?? ''}}" required>
                        </div>
                        <div class="col-sm-3">
                            <label for="valor">Valor<span style="color:#FF0000";>*</span></label>
                            <input type="number" class="form-control" id="valor" name="valor" value="{{$prestacion->valor ?? ''}}" required>
                        </div>
                        <div class="col-sm-3">
                            <label for="anio">Año<span style="color:#FF0000";>*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="anio" name="anio" autocomplete="off" value="{{$prestacion->anio ?? ''}}" required>
                            </div>
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
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <script> 

        @if(isset($prestacion))            

        var nombre = @json($prestacion->nombre);
        var valor = @json($prestacion->valor);
        var anio = @json($prestacion->anio);

        $("#nombre").val(nombre);
        $("#valor").val(valor);
        $("#anio").val(anio);

        @endif

        $( document ).ready(function() {
            $("#anio").datepicker({
                autoclose: true,
                format: " yyyy",
                viewMode: "years",
                minViewMode: "years"
            });
        });

    </script>    
@endsection