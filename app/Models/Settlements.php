<?php

namespace App\Models;

use App\generics\GenericResponse;
use App\interfaces\ImportationContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property $id
 * @property $name
 * @property $zone_type
 * @property $settlement_type
 * @property $zip_id
 */
class Settlements extends Model implements ImportationContract
{
    use HasFactory;
    protected $table = "settlements";
    const EXCEL_NAME ="d_asenta";
    const EXCEL_ZONE_TYPE = "d_zona";

    const NAME_FIELD            = "name";
    const ZONE_TYPE_FIELD       = "zone_type";
    const ZIP_FIELD             = "zip_id";
    const SETTLEMENT_TYPE_FIELD = "settlement_type";

    protected $fillable = [
        "name",
        "zone_type",
        "settlement_type",
        "zip_id"
    ];

    public function SettlementTypes(){
        return $this->hasMany(SettlementType::class);
    }

    public function mapFromExcel($row){
        /*
         * [
                        'name' => $row["d_asenta"],
                        'zone_type' => $row["d_zona"],
                        'settlement_type'  => $SettlementTypeinsertedID,
                        'zip_id' => $insertedID
                    ]
         * */
        $this->name = $row[self::EXCEL_NAME];
        $this->zone_type = $row[self::EXCEL_ZONE_TYPE];
    }

    public function saveFromExcel($row):GenericResponse
    {
        // TODO: Implement saveFromExcel() method.
        $returnObj = new GenericResponse();
        $returnObj->inserted = false;
        $insertedID = -1;

            $matchThese = [
                self::NAME_FIELD => $row[self::EXCEL_NAME],
                self::ZONE_TYPE_FIELD => $row[self::EXCEL_ZONE_TYPE]
            ];
            $st = Settlements::where($matchThese)->first();
            if($st == null){
                $settlement = new Settlements();
                $settlement->mapFromExcel($row);
                $settlement->zip_id = $row[self::ZIP_FIELD];
                $settlement->settlement_type = $row[self::SETTLEMENT_TYPE_FIELD];
                $insertedID = DB::table($this->table)->insertGetId($settlement->toArray());

                $returnObj->inserted = true;
                $returnObj->id = $insertedID;
                $returnObj->status = true;
                return $returnObj;
            }
            $returnObj->status = true;
            $returnObj->id = $st->id;
        return $returnObj;
    }
}
