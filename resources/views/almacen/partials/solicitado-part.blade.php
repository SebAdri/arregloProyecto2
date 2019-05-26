<div id="avisoRecepcionSolicitado"></div>
<table class="table table-responsive table-hover table-striped" id="solicitados"  style="width: 100%">
	<thead>
		<tr>
			<th></th>
			<th></th>
			<th>Cod. Pedido</th>
			<th>Fecha Solitada</th>
			<th>Fecha Recepcion</th>
			<th>Destino</th>
			<th>Estado</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($bandejaEnviado as $solicitado)
		<tr>
			<td></td>
			<td>{{$solicitado->id}}</td>
			<td>{{$solicitado->fecha_pedido}}</td>
			<td>{{$solicitado->bandejaEntrada->nombre_proyecto}}</td>
			<td>{{$solicitado->estado}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@push('scripts')
<script type="text/javascript">

	$(document).ready(function(response) {
		var tSolicitado = $('#solicitados').DataTable({	
			"processing": false,
			"serverSide": false,
			"ordering": false,
			"ajax":{
				url: '{{route('pedidosEnviados')}}',
				type: "get",
				data: {
					obra :'{{$obra->id}}',	
				},
			},  
			"columns": [
			{
				"className": "details-control",
				"orderable": false,
				"data": null,
				"defaultContent": ""
			},
			{
				targets: 0,
				data: null,
				className: 'text-center',
				searchable: false,
				orderable: false,
				render: function (data, type, full, meta) {
					return '<input type="checkbox" class="_check" name="pedidosCheck[]" value="' + data.id + '">';
				},
				width: "5%"
			},
			{ "data": "id"},
			{ "data": "obra.nombre_proyecto"},
			{ "data": "fecha_pedido" },
			{ "data": "fecha_recibido" },
			{ "data": "estado" }
			// { "data": "salida" },
			// { "data": "m_unidad_medida" },

			],
		});
			// console.log(t.columns);

			var detailRows = [];

			$('#solicitados tbody').on( 'click', 'tr td.details-control', function () {
				var tr = $(this).closest('tr');
				var row = tSolicitado.row( tr );
				var idx = $.inArray( tr.attr('id'), detailRows );
				if ( row.child.isShown() ) {
					tr.removeClass('details');
					row.child.hide();

            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
        }
        else {
        	tr.addClass('details');
        	// console.log( row.index());
        	row.child( format( row.data() ) ).show();
            // Add to the 'open' array
            if ( idx === -1 ) {
            	detailRows.push( tr.attr('id') );
            }
            $('#dsolicitado tbody').on( 'click', '#recepenviado', function () {
				// alert('se presiino');
				var id = $('#recepenviado').val();
				var material = row.data().materiales[id].id;
				var pedido = row.data().id;
				var cantidad_recibida = $('#cantRecepEnviado').val();
				$.ajax({
					headers: {
						'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')
					},
					url:'{{ route('recepcionPedido')}}',
					method: 'get', 
					data: {
						material:material,
						pedido: pedido,
						cantidad_recibida : cantidad_recibida,
					},
					dataType: 'json',
					success:function(reponse){
						console.log(reponse);
					}
				})
				.done(function (response){
					$("#avisoRecepcionSolicitado").html('<p>Se ha actualizado la cantidad Recibida</p>');
					$("#message").show();
					$("#message").hide(1500);
					// location.reload();
        			tSolicitado.ajax.reload();
				})
				.fail(function(){
					alert('ocurrio un error interno, contacte con Rolo');
				}) 
				console.log(row.data());
			});
        }
    } );

    // On each draw, loop over the `detailRows` array and show any child rows
    tSolicitado.on( 'draw', function () {
    	$.each( detailRows, function ( i, id ) {
    		$('#'+id+' td.details-control').trigger( 'click' );
    	} );
    } );


    function format ( d ) {
    	// console.log(d);
    	var text ='';
    	text += '<div class="table-responsive">';
    	text += '<table class="table" id="dsolicitado" name="detalleSolicitado">';
    	text +='<thead>';
    	text +='<tr>';
    	text +='<th>Materiales</th>'

    	text +='<th>Cantidad Solicitada</th>';
    	text +='<th>Cantidad Recibida</th>';
    	text +='<th>Accion</th>';
		// // text +='	<th>Estado</th>';
		text +='	</tr>';
		text +='	</thead>';
		text +='	<tbody>';
		for (i = 0; i < d.materiales.length; i++) {
			text += '<tr>';
			text += '<td>'+d.materiales[i].nombre_material + "</td>";
			text += '<td>'+d.materiales[i].cantidad_solicitada + "</td>";
			if (d.materiales[i].cantidad_recibida != null) {
				text += '<td>'+d.materiales[i].cantidad_recibida+'</td>';
			}else{
				text += '<td><input type="text" onkeyup="format(this)" id="cantRecepEnviado" name="cantRecepEnviado" placeholder="Cantidad Recibida"></td>';
				text += '<td><button type="button" id="recepenviado" name="recepenviado" value="'+i+'" class="btn btn-primary"><i class="fa fa-paper-plane-o"></i></button></td>';
			}

			text += '</tr>';
		}
		text+= '</tbody>';
		text+= '</table>';
		text+= '</div>';
		
		return text ;
	}
	var tdetalle = $('#dsolicitado').DataTable();
	
})
	
</script>
@endpush