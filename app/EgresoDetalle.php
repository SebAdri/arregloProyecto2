<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EgresoDetalle extends Model
{
	protected $table = 'egresos_detalles';
    public function material(){
    	return $this->belongsTo(Material::Class);
    }
}