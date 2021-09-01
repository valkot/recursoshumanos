<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContratoProgramaTresTresMilHorasPrestacion extends Model
{
    protected $table = 'contrato_programa_tres_tres_mil_horas_prestacion';

    public $guarded = [];
    public $timestamps = false;

    protected $appends = ['total'];

    public function getTotalAttribute()
    {
        return ($this->valor*$this->maximo_mes);
    }

    // public function solicitudContrato()
    // {
    //     return $this->morphOne(SolicitudContrato::class, 'contrato');
    // }

    public function prestacion()
    {
		return $this->belongsTo('App\PrestacionFuncionario', 'prestacion_id');
    }
}