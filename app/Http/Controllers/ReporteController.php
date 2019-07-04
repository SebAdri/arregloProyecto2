<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Obra;
use App\Plano;

class ReporteController extends Controller
{
    public function mostrarAvance()
    {
      $obras = Obra::where('es_obra',0)->get();
    	return view('reportes.reporteAvance', compact('obras'));
    }

    public function generarReporteAvance(Request $request)
    {
      // dd($request->all());
      $obras = Obra::where('es_obra',0)->get();
      $obra = Obra::find($request->obra_id);
      $planos = $obra->planos;
      $planos_id = $planos->pluck('id');
      $reportes = DB::table('planos_rubros_log')->select('plano_id','rubro_id','fecha_control', DB::raw('ifnull(SUM(progreso),0) as avance'))->whereIn('plano_id',$planos_id)->groupBy('plano_id','rubro_id', 'fecha_control')->get();

      // return $reportes;
      return view('reportes.reporteAvance2', compact('reportes', 'obras', 'planos'));
    }
}
