<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametroFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametro_facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('empresa_nombre');
            $table->string('empresa_eslogan')->nullable();
            $table->string('telefono');
            $table->string('correo');
            $table->string('ruc');
            $table->string('direccion');
            $table->string('imagen');
            $table->string('ciudad');
            $table->string('Pais');
            $table->string('timbrado');
            $table->string('vigencia_inicio');
            $table->string('vigencia_fin');
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
        Schema::dropIfExists('parametro_facturas');
    }
}
