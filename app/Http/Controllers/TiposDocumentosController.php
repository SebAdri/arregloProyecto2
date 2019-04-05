<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoDocumento;
use App\Http\Requests\TiposDocumentosRequest;


class TiposDocumentosController extends Controller
{
    function __construct()
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos_documentos = TipoDocumento::all();
        // dd($tipos_documentos->all());

        return view('tipos_documentos.create', compact('tipos_documentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TipoDocumento::create($request->all());
        return redirect()->route('tipos_documentos.create');
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
        $tipos_documentos =  TipoDocumento::findOrFail($id);
        return view('tipos_documentos.edit', compact('tipos_documentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TiposDocumentosRequest $request, $id)
    {
        $tipos_documentos = TipoDocumento::findOrFail($id);
        $tipos_documentos->update($request->all());

        return redirect()->route('tipos_documentos.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipos_documentos = TipoDocumento::findOrFail($id);
        
        $tipos_documentos->delete();

        return redirect()->route('tipos_documentos.create');
    }
}
