<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Plano;

class PlanosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plano = new Plano;
        $plano->nombre = 'Planta Baja';
        $plano->cliente_id = 2;
        $plano->fecha = Carbon::Parse('2019/05/19');
        $plano->obra_id = 2; 
        $plano->save();  

        $plano = new Plano;
        $plano->nombre = 'Planta Alta';
        $plano->cliente_id = 2;
        $plano->fecha = Carbon::Parse('2019/05/19');
        $plano->obra_id = 2; 
        $plano->save();  
        
    }
}
