<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspecialidadMedica extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'gen_especialidad_medica';

    public function solicitudContrato()
    {
        return $this->morphOne(SolicitudContrato::class, 'especialidad');
    }
}
