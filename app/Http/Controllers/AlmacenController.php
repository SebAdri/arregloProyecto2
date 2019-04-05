<?php

namespace App\Http\Controllers;
use App\Obra;
use App\Inventario;
use App\Pedido;
use App\Material;
use App\OrdenCompra;
use App\PedidoDetalle;
use App\DetalleCompra;
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
        $compra= new OrdenCompra;
        $compra->obra_id = $obra;
        $compra->save();
        foreach ($materialesCantidades as $materialCantidad) {
            $compraDetalle = new DetalleCompra;
            $compraDetalle->material_id = $materialCantidad[0];
            $compraDetalle->cantidad =  $materialCantidad[1];
            $compraDetalle->orden_compra_id =$compra->id;
            $compraDetalle->save();
            // $detalleCompra->cantidad_remitida=0;
        }
        echo json_encode(1);
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
        $compra = $obra->compra()->where('oc_estado', 1)->get();
        $inventario = $obra->inventario()->get();

        if (count($compra)>0) {
            $materiales = OrdenCompra::findOrFail($compra[0]->id)->detalleCompra()->get();
            return view('almacen.almacen', compact('obra', 'materiales', 'inventario'));
        }else{
            return view('almacen.almacen', compact('obra', 'inventario'));
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

    function updatePedido(Request $request){    
        $compra = OrdenCompra::where('obra_id', $request->input('obra'))->get();
        $detalleCompra = DetalleCompra::where('orden_compra_id', $compra[0]->id)->where('material_id' , $request->input('articulo'))->get();
        $cantidadInicialSolicitada = $detalleCompra[0]->cantidad;
        $cantidadConfirmada = $request->input('cantidad');
        // Pedido : OrdenEgreso
        if ($cantidadInicialSolicitada > $cantidadConfirmada) {
            $ordenEgresoExists = Pedido::where('orden_compra_id',$compra[0]->id);
            if (count($ordenEgresoExists)>0) {
                $ordenEgreso = Pedido::where('orden_compra_id',$compra[0]->id);
                $detalleEgreso = new PedidoDetalle;
                $detalleEgreso->material_id = $request->input('articulo');
                $detalleEgreso->cantidad = $cantidadInicialSolicitada - $cantidadConfirmada;
                $detalleEgreso->pedido_id = $ordenEgreso[0]->id;
                $detalleEgreso->save();
            }else{
                $ordenEgreso= new Pedido;
                $ordenEgreso->obra_id = $request->input('obra');
                $ordenEgreso->orden_compra_id = $compra[0]->id;
                $ordenEgreso->save();
                $detalleEgreso = new PedidoDetalle;
                $detalleEgreso->material_id = $request->input('articulo');
                $detalleEgreso->cantidad = $cantidadInicialSolicitada - $cantidadConfirmada;
                $detalleEgreso->pedido_id = $ordenEgreso->id;
                $detalleEgreso->save();

            }

            // $pedido->save();
        }else{
            $datalleCompra->cantidad = $cantidadConfirmada;
        }


        // $compra->obra_id = $obra;
        // $compra->save();
        // foreach ($materialesCantidades as $materialCantidad) {
        //     $compraDetalle = new DetalleCompra;
        //     $compraDetalle->material_id = $materialCantidad[0];
        //     $compraDetalle->cantidad =  $materialCantidad[1];
        //     $compraDetalle->orden_compra_id =$compra->id;
        //     $compraDetalle->save();
        //     // $detalleCompra->cantidad_remitida=0;
        // }
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
