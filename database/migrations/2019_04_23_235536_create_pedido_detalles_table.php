<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pedido_id');
            $table->integer('material_id');
            $table->integer('cantidad_solicitada');
            $table->integer('cantidad_recibida');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_detalles');
    }
}
