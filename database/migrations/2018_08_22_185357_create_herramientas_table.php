<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHerramientasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('herramientas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('h_nombre');
            $table->string('h_marca');
            $table->string('h_modelo')->nullable();
            $table->string('h_nro_serie')->nullable();
            $table->date('h_fecha_adquisicion');
            $table->string('h_ubicacion')->default('DEPOSITO CENTRAL');
            $table->boolean('h_estado')->default(1);
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
        Schema::dropIfExists('herramientas');
    }
}
