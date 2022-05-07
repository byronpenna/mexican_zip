<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Federal extends Model
{
    use HasFactory;
    protected $fillable = [
        "name","code","zip_id"
    ];
}
