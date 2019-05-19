<?php

use Illuminate\Database\Seeder;
use App\Material;

class MaterialesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $material = new Material;
        $material->m_descripcion = 'Caño PVC 40 mm';
        $material->m_unidad_medida = 'ml';
        $material->m_costo ='15000';
        $material->m_estado = 1; //activo:1 desactivo:0
        $material->save();

        $material = new Material;
        $material->m_descripcion = 'Zapata';
        $material->m_unidad_medida = 'm3';
        $material->m_costo ='500000';
        $material->m_estado = 1; //activo:1 desactivo:0
        $material->save();

        $material = new Material;
        $material->m_descripcion = 'Zocalo de cemento alisado';
        $material->m_unidad_medida = 'ml';
        $material->m_costo ='5520';
        $material->m_estado = 1; //activo:1 desactivo:0
        $material->save();

        $material = new Material;
        $material->m_descripcion = 'Zocalo de Parquet';
        $material->m_unidad_medida = 'ml';
        $material->m_costo ='9000';
        $material->m_estado = 1; //activo:1 desactivo:0
        $material->save();

        $material = new Material;
        $material->m_descripcion = 'Arena';
        $material->m_unidad_medida = 'm3';
        $material->m_costo ='5000';
        $material->m_estado = 1; //activo:1 desactivo:0
        $material->save();

		$material = new Material;
        $material->m_descripcion = 'Cemento';
        $material->m_unidad_medida = 'kg';
        $material->m_costo ='8000';
        $material->m_estado = 1; //activo:1 desactivo:0
        $material->save();        
    }
}
