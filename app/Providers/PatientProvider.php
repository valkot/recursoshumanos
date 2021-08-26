<?php

namespace App\Providers;

interface PatientProvider {
    public function fetch($rut, $dv);
    public function fetchNormalized($rut, $dv);
}