<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'gen_sexo';
}
