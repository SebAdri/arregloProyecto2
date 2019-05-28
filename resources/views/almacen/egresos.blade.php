@extends('layout')

@section('contenido')
<div class="container">
	<div class="row">
		<h2>Pre Orden de Compra</h2>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-md-12">
					<div class="row">
						<form method="POST" action="{{ route('registrarEgresos') }}">
							{{ csrf_field() }}
							<div class="row">
								<div class="table-responsive mailbox-messages">
									<table class="table table-responsive table-hover table-striped" id="preOrden" style="width: 100%">
										<thead>
											<tr>
												<th>Cod. Material</th>
												<th>Material</th>
												<th>Cantidad Solicitada</th>
												<th>Cantidad Disponible</th>
												<th>Cantidad Dada</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($materialesPedidos as $material)
											<tr>
												<input type="hidden"class="form-control" name="egreso[materialesPedidos][]" value={{$material->material_id}}>
												<td>{{$material->material_id}}</td>
												<td>{{$material->m_descripcion}}</td>
												<td>{{$material->cantidad_solicitada}}</td>
												<input type="hidden"class="form-control" name="egreso[cantidad_solicitada][]" value={{$material->cantidad_solicitada}}>
												<td>{{$material->cantidad_actual}}</td>
												<td><input type="text" name="egreso[cantidad_dada][]"></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<input type="hidden"class="form-control" name="obra" value={{$obra}}>
	    						<input type="hidden"class="form-control" name="obra_id_solicitante" value={{$materialesPedidos[0]->id_obra_solicitante}}>

								<button type="submit">aceptar</button>
							</div>
						</form>
					</div>	
				</div>

			</div>
		</div>	
	</div>
	
</div>

@endsection

@push('scripts')
<script type="text/javascript">
	$(document).ready(function(response) {
		var t = $('#preOrden').DataTable();

		$(".select2").select2({
			tags: true,
  		// maximumSelectionLength : 1
  	});
	})

</script>
@endpush