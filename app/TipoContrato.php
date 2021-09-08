<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoContrato extends Model
{
    protected $table = 'tipo_contrato';

    use SoftDeletes;
    public $guarded = [];
}