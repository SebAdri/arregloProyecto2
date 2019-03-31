<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCantidadAssignedMaterialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assigned_materiales', function (Blueprint $table) {
            $table->integer('cantidad_inicial')->nullable();
            $table->integer('cantidad_disponible')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assigned_materiales', function (Blueprint $table) {
            $table->dropColumn('cantidad_inicial');
            $table->dropColumn('cantidad_disponible');
        });
    }
}
