<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Obra;
use App\Plano;

class Presupuesto extends Model
{
    function obra(){
    	return $this->belongsTo(Obra::class);
    }

    function planos(){
    	return $this->belongsTo(Plano::class);
    }
}
