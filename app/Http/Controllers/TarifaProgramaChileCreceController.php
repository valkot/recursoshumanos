<?php

namespace App\Http\Controllers;

use App\TarifaProgramaChileCrece;
use Illuminate\Http\Request;

class TarifaProgramaChileCreceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tarifasPCC = TarifaProgramaChileCrece::paginate(10);
        return view('tipoContrato.programaChileCrece.tarifa.index', compact('tarifasPCC'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipoContrato.programaChileCrece.tarifa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existe = TarifaProgramaChileCrece::find($request->id);
        $datos = [
            'nombre'=> request()->nombre,
            'valor'=> request()->valor,
            'anio'=> request()->anio
        ];
        
        $tarifa = TarifaProgramaChileCrece::updateOrCreate(['id'=> $request->id], $datos);
        
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
     * @param  \App\TarifaProgramaChileCrece  $tarifaProgramaChileCrece
     * @return \Illuminate\Http\Response
     */
    public function show(TarifaProgramaChileCrece $tarifaProgramaChileCrece)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TarifaProgramaChileCrece  $tarifaProgramaChileCrece
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarifasPCC = TarifaProgramaChileCrece::find($id);
        return view('tipoContrato.programaChileCrece.tarifa.create', compact('tarifasPCC'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TarifaProgramaChileCrece  $tarifaProgramaChileCrece
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TarifaProgramaChileCrece $tarifaProgramaChileCrece)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TarifaProgramaChileCrece  $tarifaProgramaChileCrece
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarifa = TarifaProgramaChileCrece::find($id)->delete();
        if($tarifa){
            return redirect('/tipoTarifas')->with('message', "La tarifa se ha eliminado correctamente");
        }else{
            return redirect('/tipoTarifas')->with('error', "No se ha podido eliminar la tarifa");
        }
    }
}
