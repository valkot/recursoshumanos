<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TarifaProgramaChileCrece extends Model
{

    use SoftDeletes;

    protected $table = 'tarifa_programa_chile_crece';
    
    public $guarded = [];
    public $timestamps = false;

    // public function servicio()
    // {
		// return $this->belongsTo('App\Servicio', 'servicio_id');
    // }

    // public function especialidad()
    // {
    //     return $this->morphTo();
    // }

    // public function valor()
    // {
		// return $this->hasOne('App\TarifaHonorarioTurnoValor', 'tarifa_id')->latest();
    // }
}
