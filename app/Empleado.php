<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = ['primerNombre', 'segundoNombre', 'primerApellido', 'segundoApellido', 'direccion', 'telefono', 'rubro_id'];

    public function rubro(){
	return $this->belongsTo(Rubro::Class);
	}

	public function obras(){
	return $this->belongsToMany(Obra::Class)->withTimestamps();
	}
}


