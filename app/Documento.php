<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = ['nombre', 'tipo_doc', 'fecha_emision', 'ubicacion', 'obra_id'];

    public function obra(){
        return $this->belongsTo(Obra::Class);
    }

}
