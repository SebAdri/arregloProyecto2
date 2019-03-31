<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
	protected $table = 'materiales';
    protected $fillable = ['m_descripcion', 'm_unidad_medida', 'm_costo'];

    public function obras()
	{
		return $this->belongsToMany(Obra::class, 'assigned_materiales')->withPivot('cantidad_inicial','cantidad_disponible');
	}

    public function hasObras(array $obras)
	{
		foreach ($obras as $obra) 
		{
			foreach ($this.obras as $obrasAssigned) 
			{
				if ($obrasAssigned->nombre_proyecto == $obra) {
					return true;
				}
			}
		}
	}
}
