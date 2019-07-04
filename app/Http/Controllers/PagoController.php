<?php

namespace App\Http\Controllers;
use App\Obra;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_obra= 1;
        return view('pago.pagos', compact('id_obra'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
           
    }
    /**
        * Recibe como parametro la obra y retorna los pagos de dicha obra
    */
    public function getPagoObra(Request $request){

        $obra = Obra::where('nombre_proyecto', $request->busqueda)->first();
        $documentos = $obra->documentos()->where('tipo_doc', 1)->first()->pagos()->get();
        for ($i=0; $i < count($documentos); $i++) { 
            if ($documentos[$i]->estado == 0) {
                $documentos[$i]->estado = '<td>Pendiente</td><td><a href="#"><button type=button>Generar Factura</button><a></td>';
            }elseif ($documentos[$i]->estado == 1) {
                $documentos[$i]->estado = '<td>Pagado</td><td><a href="#"><button type=button>Imprimir Factura</button><a></td>';
                # code...
            }
        }
        return $documentos;

        
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
