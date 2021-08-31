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
        $prestacion = PrestacionFuncionario::updateOrCreate(['id' => $request->id], $request->except('_token'));
        if($prestacion){
            return redirect('/prestacion')->with('message', "La prestacion se ha creado correctamente");
        }else{
            return redirect('/prestacion')->with('error', "No se ha podido crear la prestacion");
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

        dd($prestacion);
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
    public function destroy(PrestacionFuncionario $prestacionFuncionario)
    {
        //
    }
}
