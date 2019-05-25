 <div class="row">

 	<table class="table" id="tablaRubros" name="tablaRubros" >
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
 				<td>{{$rubro->mano_obra}}</td>
 				<td>{{$rubro->unidad_medida}}</td>
 			</tr>
 			@endforeach
 			@endif
 		</tbody>
 	</table>  
 </div>
 <div class="row">
	<div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
		<button type="submit" name="submitRubro" value="2" class="btn button-primary">Guardar</button>
		<a class="btn button-primary" href="{{ route('calculoCosto.create') }}">Cancelar</a>
		<button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
	</div>
</div>