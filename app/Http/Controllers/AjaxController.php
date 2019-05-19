<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rubro;
use App\Obra;

class AjaxController extends Controller
{
    public function jsonRubrosMateriales(){
        $id_obra = 2;
        $obras = Obra::find($id_obra);
        $planos = $obras->planos[0]->rubros;
        //dd($planos);
    	// $rubros = Rubro::where('estado',1)->get();
    	//$rubros = $obras->planos->rubros;

        $data['data'] = array();


        foreach ($obras->planos as $plano) {
	        foreach ($plano->rubros as $rubro) {
	        	$arrayAux = array();
	        	$arrayAux['id'] = $rubro->id;
	        	$arrayAux['nombre'] = $rubro->nombre;
	        	$arrayAux['mano_obra'] = $rubro->mano_obra;
	        	$arrayAux['unidad_medida'] = $rubro->unidad_medida;
	        	$arrayAux['familia_rubro_id'] = $rubro->familia_rubro_id;
	        	$arrayAux['estado'] = $rubro->estado;
	        	// $arrayAux[] = $rubro;No se por que no funciona asi, debo especificar uno por uno los campos de rubro
	        	$i = 0;
	        		// dd($rubro);
	        	foreach ($rubro->materiales as $materialRubro) {
	        		// $name = 'Material'.strval($i);
	        		$arrayAux['material'][] = $materialRubro;
	        		$i += 1;
	        		// return($materialRubro->pivot->cantidad_material);
	        		// return($materialRubro);//aqui se tiene el material que se especifica en la tabla media mas el pivot
	        		// return($materialRubro->get());//aqui se tiene todos los registros de la otra tabla en relacion(material)
	        	}
	        		// return($arrayAux);
	        	$data['data'][] = $arrayAux;
	        }
        }
        return($data);
        //return view('calculoCosto.create2', compact('rubros', 'id_obra', 'obras'));
        // foreach ($bandejaEntrada as $loQueMePiden) {
        //     $arrayAux = array();
        //     $arrayAux['id'] = $loQueMePiden->id;
        //     // dd($loQueMePiden->detallePedido);
        //     foreach ($loQueMePiden->detallePedido as $detalle) {
                
        //         $arrayAux['materiales'][] = $detalle->materiales; 
        //     }
        //     $arrayAux['fecha_pedido'] = $loQueMePiden->fecha_pedido;
        //     $arrayAux['fecha_recibido'] = $loQueMePiden->fecha_recibido;
        //     $arrayAux['nombre_proyecto'] = $loQueMePiden->bandejaEnviado;
        //     $arrayAux['observacion'] = $loQueMePiden->observacion;
        //     // dd($loQueMePiden->bandejaEnviado);
        //     $data['data'][]=$arrayAux;
        // }
        // return $data;
    }
}
