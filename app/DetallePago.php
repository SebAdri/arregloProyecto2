<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePago extends Model
{
    function pago(){
    	return $this->belongsTo(Pago::Class);
    }
    function formaPago(){
    	return $this->belongsTo(FormaPago::Class);
    }
    function detalleFormaPago(){
    	return $this->hasMany(DetalleFormaPago::Class);
    }
}
