<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
	protected $table = 'pedido_detalles';
    //
    function materiales (){
    	return $this->belongsTo(Material::Class, 'material_id');
    }
}
