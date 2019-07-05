<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
	function documentos(){
		return $this->belongsTo(Documento::Class, 'documento_id');
	}
	function detallesPagos(){
		return $this->hasMany(DetallePago::Class);
	}
	function obra(){
		return $this->belongsTo(Obra::Class);
	}

}
