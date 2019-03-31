<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    public function orden_Compra(){
    	return $this->belongsTo(OrdenCompra::Class);
    }
}
