<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialRubroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
    //     Schema::create('material_rubro', function (Blueprint $table) {
    //         $table->increments('id');
    //         $table->integer('plano_id');
    //         $table->integer('rubro_id');
    //         $table->integer('material_id');
    //         $table->float('cantidad_material');
    //         //$table->float('costo_x_material');
    //         $table->timestamps();
    //     });
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_rubro');
    }
}
