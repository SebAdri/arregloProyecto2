<?php

namespace App\Http\Controllers;
use App\Obra;
use App\Inventario;
use App\Pedido;
use App\PedidoDetalle;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        // $this->middleware('auth'); 
        $this->middleware(['auth']); 

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
        $materialesCantidades = $request->input('materiales');
        $obra = $request->input('obra');
        $pedido= new Pedido;
        $pedido->obra_id = $obra;
        $pedido->save();
        foreach ($materialesCantidades as $materialCantidad) {
            $pedidoDetalle = new PedidoDetalle;
            $pedidoDetalle->material_id = $materialCantidad[0];
            $pedidoDetalle->cantidad =  $materialCantidad[1];
            $pedidoId = $pedido->id;
            $pedidoDetalle->pedido_id =$pedidoId;
            $pedidoDetalle->save();
            // $detalleCompra->cantidad_remitida=0;
        }
        // echo json_encode(1);
    }
    public function getMateriales(Request $material){
        dd($material);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obra = Obra::find($id);
        // $materiales =  Obra::findOrFail($id)->pedidos()->get();
        $pedido = $obra->pedidos()->where('p_estado', 1)->get();
        
        if (count($pedido)>0) {
            $materiales = Pedido::findOrFail($pedido[0]->id)->pedidoDetalle()->get();
            return view('almacen.almacen', compact('obra', 'materiales'));
        }else{
            return view('almacen.almacen', compact('obra'));
        }
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
