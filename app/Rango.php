<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rango extends Model
{
    protected $table = 'rango';
    
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
		return $this->hasOne('App\RangoValor', 'rango_id')->latest();
    }
}
