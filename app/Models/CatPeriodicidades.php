<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatPeriodicidades extends Model
{
    //
    protected $table = 'cat_periodicidades';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
    ];
}
