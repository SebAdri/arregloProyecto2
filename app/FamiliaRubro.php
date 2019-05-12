<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamiliaRubro extends Model
{
     protected $fillable = ['nombre'];
     protected $table = 'familia_rubros';

     public function rubros()
    {
        return $this->hasMany(Rubro::Class);
    }
}
