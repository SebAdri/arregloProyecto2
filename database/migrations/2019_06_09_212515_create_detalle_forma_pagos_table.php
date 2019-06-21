<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleFormaPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_forma_pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('detalle_pagos_id');
            $table->string('entidad_bancaria');
            $table->string('nro_referencia');
            $table->string('cuenta');
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
        Schema::dropIfExists('detalle_forma_pagos');
    }
}
