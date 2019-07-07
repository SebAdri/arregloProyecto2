<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignedMaquinaria extends Model
{
    protected $fillable = ['herramienta_id', 'obra_id', 'fecha'];

    public function obra()
    {
        return $this->belongsTo(Obra::Class);
    }

    public function maquinarias()
    {
        return $this->hasMany(Maquinaria::class, 'id', 'maquinaria_id');
    }
}
