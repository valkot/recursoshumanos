<?php

namespace App\Http\Controllers;

use App\TarifaHonorarioSumaAlzada;
use Illuminate\Http\Request;

class TarifaHonorarioSumaAlzadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tarifasHSA = TarifaHonorarioSumaAlzada::paginate(10);
        return view('tipoContrato.honorarioSumaAlzada.tarifa.index', compact('tarifasHSA'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipoContrato.honorarioSumaAlzada.tarifa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valor = TarifaHonorarioSumaAlzada::create($request->except('_token'));
        if($valor){
            return redirect('/tarifaHonorarioSumaAlzada/')->with('message', "Se han actualizado los datos");
        }else{
            return redirect('/tarifaHonorarioSumaAlzada/')->with('error', "No se han actualizado los datos");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TarifaHonorarioSumaAlzada  $tarifaHonorarioSumaAlzada
     * @return \Illuminate\Http\Response
     */
    public function show(TarifaHonorarioSumaAlzada $tarifaHonorarioSumaAlzada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TarifaHonorarioSumaAlzada  $tarifaHonorarioSumaAlzada
     * @return \Illuminate\Http\Response
     */
    public function edit(TarifaHonorarioSumaAlzada $tarifaHonorarioSumaAlzada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TarifaHonorarioSumaAlzada  $tarifaHonorarioSumaAlzada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TarifaHonorarioSumaAlzada $tarifaHonorarioSumaAlzada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TarifaHonorarioSumaAlzada  $tarifaHonorarioSumaAlzada
     * @return \Illuminate\Http\Response
     */
    public function destroy(TarifaHonorarioSumaAlzada $tarifaHonorarioSumaAlzada)
    {
        //
    }
}
