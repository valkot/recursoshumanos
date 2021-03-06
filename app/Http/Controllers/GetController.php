<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Api\FonasaApi;
use App\User;
use App\Funcionario;
use App\TarifaHonorarioTurno;
use App\TipoEspecialidad;
use App\PrestacionFuncionario;

class GetController extends Controller
{
    public function getDatosRut(Request $request, FonasaApi $fonasaApi)
    {
        $rut = preg_replace('/[^k0-9]/i', '', request()->rut);
        $dv  = substr($rut, -1);
        $numero = substr($rut, 0, strlen($rut)-1);
        $i = 2;
        $suma = 0;
        if (is_numeric($numero)) {
            foreach (array_reverse(str_split($numero)) as $v) {
                if ($i==8) {
                    $i = 2;
                }

                $suma += $v * $i;
                ++$i;
            }
        }

        $dvr = 11 - ($suma % 11);
        
        if($dvr == 11)
            $dvr = 0;
        if($dvr == 10)
            $dvr = 'K';

        if($dvr != strtoupper($dv) || !is_numeric($numero)){
            $data['error'] = 'Ingrese Rut Valido';
            return $data;
        }

        $rut = str_replace(".","",request()->rut);
        $rutDV = explode("-", $rut);
        $data = Funcionario::where('nr_run', $rutDV[0])->first();
        if($data){
            $data = $data->toArray();
            $data['funcionario_id'] = $data['id'];
        }else{
            $data = $fonasaApi->fetchNormalized($rutDV[0], $rutDV[1]);
            $data['id_comuna'] = $data['cdgComuna'];
        }
        $user = User::where('rut', $rut)->first();
        if(isset($user)){
            $data['user'] = true;
            $data['id'] = $user->id;
        }else{
            $data['user'] = false;
        }
        $eliminado = User::onlyTrashed()->where('rut', $rut)->first();
        if(isset($eliminado)){
            $data['eliminado'] = true;
            $data['id'] = $eliminado->id;
        }else{
            $data['eliminado'] = false;
        }
        $data['error'] = null;
        return $data;
    }

    public function getValor(Request $request)
    {
        $tipoEspecialidad = TipoEspecialidad::find($request->id_tipo_especialidad);
        $tarifa = TarifaHonorarioTurno::with('valor')->where('especialidad_id', $request->especialidad_id)->where('servicio_id', $request->servicio_id)->where('especialidad_type', $tipoEspecialidad->modelo)->first();
        if(is_null($tarifa)){
            $tarifa = TarifaHonorarioTurno::with('valor')->where('especialidad_id', $request->especialidad_id)->whereNull('servicio_id')->where('especialidad_type', $tipoEspecialidad->modelo)->first();
        }
        if(is_null($tarifa)){
            return 0;
        }
        $data = $tarifa->valor;
        return $data;
    }

    public function getValorPrestacion(Request $request)
    {
        $data = PrestacionFuncionario::find($request->id_prestacion);
        return $data;
    }
}
