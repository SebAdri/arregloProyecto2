<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObrasRubrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras_rubros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('obra_id');
            $table->integer('rubro_id');
            $table->integer('superficie');
            // $table->integer('dimension_dos');
            // $table->integer('dimension_tres');
            // $table->integer('costo_obra_rubro');
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
        Schema::dropIfExists('obras_rubros');
    }
}
