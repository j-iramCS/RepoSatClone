<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodosHasPeriodicidades extends Model
{
    //
    protected $table = 'periodos_has_periodicidades';
    protected $primaryKey = 'id';
    protected $fillable = [
        'cat_periodo_id',
        'cat_periodicidad_id',
    ];
}
