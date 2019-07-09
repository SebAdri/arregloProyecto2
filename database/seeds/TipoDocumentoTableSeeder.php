<?php

use Illuminate\Database\Seeder;
use App\TipoDocumento;

class TipoDocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoDoc = new TipoDocumento;
        $tipoDoc->nombre = 'Contrato';
        $tipoDoc->descripcion = 'Contrato';
        $tipoDoc->tipo_documento_id ='1';
        $tipoDoc->save();

        $tipoDoc = new TipoDocumento;
        $tipoDoc->nombre = 'Plano';
        $tipoDoc->descripcion = 'Plano';
        $tipoDoc->tipo_documento_id ='2';
        $tipoDoc->save();
    }
}
