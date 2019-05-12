<?php

use Illuminate\Database\Seeder;
use App\Cliente;
use Carbon\Carbon;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientes = new Cliente;
        $clientes->id = 1;
        $clientes->nombre = 'RUPERTO GONZALEZ';
        $clientes->cedula = 4411224;
        $clientes->ruc = '4411224-5';
        $clientes->fecha_inscripcion = Carbon::parse('2019/01/05');
        $clientes->direccion = 'Ruta nro 2 calle por ahi';
        $clientes->telefono = '085471632';
        $clientes->email = 'mycorreofalso@gmail.com';
        $clientes->estado = 1;
		$clientes->save();

        $clientes = new Cliente;
        $clientes->id = 2;
        $clientes->nombre = 'RUPERTINA GONZALEZ';
        $clientes->cedula = 1234774;
        $clientes->ruc = '1234774-5';
        $clientes->fecha_inscripcion = Carbon::parse('2019/01/05');
        $clientes->direccion = 'Ruta nro 1 calle por ahi';
        $clientes->telefono = '085471632';
        $clientes->email = 'mycorreofalso2@gmail.com';
        $clientes->estado = 1;
		$clientes->save();

        $clientes = new Cliente;
        $clientes->id = 3;
        $clientes->nombre = 'CIRILO PEREZ';
        $clientes->cedula = 1234775;
        $clientes->ruc = '1234775-5';
        $clientes->fecha_inscripcion = Carbon::parse('2019/01/05');
        $clientes->direccion = 'Ruta nro 1 calle por ahi';
        $clientes->telefono = '085471632';
        $clientes->email = 'mycorreofalso3@gmail.com';
        $clientes->estado = 1;
		$clientes->save();

	}
}
