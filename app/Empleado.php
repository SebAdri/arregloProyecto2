<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = ['primerNombre', 'segundoNombre', 'primerApellido', 'segundoApellido', 'direccion', 'telefono', 'profesion_id'];

    public function profesion(){
		return $this->belongsTo(Profesion::Class);
	}

	public function obras(){
		return $this->belongsToMany(Obra::Class)->withTimestamps();
	}
}


