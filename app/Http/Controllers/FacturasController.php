<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FormaPago;
use App\Pago;
use App\DetallePago;
use App\Cliente;
use App\Factura;
use App\DetalleFactura;
use App\ParametroFactura;
use App\DetalleFormaPago;
class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /* parametros para la impresion 
        de la factura6
    
    */
    public function setParameter(Request $request){
        // dd($request->all());
        $parametroFactura = new ParametroFactura();
        $parametroFactura->empresa_nombre = $request->empresa;
        $parametroFactura->empresa_eslogan = $request->eslogan;
        $parametroFactura->telefono = $request->telefono;
        $parametroFactura->correo = $request->correo;
        $parametroFactura->ciudad = $request->ciudad;
        $parametroFactura->pais = $request->pais;
        $parametroFactura->vigencia_inicio = $request->fechaIni;
        $parametroFactura->vigencia_fin = $request->fechaFin;
        $parametroFactura->direccion = $request->direccion;
        $parametroFactura->imagen = $request->file('logo')->store('public');
        $parametroFactura->timbrado = $request->timbrado;
        $parametroFactura->ruc = $request->ruc;
        $parametroFactura->save();
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parametro = ParametroFactura::first();
        return view('facturas.parametro', compact('parametro'));
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
        $pago = Pago::find($request->pago);
        foreach ($request->detalles as $detalle) {
            $pago = explode(',', $detalle);
            $formaPago = FormaPago::where('descripcion', $pago[0])->first();
            $detallePago = new DetallePago;
            $detallePago->pago_id = $request->pago;
            $detallePago->monto = $pago[1];
            $saldo = Pago::where('documento_id', $request->documento_id)->where('estado', '0')->sum('monto_pago');
            $detallePago->saldo = $saldo ;
            $detallePago->entidad = $pago[2] ;
            $detallePago->referencia = $pago[3] ;
            $detallePago->nro_cheque = $pago[4] ;

            $detallePago->forma_pago_id = $formaPago->id;
            // dd($detallePago);
            // $detallePago->save();
            dd($pago);
            $pago->estado = 1;
            $pago->save();
            $sgtPago = Pago::where('estado', 0)->where('obra_id', $pago->obra_id)->orderBy('nro_pago', 'asc')->first();
            if ($sgtPago!=null) {
            # code...
                $diferencia = $pago[1] - $sgtPago->monto_pago;
                $sgtPago->monto_pago = $sgtPago->monto_pago - $diferencia;
                $sgtPago->save();
            }
        }
        $cliente = Cliente::where('cedula', $request->fc_ruc)->orWhere('ruc', $request->fc_ruc)->first();
        $factura = new Factura;
        $factura->monto_factura = $request->monto_pago;
        $factura->fecha_emision = $request->fc_fecha_emision;
        $factura->cliente_id = $cliente->id;
        $factura->obra_id = $pago->obra_id;
        $factura->pago_id = $pago->id;
        $iva10 = round($request->monto_pago/11, 0);
        $factura->total_iva_10 = $iva10;
        $factura->total_iva_5 = 0;
        $factura->exentas = 0;
        $factura->estado = 'activo'; 
        $factura->save();
        $detalleFactura = new DetalleFactura;
        $detalleFactura->factura_id = $factura->id;
        $detalleFactura->item = $request->pago;
        $detalleFactura->concepto = $request->concepto;
        $detalleFactura->cantidad = 1;
        $detalleFactura->precio_unitario = $request->monto_pago;
        $detalleFactura->iva_10 = $iva10;
        $detalleFactura->iva_5 = 0;
        $detalleFactura->save();
        return redirect()->action('PdfController@generatePDF', ['data' => $factura->id]);
    }
    public function generarDetallePago($formaPago, $pago_id, $monto, $documento){
        
        // dd($sgtPago);
        return $detallePago;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pago = Pago::find($id);
        $tiposPagos = FormaPago::all();
        // $cliente = $pago->documentos()->first()->obra()->first()->cliente()->first();
        $cliente = $pago->obra()->first()->cliente()->first();
        return view('facturas.create', compact('pago', 'cliente', 'tiposPagos'));
        
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
