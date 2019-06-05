<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
	function documentos(){
		return $this->belongsTo(Documento::Class);
	}

}
