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
		return $this->belongsToMany(Material::class, 'material_rubro', 'material_id')->withPivot('cantidad_material');
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
