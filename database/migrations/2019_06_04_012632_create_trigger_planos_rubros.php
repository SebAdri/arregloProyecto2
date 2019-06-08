<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerPlanosRubros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*ncrements('id');
            $table->integer('plano_id');
            $table->integer('rubro_id');
            $table->integer('area')->nullable();
            $table->integer('progreso')->nullable();
            $table->timestamps();
        */
        DB::unprepared('
        CREATE TRIGGER tr_planos_rubros_log AFTER INSERT ON `planos_rubros` FOR EACH ROW
        BEGIN
         INSERT INTO planos_rubros_log (`plano_id`, `rubro_id`, `area`, `progreso`,`fecha_control`,`accion`) VALUES (NEW.plano_id, NEW.rubro_id, NEW.area, NEW.progreso, now(), `INSERT`);
        END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_planos_rubros_log`');
    }
}
