@extends('adminlte::page')

@section('title', 'Valores de Chile Crece Contigo')

@section('content')
    <br>
    <div class="card">
        <form role="form" class="form-horizontal" id="form" method="POST" action="{{action('TarifaProgramaChileCreceController@store')}}">
            {{ csrf_field() }}
            <input type="hidden" id="id" name="id" value="{{$tarifa->id ?? ''}}"/>
            <div class="card-header">
                <h3 style="color:green" class="card-title"><strong>Tarifa</strong></h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="nombre">Nombre<span style="color:#FF0000";>*</span></label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="col-sm-3">
                            <label for="valor">Valor<span style="color:#FF0000";>*</span></label>
                            <input type="number" class="form-control" id="valor" name="valor" required>
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
    </script>    
@endsection