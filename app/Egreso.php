<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    function detalleEgreso(){
    	return $this->hasMany(EgresoDetalle::Class);
    }
}
