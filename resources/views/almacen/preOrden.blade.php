@extends('layout')

@section('contenido')
<div class="container">
	<h2>Pre Orden de Compra</h2>
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="col-md-12">
				<div class="row">
					<form method="POST" action="{{ route('generarOrdenCompra') }}">
						{{ csrf_field() }}
						<div class="row">
							<div class="table-responsive mailbox-messages">
								<table class="table table-responsive table-hover table-striped" id="preOrden" style="width: 100%">
									<thead>
										<tr>
											<th>Cod. Material</th>
											<th>Material</th>
											<th>Cantidad Solicitada</th>
											<th>Proveedor</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($materialesPedidos as $material)
										<tr>
    										<input type="hidden"class="form-control" name="compra[materialesPedidos][]" value={{$material->id}}>
											<td>{{$material->id}}</td>
											<td>{{$material->m_descripcion}}</td>
											<td>{{$material->cantidad_solicitada}}</td>
    										<input type="hidden"class="form-control" name="compra[cantidad][]" value={{$material->cantidad_solicitada}}>
											<td><select class="form-control select2" name="compra[proveedores][]" style="width: 100%">
												@foreach ($proveedores as $proveedor)
													<option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
												@endforeach
											</select></td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
    						<input type="hidden"class="form-control" name="obra" value={{$obra}}>
							<button type="submit">aceptar</button>
						</div>
					</form>
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