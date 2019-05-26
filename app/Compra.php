<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
	function proveedor(){
		return $this->belongsTo(Proveedor::Class);
	}
    function detalleCompra(){
    	return $this->hasMany(CompraDetalle::Class);
    }
}
