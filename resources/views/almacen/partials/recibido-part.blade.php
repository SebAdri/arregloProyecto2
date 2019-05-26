<form method="POST" action="{{ route('gestionPedido') }}">
	{{ csrf_field() }}
	<div class="row">
		<div class="col-md-7 col-md-offset-6">
    		<input type="hidden"class="form-control" name="obra" value={{$obra->id}}>

			<button type="submit" name="preOrden" value ='1' class="btn button-primary">PreOrden Compra</button>
			<button type="submit" name="salida" value ='1' class="btn button-primary">Salida de Materiales</button>
		</div>

	</div>
	<br>
	<div class="row">
		<div class="table-responsive mailbox-messages">
			<table class="table table-responsive table-hover table-striped" id="recibidos" style="width: 100%">
				<thead>
					<tr>
						<th></th>
						<th></th>
						<th>Cod. Pedido</th>
						<th>Solicitante</th>
						<th>Fecha Recepcion</th>
						<th>Fecha Atencion</th>
						<th>Estado</th>
						
					</tr>
				</thead>
				<tbody>
					@foreach ($bandejaEntrada as $recibido)
					<tr>
						<td></td>
						<td></td>
						{{-- <td><input type="checkbox" class="form-check-input" id="pedidoSelect[]"></td> --}}
						<td>{{$recibido->id}}</td>
						<td>{{$recibido->bandejaEnviado->nombre_proyecto}}</td>
						<td>{{$recibido->fecha_pedido}}</td>
						<td>{{$recibido->fecha_recibido}}</td>
						<td>{{$recibido->estado}}</td>
						{{-- <td>Compra</td> --}}
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>	
		
	</div>
</form>

@push('scripts')
<script type="text/javascript">
	$(document).ready(function(response) {
		var tRecibido = $('#recibidos').DataTable({	
			"processing": false,
			"serverSide": false,
			"ordering": false,
			"ajax":{
				url: '{{route('pedidosRecibidos')}}',
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

			$('#recibidos tbody').on( 'click', 'tr td.details-control', function () {
				var tr = $(this).closest('tr');
				var row = tRecibido.row( tr );
				var idx = $.inArray( tr.attr('id'), detailRows );
				if ( row.child.isShown() ) {
					tr.removeClass('details');
					row.child.hide();

            // Remove from the 'open' array
		            detailRows.splice( idx, 1 );
		        }else {
		        	tr.addClass('details');
		        	console.log( row.index());
		        	row.child( format( row.data() ) ).show();
		            // Add to the 'open' array
		            if ( idx === -1 ) {
		            	detailRows.push( tr.attr('id') );
		            }
		        }
		    } );

    // On each draw, loop over the `detailRows` array and show any child rows
		    tRedactar.on( 'draw', function () {
		    	$.each( detailRows, function ( i, id ) {
		    		$('#'+id+' td.details-control').trigger( 'click' );
		    	} );
		    } );	
    function format ( d ) {
    	// console.log(d);
    	var text ='';
    	text += '<div class="table-responsive">';
    	text += '<table class="table table-responsive table-hover table-striped" >';
    	text +='<thead>';
    	text +='<tr>';
    	text +='<th>Materiales</th>'

		text +='<th>Cantidad Solicitada</th>';
		// // text +='	<th>Fecha Recepcion</th>';
		// // text +='	<th>Fecha Atencion</th>';
		// // text +='	<th>Estado</th>';
		text +='	</tr>';
		text +='	</thead>';
		text +='	<tbody>';
		for (i = 0; i < d.materiales.length; i++) {
			text += '<tr>';
			text += '<td>'+d.materiales[i].nombre_material + "</td>";
			text += '<td>'+d.materiales[i].cantidad + "</td>";
			text += '</tr>';
		}
		text+= '</tbody>';
		text+= '</table>';
		text+= '</div>';
		
		return text ;
	}	
})

</script>
@endpush