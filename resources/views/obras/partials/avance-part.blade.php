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
 										<td>
 											{{$rubrosObra->pivot->area}}
 										</td>
 										<td>
 											<div>
 												<input class="form-control" type="text" value="{{$rubrosObra->pivot->progreso}}" id="inputProgreso_{{$rubrosObra->pivot->progreso}}" name="inputProgreso[{{$plano->id}}-{{$rubrosObra->id}}]">
 											</div>
 										</td>
 										<td>{{'Mostrar con una barra el progreso'}}</td>
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