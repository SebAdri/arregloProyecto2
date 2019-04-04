<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    public function obra() {
   		return $this->belongsTo(Obra::Class);
   }
   public function material() {
   		return $this->belongsTo(Material::Class);
   }

}
