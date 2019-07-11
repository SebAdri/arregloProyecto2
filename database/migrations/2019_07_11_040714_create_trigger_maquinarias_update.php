<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerMaquinariasUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_assigned_maquinarias_update BEFORE UPDATE ON `inventarios` FOR EACH ROW
        BEGIN
         if (NEW.maquinaria_id is not null) then
          INSERT INTO assigned_maquinarias (`maquinaria_id`, `obra_id`, `fecha`,`accion`) VALUES (NEW.maquinaria_id, NEW.obra_id, now(), \'UPDATE\');
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
        DB::unprepared('DROP TRIGGER `tr_assigned_maquinarias_update`');
        
    }
}
