<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Herramienta;
use App\Maquinaria;
use App\Material;
use App\Obra;

class AlmacenGeneralController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth']); 
    }
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
        $herramientas = Herramienta::all();
        $maquinarias = Maquinaria::all();
        $materiales = Material::all();
        $obras = Obra::all();
        // dd($materiales );
        return view('almacenGeneral.create',compact('herramientas','maquinarias','materiales','obras'));
        //return view('almacenGeneral.almacen');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->asignarHerramientaObra($request, $request->obra_id);
        return redirect()->route('almacenGeneral.create'); 
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

    public function asignarHerramientaObra(Request $request, $id)
    {
        $heramientasAsignadas = $request->all();
        $id_obra = $request->obra_id;
        //$cantidad_solicitada =$request->cantidad_solicitada;
        foreach ($heramientasAsignadas['checkHerramientasAsignado'] as $herramientasAsignado) {
            $existeEnInventario = DB::table('inventario')->where([
                                                ['herramienta_id', '=', $herramientasAsignado],
                                                ['obra_id', '=', $id_obra],
                                            ])->exists();
            //verificamos primeramente que exista la herramienta asignada a una obra
            if ($existeEnInventario) {

                //obtenemos el material en caso de que exista
                //$mat = DB::table('inventario')->where([
                //                                ['herramienta_id', '=', $herramientasAsignado],
                //                                ['obra_id', '=', $id_obra]
                //                            ])->get();

                $herramienta = Herramienta::findOrFail($herramientasAsignado);
                $herramienta->h_ubicacion = $id_obra;
                $herramienta->save();
                //calculamos el nuevo stock
                // dd($mat);
                //dd($mat[0]->cantidad_disponible);

                //$cantidad_actual = intval($mat[0]->cantidad_disponible) - intval($cantidad_solicitada);
                //y actualizamosel registro en cuestion
                $herramienta = DB::table('inventario')->where([
                                               ['herramienta_id', '=', $herramientasAsignado],
                                               ['obra_id', '=', $id_obra]
                                           ])->update(['obra_id' => $id_obra]);
            }
            else
            {
                //en caso contrario insertamos
                DB::table('inventario')->insert([
                    ['herramienta_id' => $herramientasAsignado,
                     'obra_id' => $id_obra
                     //'cantidad_disponible' => $cantidad_solicitada
                    ]
                ]);
                
                //y actualizamos a tabla de herrramienta
                $herramienta = Herramienta::findOrFail($herramientasAsignado);
                $herramienta->h_ubicacion = $id_obra;
                $herramienta->save();
            }
        }
        return redirect()->route('almacenGeneral.create'); 

        /* Primera idea
        $herramientasAsignadas = $request->all();
        $id_obra = $request->obra_id;
        // dd($id ? : 'asd');
        foreach ($herramientasAsignadas['checkHerramientasAsignado'] as $herramientaAsignada) {
            $herramienta = Herramienta::findOrFail($herramientaAsignada);
        // dd($herramienta->obras()->where('herramienta_id', $herramientaAsignada)->exists());
            if ($herramienta->obras()->where('herramienta_id', $herramientaAsignada)->exists())
            {
                //dd($id_obra);   
                $herramienta->obras()->updateExistingPivot($herramienta->id, ['obra_id' => $id_obra]);;
            }
            else
            {
                $herramienta->obras()->attach($id_obra);
            }
        }*/
    }

    public function asignarMaquinariaObra(Request $request, $id)
    {
        $maquinariasAsignadas = $request->all();
        $id_obra = $request->obra_id;
        //$cantidad_solicitada =$request->cantidad_solicitada;
        foreach ($maquinariasAsignadas['checkMaquinariasAsignado'] as $maquinariasAsignado) {
            $existeEnInventario = DB::table('inventario')->where([
                                                ['maquinaria_id', '=', $maquinariasAsignado],
                                                ['obra_id', '=', $id_obra],
                                            ])->exists();
            //verificamos primeramente que exista la herramienta asignada a una obra
            if ($existeEnInventario) {

                //obtenemos la maquinaria en caso de que exista
                //$mat = DB::table('inventario')->where([
                //                                ['maquinaria_id', '=', $maquinariasAsignado],
                //                                ['obra_id', '=', $id_obra]
                //                            ])->get();

                $maquinaria = Maquinaria::findOrFail($maquinariasAsignado);
                $maquinaria->h_ubicacion = $id_obra;
                $maquinaria->save();
                //calculamos el nuevo stock
                // dd($mat);
                //dd($mat[0]->cantidad_disponible);

                //$cantidad_actual = intval($mat[0]->cantidad_disponible) - intval($cantidad_solicitada);
                //y actualizamosel registro en cuestion
                $maquinaria = DB::table('inventario')->where([
                                               ['maquinaria_id', '=', $maquinariasAsignado],
                                               ['obra_id', '=', $id_obra]
                                           ])->update(['obra_id' => $id_obra]);
            }
            else
            {
                //en caso contrario insertamos
                DB::table('inventario')->insert([
                    ['maquinaria_id' => $maquinariasAsignado,
                     'obra_id' => $id_obra
                     //'cantidad_disponible' => $cantidad_solicitada
                    ]
                ]);
                
                //y actualizamos a tabla de herrramienta
                $maquinaria = Maquinaria::findOrFail($maquinariasAsignado);
                $maquinaria->h_ubicacion = $id_obra;
                $maquinaria->save();
            }
        }
        return redirect()->route('almacenGeneral.create'); 

        /* Primera idea
        $maquinariasAsignadas = $request->all();
        $id_obra = $request->obra_id;        
        foreach ($maquinariasAsignadas['checkMaquinariasAsignado'] as $maquinariaAsignada) {
            $maquinaria = Maquinaria::findOrFail($maquinariaAsignada);
            if ($maquinaria->obras()->where('maquinaria_id', $maquinariaAsignada)->exists()) 
            {
                //dd($id_obra);   
                $maquinaria->obras()->updateExistingPivot($maquinaria->id, ['obra_id' => $id_obra]);;
            }
            else
            {
                $maquinaria->obras()->attach($id_obra);
            }
        }
        return redirect()->route('almacenGeneral.create'); */
        
    }

    public function asignarMaterialObra(Request $request, $id)
    {
        dd($request->all());
        $materialesAsignadas = $request->all();
        $id_obra = $request->obra_id;
        $cantidad_solicitada =$request->cantidad_solicitada;
        foreach ($materialesAsignadas['checkMaterialesAsignado'] as $materialesAsignado) {
            $existeEnInventario = DB::table('assigned_materiales')->where([
                                                ['material_id', '=', $materialesAsignado],
                                                ['obra_id', '=', $id_obra],
                                            ])->exists();
            //verificamos primeramente que exista el material en dicha obra
            if ($existeEnInventario) {

                //obtenemos el material en caso de que exista
                $mat = DB::table('assigned_materiales')->where([
                                                ['material_id', '=', $materialesAsignado],
                                                ['obra_id', '=', $id_obra],
                                            ])->get();
                //calculamos el nuevo stock
                // dd($mat);
                //dd($mat[0]->cantidad_disponible);

                $cantidad_actual = intval($mat[0]->cantidad_disponible) - intval($cantidad_solicitada);
                //y actualizamosel registro en cuestion
                $material = DB::table('assigned_materiales')->where([
                                                ['material_id', '=', $materialesAsignado],
                                                ['obra_id', '=', $id_obra]
                                            ])->update(['cantidad_disponible' => $cantidad_actual]);
            }
            else
            {
                //en caso contrario insertamos
                DB::table('assigned_materiales')->insert([
                    ['material_id' => $materialesAsignado,
                     'obra_id' => $id_obra,
                     'cantidad_disponible' => $cantidad_solicitada
                    ]
                ]);
            }
        }
        return redirect()->route('almacenGeneral.create'); 
    }
}
