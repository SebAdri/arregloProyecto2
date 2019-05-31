<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        // dd($request->all());
        if ($request->submitAvance) {
            $planos_rubros_progresos = $request->inputProgreso;
            foreach (array_keys($planos_rubros_progresos) as $plano_rubro_progreso) {
                    $plano_rubro_id = explode("-", $plano_rubro_progreso);
                    $existePlanoConRubros = DB::table('planos_rubros')->where([
                                                    ['plano_id', '=', $plano_rubro_id[0]],
                                                    ['rubro_id', '=', $plano_rubro_id[1]]
                                                ])->exists();
                    if ($existePlanoConRubros) {
                        DB::table('planos_rubros')
                                    ->updateOrInsert(
                                        ['plano_id' => $plano_rubro_id[0], 'rubro_id' => $plano_rubro_id[1]],//array que valida where
                                        ['progreso' => $planos_rubros_progresos[$plano_rubro_progreso]]//array que setea
                                    );
                    }
                    else
                    {
                       return 'No existe plano y rubro';
                    }
            }
            return redirect()->route('obras.index');
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
