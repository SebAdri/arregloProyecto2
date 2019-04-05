<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nombre', 'cedula', 'ruc', 'fecha_inscripcion', 'direccion', 'telefono', 'email'];

}
