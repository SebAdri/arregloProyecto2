<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Obra;

class Presupuesto extends Model
{
    function obra(){
    	return $this->belongsTo(Obra::class);
    }
}
