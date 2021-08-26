<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContratoProgramaQuinientosEspecialista extends Model
{
    protected $table = 'contrato_quinientos_especialista';

    public $guarded = [];
    public $timestamps = false;

    protected $appends = ['max_prestaciones_periodo_pqe', 'total_pagar_pqe', 'total_pagar_mes_pqe', 'total_pagar_periodo_pqe'];

    public function getMaxPrestacionesPeriodoPqeAttribute()
    {
        return $this->meses_periodo_pqe*$this->max_prestaciones_mes_pqe;
    }

    public function getTotalPagarPqeAttribute()
    {
        return $this->valor_prestacion_pqe*$this->max_prestaciones_mes_pqe;
    }

    public function getTotalPagarMesPqeAttribute()
    {
        return ($this->valor_prestacion_pqe*$this->max_prestaciones_mes_pqe)+$this->funciones_clinicas_pqe;
    }

    public function getTotalPagarPeriodoPqeAttribute()
    {
        return (($this->valor_prestacion_pqe*$this->max_prestaciones_mes_pqe)+$this->funciones_clinicas_pqe)*$this->meses_periodo_pqe;
    }

    public function solicitudContrato()
    {
        return $this->morphOne(SolicitudContrato::class, 'contrato');
    }

    public function prestacion()
    {
		return $this->belongsTo('App\PrestacionFuncionario', 'id_prestacion_pqe');
    }
}