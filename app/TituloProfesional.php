<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TituloProfesional extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'gen_titulo_profesional';

    public function solicitudContrato()
    {
        return $this->morphOne(SolicitudContrato::class, 'especialidad');
    }
}
