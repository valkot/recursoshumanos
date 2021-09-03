<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TarifaHonorarioTurno extends Model
{
    protected $table = 'tarifa_honorario_turno';
    
    public $guarded = [];
    public $timestamps = false;

    public function servicio()
    {
		return $this->belongsTo('App\Servicio', 'servicio_id');
    }

    public function especialidad()
    {
        return $this->morphTo();
    }

    public function valor()
    {
		return $this->hasOne('App\TarifaHonorarioTurnoValor', 'tarifa_id')->latest();
    }
}
