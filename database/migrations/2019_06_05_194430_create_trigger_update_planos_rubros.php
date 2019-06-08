<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerUpdatePlanosRubros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_update_planos_rubros_log BEFORE UPDATE ON `planos_rubros` FOR EACH ROW
        BEGIN
         INSERT INTO planos_rubros_log (`plano_id`, `rubro_id`, `area`, `progreso`,`fecha_control`,`accion`) VALUES (NEW.plano_id, NEW.rubro_id, NEW.area, NEW.progreso, now(), `UPDATE`);
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
        DB::unprepared('DROP TRIGGER `tr_update_planos_rubros_log`');
    }
}
