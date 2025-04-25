<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatYears extends Model
{
    //
    protected $table = 'cat_years';
    protected $primaryKey = 'id';
    protected $fillable = [
        'anio',
    ];
}
