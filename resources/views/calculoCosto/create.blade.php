@extends('layout')

@section('contenido')
<div class="row">
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-7 col-md-offset-3">
							<h1>Cálculo de costo de obra</h1>
						</div>
					</div>
				</div>

				<form method="POST" action="{{ route('calculoCosto.store', $id_obra) }}">
					{{csrf_field()}}
					<dir></dir>

					<ul class="nav nav-tabs" id="myTab" role="tablist">
						{{-- Primera pestaña --}}
						<li class="nav-item">
							<a class="nav-link active" id="rubros-tab" data-toggle="tab" href="#rubros" role="tab" aria-controls="rubros" aria-selected="true">Rubros</a>
						</li>
						{{-- Segunda pestaña --}}
						<li class="nav-item">
							<a class="nav-link" id="calculo-tab" data-toggle="tab" href="#calculo" role="tab" aria-controls="calculo" aria-selected="false">Cálculo</a>
						</li>
					</ul>

					<div class="tab-content" id="myTabContent">
						{{-- Primera pestaña detalle--}}
						<div class="tab-pane fade in active" id="rubros" role="tabpanel" aria-labelledby="rubros-tab">
						{{-- <div class="tab-pane fade show active" id="rubros" role="tabpanel" aria-labelledby="rubros-tab"> --}}
							<div class="panel-body">
								<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
								@include('calculoCosto.partials.rubro-part')
							</div>
						</div>
						{{-- Segunda pestaña detalle--}}
						<div class="tab-pane fade" id="calculo" role="tabpanel" aria-labelledby="calculo-tab">
							@if ($obras == null)
								<h2>No ha seleccionado y guardado ningun rubro para este proyecto. Favor elija algunos rubros para empezar el calculo</h2>
							@else
								<div class="panel-body">
									{{-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name"> --}}
									@include('calculoCosto.partials.calcul-part')
								</div>
							@endif
						</div>
					</div>

					<div class="row">
						<div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
							<button type="submit" class="btn button-primary">Guardar</button>
							<a class="btn button-primary" href="{{ route('calculoCosto.create') }}">Cancelar</a>
							<button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
						</div>
					</div>

				</div>
			</form>
		</div>    

	</div>
</div>
</div>
</div>
</div>

@push('scripts')
<script type="text/javascript">
	// function myFunction() {
	// 	var cant = $('#inputDimUno_').val();
	// 	// var mate = $('#mate').val();
	// 	alert(cant);
	// 	console.log(cant);
	// 	if(!isNaN(cant)){
	// 		$('#mate').val("");
	// 		// $('#cant').val("");
	// 	}else{
	// 		alert('Debe ser en numeros');
	// 	}
	// };


	function neeminhoud3(){
    var tabel = document.getElementById('tablaCalculos');
    var rijen = tabel.rows.length;

    for (i = 0; i < rijen; i++){
	        var inputs = tabel.rows.item(i).getElementsByTagName("input");
	        var inputslengte = inputs.length;

	        for(var j = 0; j < inputslengte; j++){
	            var inputval = inputs[j].value;                
	            alert(inputval);
	        }            
	    }      
	}



// 	function format ( d ) {
//     // `d` is the original data object for the row
//     return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
//         '<tr>'+
//             '<td>Full name:</td>'+
//             '<td>'+d.+'</td>'+
//         '</tr>'+
//         '<tr>'+
//             '<td>Extension number:</td>'+
//             '<td>'+d.mano_obra+'</td>'+
//         '</tr>'+
//         '<tr>'+
//             '<td>Extra info:</td>'+
//             '<td>'+d.unidad_medida+'</td>'+
//         '</tr>'+
//     '</table>';
// }
// 	//var rub = $("#tablaRubros").DataTable();
// 	var rub = $("#tablaRubros").DataTable({
// 		"columns": [
// 		{
// 			"className": 'details-control',
// 			"orderable": false,
// 			"data": 	null,
// 			"defaultContent": '	'
// 		},

// 		{"data":"nombre"},
// 		{"data":"mano_obra"},
// 		{"data":"unidad_medida"}
// 		]
// 	});


// 	//add el detalle
// 	$('#tablaRubros tbody').on('click', 'td.details-control', function() {
// 		var tr = $(this).closest('tr');
// 		var row = rub.row( tr );

// 	 	if (row.child.isShown()){ 
// 			row.child.hide()	;
// 			tr.removeClass('shown');
// 		}
// 		else
// 		{
// 			row.child(format(row.data()) ).show();
// 			tr.addClass('shown')
// 		}


// 	 });

	// var rub = $('#tablaRubros').DataTable( {
	// 	"paging":   false,
	// 	"ordering": false,
	// 	"info":     false,
	// 	"searching": false,
	// 	"language":{
	// 		"sEmptyTable": "No hay rubros disponibles"
	// 	}
	// } );  

</script>
@endpush
@endsection