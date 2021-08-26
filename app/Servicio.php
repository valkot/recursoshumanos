<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'gen_servicio';
}
