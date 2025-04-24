<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposEjercicios extends Model
{
    //
    protected $table = 'tipos_ejercicios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tipo',
        'descripcion',
    ];
}
