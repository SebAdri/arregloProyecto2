<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerHerramientasUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_assigned_herramientas_update BEFORE UPDATE ON `inventarios` FOR EACH ROW
        BEGIN
         if (NEW.herramienta_id is not null) then
          INSERT INTO assigned_herramientas (`herramienta_id`, `obra_id`, `created_at`,`accion`) VALUES (NEW.herramienta_id, NEW.obra_id, now(), \'UPDATE\');
         end if;
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
        DB::unprepared('DROP TRIGGER `tr_assigned_herramientas_update`');
    }
}
