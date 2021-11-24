<?php

namespace App\Http\Controllers;

use App\PrestacionFuncionario;
use Illuminate\Http\Request;

class PrestacionFuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prestaciones = PrestacionFuncionario::
            when($request->has('tx_nombre') && !is_null($request->tx_nombre), function ($collection) use ($request) {
                return $collection->whereRaw("tx_nombre LIKE ?", ['%'.$request->tx_nombre.'%']);
            })
            ->paginate(10);
        return view('prestacion.index', compact('prestaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prestacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $existe = PrestacionFuncionario::find($request->id);
        $datos = [
            'tx_nombre'=> request()->tx_nombre,
            'valor'=> request()->valor,
            'anio'=> request()->anio
        ];

        $prestacion = PrestacionFuncionario::updateOrCreate(['id'=> $request->id], $datos);
        
        if($prestacion && $existe){
            return redirect('/tipoTarifas/')->with('message', "Se han actualizado los datos correctamente");
        }elseif($prestacion){
            return redirect('/tipoTarifas/')->with('message', "Se ha creado la prestacion correctamente");
        }else{
            return redirect('/tipoTarifas/')->with('error', "No se han actualizado los datos");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PrestacionFuncionario  $prestacionFuncionario
     * @return \Illuminate\Http\Response
     */
    public function show(PrestacionFuncionario $prestacionFuncionario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PrestacionFuncionario  $prestacionFuncionario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prestacion = PrestacionFuncionario::find($id);
        return view('prestacion.create', compact('prestacion'));

        //dd($prestacion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PrestacionFuncionario  $prestacionFuncionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrestacionFuncionario $prestacionFuncionario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PrestacionFuncionario  $prestacionFuncionario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prestacion = PrestacionFuncionario::find($id)->delete();
        if($prestacion){
            return redirect('/tipoTarifas')->with('message', "La prestacion se ha eliminado correctamente");
        }else{
            return redirect('/tipoTarifas')->with('error', "No se ha podido eliminar la prestacion");
        }
    }
}
