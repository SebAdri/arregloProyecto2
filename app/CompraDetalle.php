<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompraDetalle extends Model
{
	protected $fillable = [
        'material_id', 'cantidad', 'precio_unitario', 'orden_compra_id', 'estado'
    ];
    public function material(){
    	return $this->belongsTo(Material::Class);
    }

}
