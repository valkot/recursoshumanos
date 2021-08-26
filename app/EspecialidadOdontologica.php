<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspecialidadOdontologica extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'gen_especialidad_odontologica';

    public function solicitudContrato()
    {
        return $this->morphOne(SolicitudContrato::class, 'especialidad');
    }
}
