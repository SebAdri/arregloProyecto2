<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Profesion;
use App\Obra;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateEmpleadoRequest;

class EmpleadosController extends Controller
{
    function __construct()
    {
        // $this->middleware(['auth', 'roles:emplMant']); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //este método ya se realiza en create, ya no es necesario implementar
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados = Empleado::all();
        $profesiones = Profesion::where('estado','1')->get();

        $obras = Obra::all();
        
        foreach ($empleados as $empleado) 
        {
            $empleadosObras[] = Empleado::find($empleado->id)->obras()->get();

        }

        return view('empleados.create', compact('empleados','profesiones','obras', 'empleadosObras'));
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
        Empleado::create($request->all());

        return redirect()->route('empleados.create'); 
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
        $empleado = Empleado::findOrFail($id);
        $profesiones = Profesion::all();
        return view('empleados.edit', compact('empleado','profesiones'));
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
        $empleado = Empleado::findOrFail($id);
        $empleado->update($request->all());

        return redirect()->route('empleados.create');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $empleado = Empleado::findOrFail($id);
        $empleado->update([
            $empleado->estado = 0
        ]);
        return redirect()-> route('empleados.create');
    }

}