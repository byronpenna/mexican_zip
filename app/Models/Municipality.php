<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "zip_id"
    ];
    public function mapFromExcel($row)
    {

    }
}