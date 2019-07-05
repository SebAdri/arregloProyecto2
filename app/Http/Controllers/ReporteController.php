<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Obra;
use App\Plano;
use PDF;
use Illuminate\Support\Facades\Input;

class ReporteController extends Controller
{
    public function mostrarAvance()
    {
      $obras = Obra::where('es_obra',0)->get();
    	return view('reportes.reporteAvance3', compact('obras'));
    }

    public function generarReporteAvance(Request $request)
    {
      // dd($request->all());
      // dd($obra);
      $periodo = $request->periodo;
      $obras = Obra::where('es_obra',0)->get();
      $proyecto = Obra::find($request->obra_id);
      $planos = $proyecto->planos;
      $planos_id = $planos->pluck('id');
      $reportes = DB::table('planos_rubros_log')->select('plano_id','rubro_id','fecha_control', DB::raw('ifnull(SUM(progreso),0) as avance'))->whereIn('plano_id',$planos_id)->groupBy('plano_id','rubro_id', 'fecha_control')->get();

      // return $request->submitReporteAvance;
      switch ($request->submitReporteAvance) {
        case '1':
          return view('reportes.reporteAvance3', compact('reportes', 'obras', 'planos', 'proyecto', 'periodo'));
          break;
        case '2':
          // return $request->all();
         return $this->exportarPdf($reportes, $planos, $proyecto, $periodo);
          break;
        
        default:
          break;
      }
    }

    public function exportarPdf(Request $request)
    {
      // return $request->all();
      // dd(Input::get('fechas'));
      // return $periodo;

      $obra = Obra::find($request->obra_id);
      $periodo = $request->periodo;
        $planos = $obra->planos;
        $planos_id = $planos->pluck('id');
        $reportes = DB::table('planos_rubros_log')->select('plano_id','rubro_id','fecha_control', DB::raw('ifnull(SUM(progreso),0) as avance'))->whereIn('plano_id',$planos_id)->groupBy('plano_id','rubro_id', 'fecha_control')->get();

      $pdf = PDF::loadView('reportes.partials.reportAvanceHead-part', compact('reportes', 'planos', 'obra', 'periodo'));
      // return view('reportes.partials.reportAvanceHead-part', compact('reportes', 'planos'));

      return $pdf->stream();
    }
}
