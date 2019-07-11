<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Herramienta extends Model
{
	 // $table->increments('id');
  //           $table->string('h_nombre');
  //           $table->string('h_marca');
  //           $table->string('h_modelo')->nullable();
  //           $table->string('h_nro_serie')->nullable();
  //           $table->date('h_fecha_adquisicion');
  //           $table->string('h_estado_herramienta')->default('DISPONIBLE');
  //           $table->string('ubicacion')->default('DEPOSITO CENTRAL');
  //           $table->integer('cantidad');
  //           $table->boolean('estado')->default(1);
	protected $fillable = ['h_nombre', 'h_marca', 'h_modelo', 'h_nro_serie', 'h_fecha_adquisicion', 'ubicacion'];

  public function obras()
  {
    return $this->belongsToMany(Obra::class, 'inventarios')->withPivot('cantidad_minima','cantidad_actual');
  }

  public function obrasHerramientas()
  {
    return $this->belongsTo(Obra::class,'h_ubicacion', 'id');
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
