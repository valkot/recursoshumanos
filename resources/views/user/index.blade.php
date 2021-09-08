@extends('adminlte::page')

@section('title', 'Lista de Usuarios')

@include('alert.notificacion')

@section('content')
    <br>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Lista de Usuarios</h3>
        </div>
        <div class="card-body">
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
                            <div class="col-sm-1 offset-sm-6">
                                <button type="submit" class="btn btn-info">Filtrar</button>
                            </div>
                            <div class="col-sm-1">
                                <a href={{url('user/create')}} class="btn btn-success" type="button" title="Agregar Nuevo Usuario"><i class="fa fa-plus" style="color:white"></i></a>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Rut</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Perfil</th>
                                <th>Servicio</th>
                                <th>Admin</th>
                                <th><i class="fa fa-cog"></i></th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @if (Auth::user()->perfil_id == 1 || $user->perfil_id > 2)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->rut}}</td>
                                            <td>{{$user->nombre}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->perfil->nombre}}</td>
                                            <td>{{$user->servicio->tx_descripcion ?? ""}}</td>
                                            <td>{{$user->admin == 1 ? 'Si' : 'No'}}</td>
                                            <td>
                                                <form action="{{ route('user.destroy',$user->id) }}" method="POST">
                                                    <div class="btn-group">
                                                        <a href={{url("user/".$user->id."/edit")}} title="Editar" class="btn btn-warning btn-xs"><i class="fa fa-edit" style="color:white"></i></a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('¿Esta seguro de eliminar a {{$user->nombre}}?');" title="Eliminar" type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash" style="color:white"></i></button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $users->appends(request()->query())->links() }}
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