<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PDF;
use App\Cliente;
use App\Factura;
use App\DetalleFactura;
use App\ParametroFactura;
class PdfController extends Controller
{
    public function generatePDF($id)
    {
    	$factura = Factura::find($id);
    	// dd($factura);
    	$parametroFactura = ParametroFactura::first();
    	$cliente = Cliente::find($factura->cliente_id);
    	$detalles = DetalleFactura::where('factura_id', $factura->id)->get();
    	// return view('facturas.facturas', compact('cliente', 'factura', 'detalles', 'parametroFactura'));
        $pdf = PDF::setOptions(['isRemoteEnabled' => true])->loadView('facturas.facturas', compact('cliente', 'factura', 'detalles', 'parametroFactura'));
        return $pdf->stream();
    }
    public function generartabla(){
    	$pdf = PDF::loadView('facturas.facturas', compact('cliente', 'factura', 'detalles'));
        return $pdf->stream();
    }
}
