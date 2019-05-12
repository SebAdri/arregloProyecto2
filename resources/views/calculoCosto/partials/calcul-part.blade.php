 <div class="row">
	<div class="table-responsive" >
		<table id="tablaCalculos" class="table table-condensed" style="border-collapse:collapse;">
			<thead>
				<tr>
					{{-- <th>Mas</th> --}}
					<th>Nombre del Rubro</th>
					<th>Costo del Rubro</th>
					<th>Primera Dimension</th>
					<th>Segunda Dimension</th>
					<th>Tercera Dimension</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				{{-- @foreach($obras as $obra) --}}
					@foreach($obras->rubros as $rubrosObra)
						<tr data-toggle="collapse" data-target="#{{$rubrosObra->id}}" class="accordion-toggle">
							{{--<td> 
								<div class="form-check">
				                  <input class="form-check-input" type="checkbox" value="{{$rubro->id}}" id="checkRubroesAsignado_{{ $rubro->id }}" name="checkRubroesAsignado[{{ $rubro->id }}]">
				                </div>
			                </td> --}}
			                {{-- <td>{{dd($rubrosObra)}}</td> --}}
							<td>{{$rubrosObra->nombre}}</td>
							<td>{{$rubrosObra->mano_obra}}</td>
							<td>
								<div>
				                  <input class="form-control" type="text" value="{{$rubrosObra->pivot->dimension_uno}}" id="inputDimUno_{{$rubrosObra->pivot->dimension_uno}}" name="inputDimUno[{{$rubrosObra->pivot->dimension_uno}}]">
				                </div>
								
							</td>
							<td>
								<div>
				                  <input class="form-control" type="text" value="{{$rubrosObra->pivot->dimension_dos}}" id="inputDimDos_{{$rubrosObra->pivot->dimension_dos}}" name="inputDimDos[{{$rubrosObra->pivot->dimension_dos}}]">
				                </div>
							</td>
							<td>
								<div>
				                  <input class="form-control" type="text" value="{{$rubrosObra->pivot->dimension_tres}}" id="inputDimTres_{{$rubrosObra->pivot->dimension_tres}}" name="inputDimTres_[{{$rubrosObra->pivot->dimension_tres}}]">
				                </div>
							</td>
							<td>
								@if ($rubrosObra->unidad_medida == "m2")
									{{$rubrosObra->pivot->dimension_uno *
									$rubrosObra->pivot->dimension_dos *
									$rubrosObra->mano_obra}}
								@elseif ($rubrosObra->unidad_medida == "m3")
									{{-- {{dd($rubrosObra->unidad_medida)}} --}}
									{{$rubrosObra->pivot->dimension_uno *
									$rubrosObra->pivot->dimension_dos *
									$rubrosObra->pivot->dimension_tres *
									$rubrosObra->mano_obra}}
								@else
									{{$rubrosObra->pivot->dimension_uno *
									$rubrosObra->mano_obra}}
								@endif
							</td>
						</tr>
					@endforeach
				{{-- @endforeach	 --}}
				</tbody>
			</table>
	</div>
</div>