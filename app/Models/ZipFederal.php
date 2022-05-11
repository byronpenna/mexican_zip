<?php

namespace App\Models;

use App\generics\GenericResponse;
use App\interfaces\ImportationContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property $id
 * @property $zip_id
 * @property $federal_id
 */
class ZipFederal extends Model implements ImportationContract
{
    use HasFactory;

    protected $table = "zip_federals";
    protected $fillable = [
        "zip_id","federal_id"
    ];
    const ZIP_FIELD = "zip_id";
    const FEDERAL_FIELD = "federal_id";

    public function mapFromExcel($row){
        $this->zip_id = $row[self::ZIP_FIELD];
        $this->federal_id = $row[self::FEDERAL_FIELD];
    }
    public function saveFromExcel($row):GenericResponse
    {

        $returnObj              = new GenericResponse();
        $returnObj->inserted    = false;
        $returnObj->status      = false;

            $matchThese = [
                self::ZIP_FIELD =>  $row[self::ZIP_FIELD],
                self::FEDERAL_FIELD =>  $row[self::FEDERAL_FIELD]
            ];
            $fdzip = ZipFederal::where($matchThese)->first();
            if($fdzip == null){
                //echo "insert";
                $zf = new ZipFederal();
                $zf->mapFromExcel($row);
                $insertedID = DB::table($this->table)->insertGetId(
                    $zf->toArray()
                );

                $returnObj->status = true;
                $returnObj->id = $insertedID;
                return $returnObj;
            }
            //echo "no insert";
            $returnObj->status = true;
            $returnObj->id = $fdzip->id;


        return $returnObj;

    }
}
