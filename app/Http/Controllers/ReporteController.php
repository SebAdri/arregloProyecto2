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
      $proyecto = Obra::find(2);
      $planos = $proyecto->planos;
      $planos_id = $planos->pluck('id');
      $reportes = DB::table('planos_rubros_log')->select('plano_id','rubro_id','fecha_control', DB::raw('ifnull(SUM(progreso),0) as avance'))->whereIn('plano_id',$planos_id)->groupBy('plano_id','rubro_id', 'fecha_control')->get();
      // return view('reportes.reporteAvance', compact('reportes', 'obras', 'planos', 'proyecto', 'periodo'));

      // return $request->submitReporteAvance;
      switch ($request->submitReporteAvance) {
        case '1':
          return view('reportes.reporteAvance3', compact('reportes', 'obras', 'planos', 'proyecto', 'periodo'));
          break;
        case '2':
          // return $request->all();
         return $this->exportarPdf($reportes, $planos, $proyecto, $periodo);
          break;
      }
    }

    public function exportarPdf(Request $request)
    {
      // return $request->all();
      // dd($request->all());
      // return $periodo;
      $fechaTrim = trim($request->input('periodo'));
      $periodo = explode('-', trim($fechaTrim));
      $desde = explode("/", trim($periodo[0]));
      $hasta = explode("/", trim($periodo[1]));
      $fecha_desde = $desde[2]."-".$desde[1]."-".$desde[0]." 00:00:00";
      $fecha_hasta = $hasta[2]."-".$hasta[1]."-".$hasta[0]." 23:59:59";
      // dd($fecha_desde);
      $obra = Obra::find($request->obra_id);
      // $obra = Obra::find($proyecto->obra_id);
      $periodo = $request->periodo;
      $planos = $obra->planos;
      $planos_id = $planos->pluck('id');
      $reportes = DB::table('planos_rubros_log')->select('plano_id','rubro_id','fecha_control', DB::raw('ifnull(SUM(progreso),0) as avance'))->whereIn('plano_id',$planos_id)->where('fecha_control', '>=',$fecha_desde)->where('fecha_control', '<=',$fecha_hasta)->groupBy('plano_id','rubro_id', 'fecha_control')->get();
      // $reportes->;
      // dd($reportes);

      $pdf = PDF::loadView('reportes.partials.reportAvanceHead-part', compact('reportes', 'planos', 'obra', 'periodo'));
      // return view('reportes.partials.reportAvanceHead-part', compact('reportes', 'planos'));

      return $pdf->stream();
    }
    public function reporteCompras(){
      $obras = Obra::all();
      return view('reportes.reporteCompras', compact('obras'));
    }
    public function obtenerComprasObras(Request $request){
      $
      $compras = Compra::where('obra_id', $reques->obra_id)->whereBetween('fecha_compra', [$ageFrom, $ageTo]);;
    }
}
