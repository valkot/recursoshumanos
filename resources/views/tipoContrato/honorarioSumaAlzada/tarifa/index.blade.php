@extends('adminlte::page')

@section('title', 'Lista de Tarifa Honorario Suma Alzada')

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
	@include('tipoContrato.honorarioSumaAlzada.tarifa.table')
@stop

@section('js')
    <script>
        $("body").addClass("sidebar-collapse");

        $(".alert-success").fadeTo(20000, 500).slideUp(500, function(){
            $(".alert-success").slideUp(1000);
        });

        $(".alert-danger").fadeTo(20000, 5000).slideUp(500, function(){
            $(".alert-danger").slideUp(1000);
        });
    </script>
@stop