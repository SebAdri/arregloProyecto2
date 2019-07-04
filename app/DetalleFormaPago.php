<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleFormaPago extends Model
{
   function detallePago(){
   	return $this->belongsTo(DetallePago::Class);
   }
}
