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
    $obra = Obra::where('id', $request->obra_id)->get();
// dd($obra[0]->nombre_proyecto);
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
    // $pdf = PDF::loadView('reportes.partials.reportHerramientaHead-part', compact('obraHerramientas', 'fecha_desde', 'obra', 'fecha_hasta'));

    $pdf = PDF::loadView('reportes.partials.reportHerramientaHead-part', compact('obraHerramientas', 'fecha_desde', 'obra', 'fecha_hasta','obras'));

   return $pdf->stream();
    // return view('reportes.reporteHerramientas', compact('obraHerramientas','obras'))->with('pdf', $pdf->download());

    // return $pdf->download()->with('reportes.reporteHerramientas', $obraHerramientas, $obras);

    // return [$pdf->download(), view('reportes.reporteHerramientas', compact('obraHerramientas','obras'))];

  }
}
