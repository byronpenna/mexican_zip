<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property $id
 * @property $name
 * @property $zone_type
 * @property $settlement_type
 * @property $zip_id
 */
class Settlements extends Model
{
    use HasFactory;
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
        $this->name = $row["d_asenta"];
        $this->zone_type = $row["d_zona"];
    }
}
