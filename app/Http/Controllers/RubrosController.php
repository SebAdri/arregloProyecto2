<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FamiliaRubro;
use App\Rubro;
use App\Material;

class RubrosController extends Controller
{

    function __construct()
    {
        // 
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $mano_obra = str_replace(',','.', str_replace('.','', $request->input('mano_obra')));

        $rubro = new Rubro;
        $rubro->nombre =  $request->nombre;
        $rubro->unidad_medida =  $request->unidad_medida;
        $rubro->mano_obra =  $mano_obra;
        $rubro->familia_rubro_id = $request->familia_rubro_id;
        $rubro->save();

// dd($request->all());


        return redirect()->route('rubros.create'); 
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
