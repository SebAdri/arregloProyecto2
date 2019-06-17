 {{-- <div class="row"> --}}
 	<div class="table-responsive" >
 		<table id="tablaPlanoRubros" class="table table-condensed" style="border-collapse:collapse;">
 			<thead>
 				<tr>
 					<th>Rubros seleccionado para cada plano de la obra. Favor ingresar área a producirse por rubro.</th>
 				</tr>
 			</thead>

 			<tbody>

 				@foreach ($planos as $plano)
 				<tr>
 					<td>
 						<label>{{$plano->nombre}}</label>
 					</td>
 				</tr>
 				<tr>
 					<td>
 						<div class="table-responsive" >
 							<table id="tablaCalculos{{$plano->id}}" class="table table-condensed tabCalculos" style="border-collapse:collapse;">
 								<thead>
 									<tr>
 										<th style="width: 40%;">Nombre del Rubro</th>
 										<th style="width: 20%;">Costo del Rubro</th>
 										<th style="width: 20%;">Superficie o Área</th>
 										<th style="width: 20%;">Total Costo Producción</th>
 									</tr>
 								</thead>
 								<tbody>
 									@foreach($plano->rubros as $rubrosObra)
 									<tr>
 										<td>{{$rubrosObra->nombre}}</td>
 										<td>
 											{{$rubrosObra->mano_obra}}
 											<input class="costo_rubro" type="hidden" value="{{$rubrosObra->mano_obra}}">
 										</td>
 										<td>
 											{{-- <div> --}}
 												<input class="produccion" type="text" value="{{$rubrosObra->pivot->area}}" id="inputSuperficie_{{$rubrosObra->id}}" name="inputSuperficiePlano[{{$plano->id}}-{{$rubrosObra->id}}]">
 											{{-- </div> --}}
 										</td>
 										<td class="costo_produccion">
 											{{$rubrosObra->pivot->area * $rubrosObra->mano_obra}}
 										</td>
 									</tr>
 									@endforeach
 								</tbody>
 							</table>
 						</div>
 					</td>
 				</tr>
 				@endforeach
 			</tbody>
 			<tfoot>
			    <tr>
			      <td class="costo_sub_total_obra" style="text-align: right; padding-right: 210px"></td>
			    </tr>
			</tfoot>
 		</table>
 	</div>
 {{-- </div> --}}

  <div class="panel panel-info">
    <div class="panel-heading">Ingrese los valores correspondiente al IVA y el Beneficio</div> 
    <div class="panel-body">
    	<div class="input-field col s4">
	    	<select name="iva" id="iva" value="{{$presupuestos->iva}}">
			  <option value="0.05"> 5%</option>
			  <option value="0.1"> 10%</option>
			</select>
			<label>IVA</label>
		</div>
		<div class="input-field col s4">
    		<input type="text" name="beneficio" id="beneficio" value="{{$presupuestos->beneficio}}">
    		<label>Beneficio</label>
    	</div>
    	<div class="input-field col s4">
    		<input type="text" name="costo_total_obra" id="costo_total_obra" value="{{$presupuestos->costo_total_obra}}">
    		<label class="active">Costo total de la obra</label>
    	</div>
	</div>
  </div>

 <div class="row">
 	<div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
 		<button type="submit" name="submitDocumento" value="3" class="btn button-primary">Guardar</button>
 		<a class="btn button-primary" href="{{ route('calculoCosto.create') }}">Cancelar</a>
 		<button type="button" class="btn button-primary" id="volverCalculo" name="button">Volver</button>
 		<input type="hidden" name="id_obra" id="id_obra" value={{$id_obra}}>
 	</div>
 </div>