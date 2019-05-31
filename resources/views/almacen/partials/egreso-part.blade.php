
<h2>Compras</h2>
<div id="avisoRecepcionCompra"></div>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="col-md-12">
			<div class="table-responsive mailbox-messages">
				<table class="table table-responsive table-hover table-striped" id="tEgresos" style="width: 100%">
					<thead>
						<tr>
							<th></th>
							<th>Cod. Compra</th>
							<th>Proveedor</th>
							<th>Fecha Compra</th>
						</tr>
					</thead>
					<tbody>

						@foreach ($egresos as $egreso)
						<tr>
							<th></th>
							<td>{{$egreso->id}}</td>
							<td>{{$egreso->obra}}</td>
							<td>{{$egreso->fecha_envio}}</td>

						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>	
	</div>

</div>
@push('scripts')
<script type="text/javascript">
	$(document).ready(function(response) {
		var tEgresos = $('#tEgresos').DataTable({	
			"processing": false,
			"serverSide": false,
			"ordering": false,
			"ajax":{
				url: '{{route('egresosRealizados')}}',
				type: "get",
				data :{
					obra :'{{$obra->id}}',	
				}
			},  
			"columns": [
			{
				"className": "details-control",
				"orderable": false,
				"data": null,
				"defaultContent": ""
			},
			{ "data": "id"},
			{ "data": "obra_solicitante"},
			{ "data": "fecha_envio" },
			// { "data": "fecha_recepcion" },
			],
		});
			// console.log(t.columns);

			var detailRows = [];

			$('#tEgresos tbody').on( 'click', 'tr td.details-control', function () {
				var tr = $(this).closest('tr');
				var row = tEgresos.row( tr );
				var idx = $.inArray( tr.attr('id'), detailRows );
				if ( row.child.isShown() ) {
					tr.removeClass('details');
					row.child.hide();

            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
        }
        else {
        	tr.addClass('details');
        	console.log( row.index());
        	row.child( format( row.data() ) ).show();
            // Add to the 'open' array
            if ( idx === -1 ) {
            	detailRows.push( tr.attr('id') );
            }
            $('#dEgresos tbody').on( 'click', '#recepCompra', function () {
				// alert('se presiino');
				var id = $('#recepenviado').val();
				var material = row.data().materiales[id].id;
				var pedido = row.data().id;
				var cantidad_recibida = $('#cantRecepCompra').val();
				$.ajax({
					headers: {
						'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')
					},
					url:'{{ route('recepcionCompra')}}',
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
					$("#avisoRecepcionCompra").html('<p>Se ha actualizado la cantidad Recibida</p>');
					$("#message").show();
					$("#message").hide(1500);
					// location.reload();
        			tEgresos.ajax.reload();
				})
				.fail(function(){
					alert('ocurrio un error interno, contacte con Rolo');
				}) 
				console.log(row.data());
			});
        }
        
    } );

    // On each draw, loop over the `detailRows` array and show any child rows
    tEgresos.on( 'draw', function () {
    	$.each( detailRows, function ( i, id ) {
    		$('#'+id+' td.details-control').trigger( 'click' );
    	} );
    } );	
    function format ( d ) {
    	// console.log(d);
    	var text ='';
    	text += '<div class="table-responsive">';
    	text += '<table class="table table-responsive table-hover table-striped" id="dEgresos" >';
    	text +='<thead>';
    	text +='<tr>';
		text +='<th>Cantidad Solicitada</th>';
		text +='<th>Cantidad Recibida</th>';
		// // text +='	<th>Fecha Atencion</th>';
		// // text +='	<th>Estado</th>';
		text +='	</tr>';
		text +='	</thead>';
		text +='	<tbody>';
		for (i = 0; i < d.materiales.length; i++) {
			text += '<tr>';
			text += '<td>'+d.materiales[i].nombre_material + "</td>";
			text += '<td>'+d.materiales[i].cantidad_solicitada + "</td>";
			text += '</tr>';
		}
		text+= '</tbody>';
		text+= '</table>';
		text+= '</div>';
		
		return text ;
	}	
});

</script>
@endpush