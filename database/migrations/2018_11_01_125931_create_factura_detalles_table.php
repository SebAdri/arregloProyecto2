<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('facturaCabecera_id');
            $table->integer('fd_nro');
            $table->string('fd_descripcion');
            $table->float('fd_cantidad');
            $table->float('fd_precio_unitario');
            $table->float('fd_precio');
            //$table->float('fd_');
            //$table->increments('i');
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
        Schema::dropIfExists('factura_detalles');
    }
}
