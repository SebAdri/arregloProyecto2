<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    function detallePedido(){
    	return $this->hasMany(PedidoDetalle::Class);
    }
    function bandejaEnviado(){
    	return $this->belongsTo(Obra::Class, 'id_obra_solicitante');
    }
    function bandejaEntrada(){
    	return $this->belongsTo(Obra::Class, 'id_obra_destino');
    }
}
