
<div form-horizontal>
	@empty($planos)
	    <h5>No hay planos cargados para esta obra. Cargue primeramente por favor...</h5>
	@endempty
	@isset ($planos)
	    <div class="form-check form-check-inline">
	    	@foreach ($planos as $plano)
				<input class="form-check-input" type="radio" name="plano_seleccionado" id="plano_seleccionado" checked value="{{$plano->id}}">
				<label class="form-check-label" for="plano_seleccionado">{{$plano->nombre}}</label>
	    	@endforeach
		</div>
	@endisset
</div>
<br>
{{-- <div class="row"> --}}
	<table class="table" name="tablaRubros" id="tablaRubros" style="width: 100%">
		<thead>
			<tr>
				<th></th>
				<th>Elegir</th>
				<th>Nro</th>
				<th>Rubro</th>
				<th>Mano de Obra</th>
				<th>Unidad</th>
			</tr>
		</thead>
		<tbody>
			@if (isset($rubros))
			@foreach($rubros as $rubro)
			<tr>
				<td></td>
				<td></td>
				{{-- <td> <input type="checkbox" class="form-check-input" id="elegirRubro"> </td> --}}
				<td>{{$rubro->id}}</td>
				<td>{{$rubro->nombre}}</td>
				<td id="mano_obra_rubro">{{$rubro->mano_obra}}</td>
				<td>{{$rubro->unidad_medida}}</td>
			</tr>
			@endforeach
			@endif
		</tbody>
	</table>  
{{-- </div> --}} 
<div class="row">
	<div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
		<button type="submit" name="submitDocumento" value="2" class="btn button-primary">Guardar</button>
		<a class="btn button-primary" href="{{ route('documentos.create', $id_obra) }}">Cancelar</a>
		<button type="button" class="btn button-primary" id="volverRubro" name="button">Volver</button>
	</div>
</div>