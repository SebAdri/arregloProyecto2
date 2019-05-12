<?php

use Illuminate\Database\Seeder;
use App\Profesion;

class ProfesionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profesiones = new Profesion;
        $profesiones->nombre = 'Electricista';
        $profesiones->detalle = 'Dedicado a todo tipo de instalaciones electricas';
        $profesiones->estado = 1;
        $profesiones->save();

        $profesiones = new Profesion;
        $profesiones->nombre = 'Pintor Interior';
        $profesiones->detalle = 'Dedicado a pintar en os interiores de hogares y otros';
        $profesiones->estado = 1;
        $profesiones->save();

        $profesiones = new Profesion;
        $profesiones->nombre = 'Albañil';
        $profesiones->detalle = 'Dedicado a la construccion de la obras';
        $profesiones->estado = 1;
        $profesiones->save();
        
    }
}
