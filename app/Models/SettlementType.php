<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property $id
 * @property $name
 */
class SettlementType extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "settlement_id"
    ];
    public function mapFromExcel($row)
    {
        $this->name = $row["d_tipo_asenta"];
    }
}
