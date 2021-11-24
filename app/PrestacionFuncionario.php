<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrestacionFuncionario extends Model
{

    use SoftDeletes;

    protected $connection = 'mysql2';

    protected $table = 'gen_prestacion_funcionario';

    public $guarded = [];
    public $timestamps = false;
}
