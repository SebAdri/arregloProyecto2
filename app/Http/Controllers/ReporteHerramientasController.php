<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Obra;
use App\Herramienta;
use App\AssignedHerramienta;
use PDF;
use Illuminate\Support\Facades\Input;

class ReporteHerramientasController extends Controller
{
  public function createReporteHerramientas()
  {
    $obras = Obra::all();
    $obraHerramientas = AssignedHerramienta::with('obra','herramientas')->get();

    return view('reportes.reporteHerramientas', compact('obras','obraHerramientas'));
  }

  public function generarReporteHerramientas(Request $request)
  {
    $obras = Obra::all();

    if ($request->input('periodo') != null)
    {
      $fechaTrim = trim($request->input('periodo'));
      $periodo = explode('-', trim($fechaTrim));
      $desde = explode("/", trim($periodo[0]));
      $hasta = explode("/", trim($periodo[1]));
      $fecha_desde = $desde[2]."-".$desde[1]."-".$desde[0];
      $fecha_hasta = $hasta[2]."-".$hasta[1]."-".$hasta[0];

      $obraHerramientas = AssignedHerramienta::with('obra','herramientas')->where('obra_id', $request->obra_id)->whereBetween('created_at', [$fecha_desde,$fecha_hasta])->get();
    }
    else
    {
      $obraHerramientas = AssignedHerramienta::with('obra','herramientas')->where('obra_id', $request->obra_id)->get();
    }

    // dd($obraHerramientas);

    return view('reportes.reporteHerramientas', compact('obraHerramientas','obras'));

  }
}
