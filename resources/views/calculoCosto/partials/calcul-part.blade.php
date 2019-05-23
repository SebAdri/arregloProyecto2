 <div class="row">
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
 							<table id="tablaCalculos" class="table table-condensed" style="border-collapse:collapse;">
 								<thead>
 									<tr>
 										<th>Nombre del Rubro</th>
 										<th>Costo del Rubro</th>
 										<th>Superficie o Área</th>
 										<th>Total</th>
 									</tr>
 								</thead>
 								<tbody>
 									@foreach($plano->rubros as $rubrosObra)
 									<tr>
 										<td>{{$rubrosObra->nombre}}</td>
 										<td>{{$rubrosObra->mano_obra}}</td>
 										<td>
 											<div>
 												<input class="form-control" type="text" value="{{$rubrosObra->pivot->area}}" id="inputSuperficie_{{$rubrosObra->pivot->area}}" name="inputSuperficiePlano[{{$plano->id}}-{{$rubrosObra->id}}]">
 											</div>
 										</td>
 										<td>
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
 		</table>
 	</div>
 </div>



 <div class="row">
 	<div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
 		<button type="submit" name="submitCalculo" value="3" class="btn button-primary">Guardar</button>
 		<a class="btn button-primary" href="{{ route('calculoCosto.create') }}">Cancelar</a>
 		<button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
 	</div>
 </div>