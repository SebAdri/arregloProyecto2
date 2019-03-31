<?php

namespace App\Http\Controllers;

use App\Maquinaria;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMaquinariaRequest;

class MaquinariasController extends Controller
{
    function __construct()

    {
        $this->middleware(['auth', 'roles:maq']); 

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maquinarias = Maquinaria::all();
        return view('maquinarias.create', compact('maquinarias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Maquinaria::create($request->all());
        return redirect()->route('maquinarias.create'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function show(Maquinaria $maquinaria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $maquinaria = Maquinaria::findOrFail($id);
        return view('maquinarias.edit', compact('maquinaria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $maquinaria = Maquinaria::findOrFail($id);
        $maquinaria->update($request->all());
        return redirect()->route('maquinarias.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maquinaria = Maquinaria::findOrFail($id);
        $maquinaria->update([
            $maquinaria->ma_estado = 0
        ]);
        return redirect()->route('maquinarias.create');
    }
}
