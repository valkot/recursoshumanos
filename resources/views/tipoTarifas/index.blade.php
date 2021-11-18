@extends('adminlte::page')

@section('title', 'Lista de Tipos de Tarifas')

@include('alert.notificacion')

@section('content')
    <br>
	<div class="card card-info">
		<div class="card-header">
		    <h3 class="card-title">Lista de Tipos de Tarifas</h3>
		</div>
		<div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <form class="form-horizontal">
                        <div class="form-group row">

                            <div class="col-sm-2">
                                <select class="form-control" name="filtro_tipo_tarifa" id="filtro_tipo_tarifa" onchange="setFiltroTarifa(this);">
                                    <option hidden selected>Tipo Tarifa</option>
                                        <option value="1" >Todas</option>
                                        <option value="2" >Honorario Suma Alzada</option>
                                        <option value="3" >Honorario Turno</option>
                                        <option value="4" >Programa Chile Crece Contigo</option>
                                        <option value="5" >Prestaciones</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <select class="form-control" name="filtro_año_tarifa" id="filtro_año_tarifa" onchange="setFiltroAnio(this);">
                                    <option hidden selected >Año</option>
                                        <option value="2021" >2021</option>
                                        <option value="2022" >2022</option>
                                </select>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
        
    </div>

    <div id="div_table_HSA" style="display: none;">
        @include('tipoContrato.honorarioSumaAlzada.tarifa.table')
    </div>
    <div id="div_table_HT" style="display: none;">  
        @include('tipoContrato.honorarioTurno.tarifa.table')
    </div>
    <div id="div_table_PCC" style="display: none;">
        @include('tipoContrato.programaChileCrece.tarifa.table')
    </div>
    <div id="div_table_P" style="display: none;">
        @include('prestacion.table')
    </div>
@stop
    


@section('js')
    <script>
        @include('alert.script')

        function setFiltroTarifa(tarifa)
        {
            if(tarifa.value == 1){
                $('#div_table_HSA').css('display', '');
                $('#div_table_HT').css('display', '');
                $('#div_table_PCC').css('display', '');
                $('#div_table_P').css('display', '');
            }else if(tarifa.value == 2){
                $('#div_table_HSA').css('display', '');                
                $('#div_table_HT').css('display', 'none');
                $('#div_table_PCC').css('display', 'none');
                $('#div_table_P').css('display', 'none');
            }else if(tarifa.value == 3){
                $('#div_table_HSA').css('display', 'none');                
                $('#div_table_HT').css('display', '');
                $('#div_table_PCC').css('display', 'none');
                $('#div_table_P').css('display', 'none');
            }else if(tarifa.value == 4){
                $('#div_table_HSA').css('display', 'none');                
                $('#div_table_HT').css('display', 'none');
                $('#div_table_PCC').css('display', '');
                $('#div_table_P').css('display', 'none');
            }else if(tarifa.value == 5){
                $('#div_table_HSA').css('display', 'none');                
                $('#div_table_HT').css('display', 'none');
                $('#div_table_PCC').css('display', 'none');
                $('#div_table_P').css('display', '');
            }
        }

        const dataTableHSA = $('#table_HSA').DataTable({
            "columnDefs": [ 
                { "targets": 0, "title": "ID", "data": "id" },
                { "targets": 1, "title": "Nombre", "data": "nombre" },
                { "targets": 2, "title": "Valor", "data": "valor" },
                { "targets": 3, "title": "Año", "data": "anio" },
                { "targets": 4, "title": '<i class="fa fa-cog"></i>', "data": "botones" } 
            ],
            language: {"url": "{{url('/')}}/js/datatables/spanish.json"},
        });

        const dataTableHT = $('#table_HT').DataTable({
            "columns": [
                { "title": "ID", "data": "id" },
                { "title": "Nombre", "data": "nombre" },
                { "title": "Valor", "data": "valor" },
                { "title": "Año", "data": "anio" },
                { "targets": 4, "title": '<i class="fa fa-cog"></i>', "data": "botones" } 
            ],
            language: {"url": "{{url('/')}}/js/datatables/spanish.json"},
        });
        
        const dataTablePCC = $('#table_PCC').DataTable({
            "columns": [
                { "title": "ID", "data": "id" },
                { "title": "Nombre", "data": "nombre" },
                { "title": "Valor", "data": "valor" },
                { "title": "Año", "data": "anio" },
                { "targets": 4, "title": '<i class="fa fa-cog"></i>', "data": "botones" } 
            ],
            language: {"url": "{{url('/')}}/js/datatables/spanish.json"},
        });

        const dataTableP = $('#table_P').DataTable({
            language: {"url": "{{url('/')}}/js/datatables/spanish.json"},
        });

        function setFiltroAnio(anio){
            $.ajax({
                type: "Get",
                url: "/tipoTarifas/" + $(anio).val(),
                success: function (data) {
                    
                    dataTableHSA.clear();
                    dataTableHSA.rows.add(data.tarifasHSA)
                    dataTableHSA.draw();

                    dataTableHT.clear();
                    dataTableHT.rows.add(data.tarifasHT);
                    dataTableHT.draw();

                    dataTablePCC.clear();
                    dataTablePCC.rows.add(data.tarifasPCC).draw()
                    dataTablePCC.draw();

                },
                error: function (response) {
                    console.log(response.responseText);
                }
            });
        }

        // $('.dataTable').DataTable({
        //     language: {"url": "{{url('/')}}/js/datatables/spanish.json"},
        // });

    </script>
@stop