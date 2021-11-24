<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Lista de Tarifas Honorario Turno</h3>
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
                            <div class="col-sm-12">
                                <a href={{url('tarifaHonorarioTurno/create')}} class="btn btn-success float-right" type="button" title="Agregar Nueva Tarifa"><i class="fa fa-plus" style="color:white"></i></a>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="table_HT" class="table table-striped table-hover dataTable">
                            <thead >
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Valor</th>
                                <th>Año</th>
                                <th><i class="fa fa-cog"></i></th>
                            </thead>
                            <tbody>
                                @foreach ($tarifasHT as $tarifa)
                                    <tr >
                                        <td>{{$tarifa->id}}</td>
                                        <td>{{$tarifa->nombre}}</td>
                                        <td>{{$tarifa->valor}}</td>
                                        <td>{{$tarifa->anio}}</td>
                                        <td>
                                            <div class="btn-group" style="line-height: 0">
                                                <a href={{url("tarifaHonorarioTurno/".$tarifa->id."/edit")}} title="Editar" class="btn btn-warning btn-xs"><i class="fa fa-edit" style="color:white"></i></a>
                                                <form action="{{ route('tarifaHonorarioTurno.destroy',$tarifa->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('¿Esta seguro de eliminar este paciente?');" type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash" style="color:white"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- {{ $tarifasHT->appends(request()->query())->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>