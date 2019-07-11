<div class="box-header with-border">
	<h3 class="box-title">Stock Actual de la obra @isset ($obra)<b>{{$obra->nombre_proyecto}}</b> @endisset</h3>
</div>
<div class="box-body no-padding">	
	<div class="table-responsive mailbox-messages">
		<table class="table table-responsive table-hover table-striped" id="stockObra">
			<thead>
				<tr>
					<th>Cod. Material</th>
					<th>Descripcion</th>
					<th>Cantidad Minima</th>
					<th>Cantidad Actual</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($inventarioObra as $inventario)
				<tr @if ($inventario->cantidad_minima >= $inventario->cantidad_actual) id="aviso" @endif>
					<td>{{$inventario->material->id}}</td>
					<td>{{$inventario->material->m_descripcion}}</td>
					<td>{{$inventario->cantidad_minima}}</td>
					<td>{{$inventario->cantidad_actual}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@push('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		var t = $('#stockObra').DataTable();
	})
	
</script>
@endpush