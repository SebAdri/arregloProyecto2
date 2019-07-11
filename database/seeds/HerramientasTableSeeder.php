<?php

use Illuminate\Database\Seeder;
use App\Herramienta;
use Carbon\Carbon;

class HerramientasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $herramientas = new Herramienta;
        $herramientas->h_nombre = 'LLave Inglesa' ;
        $herramientas->h_marca = 'HIER' ;
        $herramientas->h_modelo = 'C221' ;
        $herramientas->h_nro_serie = '1234411';
        $herramientas->h_fecha_adquisicion =  Carbon::Parse('2019/05/04') ;
		$herramientas->save();

		$herramientas = new Herramienta;
        $herramientas->h_nombre = 'LLave Francesa' ;
        $herramientas->h_marca = 'HIER' ;
        $herramientas->h_modelo = 'Ac21' ;
        $herramientas->h_nro_serie = '351311';
        $herramientas->h_fecha_adquisicion =  Carbon::Parse('2019/05/04') ;
		$herramientas->save();

		$herramientas = new Herramienta;
        $herramientas->h_nombre = 'Carretilla' ;
        $herramientas->h_marca = 'Tramontina' ;
        $herramientas->h_modelo = 'EEAA11' ;
        $herramientas->h_nro_serie = '2116511';
        $herramientas->h_fecha_adquisicion =  Carbon::Parse('2019/05/04') ;
		$herramientas->save();
    }
}
