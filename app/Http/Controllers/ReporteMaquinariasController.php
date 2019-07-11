<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Obra;
use App\Herramienta;
use App\AssignedMaquinaria;
use PDF;
use Illuminate\Support\Facades\Input;

class ReporteMaquinariasController extends Controller
{
  public function createReporteMaquinarias()
  {
    $obras = Obra::all();
    $obraMaquinarias = AssignedMaquinaria::with('obra','maquinarias')->get();

    return view('reportes.reporteMaquinarias', compact('obras','obraMaquinarias'));
  }

  public function generarReporteMaquinarias(Request $request)
  {
    $obras = Obra::all();
    $obra = Obra::find($request->obra_id);
    if ($request->input('periodo') != null)
    {
      $fechaTrim = trim($request->input('periodo'));
      $periodo = explode('-', trim($fechaTrim));
      $desde = explode("/", trim($periodo[0]));
      $hasta = explode("/", trim($periodo[1]));
      $fecha_desde = $desde[2]."-".$desde[1]."-".$desde[0];
      $fecha_hasta = $hasta[2]."-".$hasta[1]."-".$hasta[0];

      $obraMaquinarias = AssignedMaquinaria::with('obra','maquinarias')->where('obra_id', $request->obra_id)->whereBetween('fecha', [$fecha_desde,$fecha_hasta])->get();
    }
    else
    {
      $obraMaquinarias = AssignedMaquinaria::with('obra','maquinarias')->where('obra_id', $request->obra_id)->get();
    }
     $pdf = PDF::loadView('reportes.partials.reporMaquinariaHead-part', compact('obraMaquinarias', 'obra','fecha_desde', 'fecha_hasta','obras'));

   return $pdf->stream();
    // return view('reportes.reporteMaquinarias', compact('obraMaquinarias','obras'));

  }
}
