<?php

namespace App\Http\Controllers;
use App\Material;
use Illuminate\Http\Request;

class searchController extends Controller
{
	private $materiales = null;
	function __construct()
    {
        //el primer middleware es para que solo se pueda ingresar a la vista de users si esta autenticado
        // el segundo es para que solo el rol admin tenga acceso a Administrar Usuario
        // $this->middleware(['auth', 'roles:usr']); 
    }
	  public function getMateriales(Request $material){

	    if ($material->ajax()) {
	    	dd($material->material);
		    $materiales= Material::where('m_descripcion', 'LIKE', "%{$material->material}%")->get();

		    foreach ($materiales as $material) {
		        $html = '<p>'.$material->m_descripcion.'<p>';
		        response($html) ;
		        // $material->destroy();
		    }
	    	# code...
	    }
	    unset($materiales);
    }
}
