<?php

namespace App\Http\Controllers;
use App\Obra;
use App\Inventario;
use App\Pedido;
use App\Material;
use App\Compra;
use App\PedidoDetalle;
use App\Proveedor;
use App\Egreso;
use App\EgresoDetalle;
use App\CompraDetalle;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use DB;

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
        $date = new Carbon;
        $date = $date->now()->format('Y-m-d H:i:s');
        $materialesCantidades = $request->materiales;
        $pedido= new Pedido;
        $pedido->id_obra_solicitante = $request->obra_solicitante;
        $pedido->id_obra_destino = $request->obra_destino;
        $pedido->fecha_pedido = $date;
        $pedido->fecha_recibido = $date;
        $pedido->observacion =' ';
        $pedido->estado = 1;
        $pedido->save();
        foreach ($materialesCantidades as $materialCantidad) {
            $pedidoDetalle = new PedidoDetalle;
            $material_id = Material::select('id')->where('m_descripcion', $materialCantidad[0])->get();
            $pedidoDetalle->material_id = $material_id[0]->id ;
            $pedidoDetalle->cantidad_solicitada =str_replace ('.', '', $materialCantidad[1]);
            // $pedidoDetalle->cantidad_recibida = 0;
            $pedidoDetalle->pedido_id = $pedido->id;
            $pedidoDetalle->save();
            // $detalleCompra->cantidad_remitida=0;
        }
        echo json_encode(1);
    }
    public function aceptarPedido(Request $request){
        $material = $request->material;
        $ordenCompra = $request->orden_compra_id;
        $detalleCompra = DetalleCompra::where('orden_compra_id', $ordenCompra)->where('material_id', $material)->first();
        $detalleCompra->update([
            $detalleCompra->estado = 1
        ]);
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
        $obras = Obra::all();
        $inventarioObra = $obra->inventario()->get();
        $compras = Compra::where('obra_id', $id)->get();
        $bandejaEntrada = $obra->bandejaEntrada()->get();
        $bandejaEnviado = $obra->bandejaEnviado()->get();
        $egresos = Egreso::where('obra_id', $id)->get();
        $materiales = Material::all();
        return view('almacen.almacen', compact('obra', 'inventarioObra', 'bandejaEntrada', 'bandejaEnviado', 'materiales', 'obras', 'compras'));
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
    public function gestionPedido(Request $request){
        if ($request->input('preOrden')) {
            $materialesPedidos = DB::table('pedido_detalles as pd')
            ->join('materiales as m', 'pd.material_id', '=', 'm.id')
            ->join('pedidos as p', 'p.id', '=', 'pd.pedido_id')
            ->select('m.id', 'm.m_descripcion', DB::raw('SUM(pd.cantidad_solicitada) as cantidad_solicitada'))
            ->whereIn('pd.pedido_id', $request->pedidosCheck)->where('p.estado', '2')
            ->groupBy('m.id')->get();
            $proveedores = Proveedor::all(); 
            $obra = $request->input('obra');
            return view('almacen.preOrden', compact('materialesPedidos', 'proveedores', 'obra'));
           
            
        }elseif ($request->input('salida')) {
            // dd($request);
            $materialesPedidos = DB::table('pedido_detalles as pd')
            ->join('materiales as m', 'pd.material_id', '=', 'm.id')
            ->join('pedidos as p', 'p.id', '=', 'pd.pedido_id')
            ->join('inventarios as i', 'm.id', '=', 'i.material_id')
            ->select('i.material_id', 'm.m_descripcion', 'i.cantidad_actual', 'p.id_obra_solicitante',  DB::raw('SUM(pd.cantidad_solicitada) as cantidad_solicitada'))
            ->whereIn('pd.pedido_id', $request->pedidosCheck)->where('p.estado', '1')->where('i.obra_id', $request->obra)
            ->groupBy('i.material_id', 'm.m_descripcion', 'i.cantidad_actual', 'p.id_obra_solicitante')->get();
            // dd($materialesPedidos);
            // $materialesDisponibles = Inventario::whereIn('material_id', $request->pedidosCheck); 
            $obra = $request->obra;
            return view('almacen.egresos', compact('materialesPedidos', 'obra'));
        }
        return $text;
    }
    public function recepcionPedido (Request $request){
        $obra = Pedido::where('id', $request->pedido)->select('id_obra_solicitante')->get();
        // dd($obra[0]->id_obra_solicitante);
        $inventario = Inventario::where('material_id',$request->material )->where('obra_id', $obra[0]->id_obra_solicitante)->get();
        if (count($inventario)>0) {
            $inventario = Inventario::where('material_id',$request->material )->where('obra_id', $obra[0]->id_obra_solicitante);
            $cantidad_actual = $inventario[0]->cantidad_actual;
            $inventario->cantidad_actual = $cantidad_actual + $request->cantidad_recibida;
            $inventario->save();
        }else{
            $inventario = new Inventario;
            $inventario->material_id = $request->material;
            $inventario->obra_id = $obra[0]->id_obra_solicitante;
            $inventario->cantidad_minima = 20;
            $inventario->cantidad_actual = $request->cantidad_recibida;
            $inventario->save();
        }
        // dd($inventario);
        $detalle = PedidoDetalle::where('material_id', $request->material)
          ->where('pedido_id', $request->pedido)
          ->update(['cantidad_recibida' => $request->cantidad_recibida]);
        return $detalle;
    }
    public function recepcionCompra(Request $id_obra_solicitanterequest){
        $detalle = CompraDetalle::where('material_id', $request->material)
          ->where('compra_id', $request->pedido)
          ->update(['cantidad_recibida' => $request->cantidad_recibida]);
        return $detalle;
    }
    public function generarOrdenCompra(Request $request){
        $carbon = new Carbon;
        $date = $carbon->now();
        // dd($date->format('Y-m-d H:i:s'));
        $compras = $request->input('compra');
        for ($i=0; $i < count($compras['materialesPedidos']) ; $i++) { 
           $arrayAux = array();
           $arrayAux['material'] = $compras['materialesPedidos'][$i];   
           $arrayAux['cantidad'] = $compras['cantidad'][$i];   
           $arrayAux['proveedor'] = $compras['proveedores'][$i]; 
           $pedidoDetalles[] = $arrayAux;
        }
        $proveedores= array_unique($compras['proveedores']);
        foreach ($proveedores as $proveedor) {
            $compra = new Compra;
            $compra->proveedor_id = $proveedor;
            $compra->fecha_compra = $date->format('Y-m-d H:i:s');
            $compra->save();
            foreach ($pedidoDetalles as $detalle) {
                if ($detalle['proveedor'] == $proveedor) {
                    $compraDetalle = new CompraDetalle;
                    $compraDetalle->material_id = $detalle['material'];
                    $compraDetalle->cantidad_solicitada = $detalle['cantidad'];
                    $compraDetalle->compra_id = $compra->id;
                    $compraDetalle->save();
                    // echo .' '. $detalle['cantidad'].' '.$detalle['proveedor'] .'<br>';
                }
            }
            // echo 'para otro proveedor <br>' ;
        } 
        // dd($obra);
        return redirect()->route('almacen.show',[$obra] );
    }
    public function registrarEgresos (Request $request){
        $carbon = new Carbon;
        $date = $carbon->now();
        // dd($date->format('Y-m-d H:i:s'));
        $egreso = $request->input('egreso');
        for ($i=0; $i < count($egreso['materialesPedidos']) ; $i++) { 
           $arrayAux = array();
           $arrayAux['material'] = $egreso['materialesPedidos'][$i];   
           $arrayAux['cantidad_solicitada'] = $egreso['cantidad_solicitada'][$i];   
           $arrayAux['cantidad_dada'] = $egreso['cantidad_dada'][$i]; 
           $pedidoDetalles[] = $arrayAux;
        }
        // dd($pedidoDetalles);
        $egreso = new Egreso;
        $egreso->obra_id = $request->obra;
        $egreso->obra_id_solicitante = $request->obra_id_solicitante;
        $egreso->fecha_envio = $date->format('Y-m-d H:i:s');
        $egreso->save();
        foreach ($pedidoDetalles as $detalle) {
            $egresoDetalle = new EgresoDetalle;
            $egresoDetalle->material_id = $detalle['material'];
            $egresoDetalle->cantidad = $detalle['cantidad_dada'];
            $egresoDetalle->egreso_id = $egreso->id;
            $egresoDetalle->save();
            $inventario = Inventario::where('material_id',$request->material )->where('obra_id', $request->obra);
            $cantidad_actual = $inventario->cantidad_actual;
            $inventario->cantidad_actual = $cantidad_actual - $detalle['cantidad_dada'];
                // echo .' '. $detalle['cantidad'].' '.$detalle['proveedor'] .'<br>';
            
        }

            // echo 'para otro proveedor <br>' ; 
        // dd($obra);
        return redirect()->route('almacen.show',[$request->obra] );
    }
    public function pedidosRecibidos(Request $request){

        $obra = Obra::find($request->obra);
        $bandejaEntrada = $obra->bandejaEntrada()->get();
        $data['data']=array();
        foreach ($bandejaEntrada as $entrada) {
            $arrayAux = array();
            $arrayAux['id'] = $entrada->id;
            // dd($entrada->detallePedido);
            foreach ($entrada->detallePedido as $detalle) {
                // dd($detalle->cantidad_solicitada);
                $arrayAux2['nombre_material']= $detalle->materiales->m_descripcion;
                $arrayAux2['costo_material']= $detalle->materiales->m_costo;
                $arrayAux2['cantidad']= $detalle->cantidad_solicitada;
                $arrayAux['materiales'][] = $arrayAux2; 
            }
            $arrayAux['fecha_pedido'] = $entrada->fecha_pedido;
            $arrayAux['fecha_recibido'] = $entrada->fecha_recibido;
            $arrayAux['obra'] = $entrada->bandejaEnviado;
            $arrayAux['estado'] = $entrada->estado;
            // dd($entrada->bandejaEnviado);
            $data['data'][]=$arrayAux;
        }
        return $data;
    }
    public function pedidosEnviados(Request $request){
        $obra = Obra::find($request->obra);
        $bandejaEnviado = $obra->bandejaEnviado()->get();
        $data['data']=array();
        foreach ($bandejaEnviado as $enviado) {
            $arrayAux = array();
            $arrayAux['id'] = $enviado->id;
            // dd($enviado->detallePedido);
            foreach ($enviado->detallePedido as $detalle) {
                // dd($detalle->cantidad_solicitada);
                $arrayAux2['id']= $detalle->materiales->id;
                $arrayAux2['nombre_material']= $detalle->materiales->m_descripcion;
                $arrayAux2['costo_material']= $detalle->materiales->m_costo;
                $arrayAux2['cantidad_solicitada']= $detalle->cantidad_solicitada;
                $arrayAux2['cantidad_recibida']= $detalle->cantidad_recibida;
                $arrayAux['materiales'][] = $arrayAux2; 
            }
            $arrayAux['fecha_pedido'] = $enviado->fecha_pedido;
            $arrayAux['fecha_recibido'] = $enviado->fecha_recibido;
            $arrayAux['obra'] = $enviado->bandejaEnviado;
            $arrayAux['estado'] = $enviado->estado;
            // dd($enviado->bandejaEnviado);
            $data['data'][]=$arrayAux;
        }
        return $data;
    }
    public function comprasRealizadas (Request $request){
        $compras = Compra::where('obra_id', $request->obra)->get();
        // $compras = Compra::where('obra_id', 1)->get();
        $data['data']=array();

        foreach ($compras as $compra) {
            $arrayAux = array();
            $arrayAux['id'] = $compra->id;
            foreach ($compra->detalleCompra as $detalle) {
                $arrayAux2['id']= $detalle->material->id;
                $arrayAux2['nombre_material'] = $detalle->material->m_descripcion;
                $arrayAux2['cantidad_solicitada']= $detalle->cantidad_solicitada;
                $arrayAux2['cantidad_recibida']= $detalle->cantidad_recibida;
                $arrayAux['materiales'][] = $arrayAux2;
            }
            $arrayAux['proveedor'] = $compra->proveedor;
            $arrayAux['fecha_compra'] = $compra->fecha_compra;
            $arrayAux['fecha_recepcion'] = $compra->fecha_recepcion;
            $data['data'][]=$arrayAux;
        }
        // dd($data);
        return $data;
    }
    function updatePedido(Request $request){    
        
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
