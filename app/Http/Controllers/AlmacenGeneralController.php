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
        }
    }

    public function asignarMaquinariaObra(Request $request, $id)
    {
        // dd($request);
        // $maquinaria = Maquinaria::findOrFail($id);
        // $id_obra = $request->obra_id;

        // if (! $maquinaria->obras->contains($id_obra)) 
        // {
        //     $maquinaria->obras()->attach($id_obra);
        //     // $maquinaria->obras()->updateExistingPivot($id, $id_obra);
        //     return redirect()->route('almacenGeneral.create'); 
        // }
        // else
        // {
        //     $maquinaria->obras()->detach($id_obra);
        //     return redirect()->route('almacenGeneral.create'); 
        // }
        $maquinariasAsignadas = $request->all();
        $id_obra = $request->obra_id;
        // dd($maquinariasAsignadas);
        // dd($id_obra);
        
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
        return redirect()->route('almacenGeneral.create'); 
        
    }

    public function asignarMaterialObra(Request $request, $id)
    {
        //dd($request->all());
        // dd($id);
        $materialesAsignadas = $request->all();
        $id_obra = $request->obra_id;
        $cantidad_solicitada =$request->cantidad_solicitada;
        foreach ($materialesAsignadas['checkMaterialesAsignado'] as $materialesAsignado) {
            // dd($materialesAsignado);
            // dd($id_obra);
            $existeMaterial = DB::table('assigned_materiales')->where([
                                                ['material_id', '=', $materialesAsignado],
                                                ['obra_id', '=', $id_obra],
                                            ])->exists();
            //User::where('email', '=', Input::get('email'))->exists()
            //verificamos primeramente que exista el material en dicha obra
            // dd($existeMaterial);

            if ($existeMaterial) {

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
                // dd($cantidad_actual);
                //dd('No esta vacio' . $materialesAsignado.' '.$id_obra.$ma);
            }
            else
            {
                // dd($materialesAsignado.$id_obra.$cantidad_solicitada);

                DB::table('assigned_materiales')->insert([
                    ['material_id' => $materialesAsignado,
                     'obra_id' => $id_obra,
                     'cantidad_disponible' => $cantidad_solicitada
                    ]
                ]);
                // dd('esta vacio');
            }
            // dd($ma);
        }
        return redirect()->route('almacenGeneral.create'); 

        //en materiales no debemos verificar si un material ya fue asignado a la misma obra
        // if (! $material->obras->contains($id_obra)) 
        // {
            // $material->obras()->attach($id_obra);
            // $material->obras()->updateExistingPivot($id, $id_obra);
            // return redirect()->route('almacenGeneral.create'); 
        //}
        // else
        // {
            // return redirect()->route('almacenGeneral.create'); 
        //}





        // $cantidad_actual = 0;
        // foreach ($materialesAsignadas['checkMaterialesAsignado'] as $materialesAsignado) {
        //     $material = Material::findOrFail($materialesAsignado);
        //     // dd($material);
        //     // dd($material->obras()->where('material_id', $materialesAsignado)->exists());
        //     foreach ($material->obras as $mat) {
        //         // dd($material->id);
        //         // dd($mat->pivot->cantidad_disponible);
        //         // dd($mat->pivot->cantidad_inicial);
        //         if ($mat->pivot->cantidad_disponible >= $cantidad_solicitada) {
        //             $cantidad_actual = intval($mat->pivot->cantidad_disponible) - intval($cantidad_solicitada);
        //             dd($material->obras()->where('material_id', $materialesAsignado)->exists()->where('obra_id', $id_obra)->exists());
        //             dd($cantidad_actual);
        //             if ($material->obras()->where('material_id', $materialesAsignado)->exists()->where('obra_id', $id_obra)->exists())
        //             {
        //                 //dd($id_obra); 
        //                 $material->obras()->updateExistingPivot($material->id, ['cantidad_disponible' => $cantidad_actual]);
        //                 //$user->roles()->attach($material->id, ['obra_id' => $id_obra,
        //                 //                                       'cantidad_inicial' => $cantidad_solicitada,
        //                 //                                        'cantidad_disponible' => $cantidad_actual]);
        //                 // $material->obras()->attach($id_obra, $request->cantidad_solicitada, $cantidad_actual);
        //             }
        //             else
        //             {
        //                 //$material->obras()->attach($id_obra, $request->cantidad_solicitada, $cantidad_actual);
        //                 $material->obras()->attach($material->id, ['obra_id' => $id_obra,
        //                                                        'cantidad_inicial' => $cantidad_solicitada,
        //                                                         'cantidad_disponible' => $cantidad_actual]);
        //                 // $material->obras()->attach($id_obra);
        //             }
        //         }
        //     }
        // }
    }
}
