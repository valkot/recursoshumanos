<?php

namespace App\Http\Controllers;

use App\TipoContrato;
use Illuminate\Http\Request;

class TipoContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposContratos = TipoContrato::paginate(10);
        return view('tipoContrato.index', compact('tiposContratos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipoContrato.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoContrato = TipoContrato::updateOrCreate(['id' => $request->id], $request->except('_token'));
        if($tipoContrato){
            return redirect('/tipoContrato')->with('message', "El tipo de contrato se ha creado correctamente");
        }else{
            return redirect('/tipoContrato')->with('error', "No se ha podido crear el tipo de contrato");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoContrato  $tipoContrato
     * @return \Illuminate\Http\Response
     */
    public function show(TipoContrato $tipoContrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoContrato  $tipoContrato
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoContrato $tipoContrato)
    {
        return view('tipoContrato.create', compact('tipoContrato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoContrato  $tipoContrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoContrato $tipoContrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoContrato  $tipoContrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoContrato $tipoContrato)
    {
        //
    }
}
