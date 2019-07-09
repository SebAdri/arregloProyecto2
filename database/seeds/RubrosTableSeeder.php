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
        $rubro = New Rubro;
        $rubro->nombre = 'Relleno y Compactación';
        $rubro->mano_obra = 26400;
        $rubro->unidad_medida =  'm3';
        $rubro->familia_rubro_id = 1;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Cartel de Obra (de 1.40x2.08m con marco metálico y lona, a retirar y sin colocación)';
        $rubro->mano_obra = 0;
        $rubro->unidad_medida =  'un';
        $rubro->familia_rubro_id = 1;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Vallado de Obra';
        $rubro->mano_obra = 0;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 1;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Zapata fck=18MPa';
        $rubro->mano_obra = 500000;
        $rubro->unidad_medida =  'm3';
        $rubro->familia_rubro_id = 2;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Viga fck=21MPa';
        $rubro->mano_obra = 600000;
        $rubro->unidad_medida =  'm3';
        $rubro->familia_rubro_id = 2;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Losa fck=21MPa';
        $rubro->mano_obra = 600000;
        $rubro->unidad_medida =  'm3';
        $rubro->familia_rubro_id = 2;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Encadenado Interior 13x20 en PB';
        $rubro->mano_obra = 30000;
        $rubro->unidad_medida =  'ml';
        $rubro->familia_rubro_id = 2;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Encadenado 13x30 cm';
        $rubro->mano_obra = 30000;
        $rubro->unidad_medida =  'ml';
        $rubro->familia_rubro_id = 2;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Escalera de HºAº(15 escalones de 0.30x1.10 y 1 descanso)';
        $rubro->mano_obra = 78000;
        $rubro->unidad_medida =  'C/ES';
        $rubro->familia_rubro_id = 2;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Losa Rap h=12+5=17cm, luces hasta 4,50cm(1:2:3)';
        $rubro->mano_obra = 28000;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 2;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Losa Rap h=20+4=24cm, luces mayor a 4,5(1:2:3)';
        $rubro->mano_obra = 32000;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 2;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Losa Listalosa';
        $rubro->mano_obra = 26000;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 2;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Cimiento PBC con cal(1/2:1:4)';
        $rubro->mano_obra = 26000;
        $rubro->unidad_medida =  'm3';
        $rubro->familia_rubro_id = 3;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Cimiento PBC sin cal(1/2:1:4)';
        $rubro->mano_obra = 26000;
        $rubro->unidad_medida =  'm3';
        $rubro->familia_rubro_id = 3;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Arena Lavada';
        $rubro->mano_obra = 26000;
        $rubro->unidad_medida =  'm3';
        $rubro->familia_rubro_id = 3;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Hormigón Ciclopeo(1:3:6)';
        $rubro->mano_obra = 126000;
        $rubro->unidad_medida =  'm3';
        $rubro->familia_rubro_id = 3;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'De Nivelación con ladrillo común';
        $rubro->mano_obra = 33000;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 4;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Nivelación de 0.30m armada(1:4) con cemento Yguazú';
        $rubro->mano_obra = 36000;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 4;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Nivelación de 0.45m de ancho(1:2:8) con cemento Yguazú';
        $rubro->mano_obra = 39000;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 4;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'De Elevación con ladrillo común';
        $rubro->mano_obra = 22200;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 4;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'De Elevación a la vista';
        $rubro->mano_obra = 22200;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 4;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'De Elevación con cemento Articor a la vista';
        $rubro->mano_obra = 22200;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 4;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'De Elevación 0.20m(1:2:10) con cemento Yguazú';
        $rubro->mano_obra = 32000;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 4;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'De Elevación 0.07m(1:2:10) con cemento Yguazú y junta de 1.5cm';
        $rubro->mano_obra = 15000;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 4;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'De Elevación 0.15m(1:2:8) con cemento Yguazú';
        $rubro->mano_obra = 18000;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 4;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'De Elevación 0.15m(1:2:8) con cemento Yguazú 1 cara vista';
        $rubro->mano_obra = 18000;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 4;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'De Elevación 0.15m(1:2:8)';
        $rubro->mano_obra = 18000;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 4;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'De Elevación 0.20m(1:2:8)m';
        $rubro->mano_obra = 25000;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 4;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'De Elevación 0.20m(1:2:8)';
        $rubro->mano_obra = 25000;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 4;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'De machimbre con armazón de madera, no incluye corniza';
        $rubro->mano_obra = 30360;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 5;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Cemento Alisado';
        $rubro->mano_obra = 5520;
        $rubro->unidad_medida =  'm2';
        $rubro->familia_rubro_id = 6;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Calcáreo Base Gris';
        $rubro->mano_obra = 9000;
        $rubro->unidad_medida =  'ml';
        $rubro->familia_rubro_id = 6;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Madera 3/4 x 3';
        $rubro->mano_obra = 9000;
        $rubro->unidad_medida =  'ml';
        $rubro->familia_rubro_id = 6;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Alfombra';
        $rubro->mano_obra = 8400;
        $rubro->unidad_medida =  'ml';
        $rubro->familia_rubro_id = 6;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Cerámica Esmaltada';
        $rubro->mano_obra = 9000;
        $rubro->unidad_medida =  'ml';
        $rubro->familia_rubro_id = 6;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Mosaico Granilítico (base blanca pulido 10x30cm)';
        $rubro->mano_obra = 9000;
        $rubro->unidad_medida =  'ml';
        $rubro->familia_rubro_id = 6;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Mosaico Granilítico (base gris pulido 10x30cm)';
        $rubro->mano_obra = 9000;
        $rubro->unidad_medida =  'ml';
        $rubro->familia_rubro_id = 6;
        $rubro->save();

        $rubro = New Rubro;
        $rubro->nombre = 'Layota 28x10cm';
        $rubro->mano_obra = 9000;
        $rubro->unidad_medida =  'ml';
        $rubro->familia_rubro_id = 6;
        $rubro->save();
        /* rubros que creepara probar por sebas
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
        */
    }
}
