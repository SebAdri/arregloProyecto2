<?php

namespace App\Http\Controllers;

use App\Herramienta;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHerramientaRequest;

class HerramientasController extends Controller
{
    function __construc()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware(['auth', 'roles:herraMant']); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $herramientas = Herramienta::All();
        return view('herramientas.create', compact('herramientas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHerramientaRequest $request)
    {
        Herramienta::create($request->all());
        return redirect()->route('herramientas.create'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Herramnienta  $herramnienta
     * @return \Illuminate\Http\Response
     */
    public function show(Herramnienta $herramnienta)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Herramnienta  $herramnienta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $herramienta = Herramienta::findOrFail($id);
        return view('herramientas.edit', compact('herramienta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Herramnienta  $herramnienta
     * @return \Illuminate\Http\Response
     */
    public function update(StoreHerramientaRequest $request, $id)
    {
        $herramienta = Herramienta::findOrFail($id);
        $herramienta->update($request->all());
        return redirect()->route('herramientas.create');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Herramnienta  $herramnienta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $herramnienta = Herramienta::findOrFail($id);
        $herramnienta->update([
            $herramnienta->h_estado = 0
        ]);
        return redirect()-> route('herramientas.create');
    }
}
