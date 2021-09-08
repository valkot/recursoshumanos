<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Funcionario extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'gen_funcionario';

    use SoftDeletes;
    public $guarded = [];

    protected $appends = ['nombre', 'rut_completo', 'rut'];

    public function getNombreAttribute()
    {
        return ucwords(mb_strtolower("{$this->tx_nombres} {$this->tx_apellido_paterno} {$this->tx_apellido_materno}"));
    }

    public function getRutCompletoAttribute()
    {
        $rutNumero = $this->formatCLP(intval($this->nr_run));
        return "{$rutNumero}-{$this->tx_digito_verificador}";
    }

    public function getRutAttribute()
    {
        return "{$this->nr_run}-{$this->tx_digito_verificador}";
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
