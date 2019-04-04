@extends('layout')

@section('contenido')
<div class="container">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<h2>ALMACEN DE OBRA</h2>
				<h3>{{$obra->nombre_proyecto}}</h3>
				<div id="message"></div>
				<div class="row">
					<div class="col-md-6">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pedido">Realizar Pedido</button>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#gestion">Gestion Pedido</button>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#remision">Recibir Pedido</button>

					</div>
				</div>
				<div class="row">

					<table class="table table-responsive">
						<thead>
							<tr>
								<th>Cod. Material</th>
								<th>Descripcion</th>
								<th>Tipo</th>	
								<th>Cantidad Minima</th>
								<th>Cantidad Actual</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($inventario as $i)
						        <tr @if ($i->cantidad_minima >= $i->cantidad_actual) id="aviso" @endif>
						        	<td>{{$i->material->id}}</td>
						        	<td>{{$i->material->m_descripcion}}</td>
						        	<td></td>
	        						<td>{{$i->cantidad_minima}}</td>
	        						<td>{{$i->cantidad_actual}}</td>
	        					</tr>
	        				@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<div id="pedido" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Orden de Compra</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-12">
							<form method="POST" action="{{ route('almacen.store') }}">
								<div class="row">
									{!! csrf_field() !!}
  									{!! method_field('POST') !!}

									<label for="mate">Descripcion</label>
									<input type="text" id="mate" name="mate" placeholder="Material Requerido">
						            <label for="cant">Cantidad</label>
						            <input type="text" onkeyup="format(this)" id="cant" name="cant" placeholder="Cantidad Requerida">								
						        </div>
						        <hr>
								<div class="row" id="resultado"></div>
						        <div class="row">
						        	<div class="table-responsive" >
						        		<table class="table" id="materiales" name="materiales">
						        			<thead>
						        				<tr>
						        					<th>Material</th>
						        					<th>Cantidad Minima</th>
						        					<th>Accion</th>
						        				</tr>
						        			</thead>
						        			<tbody>
						        			</tbody>
						        			<tfoot>
						        				<tr>

						        					<th id="cant_total">Total Articulos: 0 </th>

						        				</tr>
						        			</tfoot>
						        		</table>
						        	</div>


						        </div>
						    </div>

						</div>
						<input type="hidden"class="form-control" id="obra_id" name="obra_id" value={{$obra->id}}>
						<button type="button"  id="enviar" class="btn btn-default" value="2">Enviar Aprobacion</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					{{-- </form> --}}
				</div>
			</div>
			<div class="modal-footer">
			</div>
		</div>

	</div>
</div>
<div id="gestion" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Gestion de Pedido</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-12">
							<div id="editPedido">
								<form method="POST" action="#">
									<div class="row">
										{!! csrf_field() !!}								
									</div>
									<div class="edit">
										<div class="col-md-3">
											<label for="">Articulo</label>
											<input type="text" class="form-control" name="articulo" readonly id="articuloEdit" value="" placeholder="Articulo">
										</div>
										<div class="col-md-3">
											<label for="">Descripcion</label>
											<input type="text" class="form-control" name="descripcion" id="descripcionEdit" value="" placeholder="Descripcion">
										</div>
										<div class="col-md-3">
											<label for="">Cantidad</label>
											<input type="text" class="form-control" name="cantidad" id="cantidadEdit" value="" placeholder="Cantidad Requerida">
										</div>
									</div>

									<div class="row">
										<div class="col-md-4 col-md-offset-2">
											<br>
											<button type="button" class="btn btn-primary" id="aceptarPedido" name="button">Aceptar</button>
											<button type="button" class="btn btn-primary" id="cancelar" name="button">Cancelar</button>
										</div>
										<div class="col-md-3">
										</div>
									</div>
								</form>
							</div>
							<h3>Orden de Compra</h3>
							<div class="col-md-11 col-md-offset-1">
								<div class="row">
									<div class="table-responsive" >

										<table class="table"  name="tablaPedido" id="tablaPedido">
											<thead>
												<tr>
													<th>Articulo</th>
													<th>Descripcion</th>
													<th>Cantidad Solicitada</th>
													<th>Precio</th>
													<th>En Almacen General</th>
													<th>Accion</th>
												</tr>
											</thead>
											<tbody>
												@if (isset($materiales))
												@foreach($materiales as $material)
												<tr>
													<td>{{$material->material->id}}</td>
													<td>{{$material->material->m_descripcion}}</td>
													<td>{{$material->cantidad}}</td>
													<td>--</td>
													<td>--</td>
													<td><button type="button" class="btn btn-primary btn-rounded btn-sm my-0" id="editarPedido"><i class="fa fa-edit" style="font-size:24px;"></i></button><button type="button" class="btn btn-success btn-rounded btn-sm my-0"><i class="fa fa-check" style="font-size:24px;"></i></button></td>
												</tr>
												@endforeach
												@endif
											</tbody>
										</table>
									</div>
								</div>

								</div>
								<div id="egreso">
									<hr>
									<h3>Orden de Egreso</h3>

									<div class="col-md-10 col-md-offset-1" >

									</div>
								</div>
							</div>    
						</div>

					</div>
					<input type="hidden"class="form-control" id="obra_id" name="obra_id" value={{$obra->id}}>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
			<div class="modal-footer">
			</div>
		</div>

	</div>
	<div id="remision" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Orden de Compra</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-12">
							<form method="POST" action="{{ route('almacen.store') }}">
								<div class="col-md-12">
								<div class="row">
									<div class="table-responsive" >

										<table class="table"  name="tablaPedido" id="tablaPedido">
											<thead>
												<tr>
													<th>Articulo</th>
													<th>Descripcion</th>
													<th>Cantidad Solicitada</th>
													<th>Cantidad Recibida</th>
													<th>Observacion</th>
													<th>Accion</th>
												</tr>
											</thead>
											<tbody>
												@if (isset($materiales))
												@foreach($materiales as $material)
												<tr>
													<td>{{$material->material->id}}</td>
													<td>{{$material->material->m_descripcion}}</td>
													<td>{{$material->cantidad}}</td>
													<td><input type="text" name="recibido" placeholder="Recibido"></td>
													<td><input type="text" name="Obs" placeholder="Observacion"></td>
													<td><button type="button" class="btn btn-primary btn-rounded btn-sm my-0" id="editarPedido"><i class="fa fa-edit"></i></button><button type="button" class="btn btn-success btn-rounded btn-sm my-0"><i class="fa fa-check" ></i></button></td>
												</tr>
												@endforeach
												@endif
											</tbody>
										</table>
									</div>
								</div>

								</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
			</div>
		</div>

	</div>
</div>
</div>
</div>
<!-- Modal -->
@push('scripts')
<script type="text/javascript">
	var counter = 1;
	var materialesAux =[];
	var i = 0;
	var t = $('#materiales').DataTable( {
		"paging":   false,
		"ordering": false,
		"info":     false,
		"searching": false,
		"language":{
			"sEmptyTable": "No se agregó ningun Material"
		}
	} );
	var pedido = $("#tablaPedido").DataTable();
	document.getElementById("cant").onkeypress = function() {myFunction(event, t, counter )};
	$('#materiales tbody').on('click', '#eliminar', function(){
		t.row($(this).parents('tr')).remove().draw(false);
		$("#cant_total").html('<th>Total Articulos: '+t.data().length+'</th>');
	});
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
	})
	$(document).ready(function(){
		$('#mate').on('keypress', function(){
			
			var material = $("#mate").val();
			if (material.length == $("#mate").val().length){
				$.ajax({
					// headers: {
					// 	'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')
					// },
					url:'{{route('almacenMateriales') }}',
					method: 'post', 
					data: {
						{{-- "_token":"{{ csrf_token() }}", --}}
						material:material
					}	
				})
				.done(function(resultado){
					$("#resultado").html(resultado);
				})
				.fail(function(JqXHR,errorThrown ){
					alert('ocurrio un error interno, contacte con Rolo');
					console.log(JqXHR.fail());
				})
				
			};

		})	
	})
	
	function myFunction(e, t, counter) {
		var cant = $('#cant').val();
		var mate = $('#mate').val();
		var button = '<button type="button" id="eliminar" name"eliminar" class="btn btn-primary"><i class="fa fa-trash"></i></button>';
		if(!isNaN(cant)){
			if (e.which == 13) {
				e.preventDefault();
				t.row.add( [
					mate,
					cant, button
					] ).draw( false );
				$("#cant_total").html('<th>Total Articulos: '+t.data().length+'</th>');
				$('#mate').val("");
				$('#cant').val("");
				$('#id_mate').val("");
				$('#mate').focus();
			}
		}else{
			alert('Debe ser en numeros');
		}
	};
	$('#enviar').click(function(){
		var id = $('#obra_id').val();
		var materiales = [];

		for (i = 0; i <t.data().length; i++ ){
			materiales.push(t.rows().data()[i]); 
		}
		$.ajax({
			headers: {
				'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')
			},
			url:'{{ route('almacen.store')}}',
			method: 'post', 
			data: {
				materiales:materiales,
				obra: id, 
			},
			dataType: 'json',
			success:function(reponse){
				console.log(reponse);
			}
		})
		.done(function (response){
			$("#pedido").modal('hide');
			$("#message").html('<p>Se ha enviado la solicitud</p>');
			$("#message").show();
			$("#message").hide(1500);
			location.reload();
		})
		.fail(function(){
			alert('ocurrio un error interno, contacte con Rolo');
		})
	});
	function format(input){
		var num = input.value.replace(/\./g,'');
		if(!isNaN(num)){
			num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
			num = num.split('').reverse().join('').replace(/^[\.]/,'');
			input.value = num;
		}
		else{ alert('Solo se permiten numeros');
		input.value = input.value.replace(/[^\d\.]*/g,'');
	}
}
$("#editPedido").hide();
$('#tablaPedido tbody').on('click', '#editarPedido', function(){
	$("#editPedido").show();
		var material = pedido.row($(this).parents('tr')).data()
		$("#cantidadEdit").val(material[2]);
		$("#articuloEdit").val(material[0]);
		$("#descripcionEdit").val(material[1]);
		  
});
$("#aceptarPedido").on('click', function(){
	var id = $('#obra_id').val();
	var cantidad = $("#cantidadEdit").val();
	var articulo = $("#articuloEdit").val();
	var descripcion = $("#descripcionEdit").val();
	$.ajax({
		headers: {
			'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')
		},
		url:"{{ route('updatePedido')}}",
		method: 'post', 
		data: {
			cantidad: cantidad,
			articulo:articulo,
			descripcion:descripcion,
			obra: id, 
		},
		dataType: 'json',
		// success:function(reponse){
		// 	console.log(reponse);
		// }
		})
	.done(function (response){
		$("#pedido").modal('hide');
		$("#message").html('<p>Se ha enviado la solicitud</p>');
		$("#message").show();
		$("#message").hide(1500);
		location.reload();
	})
	.fail(function(){
		alert('ocurrio un error interno, contacte con Rolo');
	})
})
$("#cancelar").on('click', function(){
	$("#editPedido").hide();
});

</script>
@endpush
@endsection


