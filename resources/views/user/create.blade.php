@extends('adminlte::page')

@section('title', 'Usuario')

@section('content')
    <br>
    <div class="card">
        <form role="form" class="form-horizontal" id="form" method="POST" action="{{action('UserController@store')}}">
            {{ csrf_field() }}
            <input type="hidden" id="id" name="id" value="{{$user->id ?? ''}}"/>
            <div class="card-header">
                <h3 style="color:green" class="card-title"><strong>Usuario</strong></h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="rut">Rut<span style="color:#FF0000";>*</span></label>
                            <input type="text" class="form-control" id="rut" name="rut" value="{{$user->rut ?? ''}}" onblur="getPerson($(this).val());" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="name">Nombre<span style="color:#FF0000";>*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$user->name ?? ''}}" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$user->email ?? ''}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="perfil_id">Perfil<span style="color:#FF0000";>*</span></label>
                            <select class="form-control" id="perfil_id" name="perfil_id" onchange="servicio($(this).val());">
                                <option value="">Seleccione Perfil</option>
                                @foreach ($perfiles as $perfil)
                                    <option value={{$perfil->id}} {{isset($user) && $user->perfil_id == $perfil->id ? 'selected' : ''}}>{{$perfil->nombre}}</option>								
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="servicio_id">Servicio</label>
                            <select class="form-control" id="servicio_id" name="servicio_id">
                                <option value="">Seleccione Servicio</option>
                                @foreach ($servicios as $servicio)
                                    <option value={{$servicio->id}} {{isset($user) && $user->servicio_id == $servicio->id ? 'selected' : ''}}>{{$servicio->tx_descripcion}}</option>								
                                @endforeach
                            </select>
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
    <script>
        function getPerson(rut){
            $.getJSON("{{action('GetController@getDatosRut')}}?rut="+rut,
                function(data){
                    if(data.error != null){
                        alert(data.error);
                        $("#rut").val(null);
                    }else{
                        $("#rut").val(data.rut);
                        $("#name").val(data.tx_nombre+' '+data.tx_apellido_paterno+' '+data.tx_apellido_materno);
                    }
                }
            )
        }

        function servicio(perfil){
            if(perfil == 4){
                $("#servicio_id").css('display','').attr('disabled', false);
                $("#servicio_id").css('display','').attr('required', true);
            }else{
                $("#servicio_id").css('display','').attr('disabled', true);
                $("#servicio_id").css('display','').attr('required', false);
            }
        }

        @if(isset($user))
            var user = @json($user);
            servicio(user.perfil_id);
        @else
            servicio();
        @endif
    </script>    
@endsection