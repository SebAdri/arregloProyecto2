<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rubro;
use App\Material;
use App\Obra;
use App\Plano;
use App\Presupuesto;

class CalculoCostoController extends Controller
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
        $rubros = Rubro::where('estado',1)->get();
        $id_obra = 2;
        $obras = Obra::find($id_obra);
        $planos = $obras->planos;
        $presupuestos = Presupuesto::where('obra_id', $id_obra)->get()[0];
        // dd($presupuestos);
         // dd($rubros);
        // dd($obras->planos);
        // dd($obras->count());
        //json_encode($rubros);
        // $rubros = Rubro::Find(1);        


        //return $rubros->materiales()->get();
        return view('calculoCosto.create2', compact('rubros', 'id_obra', 'obras', 'planos', 'presupuestos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //$parameters = \Request::segment(2);
         // dd($id_obra);
          // dd($request);
          // dd($request->all());

         //dd(Input::get('plano_seleccionado'));
        
         // dd($request->plano_seleccionado);
        
        if ($request->submitRubro) {
            // dd($request->all());
            $existeObraConRubros = DB::table('planos_rubros')->where([
                                                    ['plano_id', '=', $request->plano_seleccionado]
                                                ])->exists();
            if ($existeObraConRubros) {
               DB::table('planos_rubros')->where('plano_id', '=', $request->plano_seleccionado)->delete();

               foreach ($rubrosDeObras['checkRubroesAsignado'] as $rubrosObra) {
                   DB::table('planos_rubros')->insert([
                       ['plano_id' => $request->plano_seleccionado, 'rubro_id' => $rubrosObra]
                   ]);
               }
            }
            else
            {
               $rubrosDeObras = $request->all();
               foreach ($rubrosDeObras['checkRubroesAsignado'] as $rubrosObra) {
                   DB::table('planos_rubros')->insert([
                       ['plano_id' => $request->plano_seleccionado, 'rubro_id' => $rubrosObra]
                   ]);
               }
            }
        }
        elseif ($request->submitCalculo) {
            // return "ENTRO POR CALCULO";

                 // dd(($request->all()) );
                 // dd($request->inputSuperficiePlano['planos'] );
                // dd(array_keys($plano) );
            $planos_rubros_areas = $request->inputSuperficiePlano;
            foreach (array_keys($planos_rubros_areas) as $plano_rubro_area) {
                    // dd($planos_rubros_areas[$plano_id]);
                    // dd($plano_rubro_area);
                    // ($mes, $día, $año) = split('[/.-]', $plano_id); cuando se pone entre corchete va separar por una / o por un -
                    $plano_rubro_id = explode("-", $plano_rubro_area);
                    $existePlanoConRubros = DB::table('planos_rubros')->where([
                                                    ['plano_id', '=', $plano_rubro_id[0]],
                                                    ['rubro_id', '=', $plano_rubro_id[1]]
                                                ])->exists();
                    if ($existePlanoConRubros) {
                        DB::table('planos_rubros')
                                    ->updateOrInsert(
                                        ['plano_id' => $plano_rubro_id[0], 'rubro_id' => $plano_rubro_id[1]],//array que valida where
                                        ['area' => $planos_rubros_areas[$plano_rubro_area]]//array que setea
                                    );
                    }
                    else
                    {
                       return 'No existe plano y rubro';
                    }
            }

            //Aqui guardamos el presupuesto
            if (isset($request->beneficio) && isset($request->costo_total_obra)) {
                $existePresupuestoConObra = DB::table('presupuestos')->where([
                                                    ['obra_id', '=', $request->id_obra],
                                                ])->exists();
                if ($existePresupuestoConObra) {
                    // dd($request->all());
                    Presupuesto::where('obra_id', $request->id_obra)
                              ->update(['iva' => $request->iva, 
                                       'beneficio' => $request->beneficio,
                                       'costo_total_obra' => $request->costo_total_obra]);
                }
                else
                {
                    $presupuesto = new Presupuesto;
                    $presupuesto->obra_id = $request->id_obra;
                    $presupuesto->iva = $request->iva;
                    $presupuesto->beneficio = $request->beneficio;
                    $presupuesto->costo_total_obra = $request->costo_total_obra;
                    $presupuesto->save();
                }
            }
            

        }

        return redirect()->route('documentos.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
