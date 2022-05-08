<?php

namespace App\Models;

use App\generics\GenericResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property $id
 * @property $name
 * @property $zip_id
 */
class Municipality extends Model
{
    use HasFactory;
    protected $table = "municipalities";
    protected $fillable = [
        "name",
        "zip_id"
    ];
    const EXCEL_NAME    = 'd_mnpio';
    const NAME_FIELD    = "name";
    const ZIP_FIELD     = "zip_id";
    public function mapFromExcel($row)
    {
        $this->name = $row[self::EXCEL_NAME];
    }
    public function saveFromExcel($row)
    {
        $returnObj              = new GenericResponse();
        $returnObj->inserted    = false;
        $returnObj->status      = false;
        $insertedID             = -1;
        try{
            $matchThese = [
                self::NAME_FIELD    => $row[self::EXCEL_NAME]
            ];
            $m = Municipality::where($matchThese)->first();
            if( $m == null){
                $municipality = new Municipality();
                $municipality->mapFromExcel($row);
                $municipality->zip_id = $row[self::ZIP_FIELD];

                $insertedID = DB::table($this->table)->insertGetId(
                    $municipality->toArray()
                );
                $returnObj->status = true;
                $returnObj->id = $insertedID;
                return $returnObj;
            }
            $returnObj->status = true;
            $returnObj->id = $m->id;
        }catch (\Exception $ex){

        }
        return $returnObj;
    }
}
