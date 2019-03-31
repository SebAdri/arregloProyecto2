<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maquinaria extends Model
{
    protected $fillable = ['ma_nombre', 'ma_marca', 'ma_modelo', 'ma_fecha_adquisicion', 'ma_distancia', 'ma_fecha_mantenimiento'];
}
