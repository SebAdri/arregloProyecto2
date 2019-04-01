<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaCabecerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_cabeceras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fc_ruc');
            $table->string('fc_nombre');
            $table->string('fc_direccion')->nullable();
            $table->string('fc_telefono')->nullable();
            $table->boolean('fc_contadoCredito');//true=contado; false=credito
            $table->date('fc_fecha_emision')->default(\Carbon\Carbon::now());
            $table->integer('fc_cuota')->default(0);
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
        Schema::dropIfExists('factura_cabeceras');
    }
}
