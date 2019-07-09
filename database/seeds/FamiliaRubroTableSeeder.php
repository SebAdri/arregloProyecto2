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
        $familia_rubro = New FamiliaRubro;
        $familia_rubro->nombre = 'Trabajos Preliminares';
        $familia_rubro->save();

        $familia_rubro = New FamiliaRubro;
        $familia_rubro->nombre = 'Estructuras de Hormigón Armado';
        $familia_rubro->save();
        
        $familia_rubro = New FamiliaRubro;
        $familia_rubro->nombre = 'Fundaciones';
        $familia_rubro->save();
        
        $familia_rubro = New FamiliaRubro;
        $familia_rubro->nombre = 'Mamposterías';
        $familia_rubro->save();
        
        $familia_rubro = New FamiliaRubro;
        $familia_rubro->nombre = 'Cielo Raso';
        $familia_rubro->save();
        
        $familia_rubro = New FamiliaRubro;
        $familia_rubro->nombre = 'Zocalos';
        $familia_rubro->save();
        
        $familia_rubro = New FamiliaRubro;
        $familia_rubro->nombre = 'Pisos';
        $familia_rubro->save();
        
        $familia_rubro = New FamiliaRubro;
        $familia_rubro->nombre = 'Dinteles';
        $familia_rubro->save();
        
        $familia_rubro = New FamiliaRubro;
        $familia_rubro->nombre = 'Contrapisos';
        $familia_rubro->save();
        
        $familia_rubro = New FamiliaRubro;
        $familia_rubro->nombre = 'Revoques';
        $familia_rubro->save();
        
        $familia_rubro = New FamiliaRubro;
        $familia_rubro->nombre = 'Techos';
        $familia_rubro->save();
        
        $familia_rubro = New FamiliaRubro;
        $familia_rubro->nombre = 'Revestidos';
        $familia_rubro->save();

        $familia_rubro = New FamiliaRubro;
        $familia_rubro->nombre = 'Desague Cloacal y Pluvial';
        $familia_rubro->save();
        /* Prueba de familia rubro sebas
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
    	$familia_rubros->save();*/
    }
}
