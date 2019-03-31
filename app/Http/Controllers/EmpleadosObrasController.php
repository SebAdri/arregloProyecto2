<?php

namespace App\Http\Controllers;
use App\Empleado;
use App\Obra;
use Illuminate\Http\Request;


class EmpleadosObrasController extends Controller
{
    public function asignarEmpleadoObra(Request $request, $id)
    {
    	$empleado = Empleado::findOrFail($id);
    	$id_obra = $request->obra;

    	// $validatedData = $empleado->validate([
     //    'id' => 'unique:obras']);



    	if (! $empleado->obras->contains($id_obra)) 
    	{
    		$empleado->obras()->attach($id_obra);
    		return redirect()->route('empleados.create'); 
		}
    }


}



