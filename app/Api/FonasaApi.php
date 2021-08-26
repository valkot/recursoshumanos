<?php

namespace App\Api;

use nusoap_client;
use App\Providers\PatientProvider;
use Carbon\Carbon;

class FonasaApi implements PatientProvider
{

    const API_URL = "http://ws.fonasa.cl:8080/Certificados/Previsional?wsdl";

    public function fetch($rut, $dv)
    {
        return $this->callFonasaApi($rut, $dv);
    }

    public function fetchNormalized($rut, $dv)
    {
        return $this->normalizePacienteFonasa($this->callFonasaApi($rut, $dv));
    }

    protected function getClasificacionFonasa($tramo)
    {
        $clasificacion = 0;

        switch ($tramo) {
            case "A":
                $clasificacion = 1;
                break;
            case "B":
                $clasificacion = 2;
                break;
            case "C":
                $clasificacion = 3;
                break;
            case "D":
                $clasificacion = 4;
                break;
            default:
                break;
        }

        return $clasificacion;
    }

    protected static function getSexoFonasa($genero)
    {
        $sexo = 0;

        switch ($genero) {
            case 'M':
                $sexo = 1;
                break;
            case 'F':
                $sexo = 2;
                break;
            default:
                $sexo = 4;
                break;
        }

        return $sexo;
    }

    protected function callFonasaApi($rut, $dv)
    {
        $objSOAP = new nusoap_client(self::API_URL, "wsdl", "", "", "", "");
        $objSOAP->soap_defencoding = 'UTF-8';
        $objSOAP->decode_utf8 = FALSE;
        $clientError = $objSOAP->getError();

        if ( $clientError ) {
            return $clientError;
        }
            
        $parametros = [
            'query' => [
                'queryTO' => ['tipoEmisor' => '0', 'tipoUsuario' => '0'],
                'entidad' => '61608205',
                'claveEntidad' => '6160',
                'rutBeneficiario' => $rut,
                'dgvBeneficiario' => $dv,
                'canal' => '0'
            ]
        ];
            
        try{
            $result = $objSOAP->call('getCertificadoPrevisional', ['parameters' => $parametros], '', '', false, true);
            if ($objSOAP->fault) {
                return $result;
            } else {
                $error = $objSOAP->getError();
                if ($error) {
                    return $error;
                } else {
                    return $result;
                }
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
        
    }


    protected function normalizePacienteFonasa($fonasaResponse)
    {
        if(!is_array($fonasaResponse)){
            $data = [
                "api_fonasa" => false
            ];
            return $data;
        }
        
        $clasificacion = 0;

        $data = [
            "nr_run" => null,
            "prevision" => null,
            "id_prevision" => null,
            "tramo" => null,
            "clasificacion" => null,
            "direccion" => null,
            "nombre_completo" => null,
            "comuna" => null,
            "fecha_nacimiento" => null,
            "encontrado" => false,
            "api_fonasa" => true
        ];

        if ( isset($fonasaResponse["getCertificadoPrevisionalResult"]) ) {
            $cert = $fonasaResponse["getCertificadoPrevisionalResult"];
            if ($cert["replyTO"]["estado"] != -4 && $cert["replyTO"]["errorM"] == ""){
                
                $beneficiario = $cert["beneficiarioTO"];
                $clasificacion = $this->getClasificacionFonasa($cert["afiliadoTO"]["tramo"]);
                $sexo = $this->getSexoFonasa($beneficiario["genero"]);
                
                $fecha_nacimiento = Carbon::parse($beneficiario['fechaNacimiento'],'America/Santiago');
                $hoy = Carbon::now();
                $edad = $hoy->diff($fecha_nacimiento)->y;
                $data = [
                    "nr_run" => $beneficiario["rutbenef"],
                    "tx_digito_verificador" => $beneficiario["dgvbenef"],
                    "tx_apellido_paterno" => $beneficiario['apell1'],
                    "tx_apellido_materno" => $beneficiario['apell2'],
                    "tx_nombre" => $beneficiario['nombres'],
                    "id_sexo" => $sexo,
                    "coddesc" => $cert["coddesc"],
                    "cdgComuna" => $beneficiario["cdgComuna"],
                    "prevision" => $cert['cdgIsapre'] != " " ? "ISAPRE" : "FONASA",
                    "id_prevision" => $cert['cdgIsapre'] != " " ? 2 : 1,
                    "tramo" => $cert["afiliadoTO"]["tramo"],
                    "id_clasificacion_fonasa" => $clasificacion === 0 ? null : $clasificacion,
                    "tx_direccion" => $beneficiario['direccion'],
                    "nombre_completo" => "{$beneficiario['nombres']} {$beneficiario['apell1']} {$beneficiario['apell2']}",
                    "comuna" => "{$beneficiario['desComuna']}",
                    "fecha_nacimiento" => $fecha_nacimiento->format('d/m/Y'),
                    "edad" => $edad,
                    "encontrado" => true,
                    "rut" => "{$beneficiario["rutbenef"]}-{$beneficiario["dgvbenef"]}",
                    "nr_ficha" => null,
                    "api_fonasa" => true,
                ];
            }
        } 
        
        return $data;
    }
    
}