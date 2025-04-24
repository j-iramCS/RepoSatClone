<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ejercicios extends Model
{
    //
    protected $table = 'ejercicios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'creador_id',
        'tipo_ejercicio_id',
        'datos'
    ];
}
