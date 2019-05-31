<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documento;
use App\TipoDocumento;
use App\Obra;

class DocumentosController extends Controller
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
        $cuotas = $request->cuotas;
        dd($cuotas);
        Documento::create($request->all());
        
        return redirect()->route('documentos.show', $request->obra_id); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_obra)
    {
        $tipo_documentos = TipoDocumento::all();
        $documentos = Documento::all();
        $obraDocumentos[] = Obra::findOrFail($id_obra)->documentos()->get();

        return view('documentos.create', compact('obraDocumentos', 'id_obra', 'tipo_documentos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documento = Documento::findOrFail($id);
        
        return view('documentos.edit', compact('documento'));
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
        $documento = Documento::findOrFail($id);
        $documento->update($request->all());

        return redirect()->route('documentos.show', $request->obra_id); 
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
