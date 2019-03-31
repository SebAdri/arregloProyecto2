<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    public function obra(){
        return $this->belongsTo(Obra::Class);
    }
}
