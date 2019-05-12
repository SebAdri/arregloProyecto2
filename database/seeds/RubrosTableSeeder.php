<?php

use Illuminate\Database\Seeder;
use App\Rubro;

class RubrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$rubros = new Rubro;
        $rubros->id = 1;
        $rubros->nombre = 'ENCADENADO INFERIOR 13x20 en PB';
        $rubros->mano_obra = 30000;
        $rubros->unidad_medida ='ml';
        $rubros->familia_rubro_id = '1';
        $rubros->estado = 1;
        $rubros->save();

        $rubros = new Rubro;
        $rubros->id = 2;
        $rubros->nombre = 'LOSA RAP';
        $rubros->mano_obra = 28000;
        $rubros->unidad_medida ='m2';
        $rubros->familia_rubro_id = '1';
        $rubros->estado = 1;
        $rubros->save();
        
        $rubros = new Rubro;
        $rubros->id = 3;
        $rubros->nombre = 'VALLADO DE OBRA';
        $rubros->mano_obra = 14400;
        $rubros->unidad_medida ='m2';
        $rubros->familia_rubro_id = '2';
        $rubros->estado = 1;
        $rubros->save();

        $rubros = new Rubro;
        $rubros->id = 4;
        $rubros->nombre = 'DE NIVELACIÓN CON LADRILLO COMUN Y JUNTA DE 2 CM';
        $rubros->mano_obra = 33000;
        $rubros->unidad_medida ='m2';
        $rubros->familia_rubro_id = '3';
        $rubros->estado = 1;
        $rubros->save();

        $rubros = new Rubro;
        $rubros->id = 5;
        $rubros->nombre = 'DE ELEVACIÓN CON LADRILLO COMUN Y JUNTA DE 2 CM';
        $rubros->mano_obra = 22000;
        $rubros->unidad_medida ='m2';
        $rubros->familia_rubro_id = '3';
        $rubros->estado = 1;
        $rubros->save();
    }
}
