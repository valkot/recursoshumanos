<?php

namespace App\Http\Controllers;

use App\TarifaHonorarioTurno;
use App\TarifaHonorarioTurnoValor;
use App\Servicio;
use App\TipoEspecialidad;
use App\TituloProfesional;
use App\EspecialidadMedica;
use App\EspecialidadOdontologica;
use Illuminate\Http\Request;

class TarifaHonorarioTurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tarifas = TarifaHonorarioTurno::with('servicio', 'especialidad', 'valor')->paginate(10);
        // dd($tarifas);
        return view('tipoContrato.honorarioTurno.tarifa.index', compact('tarifas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicios = Servicio::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        $titulosProfesionales = TituloProfesional::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        $especialidadesMedicas = EspecialidadMedica::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        $especialidadesOdontologicas = EspecialidadOdontologica::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        return view('tipoContrato.honorarioTurno.tarifa.create', compact('servicios', 'titulosProfesionales', 'especialidadesMedicas', 'especialidadesOdontologicas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoEspecialidad = TipoEspecialidad::find($request->id_tipo_especialidad);
        $rangoRequest = [
            'especialidad_id'=> request()->especialidad_id,
            'especialidad_type'=> $tipoEspecialidad->modelo,
            'servicio_id'=> request()->servicio_id
        ];
        $rango = TarifaHonorarioTurno::updateOrCreate([
            'especialidad_id' => $request->especialidad_id, 
            'especialidad_type'=> $tipoEspecialidad->modelo,
            'servicio_id'=> request()->servicio_id
        ], $rangoRequest);
        $valorRequest = [
            'tarifa_id'=> $rango->id,
            'diurno'=> request()->diurno,
            'extra'=> request()->extra,
            'festivo'=> request()->festivo
        ];
        $valor = TarifaHonorarioTurnoValor::create($valorRequest);
        if($valor){
            return redirect('/tarifaHonorarioTurno/')->with('message', "Se han actualizado los datos");
        }else{
            return redirect('/tarifaHonorarioTurno/')->with('error', "No se han actualizado los datos");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TarifaHonorarioTurno  $tarifaHonorarioTurno
     * @return \Illuminate\Http\Response
     */
    public function show(TarifaHonorarioTurno $tarifaHonorarioTurno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TarifaHonorarioTurno  $tarifaHonorarioTurno
     * @return \Illuminate\Http\Response
     */
    public function edit(TarifaHonorarioTurno $tarifaHonorarioTurno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TarifaHonorarioTurno  $tarifaHonorarioTurno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TarifaHonorarioTurno $tarifaHonorarioTurno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TarifaHonorarioTurno  $tarifaHonorarioTurno
     * @return \Illuminate\Http\Response
     */
    public function destroy(TarifaHonorarioTurno $tarifaHonorarioTurno)
    {
        //
    }
}
