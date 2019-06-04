<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    protected $fillable = ['nombre_rubro', 'detalle_rubro'];

    public function familiaRubro()
    {
        return $this->belongsTo(FamiliaRubro::Class);
    }

    public function materiales()
    {
        return $this->belongsToMany(Material::class)->withPivot('cantidad_material');// al final dejo asi la relacion
		// return $this->belongsToMany(Material::class, 'material_rubro', 'material_id')->withPivot('cantidad_material');//porque si dejo asi funciona rarola relacion. cuando se trae el primer rubro, y se trae los materiales del rubro. trae todos los materiales que sean igual
    }
    public function obras()
    {
        return $this->belongsToMany(Obra::class);
    }
    public function planos()
    {
        return $this->belongsToMany(Plano::class);
    }
}
