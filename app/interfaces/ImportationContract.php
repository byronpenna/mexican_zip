<?php

namespace App\interfaces;

use App\generics\GenericResponse;

interface ImportationContract
{
    public function saveFromExcel($row):GenericResponse;
}
