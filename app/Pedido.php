<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function pedidoDetalle(){
        return $this->hasMany(PedidoDetalle::Class);
    }
}
