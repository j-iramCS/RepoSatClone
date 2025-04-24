<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TramitesServicios extends Model
{
    //
    protected $table = 'tramites_servicios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'cat_tramite_servicio_id',
        'cat_tipo_tramite_id',
        'creador_id',
    ];
}
