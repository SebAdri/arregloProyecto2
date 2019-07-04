<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PlanosController;
use App\Http\Controllers\CalculoCostoController;
use App\Http\Controllers\ContratoController;
use App\Documento;
use App\TipoDocumento;
use Illuminate\Support\Facades\DB;
use App\Rubro;
use App\Material;
use App\Obra;
use App\Plano;
use App\Presupuesto;

class DocumentosController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // agregando algo para probar y commitear
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return Rubro::where('familia_rubro_id', 1)->get();


        $rubros = Rubro::where('estado',1)->get();
        $id_obra = 2;
        $obras = Obra::find($id_obra);
        $planos = $obras->planos;
        $presupuestos = Presupuesto::where('obra_id', $id_obra)->get()[0];
        
        return view('documentos.create2', compact('rubros', 'id_obra', 'obras', 'planos', 'presupuestos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        dd($request->all());
        switch ($request->submitDocumento) {
            case '1'://Plano
                $this->guardarPlanos($request);
                // return redirect()->route('documentos.show', $request->id_obra);
                break;
            case '2'://Rubro
                $this->guardarRubros($request);
                break;
            case '3'://Calculo
                $this->guardarCalculos($request);
                break;
            case '4'://Contrato
                $this->guardarContratos($request);
                break;
            default:
                # code...
                break;

        }
        if ($request->btnGuardar) {
            // dd($request->btnGuardar);
            $this->guardarContratos($request);
        }
        return redirect()->route('documentos.show', $request->id_obra);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_obra)
    {
        // esto habia en el create pero paso ahora en el show
        $rubros = Rubro::where('estado',1)->get();
        // $id_obra = 2;
        $obras = Obra::find($id_obra);
        $clientes = $obras->cliente->first();
        $planos = $obras->planos;
        $presupuestos = Presupuesto::where('obra_id', $id_obra)->first();
        // dd($presupuestos);
        
        // hasta aca
        $tipo_documentos = TipoDocumento::all();
        $documentos = Documento::all();
        $obraDocumentos[] = Obra::findOrFail($id_obra)->documentos()->get();

        return view('documentos.create3', compact('obraDocumentos', 'id_obra', 'tipo_documentos', 'rubros', 'id_obra', 'obras', 'planos', 'presupuestos', 'clientes'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documento = Documento::findOrFail($id);
        
        return view('documentos.edit', compact('documento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $documento = Documento::findOrFail($id);
        $documento->update($request->all());

        return redirect()->route('documentos.show', $request->obra_id); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function guardarPlanos(Request $request)
    {
        // dd( array_slice($request->all(), 1, 5));
        $plano = array_slice($request->all(), 1, 5);
        Plano::create($plano);
    }

    public function guardarRubros(Request $request)
    {
        $rubrosDeObras = $request->all();
        $existeObraConRubros = DB::table('planos_rubros')->where([
                                                ['plano_id', '=', $request->plano_seleccionado]
                                            ])->exists();
        if ($existeObraConRubros) {
           DB::table('planos_rubros')->where('plano_id', '=', $request->plano_seleccionado)->delete();

           foreach ($rubrosDeObras['checkRubroesAsignado'] as $rubrosObra) {
               DB::table('planos_rubros')->insert([
                   ['plano_id' => $request->plano_seleccionado, 'rubro_id' => $rubrosObra]
               ]);
               // DB::table('planos_rubros')->insert(['plano_id' => $request->plano_seleccionado, 'rubro_id' => $rubrosObra]);
           }
        }
        else
        {
           foreach ($rubrosDeObras['checkRubroesAsignado'] as $rubrosObra) {
            // dd($rubrosDeObras);
                // dd($request->plano_seleccionado. ' -> ' .$rubrosObra);
               DB::table('planos_rubros')->insert([
                   ['plano_id' => $request->plano_seleccionado, 'rubro_id' => $rubrosObra]
               ]);
           }
        }
        // return redirect()->route('documentos.show', $request->id_obra);
    }

    public function guardarCalculos(Request $request)
    {
        $planos_rubros_areas = $request->inputSuperficiePlano;
        foreach (array_keys($planos_rubros_areas) as $plano_rubro_area) {
            // dd($planos_rubros_areas[$plano_id]);
            // dd($plano_rubro_area);
            // ($mes, $día, $año) = split('[/.-]', $plano_id); cuando se pone entre corchete va separar por una / o por un -
            $plano_rubro_id = explode("-", $plano_rubro_area);
            $existePlanoConRubros = DB::table('planos_rubros')->where([
                                            ['plano_id', '=', $plano_rubro_id[0]],
                                            ['rubro_id', '=', $plano_rubro_id[1]]
                                        ])->exists();
            if ($existePlanoConRubros) {
                DB::table('planos_rubros')
                            ->updateOrInsert(
                                ['plano_id' => $plano_rubro_id[0], 'rubro_id' => $plano_rubro_id[1]],//array que valida where
                                ['area' => $planos_rubros_areas[$plano_rubro_area]]//array que setea
                            );
            }
            else
            {
               return 'No existe plano y rubro';
            }
        }

        //Aqui guardamos el presupuesto
        if (isset($request->beneficio) && isset($request->costo_total_obra)) {
            $existePresupuestoConObra = DB::table('presupuestos')->where([
                                                ['obra_id', '=', $request->id_obra],
                                            ])->exists();
            if ($existePresupuestoConObra) {
                // dd($request->all());
                Presupuesto::where('obra_id', $request->id_obra)
                          ->update(['iva' => $request->iva, 
                                   'beneficio' => $request->beneficio,
                                   'costo_total_obra' => $request->costo_total_obra]);
            }
            else
            {
                $presupuesto = new Presupuesto;
                $presupuesto->obra_id = $request->id_obra;
                $presupuesto->iva = $request->iva;
                $presupuesto->beneficio = $request->beneficio;
                $presupuesto->costo_total_obra = $request->costo_total_obra;
                $presupuesto->save();
            }
        }
        return redirect()->route('documentos.show', $request->id_obra);

    }

    public function guardarContratos(Request $request)
    {
        //Primeramente guardamos el contrato
        dd($request->all());
        $contrato = new Documento;
        $contrato->nombre = $request->nombre;
        $contrato->tipo_doc_id = TipoDocumento::where('nombre', 'Contrato')->first()->id;
        $contrato->fecha_emision = $request->fecha;
        $contrato->ubicacion = $request->descripcion_contrato;
        $contrato->obra_id = $request->id_obra;

        $cuotas = $request->cuotas;
        $arrayCuotas = array();
        foreach ($cuotas as $cuota) {
            $arrayAux = array();
            $arrayAux['nro_cuota'] = $cuota[0];
            $arrayAux['saldo'] = $cuota[1];
            $arrayAux['monto_pago'] = $cuota[2];
            $arrayAux['porcentaje_pago'] = $cuota[3];
            $arrayAux['porcentaje_obra'] = $cuota[4];
            $arrayCuotas[] = $arrayAux;
        }
        dd($arrayCuotas);
        $nombre_doc = $request->nombreDoc;
        $fecha = $request->fecha_emision; 
        Documento::create($request->all());
        
        // // return redirect()->route('documentos.show', $request->obra_id); 
        // return redirect()->route('documentos.create'); 

    }
}
