<?php

namespace App\Http\Controllers;

use App\TipoContrato;
use Illuminate\Http\Request;

class TipoContratoController extends Controller
{
    public function index(Request $request)
    {
        $tiposContratos = TipoContrato::withTrashed()
                ->when($request->has('nombre') && !is_null($request->nombre), function ($collection) use ($request){
                    $collection->whereRaw("nombre LIKE ?", ['%'.$request->nombre.'%']);
                })
                ->paginate(10);
        return view('tipoContrato.index', compact('tiposContratos'));
    }

    public function create()
    {
        return view('tipoContrato.create');
    }

    public function store(Request $request)
    {
        $tipoContrato = TipoContrato::updateOrCreate(['id' => $request->id], $request->except('_token'));
        if($tipoContrato){
            return redirect('/tipoContrato')->with('message', "El tipo de contrato se ha creado correctamente");
        }else{
            return redirect('/tipoContrato')->with('error', "No se ha podido crear el tipo de contrato");
        }
    }

    public function show(TipoContrato $tipoContrato)
    {
        //
    }

    public function edit(TipoContrato $tipoContrato)
    {
        return view('tipoContrato.create', compact('tipoContrato'));
    }

    public function update(Request $request, TipoContrato $tipoContrato)
    {
        //
    }

    public function destroy(TipoContrato $tipoContrato)
    {
        if($tipoContrato->delete()){
            return redirect('/tipoContrato')->with('error', $tipoContrato->nombre." a sido desactivado correctamente");
        }else{
            return redirect('/tipoContrato')->with('error', "El contrao no a sido desactivado, intente nuevamente");
        }
    }

    public function activar($id)
    {
        $tipoContrato = TipoContrato::onlyTrashed()->find($id)->restore();
        return redirect('/tipoContrato/')->with('message', "Se ha activado el contrato correctamente");
    }
}