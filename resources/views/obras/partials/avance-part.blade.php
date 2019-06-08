 <div class="row">
 	{{-- <input type="text" class="datepicker"> --}}
 	Fecha: <input type="date" name="fecha_avance" id="fecha_avance">
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
 										<th style="width: 40%;">Nombre del Rubro</th>
 										<th style="width: 20%;">Superficie o Área</th>
 										<th style="width: 20%;">Progreso</th>
 										<th style="width: 20%;">Porcentaje</th>
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
											  <div class="progress-bar progress-bar-striped porcentaje" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
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
				      	<div class="progress-bar progress-bar-striped total_porcentaje" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
				      	</div>
			      	</div>
			      </td>
			    </tr>
			</tfoot>
 		</table>
 	</div>
 </div>

 <div class="row">
 	<div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
 		<button type="submit" name="submitAvance" value="1" class="btn button-primary">Guardar</button>
 		<a class="btn button-primary" href="{{ route('obras.index') }}">Cancelar</a>
 		<button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
 	</div>
 </div>