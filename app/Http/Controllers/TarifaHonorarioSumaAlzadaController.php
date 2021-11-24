<?php

namespace App\Http\Controllers;

use App\TarifaHonorarioSumaAlzada;
use Dotenv\Result\Success;
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
        $existe = TarifaHonorarioSumaAlzada::find($request->id);
        $datos = [
            'nombre'=> request()->nombre,
            'valor'=> request()->valor,
            'anio'=> request()->anio
        ];

        $tarifa = TarifaHonorarioSumaAlzada::updateOrCreate(['id'=> $request->id], $datos);
        
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
    public function edit($id)
    {
        $tarifasHSA = TarifaHonorarioSumaAlzada::find($id);
        return view('tipoContrato.honorarioSumaAlzada.tarifa.create', compact('tarifasHSA'));
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
    public function destroy($id)
    {
        $tarifa = TarifaHonorarioSumaAlzada::find($id)->delete();
        if($tarifa){
            return redirect('/tipoTarifas')->with('message', "La tarifa se ha eliminado correctamente");
        }else{
            return redirect('/tipoTarifas')->with('error', "No se ha podido eliminar la tarifa");
        }
    }
}
