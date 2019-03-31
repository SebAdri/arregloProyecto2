<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
     protected $fillable = ['nombre_proyecto', 'cliente_id', 'fecha_inicio', 'fecha_fin'];

    public function cliente(){
        return $this->belongsTo(Cliente::Class);
    }

	public function empleados(){
	return $this->belongsToMany(Empleado::Class)->withTimestamps();;
	}

	public function documentos(){
        return $this->hasMany(Documento::Class);
    }
    public function pedidos(){
        return $this->hasMany(Pedido::Class);
    }
    
}
