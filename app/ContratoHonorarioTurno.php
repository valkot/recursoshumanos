<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContratoHonorarioTurno extends Model
{
    protected $table = 'contrato_honorario_turno';

    public $guarded = [];
    public $timestamps = false;

    protected $appends = ['valor_mensual_diurno_ht', 'valor_mensual_extra_ht', 'valor_mensual_festivo_ht', 'valor_total_ht', 'total_pagar_ht'];

    public function getValorMensualDiurnoHtAttribute()
    {
        return $this->numero_hora_diurno_ht*$this->valor_hora_diurno_ht;
    }

    public function getValorMensualExtraHtAttribute()
    {
        return $this->numero_hora_extra_ht*$this->valor_hora_extra_ht;
    }

    public function getValorMensualFestivoHtAttribute()
    {
        return $this->numero_hora_festivo_ht*$this->valor_hora_festivo_ht;
    }

    public function getValorTotalHtAttribute()
    {
        return ($this->numero_hora_diurno_ht*$this->valor_hora_diurno_ht)+($this->numero_hora_extra_ht*$this->valor_hora_extra_ht)+($this->numero_hora_festivo_ht*$this->valor_hora_festivo_ht);
    }

    public function getTotalPagarHtAttribute()
    {
        return round((($this->numero_hora_diurno_ht*$this->valor_hora_diurno_ht)*(30-$this->dias_ausentados_ht)/30)+($this->numero_hora_extra_ht*$this->valor_hora_extra_ht)+($this->numero_hora_festivo_ht*$this->valor_hora_festivo_ht));
    }

    public function solicitudContrato()
    {
        return $this->morphOne(SolicitudContrato::class, 'contrato');
    }
}