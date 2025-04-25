<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatPeriodos extends Model
{
    //
    protected $table = 'cat_periodos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
    ];
}
