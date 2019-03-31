<?php

namespace App\Http\Controllers;

use App\Rubro;
use Illuminate\Http\Request;

class RubrosController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth', 'roles:rubrMant']); 
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
        $rubros = Rubro::all();
        //dd($rubros);
        return view('rubros.create', compact('rubros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Rubro::create($request->all());
        return redirect()->route('rubros.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function show(Rubro $rubro)
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
        $rubros =  Rubro::findOrFail($id);
        return view('rubros.edit', compact('rubros'));
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
        $rubros = Rubro::findOrFail($id);
        $rubros->update($request->all());

        return redirect()->route('rubros.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $rubros = Rubro::findOrFail($id);
        
        $rubros->delete();

        return redirect()->route('rubros.create');
    }
}
