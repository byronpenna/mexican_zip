<?php

namespace App\Imports;

use App\Models\Federal;
use App\Models\Municipality;
use App\Models\Petition;
use App\Models\Settlements;
use App\Models\SettlementType;
use App\Models\Zip;
use Hamcrest\Core\Set;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ZipImport implements ToModel,WithHeadingRow,WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //print_r($row);
        $zip = new Zip();
        $zip->saveAllFromExcel($row);
        /*
        if(
            $row['d_codigo'] == null
        ){
            return null;
        }
        $zip = Zip::where('code' , '=' , $row['d_codigo'])->first();
        if(
            $zip == null
        ){

            $settlement = new Settlements();
            $settlement->mapFromExcel($row);
            $settlement->settlement_type = $SettlementTypeinsertedID;
            $settlement->zip_id = $insertedID;
            $SettlementinsertedID = DB::table('settlements')->insertGetId(
                $settlement->toArray()
            );
            $zip->federals()->create([
                'name' => $row["d_estado"]
            ]);

            $zip->municipalities()->create(
                [
                    'name' => $row['d_mnpio']
                ]
            );
            return $zip;
        }else{
            new Zip([
                'code' => '1111'
            ]);
            return new Municipality([
                'name' => $row['d_mnpio']."yy",
                'zip_id' => $zip->id
            ]);
        }*/


    }

    public function batchSize(): int
    {
        // TODO: Implement batchSize() method.
        return 500;
    }
}
