<?php

namespace App\Handlers;

use App\generics\GenericResponse;
use Illuminate\Support\Facades\DB;

class ExcelHandler
{
    public function saveFromRow($obj,$row,$tableName):GenericResponse{
        $returnObj = new GenericResponse();
        $insertedID = DB::table($tableName)->insertGetId(
            $obj->toArray()
        );
        $returnObj->status = true;
        $returnObj->id = $insertedID;
        return $returnObj;
    }
}
