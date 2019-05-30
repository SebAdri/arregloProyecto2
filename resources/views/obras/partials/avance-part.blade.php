 <div class="row">
 	<div class="table-responsive" >
 		<table id="tablaPlanoRubros" class="table table-condensed" style="border-collapse:collapse;">
 			<thead>
 				<tr>
 					<th>Ingrese el progreso de la obra para cada rubro</th>
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
 										<th>Superficie o Área</th>
 										<th>Progreso</th>
 										<th>Porcentaje</th>
 									</tr>
 								</thead>
 								<tbody>
 									@foreach($plano->rubros as $rubrosObra)
 									<tr>
 										<td>{{$rubrosObra->nombre}}</td>
 										<td class="area">
 											{{$rubrosObra->pivot->area}}
 										</td>
 										<td>
 											{{-- <div> --}}
 												<input class="produccion" type="text" value="{{$rubrosObra->pivot->progreso}}" id="inputProgreso_{{$rubrosObra->pivot->progreso}}" name="inputProgreso[{{$plano->id}}-{{$rubrosObra->id}}]">
 											{{-- </div> --}}
 										</td>
 										<td>
 											<div class="progress">
											  <div class="progress-bar progress-bar-striped progress-bar-animated porcentaje" role="progressbar" aria-valuenow="{{4/$rubrosObra->pivot->area}}" aria-valuemin="0" aria-valuemax="100" style="width: 75%">{{round(4/$rubrosObra->pivot->area,2)*100}}%</div>
											</div>
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
			      <td>
			      	<div class="progress" style="text-align: right">
				      	<div class="progress-bar progress-bar-striped progress-bar-animated total_porcentaje" role="progressbar" aria-valuenow="{{4/$rubrosObra->pivot->area}}" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">{{round(4/$rubrosObra->pivot->area,2)*100}}%
				      	</div>
			      	</div>
			      </td>
			    </tr>
			</tfoot>
 		</table>
 	</div>
 </div>