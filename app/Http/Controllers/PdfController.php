<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PDF;
use App\Cliente;
use App\Factura;
use App\DetalleFactura;

class PdfController extends Controller
{
    public function generatePDF($id)
    {
    	$factura = Factura::find($id);
    	// dd($factura);
    	$cliente = Cliente::find($factura->cliente_id);
    	$detalles = DetalleFactura::where('factura_id', $factura->id)->get();
    	// dd($detalles);
    	// return view('facturas.facturas', compact('cliente'));
        $pdf = PDF::loadView('facturas.facturas', compact('cliente', 'factura', 'detalles'));
  
        return $pdf->stream();
    }
}
