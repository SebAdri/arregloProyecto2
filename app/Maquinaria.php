<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maquinaria extends Model
{
    protected $fillable = ['ma_nombre', 'ma_marca', 'ma_modelo', 'ma_fecha_adquisicion', 'ma_distancia', 'ma_fecha_mantenimiento'];

    public function obras()
	{
		return $this->belongsToMany(Obra::class, 'inventarios')->withPivot('cantidad_minima','cantidad_actual');
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
