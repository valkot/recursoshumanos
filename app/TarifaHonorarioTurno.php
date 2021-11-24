<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TarifaHonorarioTurno extends Model
{

    use SoftDeletes;
    
    protected $table = 'tarifa_honorario_turno';
    
    public $guarded = [];
    public $timestamps = false;

    public function ano()
    {
		return $this->hasOne('App\TarifaHonorarioTurnoAno', 'tarifa_id');
    }

    // public function especialidad()
    // {
    //     return $this->morphTo();
    // }

    // public function valor()
    // {
		// return $this->hasOne('App\TarifaHonorarioTurnoValor', 'tarifa_id')->latest();
    // }
}
