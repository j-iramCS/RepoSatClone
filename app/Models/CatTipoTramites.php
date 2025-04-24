<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatTipoTramites extends Model
{
    //
    protected $table = 'cat_tipo_tramites';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tipo'
    ];
}
