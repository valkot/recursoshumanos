<?php

namespace App\Http\Controllers;

use App\Rango;
use App\RangoValor;
use App\Servicio;
use App\TipoEspecialidad;
use App\TituloProfesional;
use App\EspecialidadMedica;
use App\EspecialidadOdontologica;
use Illuminate\Http\Request;

class RangoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rangos = Rango::with('servicio', 'especialidad', 'valor')->paginate(10);
        // dd($rangos);
        return view('rango.index', compact('rangos'));
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
        return view('rango.create', compact('servicios', 'titulosProfesionales', 'especialidadesMedicas', 'especialidadesOdontologicas'));
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
        $rango = Rango::updateOrCreate([
            'especialidad_id' => $request->especialidad_id, 
            'especialidad_type'=> $tipoEspecialidad->modelo,
            'servicio_id'=> request()->servicio_id
        ], $rangoRequest);
        $valorRequest = [
            'rango_id'=> $rango->id,
            'diurno'=> request()->diurno,
            'extra'=> request()->extra,
            'festivo'=> request()->festivo
        ];
        $valor = RangoValor::create($valorRequest);
        if($valor){
            return redirect('/rango/')->with('message', "Se han actualizado los datos");
        }else{
            return redirect('/rango/')->with('error', "No se han actualizado los datos");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rango  $rango
     * @return \Illuminate\Http\Response
     */
    public function show(Rango $rango)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rango  $rango
     * @return \Illuminate\Http\Response
     */
    public function edit(Rango $rango)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rango  $rango
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rango $rango)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rango  $rango
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rango $rango)
    {
        //
    }
}
