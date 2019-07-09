<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignedHerramienta extends Model
{
    protected $fillable = ['herramienta_id', 'obra_id', 'created_at', 'updated_at'];

    public function obra()
    {
        return $this->belongsTo(Obra::Class);
    }

    public function herramientas()
    {
        return $this->hasMany(Herramienta::class, 'id', 'herramienta_id');
    }
}
