<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContratoProgramaChileCrece extends Model
{
    protected $table = 'contrato_programa_chile_crece';

    public $guarded = [];
    public $timestamps = false;

    protected $appends = ['total_pagar_hsa'];

    public function getTotalPagarHsaAttribute()
    {
        return round(($this->valor_mensual_hsa*(30-$this->dias_ausentados_hsa)/30));
    }

    public function solicitudContrato()
    {
        return $this->morphOne(SolicitudContrato::class, 'contrato');
    }
}