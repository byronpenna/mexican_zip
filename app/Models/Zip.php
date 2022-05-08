<?php

namespace App\Models;

use App\generics\GenericResponse;
use App\interfaces\ImportationContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use App\Models\Municipality;
use Illuminate\Support\Facades\DB;

/**
 * @property $id
 * @property $code
 */
class Zip extends Model implements ImportationContract
{
    use HasFactory;
    protected $table = "zips";
    // excel
    const EXCEL_CODE = 'd_codigo';
    // fields
    const CODE_FIELD = "code";
    protected $fillable = [

    ];

    // Relations
    public function municipalities(): Relations\HasMany
    {
        return $this->hasMany(Municipality::class);
    }
    public function federals():Relations\HasMany
    {
        return $this->hasMany(Federal::class);
    }
    public function settlements(): Relations\HasMany
    {
        return $this->hasMany(Settlements::class);
    }
    public function mapFromExcel($row){
        $this->code = $row[self::EXCEL_CODE];
    }
    // implements
    public function saveFromExcel($row):GenericResponse{
        $returnObj = new GenericResponse();
        $returnObj->inserted = false;
        try {
            $zip = Zip::where(self::CODE_FIELD , '=' , $row[self::EXCEL_CODE])->first();
            if($zip == null){
                $zip = new Zip();
                $zip->mapFromExcel($row);
                $insertedID = DB::table($this->table)->insertGetId($zip->toArray());
                $returnObj->inserted = true;
                $returnObj->status = true;
                $returnObj->id = $insertedID;
                return  $returnObj;
            }
            $returnObj->status = true;
            $returnObj->id = $zip->id;
        }catch (\Exception $ex){

        }

        return $returnObj;
    }
    public function saveAllFromExcel($row){
        // save zip
            $control = $this->saveFromExcel($row);
            $row[Settlements::ZIP_FIELD] = $control->id;
        // save settlement type
            $stType                 = new SettlementType();
            $control                = $stType->saveFromExcel($row);
            $row["settlement_type"] = $control->id;
        // save settlements
            $st = new Settlements();
            $st->saveFromExcel($row);
        // save federals
            $fd = new Federal();
            $fd->saveFromExcel($row);
        // save municipality
            $m = new Municipality();
            $m->saveFromExcel($row);
    }
}
