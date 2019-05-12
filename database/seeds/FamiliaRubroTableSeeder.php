<?php

use Illuminate\Database\Seeder;
use App\FamiliaRubro;

class FamiliaRubroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $familia_rubros = new FamiliaRubro;
        $familia_rubros->id = 1;
        $familia_rubros->nombre = 'ESTRUCTURAS DE HORMIGON ARMADO';
        $familia_rubros->save();

        $familia_rubros = new FamiliaRubro;
        $familia_rubros->id = 2;
        $familia_rubros->nombre = 'TRABAJOS  PREELIMINARES';
		$familia_rubros->save();
        
        $familia_rubros = new FamiliaRubro;
        $familia_rubros->id = 3;
        $familia_rubros->nombre = 'MAMPOSTERIAS';
    	$familia_rubros->save();
    }
}
