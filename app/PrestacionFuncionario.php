<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrestacionFuncionario extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'gen_prestacion_funcionario';

    public $guarded = [];
    public $timestamps = false;
}
