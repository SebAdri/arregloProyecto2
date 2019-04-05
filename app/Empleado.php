<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = ['primerNombre', 'segundoNombre', 'primerApellido', 'segundoApellido', 'direccion', 'telefono', 'profesion_id'];

<<<<<<< HEAD
    public function profesion(){
		return $this->belongsTo(Profesion::Class);
=======
    public function rubro(){
	return $this->belongsTo(Rubro::Class);
>>>>>>> 12bf9022b901a4cbc29d6de78d1ade0d9f735312
	}

	public function obras(){
	return $this->belongsToMany(Obra::Class)->withTimestamps();
	}
}


