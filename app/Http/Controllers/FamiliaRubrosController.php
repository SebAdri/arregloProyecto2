<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\FamiliaRubro;
use App\Rubro;
use App\Material;

class FamiliaRubrosController extends Controller
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
        $fliaRubros = FamiliaRubro::all();
        $rubros = Rubro::where('estado','1')->get();
        $materiales = Material::all();

        foreach ($rubros as $rubro) 
        {
            // dd(Rubro::find($rubro->id)->materiales()->pivot->material_id);
            // $materialesRubros = Rubro::find($rubro->id)->materiales()->get();
            $materialesRubros[] = Rubro::find($rubro->id)->materiales()->get();
            // $materialesRubros[] = Rubro::find($rubro->id)->pivot;

        }

        return view('rubros.create', compact('fliaRubros', 'rubros', 'materiales', 'materialesRubros'));
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
        $rubro = Rubro::findOrFail($id);
        $fliaRubros = FamiliaRubro::all();

        return view('rubros.edit', compact('rubro','fliaRubros'));
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
        $rubro = Rubro::findOrFail($id);
        $rubro->update($request->all());

        return redirect()->route('rubros.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rubro = Rubro::findOrFail($id);
        $rubro->update([$rubro->estado = 0]);
        
        return redirect()-> route('rubros.create');
    }

    public function store(Request $request)
    {
        FamiliaRubro::create($request->all());

        return redirect()->route('rubros.create'); 
    }

    public function storeMateriales(Request $request)
    {
     $rubro = Rubro::findOrFail($request->rubro_id);
        $materiales = $request->materiales;
        $cantidades = $request->cantidades;
        
        // dd($request->all());

        if (!$rubro->materiales->contains($rubro->id)) {
            for($i=0; $i<count($materiales); $i++){
                $material_id = Material::where('m_descripcion', $materiales[$i])->get();
                // dd($material_id[0]->id);
                DB::table('material_rubro')->insert([
                    [
                        'material_id' => $material_id[0]->id,
                        'rubro_id' => $rubro->id,
                        'cantidad' => $cantidades[$i],
                    ]
                ]);

                // $rubro->materiales()->attach($rubro->id, [$cantidades[$i]]);
            }
        }else{

        }
        return redirect()->route('rubros.create'); 
    }

}
