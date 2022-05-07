<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use App\Models\Municipality;
/**
 * @property $id
 * @property $code
 */
class Zip extends Model
{
    use HasFactory;
    protected $fillable = [
        "code"
    ];
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
        $this->code = $row['d_codigo'];
    }
}
