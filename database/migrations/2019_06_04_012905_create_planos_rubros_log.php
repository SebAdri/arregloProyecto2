<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanosRubrosLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planos_rubros_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plano_id');
            $table->integer('rubro_id');
            $table->integer('area')->nullable();
            $table->integer('progreso')->nullable();
            $table->date('fecha_control')->default(\Carbon\Carbon::now());
            $table->text('accion')->nullable();
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
        Schema::dropIfExists('planos_rubros_log');
    }
}
