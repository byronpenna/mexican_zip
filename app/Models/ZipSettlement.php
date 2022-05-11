<?php

namespace App\Models;

use App\generics\GenericResponse;
use App\Handlers\ExcelHandler;
use App\interfaces\ImportationContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property $id
 * @property $zip_id
 * @property $settlements_id
 */
class ZipSettlement extends Model implements ImportationContract
{
    use HasFactory;

    protected $table = "zip_settlements";
    protected $fillable = [
        "settlements_id","zip_id"
    ];
    const ZIP_FIELD         = "zip_id";
    const SETTLEMENT_FIELD  = "settlements_id";

    public function mapFromExcel($row){
        $this->zip_id           = $row[self::ZIP_FIELD];
        $this->settlements_id    = $row[self::SETTLEMENT_FIELD];
    }
    public function saveFromExcel($row): GenericResponse
    {
        $returnObj              = new GenericResponse();
        $returnObj->inserted    = false;
        $returnObj->status      = false;

        //try {
            $matchThese = [
                self::ZIP_FIELD =>  $row[self::ZIP_FIELD],
                self::SETTLEMENT_FIELD =>  $row[self::SETTLEMENT_FIELD]
            ];
            $zpSt = ZipSettlement::where($matchThese)->first();
            if($zpSt == null){
                $zs = new ZipSettlement();
                $zs->mapFromExcel($row);
                $xlsHandler = new ExcelHandler();
                return $xlsHandler->saveFromRow($zs,$row,$this->table);
            }
            $returnObj->status = true;
            $returnObj->id = $zpSt->id;
            return $returnObj;
        /*}catch (\Exception $ex){

        }*/
    }
}
