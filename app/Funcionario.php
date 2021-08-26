<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Funcionario extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'gen_funcionario_nuevo';

    use SoftDeletes;
    public $guarded = [];

    protected $appends = ['nombre', 'rut_completo'];

    public function getNombreAttribute()
    {
        return ucwords(mb_strtolower("{$this->tx_nombre} {$this->tx_apellido_paterno} {$this->tx_apellido_materno}"));
    }

    public function getRutCompletoAttribute()
    {
        $rut = explode("-", $this->rut);
        $rut[0] = $this->formatCLP(intval($rut[0]));
        return "{$rut[0]}-{$rut[1]}";
    }

    public function sexo()
    {
		return $this->belongsTo('App\Sexo', 'id_sexo')->withDefault(["tx_descripcion" => "Sin Información"]);
    }

    public function comuna()
    {
		return $this->belongsTo('App\Comuna', 'id_comuna', 'cd_comuna')->withDefault(["tx_descripcion" => "Sin Información"]);
    }

    function formatCLP($n)
    {
        return is_int($n) ? number_format($n, 0, ',', '.') : null;
    }
}
