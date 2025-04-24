<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatTramitesServicios extends Model
{
    //
    protected $table = 'cat_tramites_servicios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'titulo',
        'descripcion',
        'disponible'
    ];
}
