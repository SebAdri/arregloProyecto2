<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rubro;
use App\Material;
use Illuminate\Support\Facades\DB;
use App\Obra;

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
        $rubros = Rubro::where('estado',1)->paginate(15);
        $id_obra = 2;
        $obras = Obra::find($id_obra);
        // dd($obras);
        // dd($obras->count());
        //json_encode($rubros);
        // $rubros = Rubro::Find(1);        


        //return $rubros->materiales()->get();
        return view('calculoCosto.create', compact('rubros', 'id_obra', 'obras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_obra)
    {
         //$parameters = \Request::segment(2);
         // dd($id_obra);
         // dd($request);
         // dd($request->all());
        $rubrosDeObras = $request->all();
         $existeObraConRubros = DB::table('obras_rubros')->where([
                                                ['obra_id', '=', $id_obra]
                                            ])->exists();
         if ($existeObraConRubros) {
            DB::table('obras_rubros')->where('obra_id', '=', $id_obra)->delete();

            foreach ($rubrosDeObras['checkRubroesAsignado'] as $rubrosObra) {
                DB::table('obras_rubros')->insert([
                    ['obra_id' => $id_obra, 'rubro_id' => $rubrosObra]
                ]);
            }
         }
         else
         {
            foreach ($rubrosDeObras['checkRubroesAsignado'] as $rubrosObra) {
                DB::table('obras_rubros')->insert([
                    ['obra_id' => $id_obra, 'rubro_id' => $rubrosObra]
                ]);
            }
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
