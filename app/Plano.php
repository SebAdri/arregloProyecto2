<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
	protected $fillable = ['nombre', 'descripcion', 'fecha', 'cliente_id','obra_id'];

    public function rubros()
    {
        return $this->belongsToMany(Rubro::class, 'planos_rubros')->withPivot('area','progreso');
        
    }

    public function obras()
    {
        return $this->belongsTo(Obra::class, 'obra_id');
    }

    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class);
    }
}
