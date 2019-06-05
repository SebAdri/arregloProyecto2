@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('documentos.store') }}">
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

									<button class="btn button-primary" id="buscar" type="button"><i class="fa fa-search"></i></button>									
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

						<tbody style="text-align: center">
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
		$('#buscar').on('click', function(){
			var busqueda = $('#busqueda').val();
			if (busqueda != '') {
				$.ajax({
					headers: {
						'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')
					},
					url:"{{ route('getPago') }}",
					method: 'post', 
					data: {
						busqueda: busqueda,
					},
      			})
				.done(function (response){
					console.log(response);
					
					$("#pedido").modal('hide');
					$("#message").html('<p>Se ha enviado la solicitud</p>');
					$("#message").show();
					$("#message").hide(1500);
          // location.reload();
      			})
				.fail(function(){
					alert('ocurrio un error interno, contacte con Rolo');
				})
				var tPagos = $('#tPagos').DataTable();
			}
		})
		
	</script>
@endpush