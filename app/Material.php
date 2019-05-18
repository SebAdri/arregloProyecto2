<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
	protected $table = 'materiales';
    protected $fillable = ['m_descripcion', 'm_unidad_medida', 'm_costo'];
    // protected $primaryKey = 'material_id';

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

	public function rubros()
    {
		return $this->belongsToMany(Rubro::Class);    	
    }

    
}
