<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Profesion;

class ProfesionesController extends Controller
{
     function __construct()
    {
        //$this->middleware(['auth', 'roles:rubrMant']); 
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
        //
        $profesiones = Profesion::where('estado', '1')->get();
        //dd($rubros);
        return view('profesiones.create', compact('profesiones'));
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
        Profesion::create($request->all());
        return redirect()->route('profesiones.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function show(Profesion $rubro)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $profesiones =  Profesion::findOrFail($id);
        return view('profesiones.edit', compact('profesiones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $profesiones = Profesion::findOrFail($id);
        $profesiones->update($request->all());

        return redirect()->route('profesiones.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
        $profesion = Profesion::findOrFail($id);
        
        $profesion->update([ $profesion->estado = 0 ]);

        return redirect()->route('profesiones.create');
    }
}
