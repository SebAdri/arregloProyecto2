<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FormaPago;
use App\Pago;
use App\DetallePago;
use App\Cliente;
use App\Factura;
use App\DetalleFactura;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *            
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($accion);
        $cliente = Cliente::where('cedula', $request->fc_ruc)->orWhere('ruc', $request->fc_ruc)->first();
        $factura = new Factura;
        $factura->monto_factura = $request->monto_pago;
        $factura->fecha_emision = $request->fc_fecha_emision;
        $factura->cliente_id = $cliente->id;
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
        switch ($request->fc_formaPago) {
            case 'ChequeEfectivo':
                $resultadoCheque = $this->generarDetallePago('Cheque', $request->pago, $request->monto_banco, $request->documento_id);
                $resultadoDetalle = $this->generarDetalleFormaPago($request);
                $resultadoEfectivo = $this->generarDetallePago('Efectivo', $request->pago, $request->monto_efectivo, $request->documento_id);
                break;
            case 'TransferenciaEfectivo':
                $resultadoCheque = $this->generarDetallePago('Transferencia', $request->pago, $request->monto_banco, $request->documento_id);
                $resultadoDetalle = $this->generarDetalleFormaPago($request);                
                $resultadoEfectivo = $this->generarDetallePago('Efectivo', $request->pago, $request->monto_efectivo, $request->documento_id);
                break;
            case ('Cheque'):     
                $resultado = $this->generarDetallePago($request->fc_formaPago,  $request->pago, $request->monto_pago, $request->documento_id);
                $resultadoDetalle = $this->generarDetalleFormaPago($request);                
            case ('Transferencia'):
                $resultado = $this->generarDetallePago($request->fc_formaPago,  $request->pago, $request->monto_pago, $request->documento_id);
                $resultadoDetalle = $this->generarDetalleFormaPago($request);
            default:
                $resultado = $this->generarDetallePago($request->fc_formaPago,  $request->pago, $request->monto_pago, $request->documento_id);
                break; 
        }
        return redirect()->action('PdfController@generatePDF', ['data' => $factura->id]);
    }
    public function generarDetallePago($formaPago, $pago_id, $monto, $documento){
        $formaPago = FormaPago::where('descripcion', $formaPago)->first();
        $detallePago = new DetallePago;
        $detallePago->pago_id = $pago_id;
        $detallePago->monto = $monto;
        $saldo = Pago::where('documento_id', $documento)->where('estado', '0')->sum('monto_pago');
        // dd($saldo);
        $detallePago->saldo = $saldo ;
        $detallePago->forma_pago_id = $formaPago->id;
        $detallePago->save();
        $pago = Pago::find($pago_id);
        $pago->estado = 1;
        $pago->save();
        $sgtPago = Pago::where('estado', 0)->orderBy('nro_pago', 'asc')->first();
        if ($sgtPago!=null) {
            # code...
            $diferencia = $monto - $sgtPago->monto_pago;
            $sgtPago->monto_pago = $sgtPago->monto_pago - $diferencia;
            $sgtPago->save();
        }
        // dd($sgtPago);
        return $detallePago;
    }

    public function generarDetalleFormaPago($request){
        $detalleFormaPago = new DetalleFormaPago;
        $detalleFormaPago->entidad_bancaria = $request->banco;
        $detalleFormaPago->cuenta = $request->cuenta;
        $detalleFormaPago->nro_referencia = $request->nro_referencia;
        $detalleFormaPago->save();
        return $detalleFormaPago;
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
        $cliente = $pago->documentos()->first()->obra()->first()->cliente()->first();
        return view('facturas.create', compact('pago', 'cliente'));
        
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
