<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rubro;
use App\Obra;
use App\Inventario;
use App\Plano;


class AvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        if ($request->submitAvance) {
            $planos_rubros_progresos = $request->inputProgreso;

            // dd($request->all());

            foreach (array_keys($planos_rubros_progresos) as $plano_rubro_progreso) {
                    $plano_rubro_id = explode("-", $plano_rubro_progreso);
                    $existePlanoConRubros = DB::table('planos_rubros')->where([
                                                    ['plano_id', '=', $plano_rubro_id[0]],
                                                    ['rubro_id', '=', $plano_rubro_id[1]]
                                                ])->exists();
                    if ($existePlanoConRubros) {
                        // dd($request->fecha_avance);
                        DB::table('planos_rubros')
                                    ->updateOrInsert(
                                        ['plano_id' => $plano_rubro_id[0], 'rubro_id' => $plano_rubro_id[1]],//array que valida where
                                        ['progreso' => $planos_rubros_progresos[$plano_rubro_progreso], 
                                        'fecha_control' => $request->fecha_avance]//array que setea
                                    );
                    }
                    else
                    {
                       return 'No existe plano y rubro';
                    }
                    // dd($plano_rubro_progreso[0]);
                    $plano = Plano::find($plano_rubro_progreso[0]);
                    // dd($plano);
            }

            $this->actualizarInventario($planos_rubros_progresos, $plano->obra_id);
            return redirect()->route('avance.show',$plano->obra_id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rubros = Rubro::where('estado',1)->get();
        $obras = Obra::find($id);
        $planos = $obras->planos;
        $planos_id = $planos->pluck('id');
        $plano_log = DB::table('planos_rubros_log')->select('plano_id','rubro_id', DB::raw('SUM(progreso) as total_sales'))->whereIN('plano_id',$planos_id)->groupBy('plano_id','rubro_id')->get();
        // dd($plano_log);
             
        return view('obras.homeObra', compact('rubros', 'obras', 'planos', 'plano_log'));
        // dd($id);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function actualizarInventario($planos_rubros_progresos, $obra_id)
    {
        // dd($planos_rubros_progresos);
        foreach (array_keys($planos_rubros_progresos) as $plano_rubro_progreso) {
            // dd($plano_rubro_progreso[2]);
            $rubro = Rubro::find($plano_rubro_progreso[2]);
            // $cantidad_necesaria_material[$material->m_descripcion]['cantidad'] = array();
            foreach ($rubro->materiales as $material) {
                $cantidad_necesaria_material[$material->m_descripcion]['cantidad'] = $material->pivot->cantidad_material;
                $cantidad_necesaria_material[$material->m_descripcion]['id']= $material->id;
            }
            // dd($cantidad_necesaria_material);
            // $obra_id = Plano::find($plano_rubro_progreso[0])->obras->id;
            }

            foreach ($cantidad_necesaria_material as $cantidad_material) {
                // dd($cantidad_material);
                Inventario::where('obra_id', $obra_id)
                          ->where('material_id', $cantidad_material['id'])
                          ->update(['cantidad_actual' => $cantidad_material['cantidad']]);
            }
    }
}
