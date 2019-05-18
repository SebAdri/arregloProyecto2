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

    public function compra(){
        return $this->hasMany(OrdenCompra::Class);
    }
    public function inventario(){
        return $this->hasMany(Inventario::Class);
    }
    public function rubros()
    {
        return $this->belongsToMany(Rubro::class, 'obras_rubros')->withPivot('area');
        // return $this->belongsToMany(Rubro::class, 'obras_rubros')->withPivot('dimension_uno', 'dimension_dos', 'dimension_tres', 'costo_obra_rubro');
    }

    public function planos()
    {
        return $this->belongsToMany(Plano::class);
    }
}
