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
        $tarifasHT = TarifaHonorarioTurno::get();
        return view('tipoContrato.honorarioTurno.tarifa.index', compact('tarifasHT'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipoContrato.honorarioTurno.tarifa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existe = TarifaHonorarioTurno::find($request->id);
        $datos = [
            'nombre'=> request()->nombre,
            'valor'=> request()->valor,
            'anio'=> request()->anio
        ];
        
        $tarifa = TarifaHonorarioTurno::updateOrCreate(['id'=> $request->id], $datos);
        
        if($tarifa && $existe){
            return redirect('/tipoTarifas/')->with('message', "Se han actualizado los datos correctamente");
        }elseif($tarifa){
            return redirect('/tipoTarifas/')->with('message', "Se ha creado la tarifa correctamente");
        }else{
            return redirect('/tipoTarifas/')->with('error', "No se han podido guardar los datos");
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
    public function edit($id)
    {
        $tarifasHT = TarifaHonorarioTurno::find($id);
        return view('tipoContrato.honorarioTurno.tarifa.create', compact('tarifasHT'));
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
    public function destroy($id)
    {
        $tarifa = TarifaHonorarioTurno::find($id)->delete();

        if($tarifa){
            return redirect('/tipoTarifas')->with('message', "La tarifa se ha eliminado correctamente");
        }else{
            return redirect('/tipoTarifas')->with('error', "No se ha podido eliminar la tarifa");
        }
        
    }
}
