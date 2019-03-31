<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaquinariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquinarias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_nombre');
            $table->string('ma_marca');
            $table->string('ma_modelo')->nullable();
            $table->date('ma_fecha_adquisicion');
            $table->string('ma_distancia')->nullable();
            $table->date('ma_fecha_mantenimiento')->nullable();
            $table->boolean('ma_estado')->default(1);
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
        Schema::dropIfExists('maquinarias');
    }
}
