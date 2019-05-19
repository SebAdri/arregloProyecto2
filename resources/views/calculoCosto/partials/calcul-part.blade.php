 <div class="row">
	<div class="table-responsive" >
		<table id="tablaCalculos" class="table table-condensed" style="border-collapse:collapse;">
			<thead>
				<tr>
					<th>Nombre del Rubro</th>
					<th>Costo del Rubro</th>
					<th>Superficie o Área</th>
{{-- 					<th>Segunda Dimension</th>
					<th>Tercera Dimension</th> --}}
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
					@foreach($obras->rubros as $rubrosObra)
						<tr data-toggle="collapse" data-target="#{{$rubrosObra->id}}" class="accordion-toggle">
							<td>{{$rubrosObra->nombre}}</td>
							<td>{{$rubrosObra->mano_obra}}</td>
							<td>
								<div>
				                  <input class="form-control" type="text" value="{{$rubrosObra->pivot->area}}" id="inputSuperficie_{{$rubrosObra->pivot->area}}" name="inputSuperficie[{{$rubrosObra->id}}]">
				                </div>
								
							</td>
{{-- 							<td>
								<div>
				                  <input class="form-control" type="text" value="{{$rubrosObra->pivot->dimension_dos}}" id="inputDimDos_{{$rubrosObra->pivot->dimension_dos}}" name="inputDimDos[{{$rubrosObra->pivot->dimension_dos}}]">
				                </div>
							</td>
							<td>
								<div>
				                  <input class="form-control" type="text" value="{{$rubrosObra->pivot->dimension_tres}}" id="inputDimTres_{{$rubrosObra->pivot->dimension_tres}}" name="inputDimTres_[{{$rubrosObra->pivot->dimension_tres}}]">
				                </div>
							</td> --}}
							<td>
								{{-- {{dd($rubrosObra->pivot)}} --}}
								{{$rubrosObra->pivot->area * $rubrosObra->mano_obra}}
{{-- 								@if ($rubrosObra->unidad_medida == "m2")
									{{$rubrosObra->pivot->dimension_uno *
									$rubrosObra->pivot->dimension_dos *
									$rubrosObra->mano_obra}}
								@elseif ($rubrosObra->unidad_medida == "m3")
									{{$rubrosObra->pivot->dimension_uno *
									$rubrosObra->pivot->dimension_dos *
									$rubrosObra->pivot->dimension_tres *
									$rubrosObra->mano_obra}}
								@else
									{{$rubrosObra->pivot->dimension_uno *
									$rubrosObra->mano_obra}}
								@endif --}}
							</td>
						</tr>
					@endforeach
				{{-- @endforeach	 --}}
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