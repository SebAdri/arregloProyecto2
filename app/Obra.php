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
    }

    public function planos()
    {
        return $this->hasMany(Plano::class);
    }

    public function presupuesto()
    {
        return $this->hasOne(Presupuesto::class);
    }

    function bandejaEnviado(){
        return $this->hasMany(Pedido::Class, 'id_obra_solicitante');
    }

    function bandejaEntrada(){
        return $this->hasMany(Pedido::Class, 'id_obra_destino');
    }
}
