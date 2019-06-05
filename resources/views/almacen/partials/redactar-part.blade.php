
<div class="col-md-12">
	{{-- <form method="POST" action="{{ route('almacen.store') }}"> --}}
			{!! csrf_field() !!}
			{!! method_field('POST') !!}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="selectObra">Destino del pedido</label>
					<select class="form-control select2" name="selectObra" style="width: 100%">
						@foreach ($obras as $obraPedido)
							@if ($obraPedido->id != $obra->id)
								<option id="obraDestino" value="{{$obraPedido->id}}">{{$obraPedido->nombre_proyecto}}</option>
							@endif
						@endforeach
					</select>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="selectMaterial">Seleccione el Material Requerido</label>
					<select id="materialBase" class="form-control select2" name="selectMaterial" style="width: 100%">
						@foreach ($materiales as $material)
							<option >{{$material->m_descripcion}}</option>
						@endforeach
					</select>
					
				</div>
				<div class="col-md-3">
					<label for="cant">Cantidad</label>
					<input type="text" onkeyup="format(this)" id="cant" name="cant" placeholder="Cantidad Requerida">
					
				</div>
			</div>
		</div>
		<hr>
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
		<input type="hidden"class="form-control" id="obra_id" name="obra_id" value={{$obra->id}}>
		<button type="button"  id="enviar" class="btn btn-default" value="2">Enviar Aprobacion</button>
	{{-- </form>	 --}}
</div>

@push('scripts')
<script type="text/javascript">
	$(".select2").select2({
		tags: true,
  		// maximumSelectionLength : 1
  	});
	var counter = 1;
	var materiales = [];
	var cantMateriales =0;
	var tRedactar = $('#materiales').DataTable( {
		"paging":   false,
		"ordering": false,
		"info":     false,
		"searching": false,
		"language":{
			"sEmptyTable": "No se agregó ningun Material"
		}
	} );
	var pedido = $("#tablaPedido").DataTable();
	document.getElementById("cant").onkeypress = function() {myFunction(event, tRedactar, counter )};
	$('#materiales tbody').on('click', '#eliminar', function(){
		tRedactar.row($(this).parents('tr')).remove().draw(false);
		$("#cant_total").html('<th>Total Articulos: '+tRedactar.data().length+'</th>');
	});
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	})
	function myFunction(e, t, counter) {
		var cant = $('#cant').val();
		var mate = $('#materialBase').val();
		var id_mate = $('#id_mate').val();
		var button = '<button type="button" id="eliminar" name"eliminar" class="btn btn-primary"><i class="fa fa-trash"></i></button>';
		if(!isNaN(cant)){
			// cant = cant.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
			// cant = cant.split('').reverse().join('').replace(/^[\.]/,'');
			$('#cant').value = cant;
			if (e.which == 13) {
				// materiales.push(mate);
				tRedactar.row.add( [
					mate,
					cant, button
					] ).draw( false );
				$("#cant_total").html('<th>Total Articulos: '+tRedactar.data().length+'</th>');
				$('#mate').val("");
				$('#cant').val("");
				$('#id_mate').val("");
				$('#mate').focus();
				// console.log(t.rows().data()[1]);
				// console.log(mater);
			}
		}else{
			alert('Debe ser en numeros');
		}
	};

	$('#enviar').click(function(){
		var obra_solicitante = $('#obra_id').val();
		var obra_destino = $('#obraDestino').val();
		var materiales = [];

		for (i = 0; i <tRedactar.data().length; i++ ){
			materiales.push(tRedactar.rows().data()[i]); 
		}
		$.ajax({
			headers: {
				'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')
			},
			url:'{{ route('almacen.store')}}',
			method: 'post', 
			data: {
				materiales:materiales,
				obra_solicitante: obra_solicitante,
				obra_destino: obra_destino, 
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
	$("#cantidadEdit").val(material[3]);
	$("#articuloEdit").val(material[1]);
	$("#descripcionEdit").val(material[2]);
	$("#ordenCompra").val(material[0]);
});
$("#aceptarPedido").on('click', function(){
	var id = $('#obra_id').val();
	var cantidad = $("#cantidadEdit").val();
	var articulo = $("#articuloEdit").val();
	var descripcion = $("#descripcionEdit").val();
	var ordenCompra = $("#ordenCompra").val();
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
			orden_compra_id: ordenCompra,
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
})





</script>
@endpush