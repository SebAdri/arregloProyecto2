<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Obra;
use App\Herramienta;
use PDF;
use Illuminate\Support\Facades\Input;

class ReporteHerramientasController extends Controller
{
  public function createReporteHerramientas()
  {
    $obras = Obra::all();
    return view('reportes.reporteHerramientas', compact('obras'));
  }

  public function generarReporteHerramientas(Request $request)
  {
    dd($request->all());
  }
}
