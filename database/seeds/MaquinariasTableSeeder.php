<?php

use Illuminate\Database\Seeder;
use App\Maquinaria;
use Carbon\Carbon;

class MaquinariasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maquinarias = new Maquinaria;
        $maquinarias->ma_nombre = 'Tractor' ;
        $maquinarias->ma_marca = 'CAT' ;
        $maquinarias->ma_modelo = 'FX.221' ;
        $maquinarias->ma_fecha_adquisicion = Carbon::Parse('2019/05/04');
        $maquinarias->ma_distancia = '2000' ;
        $maquinarias->ma_fecha_mantenimiento = '2019/06/04' ;
        $maquinarias->ma_estado = 1 ;
		$maquinarias->save();

		$maquinarias = new Maquinaria;
        $maquinarias->ma_nombre = 'Excavadora' ;
        $maquinarias->ma_marca = 'CAT' ;
        $maquinarias->ma_modelo = 'Fz.4521' ;
        $maquinarias->ma_fecha_adquisicion = Carbon::Parse('2019/05/04');
        $maquinarias->ma_distancia = '3000' ;
        $maquinarias->ma_fecha_mantenimiento = '2019/06/04' ;
        $maquinarias->ma_estado = 1 ;
		$maquinarias->save();

    }
}
