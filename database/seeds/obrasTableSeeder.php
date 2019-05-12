<?php

use Illuminate\Database\Seeder;
use App\Obra;
use Carbon\Carbon;

class ObrasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $obras = new Obra;
        $obras->nombre_proyecto = 'FP-UNA';
        $obras->cliente_id = 1;
        $obras->fecha_inicio = Carbon::Parse('2019/01/02');
        //$obras->fecha_fin = ;
        $obras->es_obra = 0;//0:es proyecto; 1:es obra
        $obras->save();

        $obras = new Obra;
        $obras->nombre_proyecto = 'FQ-UNA';
        $obras->cliente_id = 2;
        $obras->fecha_inicio = Carbon::Parse('2019/01/02');
        $obras->es_obra = 0;//0:es proyecto; 1:es obra
        $obras->save();

        $obras = new Obra;
        $obras->nombre_proyecto = 'FV-UNA';
        $obras->cliente_id = 3;
        $obras->fecha_inicio = Carbon::Parse('2019/01/02');
        $obras->es_obra = 0;//0:es proyecto; 1:es obra
        $obras->save();
    }
}
