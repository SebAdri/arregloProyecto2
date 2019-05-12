 <div class="row">
	<div class="table-responsive" >
		<table id="tablaRubros" class="table table-condensed" style="border-collapse:collapse;">

			<thead>
				<tr>
					{{-- <th>Mas</th> --}}
					<th>Elegir</th>
					<th>Nro</th>
					<th>Nombre Rubro</th>
					<th>Familia</th>
					<th>Costo del Rubro</th>
				</tr>
			</thead>
			<tbody>
				@foreach($rubros as $rubro)
				<tr data-toggle="collapse" data-target="#{{$rubro->id}}" class="accordion-toggle">
					<td>
						<div class="form-check">
		                  <input class="form-check-input" type="checkbox" value="{{$rubro->id}}" id="checkRubroesAsignado_{{ $rubro->id }}" name="checkRubroesAsignado[{{ $rubro->id }}]">
		                </div>
	                </td>
					<td>{{$rubro->id}}</td>
					<td>{{$rubro->nombre}}</td>
					<td>{{$rubro->nombre}}</td>
					<td>{{$rubro->mano_obra}}</td>
					
				</tr>
				@foreach($rubro->materiales as $material_rubro)
				<tr>
					
					<td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="{{$rubro->id}}"> 
						<table class="table table-striped">
							<thead>
								<tr>
									<td>Nombre del Material</td>
									<td>Cantidad</td>
									<td>Precio</td>
									<td>Costo</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>{{$material_rubro->m_descripcion}}</th>
									<th>{{$material_rubro->pivot->cantidad_material}}</th>
									<th>{{$material_rubro->m_costo}}</th>
									{{-- <th>{{$material_rubro->pivot->costo_x_material}}</th> --}}
									<th>{{$material_rubro->pivot->cantidad_material * $material_rubro->m_costo}}</th>
								</tr>
								</tbody>
							</table>

						</div> </td>
					
					</tr>
				@endforeach	
				@endforeach	
				</tbody>
			</table>
 

			{{-- hasta aca celso --}}
{{-- 
	 <table class="table" id="tablaRubros" name="tablaRubros" >
			<thead>
				<tr>
					<th>Elegir</th>
					<th>Nro</th>
					<th>Nombre Rubro</th>
					<th>Familia</th>
				</tr>
			</thead>
			<tbody>
				
				@if (isset($rubros))
				@foreach($rubros as $rubro)
				<tr>
					<td> <input type="checkbox" class="form-check-input" id="elegirRubro"> </td>
					<td>{{$rubro->id}}</td>
					<td>{{$rubro->nombre}}
						<div id="accordion">
						  <div class="card">
						    <div class="card-header" id="headingOne">
						      <h5 class="mb-0">
						        <button class="btn btn-link" data-toggle="collapse" data-target="#{{$rubro->id}}" aria-expanded="true" aria-controls="{{$rubro->id}}">
						          {{$rubro->nombre}}
						        </button>
						      </h5>
						    </div>

						    <div id="{{$rubro->id}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
						      <div class="card-body">
						        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
						      </div>
						    </div>
						  </div>
						</div>
					</td>
					<td>--</td>

				</tr>
				@endforeach
				@endif
			</tbody>
		</table>  --}}
	</div>
</div>