<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obra;
use App\Cliente;
use App\Empleado;

class ObrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware(['auth', 'roles:obras']);

    }
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
        $obras = Obra::all();
        $clientes = Cliente::all();
        
        return view('obras.create', compact('obras','clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Obra::create($request->all());

        return redirect()->route('obras.create'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //muestra empleados de obra
    {
        $empleadosObras = Obra::find($id)->empleados()->get();
        $obra = Obra::find($id);
        $empleados = Empleado::all();

        return view('obras.show', compact('empleadosObras','obra','empleados'));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obra = Obra::findOrFail($id);
        $clientes = Cliente::all();

        return view('obras.create', compact('obra','clientes'));
         // return view('obras.create', compact('clientes'));
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
        $obra = Obra::findOrFail($id);
        $obra->update($request->all());

        return redirect()->route('obras.create');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function desvincular(Obra $obra, $id) //desvincula empleado de obra
    {
        $empleado = Empleado::findOrFail($id);
        $obra->empleados()->detach($empleado);
        $id_obra = $obra->id;

       return redirect()->route('obras.show', $obra->id);
   
    }
        
}
