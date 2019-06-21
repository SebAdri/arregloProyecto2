<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DetalleFactura;
class Factura extends Model
{
    public function detalles(){
    	return $this->hasMany(DetalleFactura::class);
    }
}
