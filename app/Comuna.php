<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'gen_comuna';
}
