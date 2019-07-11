<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Obra;
use App\Plano;
use App\Compra;
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
    $request->session()->flash('obra_id', $request->obra_id);
    $periodo = $request->periodo;
    $obras = Obra::where('es_obra',0)->get();
    $proyecto = Obra::find($request->obra_id);
    $planos = $proyecto->planos;
    $planos_id = $planos->pluck('id');
    $reportes = DB::table('planos_rubros_log')->select('plano_id','rubro_id','fecha_control', DB::raw('ifnull(SUM(progreso),0) as avance'))->whereIn('plano_id',$planos_id)->groupBy('plano_id','rubro_id', 'fecha_control')->get();
    switch ($request->submitReporteAvance) {
      case '1':
      return view('reportes.reporteAvance3', compact('reportes', 'obras', 'planos', 'proyecto', 'periodo'));
      break;
      case '2':
        // $request = array_slice($request->all(), 1, 5);
      return redirect()->route('exportarPdf', ['obra_id'=>$request->obra_id, 'periodo'=>$request->periodo]);

      // return $this->exportarPdf($reportes, $planos, $proyecto, $periodo);
      break;

      default:
      break;
    }
  }
 

    public function exportarPdf(Request $request)
    {
      // return $request->all();
      // dd($this->user );
      // dd(\Auth::user());
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

    return $pdf->stream('reporte', array('Attachment'=>0));
  }
  public function reporteCompras(){
    $obras = Obra::all();
    return view('reportes.reporteCompra', compact('obras'));
  }
  public function obtenerComprasObras(Request $request){
    // $request->session()->flash('obra_id', $request->obra_id);
    $obras = Obra::all();
    $obra = Obra::find($request->obra_id);
    $compras = Compra::where('obra_id', $request->obra_id);
    if (isset($request->periodo)) {
      $rango = explode('-', $request->periodo);
      $desde = explode("/", trim($rango[0]));
      $hasta = explode("/", trim($rango[1]));
      $fecha_desde = $desde[2]."-".$desde[1]."-".$desde[0];
      $fecha_hasta = $hasta[2]."-".$hasta[1]."-".$hasta[0];
      $compras = $compras->whereBetween('fecha_compra', [$fecha_desde, $fecha_hasta])->get();
    }else{
      $compras = $compras->get();
    }
    switch ($request->procesar) {
      case '1':
      return view('reportes.reporteCompra', compact('obras', 'compras'));
      break;
      case '2':
        // $request = array_slice($request->all(), 1, 5);
      return redirect()->route('exportarPdfCompras', ['obra_id'=>$request->obra_id, 'periodo'=>$request->periodo]);

      // return $this->exportarPdf($reportes, $planos, $proyecto, $periodo);
      break;

      default:
      break;
    }
  }
  public function exportarPdfCompras(Request $request){
    $obra = Obra::find($request->obra_id);
    $compras = Compra::where('obra_id', $request->obra_id);
    if (isset($request->periodo)) {
      $periodo = $request->periodo;
      $rango = explode('-', $request->periodo);
      $desde = explode("/", trim($rango[0]));
      $hasta = explode("/", trim($rango[1]));
      $fecha_desde = $desde[2]."-".$desde[1]."-".$desde[0];
      $fecha_hasta = $hasta[2]."-".$hasta[1]."-".$hasta[0];
      $compras = $compras->whereBetween('fecha_compra', [$fecha_desde, $fecha_hasta])->get();
    }else{
      $compras = $compras->get();
    }
    $pdf = PDF::loadView('reportes.partials.reportComprasHead-part', compact('compras', 'periodo', 'obra', 'fecha_desde', 'fecha_hasta'));
      // return view('reportes.partials.reportAvanceHead-part', compact('reportes', 'planos'));

    return $pdf->stream('reporte', array('Attachment'=>0));
  }
}
