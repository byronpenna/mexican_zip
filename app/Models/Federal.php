<?php

namespace App\Models;

use App\generics\GenericResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property $id
 * @property $name
 * @property $code
 * @property $zip_id
 */
class Federal extends Model
{
    use HasFactory;
    protected $table = "federals";
    protected $fillable = [
        "name","code","zip_id"
    ];

    const EXCEL_NAME = "d_estado";

    const NAME_FIELD = 'name';
    const ZIP_FIELD = "zip_id";
    public function mapFromExcel($row){
        $this->name = $row[self::EXCEL_NAME];
    }
    public function saveFromExcel($row)
    {
        $returnObj              = new GenericResponse();
        $returnObj->inserted    = false;
        $returnObj->status      = false;
        try {
            $matchThese = [
                self::NAME_FIELD =>  $row[self::EXCEL_NAME]
            ];
            $fd = Federal::where($matchThese)->first();
            if($fd == null){
                $federal = new Federal();
                $federal->mapFromExcel($row);
                $federal->zip_id = $row[self::ZIP_FIELD];
                $insertedID = DB::table($this->table)->insertGetId(
                    $federal->toArray()
                );
                $returnObj->status = true;
                $returnObj->id = $insertedID;
                return $returnObj;
            }

            $returnObj->status = true;
            $returnObj->id = $fd->id;
        }catch (\Exception $ex){

        }
        return $returnObj;
    }
}
