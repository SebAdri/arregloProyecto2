@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('getPago') }}">
	{!! csrf_field() !!}
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Pagos</h1>
				</div>
				<div class="panel-body">
					<div class="col-md-11 col-md-offset-1">
						<label for="">Obra</label>
						<div class="form-group">
							<div class="input-group">
								<input type="text"  class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}" name="busqueda" id="busqueda" value="" placeholder="Nombre de la obra" required>
								@if ($errors->has('documento'))
								<span class="invalid-feedback errors" role="alert">
									<strong>{{ $errors->first('documento') }}</strong>
								</span>
								@endif
								<span class="input-group-btn">

									<button class="btn button-primary" id="buscar" type="submit"><i class="fa fa-search"></i></button>									
								</span>
							</div>
						</div>
					</div>
					<table id="tPagos" class="table table-responsive">
						<thead>
							<tr>
								<th style="text-align: center;">Nro.</th>
								<th style="text-align: center;">Saldo</th>
								<th style="text-align: center;">Monto pago</th>
								<th style="text-align: center;">Estado</th>
								<th style="text-align: center;">Accion</th>

								{{-- <th  style="text-align: center;"></th> --}}
							</tr>
						</thead>

						<tbody id="tPagosBody" style="text-align: center">
							@isset ($pagos)
								@foreach ($pagos as $pago)
								<tr>
									<td>{{$pago->nro_pago}}</td>
									<td>{{$pago->saldo}}</td>
									<td>{{number_format($pago->monto_pago, 0, '','.')}}</td>

									@if ($pago->estado==0)
										<td>Pendiente</td>
									@else
										<td>Pagado</td>
									@endif
									@if ($pago->estado==0)
										<td><a href="{{ route('facturas.show', $pago->id) }}"><button type=button>Generar Factura</button><a></td>
									@else
										<td><a href="{{ route('generate-factura', $pago->id) }}"><button type=button>Imprimir Factura</button><a></td>
									@endif
								</tr>
								@endforeach
							    
							@endisset
						</tbody>
					</table>

					{{-- <div class="row">
						<div class="col-md-4 col-md-offset-4" style="margin-top: 20px">
							<button type="submit" id="btnGuardar" class="btn button-primary">Guardar</button>
							<a class="btn button-primary" href="">Cancelar</a>
							<button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
						</div>
					</div> --}}
				</div>
			</div>
		</div>
	</div>
</form>
@endsection
@push('scripts')
	<script type="text/javascript">
		// $('#buscar').on('click', function(event){
		// 	event.preventDefault();
		// 	var busqueda = $('#busqueda').val();
		// 	if (busqueda != '') {
		// 		$.ajax({
		// 			headers: {
		// 				'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')
		// 			},
		// 			url:"{{ route('getPago') }}",
		// 			method: 'post', 
		// 			data: {
		// 				busqueda: busqueda,
		// 			},
  //     			})
		// 		.done(function (response){
		// 			// var pagos = JSON.parse(response);
		// 			var pagos = response;
		// 			console.log(pagos);
		// 			var text = "";
		// 			for (var i = 0; i < pagos.length; i++) {
		// 				text += '<tr>';
		// 				text += '<td>'+pagos[i].nro_pago+'</td>';
		// 				text += '<td>'+pagos[i].saldo+'</td>';
		// 				text += '<td>'+pagos[i].monto_pago+'</td>';
		// 				// text += pagos[i].estado;
		// 				// if (pagos[i].estado ==0) {
		// 				// 	text += '<td>Pendiente</td>';
		// 				// 	text += '<td><a href="#"><button type=button>Generar Factura</button><a></td>'
		// 				// }else if(pagos[i].estado ==1){
		// 				// 	text += '<td>Pagado</td>';
		// 				// 	text += '<td><a href="#"><button type=button>Imprimir Factura</button><a></td>'
		// 				// }
		// 				// text += '<td>'+pagos[i]+'</td>';
		// 				text += '</tr>'
		// 			}
		// 			$("#tPagosBody").html(text);
		// 			var tPagos = $('#tPagos').DataTable();

		// 			$("#pedido").modal('hide');
		// 			$("#message").html('<p>Se ha enviado la solicitud</p>');
		// 			$("#message").show();
		// 			$("#message").hide(1500);
  //         // location.reload();
  //     			})
		// 		.fail(function(){
		// 			alert('ocurrio un error interno, contacte con Rolo');
		// 		})
		// 	}
		// })
		
	</script>
	@endpush