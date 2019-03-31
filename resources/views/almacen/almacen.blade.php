@extends('layout')

@section('contenido')
<div class="container">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<h2>ALMACEN DE OBRA</h2>
				<div class="row">
					<div class="col-md-3">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pedido">Realizar Pedido</button>
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
								<th>Cantidad</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Cemento Porland</td>
								<td>--</td>
								<td>30</td>
								<td>120</td>
							</tr>
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
							<div class="row">
								<label for="mate">Descripcion</label>
								<input type="text" id="mate" name="mate" placeholder="Material Requerido">
								{{-- <label for="" style="margin-top: 10px">Material</label>
               					<div class="form-group">
					                <select class="form-control" id="mate_id" name="mate_id">
					                    @foreach ($materiales as $material) {
					                    	<option id="mate" value={{$material->id}}>{{$material->m_descripcion}}</option> 
					                    @endforeach
					                </select>
                				</div> --}}
								<label for="cant">Cantidad</label>
								<input type="text" onkeyup="format(this)" id="cant" name="cant" placeholder="Cantidad Requerida">								
							</div>
							<div class="row">
								<div class="table-responsive" >
									<table class="table" id="materiales" >
										<thead>
											<tr>
												<th>Material</th>
												<th>Cantidad</th>
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
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default">Enviar Aprobacion</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>
<!-- Modal -->
@push('scripts')
<script type="text/javascript">
	var counter = 1;
	var materiales = [];
	var cantMateriales =0;
	var t = $('#materiales').DataTable( {
		"paging":   false,
		"ordering": false,
		"info":     false,
		"searching": false,
		"language":{
			"sEmptyTable": "No se agregó ningun Material"
		}
	} );
	document.getElementById("cant").onkeypress = function() {myFunction(event, t, counter )};
	$('#materiales tbody').on('click', '#eliminar', function(){
		t.row($(this).parents('tr')).remove().draw(false);
		$("#cant_total").html('<th>Total Articulos: '+t.data().length+'</th>');
	});

	function myFunction(e, t, counter) {
		var cant = $('#cant').val();
		var mate = $('#mate').val();
		var id_mate = $('#id_mate').val();
		var button = '<button type="button" id="eliminar" name"eliminar" class="btn btn-primary"><i class="fa fa-trash"></i></button>';
		if(!isNaN(cant)){
			cant = cant.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
			cant = cant.split('').reverse().join('').replace(/^[\.]/,'');
			$('#cant').value = cant;
			if (e.which == 13) {
				// materiales.push(mate);
				t.row.add( [
					mate,
					cant, button
					] ).draw( false );
				$("#cant_total").html('<th>Total Articulos: '+t.data().length+'</th>');
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

	</script>
	@endpush
	@endsection


