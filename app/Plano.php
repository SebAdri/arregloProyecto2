<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    public function rubros()
    {
        return $this->belongsToMany(Rubro::class, 'planos_rubros')->withPivot('area','progreso');
        
    }

    public function obras()
    {
        return $this->belongsTo(Obra::class, 'obra_id');
    }
}
