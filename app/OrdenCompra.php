<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
   public function detalleCompra(){
   		return $this->hasMany(DetalleCompra::Class); 
   }
}
