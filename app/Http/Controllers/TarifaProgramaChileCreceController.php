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
        $tarifas = TarifaProgramaChileCrece::paginate(10);
        return view('tipoContrato.programaChileCrece.tarifa.index', compact('tarifas'));
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
        $valor = TarifaProgramaChileCrece::create($request->except('_token'));
        if($valor){
            return redirect('/tarifaProgramaChileCrece/')->with('message', "Se han actualizado los datos");
        }else{
            return redirect('/tarifaProgramaChileCrece/')->with('error', "No se han actualizado los datos");
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
    public function edit(TarifaProgramaChileCrece $tarifaProgramaChileCrece)
    {
        //
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
    public function destroy(TarifaProgramaChileCrece $tarifaProgramaChileCrece)
    {
        //
    }
}
