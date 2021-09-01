<?php

namespace App\Http\Controllers;

use App\SolicitudContrato;
use App\SolicitudContratoEstado;
use App\Funcionario;
use App\Sexo;
use App\Comuna;
use App\Servicio;
use App\TipoEspecialidad;
use App\TituloProfesional;
use App\EspecialidadMedica;
use App\EspecialidadOdontologica;
use App\TipoContrato;
use App\ContratoHonorarioTurno;
use App\ContratoHonorarioSumaAlzada;
use App\ContratoProgramaChileCrece;
use App\ContratoProgramaQuinientosEspecialista;
use App\PrestacionFuncionario;
use Illuminate\Http\Request;
use Auth;
use DateTime;
use NumberFormatter;
use Response;
use Session;

class SolicitudContratoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        if (isset($request->rut)) {
            $rut = str_replace(".","",request()->rut);
            $id_funcionarios_rut = Funcionario::whereRaw("rut LIKE ?", ['%'.$rut.'%'])->pluck('id')->toArray();
        }else{
            $id_funcionarios_rut = null;
        }
        if (isset($request->nombre)) {
            $id_funcionarios_nombre = Funcionario::whereRaw("CONCAT(tx_nombre,' ',tx_apellido_paterno,' ',tx_apellido_materno) LIKE ?", ['%'.$request->nombre.'%'])->pluck('id')->toArray();
        }else{
            $id_funcionarios_nombre = null;
        }

        $solicitudesContratos = SolicitudContrato::with('funcionario', 'servicio', 'especialidad', 'tipoContrato', 'estado')
                ->when($request->has('rut') && !is_null($request->rut), function ($collection) use ($id_funcionarios_rut){
                    $collection->whereIn('funcionario_id', $id_funcionarios_rut);
                }) 
                ->when($request->has('nombre') && !is_null($request->nombre), function ($collection) use ($id_funcionarios_nombre){
                    $collection->whereIn('funcionario_id', $id_funcionarios_nombre);
                }) 
                ->when($request->has('servicio_id') && !is_null($request->servicio_id), function ($collection) use ($request){
                    $collection->where('servicio_id', $request->servicio_id);
                }) 
                ->when(Auth::user()->perfil_id == 4, function ($collection){
                    $collection->where('servicio_id', Auth::user()->servicio_id);
                }) 
                ->when($request->has('estados') && !is_null($request->estados), function ($collection) use ($request){
                    $collection->whereIn('estado_id', $request->estados);
                })
                ->orderBy('id', 'desc')
                ->paginate(10);
        $servicios = Servicio::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        $estados = SolicitudContratoEstado::get();
        return view('solicitudContrato.index', compact('solicitudesContratos', 'servicios', 'estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session_start();
        $_SESSION['lista_prestaciones'] = null;
        $sexos = Sexo::where("bo_estado", 1)->get();
        $comunas = Comuna::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        $servicios = Servicio::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        $titulosProfesionales = TituloProfesional::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        $especialidadesMedicas = EspecialidadMedica::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        $especialidadesOdontologicas = EspecialidadOdontologica::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        $tiposContratos = TipoContrato::orderBy('nombre')->get();
        $prestaciones = PrestacionFuncionario::get();
        return view('solicitudContrato.create', compact('sexos', 'comunas', 'servicios', 'titulosProfesionales', 'especialidadesMedicas', 'especialidadesOdontologicas', 'tiposContratos', 'prestaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $funcionarioRequest = [
            'rut'=> request()->rut,
            'tx_nombre'=> request()->tx_nombre,
            'tx_apellido_paterno'=> request()->tx_apellido_paterno,
            'tx_apellido_materno'=> request()->tx_apellido_materno,
            'id_sexo'=> request()->id_sexo,
            'tx_direccion'=> request()->tx_direccion,
            'id_comuna'=> request()->id_comuna
        ];
        $funcionario = Funcionario::updateOrCreate(['id' => $request->funcionario_id], $funcionarioRequest);

        $tipoEspecialidad = TipoEspecialidad::find(request()->id_tipo_especialidad);
        $tipoContrato = TipoContrato::find(request()->tipo_contrato_id);
        switch ($tipoContrato->id) {
            case 1:
                $ContratoRequest = [
                    'numero_hora_diurno_ht'=> request()->numero_hora_diurno_ht,
                    'valor_hora_diurno_ht'=> request()->valor_hora_diurno_ht,
                    'numero_hora_extra_ht'=> request()->numero_hora_extra_ht,
                    'valor_hora_extra_ht'=> request()->valor_hora_extra_ht,
                    'numero_hora_festivo_ht'=> request()->numero_hora_festivo_ht,
                    'valor_hora_festivo_ht'=> request()->valor_hora_festivo_ht,
                    'dias_ausentados_ht'=> request()->dias_ausentados_ht
                ];
                $subContrato = ContratoHonorarioTurno::updateOrCreate(['id' => $request->id_contrato], $ContratoRequest);
                break;

            case 2:
                $ContratoRequest = [
                    'numero_hora_hsa'=> request()->numero_hora_hsa,
                    'valor_mensual_hsa'=> request()->valor_mensual_hsa,
                    'dias_ausentados_hsa'=> request()->dias_ausentados_hsa
                ];
                $subContrato = ContratoHonorarioSumaAlzada::updateOrCreate(['id' => $request->id_contrato], $ContratoRequest);
                break;

            case 3:
                $ContratoRequest = [
                    'numero_hora_hsa'=> request()->numero_hora_hsa,
                    'valor_mensual_hsa'=> request()->valor_mensual_hsa,
                    'dias_ausentados_hsa'=> request()->dias_ausentados_hsa
                ];
                $subContrato = ContratoProgramaChileCrece::updateOrCreate(['id' => $request->id_contrato], $ContratoRequest);
                break;
            
            case 4:
                $ContratoRequest = [
                    'numero_hora_pqe'=> request()->numero_hora_pqe,
                    'meses_periodo_pqe'=> request()->meses_periodo_pqe,
                    'funciones_clinicas_pqe'=> request()->funciones_clinicas_pqe,
                    'id_prestacion_pqe'=> request()->id_prestacion_pqe,
                    'valor_prestacion_pqe'=> request()->valor_prestacion_pqe,
                    'max_prestaciones_mes_pqe'=> request()->max_prestaciones_mes_pqe
                ];
                $subContrato = ContratoProgramaQuinientosEspecialista::updateOrCreate(['id' => $request->id_contrato], $ContratoRequest);
                break;

            default:
                # code...
                break;
        }

        $solicitudContratoRequest = [
            'funcionario_id'=> $funcionario->id,
            'servicio_id'=> request()->servicio_id,
            'fc_inicio'=> request()->fc_inicio,
            'fc_termino'=> request()->fc_termino,
            'especialidad_type'=> $tipoEspecialidad->modelo,
            'especialidad_id'=> request()->especialidad_id,
            'contrato_type'=> $tipoContrato->modelo,
            'contrato_id'=> $subContrato->id
        ];
        // dd($solicitudContratoRequest);

        $solicitudContrato = SolicitudContrato::updateOrCreate(['id' => $request->id_solicitud], $solicitudContratoRequest);

        if($funcionario && $solicitudContratoRequest){
            return redirect('/solicitudContrato')->with('message', "La solicitud se ha ingresado correctamente");
        }else{
            return redirect()->route('home')->with('error', "No se ha podido guardar la solicitud");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SolicitudContrato  $solicitudContrato
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitudContrato = SolicitudContrato::with('funcionario', 'usuario', 'especialidad', 'contrato', 'tipoContrato')->find($id);
        $data2 = array(
            'user' => 'hsjd',
            'key' => 'desa',
            "id_solicitud" => $id
        );
        $payload = json_encode($data2);
        $ch = curl_init('http://sanjuandesa.desa72.zecovery.com/api/ws_consulta_hsjd.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload))
        );
        $result = curl_exec($ch);
        curl_close($ch);
        $response = Response::json(json_decode($result),200);
        // dd($response);

        $pdf = \PDF::loadView('solicitudContrato.show', compact('solicitudContrato'));
     
        return $pdf->stream('archivo.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SolicitudContrato  $solicitudContrato
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitudContrato = SolicitudContrato::with('funcionario', 'especialidad', 'tipoEspecialidad', 'contrato', 'tipoContrato')->find($id);
        $sexos = Sexo::where("bo_estado", 1)->get();
        $comunas = Comuna::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        $servicios = Servicio::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        $titulosProfesionales = TituloProfesional::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        $especialidadesMedicas = EspecialidadMedica::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        $especialidadesOdontologicas = EspecialidadOdontologica::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        $tiposContratos = TipoContrato::orderBy('nombre')->get();
        $prestaciones = PrestacionFuncionario::get();
        return view('solicitudContrato.create', compact('solicitudContrato', 'sexos', 'comunas', 'servicios', 'titulosProfesionales', 'especialidadesMedicas', 'especialidadesOdontologicas', 'tiposContratos', 'prestaciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SolicitudContrato  $solicitudContrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SolicitudContrato $solicitudContrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SolicitudContrato  $solicitudContrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(SolicitudContrato $solicitudContrato)
    {
        //
    }

    public function solicitudContratoPdf($id)
    {
        $data2 = array(
            'user' => 'hsjd',
            'key' => 'desa',
            "id_solicitud" => $id
        );
        $payload = json_encode($data2);
        $ch = curl_init('http://sanjuandesa.desa72.zecovery.com/api/ws_obtiene_documentos_hsjd.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload))
        );
        $result = curl_exec($ch);
        curl_close($ch);

        $recetas = json_decode($result);
        //$response = ($recetas->codigo == '001') ? Response::json(['data'=>array_reverse($recetas->mensaje)],200) : Response::json(['data'=>[]],200);
        // $obj = json_decode($recetas->data);
        //return $response;
        $inf=$recetas->convenio_doc;
        $data = base64_decode($inf);
        header('Content-Type: application/pdf');
        echo $data;
    }

    public function solicitudContratoEnviar($id)
    {
        $solicitudContrato = SolicitudContrato::find($id);
        $solicitudContrato->estado_id = 2;
        $solicitudContrato->gestor_id = Auth::id();
        $solicitudContrato->save();
        return redirect()->back()->with('message', 'La solicitud ha sido confirmada');
    }

    public function solicitudContratoAnular($id)
    {
        $solicitudContrato = SolicitudContrato::find($id);
        $solicitudContrato->estado_id = 4;
        $solicitudContrato->save();
        return redirect()->back()->with('error', 'La solicitud ha sido anulada');
    }

    public function api($id)
    {
        $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);
        $solicitudContrato = SolicitudContrato::with('funcionario', 'especialidad', 'contrato')->find($id);
        setlocale(LC_ALL, 'es_ES');
        $monthNum  = date("m", strtotime($solicitudContrato->fc_inicio));
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthNameInicio = strftime('%B', $dateObj->getTimestamp());
        $monthNum  = date("m", strtotime($solicitudContrato->fc_termino));
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthNameTermino = strftime('%B', $dateObj->getTimestamp());

        $tipoContrato = TipoContrato::where('modelo', $solicitudContrato->contrato_type)->first();

        switch ($tipoContrato->id) {
            case 1:
                $contrato = array(
                    "id_solicitud" => $solicitudContrato->id,
                    "dia_inicio_nro" => date("d", strtotime($solicitudContrato->fc_inicio)),
                    "mes_inicio_palabras" => strtoupper($monthNameInicio),
                    "nombre_completo" => strtoupper($solicitudContrato->funcionario->nombre),
                    "rutcompleto" => $solicitudContrato->funcionario->rut_completo,
                    "titulo_especialidad" => $solicitudContrato->especialidad->tx_descripcion,
                    "m_20_direccion_particular" => $solicitudContrato->funcionario->tx_direccion,
                    "m_21_direccion_particular_comuna" => $solicitudContrato->funcionario->comuna->tx_descripcion,
                    "valor_hora_diurna_extra" => 0,
                    "valor_hora_festiva_y_nocturna" => $solicitudContrato->contrato->valor_hora,
                    "dia_termino" => date("d", strtotime($solicitudContrato->fc_termino)),
                    "mes_termino" => strtoupper($monthNameTermino),
                    "monto_mensual_variable" => ($solicitudContrato->contrato->numero_hora_ht*$solicitudContrato->contrato->valor_hora_ht),
                    "letra_monto_variable" => $formatterES->format($solicitudContrato->contrato->numero_hora_ht*$solicitudContrato->contrato->valor_hora_ht),
                    "unidad" => $solicitudContrato->servicio->tx_descripcion,
                    "n_interno_resolucion_informal" => 5001,
                    "genero" => $solicitudContrato->funcionario->sexo->tx_descripcion_2,
                );
                break;

            case 2:
                $contrato = array(
                    "id_solicitud" => $solicitudContrato->id,
                    "dia_inicio_nro" => date("d", strtotime($solicitudContrato->fc_inicio)),
                    "mes_inicio_palabras" => strtoupper($monthNameInicio),
                    "nombre_completo" => strtoupper($solicitudContrato->funcionario->nombre),
                    "rutcompleto" => $solicitudContrato->funcionario->rut_completo,
                    "titulo_especialidad" => $solicitudContrato->especialidad->tx_descripcion,
                    "m_20_direccion_particular" => $solicitudContrato->funcionario->tx_direccion,
                    "m_21_direccion_particular_comuna" => $solicitudContrato->funcionario->comuna->tx_descripcion,
                    "valor_hora_diurna_extra" => 0,
                    "valor_hora_festiva_y_nocturna" => $solicitudContrato->contrato->valor_hora,
                    "dia_termino" => date("d", strtotime($solicitudContrato->fc_termino)),
                    "mes_termino" => strtoupper($monthNameTermino),
                    "monto_mensual_variable" => ($solicitudContrato->contrato->numero_hora_ht*$solicitudContrato->contrato->valor_hora_ht),
                    "letra_monto_variable" => $formatterES->format($solicitudContrato->contrato->numero_hora_ht*$solicitudContrato->contrato->valor_hora_ht),
                    "unidad" => $solicitudContrato->servicio->tx_descripcion,
                    "n_interno_resolucion_informal" => 5001,
                    "genero" => $solicitudContrato->funcionario->sexo->tx_descripcion_2,
                    "funcion" => 5001,
                    "total_max_hh_diurnas_mes" => 5001,
                    "total_max_hh_diurnas_periodo" => 5001,
                    "valor_por_hh_diurna" => 5001,
                    "valor_max_pago_mensual" => 5001,
                    "total_suma_alzada" => 5001,
                );
                break;
            
            default:
                # code...
                break;
        }
        

        $solicitud = array(
            "user" => "hsjd",
            "key" => "desa",
            "tipo_solicitud" => $tipoContrato->id,
            "solicitud" => $contrato,
        );

        $payload = json_encode($solicitud);
        $ch = curl_init('http://sanjuandesa.desa72.zecovery.com/api/ws_solicitud_hsjd.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload))
        );
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;


        // $json = json_encode($solicitud);
        // dd($json);
    }

    public function solicitudContratoAgregarPrestacion(Request $request){
        session_start();
        // dd($_SESSION['lista_prestaciones']);
        // dd($request->all());
        if(!isset($_SESSION['lista_prestaciones'])){
            $lista_prestaciones = array();
            $_SESSION['lista_prestaciones'] = $lista_prestaciones;
        }
        $lista_prestaciones = $_SESSION['lista_prestaciones'];

        if(isset($request->id_prestacion_ptmh) && isset($request->max_prestaciones_mes_ptmh)){
            $prestacion = PrestacionFuncionario::find($request->id_prestacion_ptmh)->toArray();
            $prestacion['max'] = $request->max_prestaciones_mes_ptmh;
            $prestacion['total'] = $prestacion['valor'] * $request->max_prestaciones_mes_ptmh;
            array_push($lista_prestaciones, $prestacion);
            $_SESSION['lista_prestaciones'] = $lista_prestaciones;
        }
        // dd($prestacion);
        // $lista_pacientes['error'] = 0;
        // $lista_pacientes = $_SESSION['lista_pacientes'];

        return $lista_prestaciones;
    }
}
