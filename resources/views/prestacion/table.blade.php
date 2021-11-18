<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Lista de Prestaciones</h3>
    </div>
    <div class="card-body">
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <form class="form-horizontal">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <a href={{url('prestacion/create')}} class="btn btn-success float-right" type="button" title="Agregar Nueva Prestacion"><i class="fa fa-plus" style="color:white"></i></a>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="table_P" class="table table-striped table-hover dataTable">
                            <thead style="font-size:12px">
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Valor</th>
                                <th><i class="fa fa-cog"></i></th>
                            </thead>
                            <tbody>
                                @foreach ($prestaciones as $prestacion)
                                    <tr style="font-size:12px">
                                        <td>{{$prestacion->id}}</td>
                                        <td>{{$prestacion->tx_nombre}}</td>
                                        <td>{{$prestacion->valor}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href={{url("prestacion/".$prestacion->id."/edit")}} title="Editar" class="btn btn-warning btn-xs"><i class="fa fa-edit" style="color:white"></i></a>
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
                    {{-- {{ $prestaciones->appends(request()->query())->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>