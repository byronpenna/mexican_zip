<?php

namespace App\Models;

use App\generics\GenericResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property $id
 * @property $name
 */
class SettlementType extends Model
{
    use HasFactory;
    protected $table = "settlement_types";

    const EXCEL_NAME = "d_tipo_asenta";
    const NAME_FIELD = "name";
    protected $fillable = [
        "name",
        "settlement_id"
    ];
    public function mapFromExcel($row)
    {
        $this->name = $row[self::EXCEL_NAME];
    }
    // implements
    public function saveFromExcel($row)
    {
        $returnObj              = new GenericResponse();
        $returnObj->inserted    = false;
        $returnObj->status      = false;
        $insertedID             = -1;
        try {
            $st = SettlementType::where(self::NAME_FIELD , '=' , $row[self::EXCEL_NAME])->first();
            if($st == null){
                $settlementType = new SettlementType();
                $settlementType->mapFromExcel($row);
                $insertedID = DB::table($this->table)->insertGetId(
                    $settlementType->toArray()
                );
                $returnObj->inserted    = true;
                $returnObj->status      = true;
                $returnObj->id          = $insertedID;
                return $returnObj;
            }
            $returnObj->status  = true;
            $returnObj->id = $st->id;
        }catch (\Exception $ex){

        }
        return $returnObj;
    }
}
