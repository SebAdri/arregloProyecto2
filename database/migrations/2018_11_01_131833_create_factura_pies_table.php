<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaPiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_pies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('facturaDetalle_id');
            $table->float('fp_subTotal');
            $table->float('fp_iva10');
            $table->float('fp_iva5');
            $table->float('fp_total');
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
        Schema::dropIfExists('factura_pies');
    }
}
