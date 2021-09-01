<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class SolicitudContrato extends Model
{
    protected $table = 'solicitud_contrato';

    use SoftDeletes;
    public $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function($solicitudContrato)
        {
            if(isset(Auth::user()->servicio_id)){
                $solicitudContrato->servicio_id = Auth::user()->servicio_id;
            }
            $solicitudContrato->usuario_id = Auth::id();
        });
          
        static::created(function($solicitudContrato)
        {
            if(isset(Auth::user()->servicio_id)){
                $solicitudContrato->servicio_id = Auth::user()->servicio_id;
            }
            $solicitudContrato->usuario_id = Auth::id();
        });
    }

    protected $appends = ['fecha_inicio', 'fecha_termino'];

    public function getFechaInicioAttribute()
    {
        $fecha_inicio = date('d/m/Y', strtotime(str_replace("/", ".", $this->fc_inicio)));
        return "{$fecha_inicio}";
    }

    public function getFechaTerminoAttribute()
    {
        $fecha_termino = date('d/m/Y', strtotime(str_replace("/", ".", $this->fc_termino)));
        return "{$fecha_termino}";
    }

    public function funcionario()
    {
		return $this->belongsTo('App\Funcionario', 'funcionario_id');
    }

	public function usuario()
    {
		return $this->belongsTo('App\User', 'usuario_id');
    }

	public function gestor()
    {
		return $this->belongsTo('App\User', 'gestor_id');
    }

    public function servicio()
    {
		return $this->belongsTo('App\Servicio', 'servicio_id');
    }

    public function tipoContrato()
    {
		return $this->belongsTo('App\TipoContrato', 'contrato_type', 'modelo');
    }

    public function contrato()
    {
        return $this->morphTo();
    }

	public function tipoEspecialidad()
    {
		return $this->belongsTo('App\TipoEspecialidad', 'especialidad_type', 'modelo');
    }

    public function especialidad()
    {
        return $this->morphTo();
    }

    public function estado()
    {
		return $this->belongsTo('App\SolicitudContratoEstado', 'estado_id');
    }
}
