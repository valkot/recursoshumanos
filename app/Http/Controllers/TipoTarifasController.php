<?php

namespace App\Http\Controllers;

use App\TarifaHonorarioSumaAlzada;
use App\PrestacionFuncionario;
use App\TarifaHonorarioTurno;
use App\TarifaProgramaChileCrece;
use Illuminate\Http\Request;

class TipoTarifasController extends Controller
{

    public function index(Request $request)
    {   
        $tarifasHSA = TarifaHonorarioSumaAlzada::get();
        $tarifasHT = TarifaHonorarioTurno::get();
        $tarifasPCC = TarifaProgramaChileCrece::get();
        $prestaciones = PrestacionFuncionario::get();
        return view('tipoTarifas.index', compact('tarifasHSA','tarifasHT','tarifasPCC','prestaciones'));
    }

    public function fetchAnioTarifas($anio)
    {
        $tarifasHSA = TarifaHonorarioSumaAlzada::where("anio", $anio)->get();        
        foreach ($tarifasHSA as $tarifa){
            $b = view("tipoContrato.honorarioSumaAlzada.tarifa.botones_tabla", ["id" => $tarifa->id])->render();
            $tarifa['botones']=$b;
        }    

        $tarifasHT = TarifaHonorarioTurno::where("anio", $anio)->get();
        foreach ($tarifasHT as $tarifa){
            $b = view("tipoContrato.honorarioTurno.tarifa.botones_tabla", ["id" => $tarifa->id])->render();
            $tarifa['botones']=$b;
        }

        $tarifasPCC = TarifaProgramaChileCrece::where("anio", $anio)->get();
        foreach ($tarifasPCC as $tarifa){
            $b = view("tipoContrato.programaChileCrece.tarifa.botones_tabla", ["id" => $tarifa->id])->render();
            $tarifa['botones']=$b;
        }

        $prestaciones = PrestacionFuncionario::where("anio", $anio)->get();
        foreach ($prestaciones as $prestacion){
            $b = view("prestacion.botones_tabla", ["id" => $prestacion->id])->render();
            $prestacion['botones']=$b;
        }

        return response()->json([
            'tarifasHSA' => $tarifasHSA,
            'tarifasHT' => $tarifasHT,
            'tarifasPCC' => $tarifasPCC,
            'prestaciones' => $prestaciones
        ]);

    }

}