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
									{{-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name"> --}}
									@include('calculoCosto.partials.rubro-part2')
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
	function format ( d ) {
		var i = 0;
		var cuerpo = '';
	    // console.log(d.length);
	    for (i = 0; i < d.material.length; i++){
	    	console.log(d.material[i]);
	    	cuerpo = '<tr><td>'+d.material[i].m_descripcion+'</td>'+
	    	'<td>'+d.material[i].m_costo+'</td>'+
	    	'<td>'+d.material[i].pivot.cantidad_material+'</td>'
	    	+'<td>'+d.material[i].m_costo * d.material[i].pivot.cantidad_material+'</td></tr>'+ cuerpo;
		}
		var cabeceraYpie = '<table class="table table-striped table-bordered table-hover table-condensed" id="tablaRubrosHijo" name="tablaRubrosHijo" >'+
		'<thead>'+
		'<tr>'+
		'<th>Material</th>'+
		'<th>Costo Material</th>'+
		'<th>Cantidad Requerida</th>'+
		'<th>Total</th>'+
		'</tr>'+
		'</thead>'+
		'<tbody>'+
		cuerpo
		'</tbody>'+
		'</table>  '+
		'</div>';

		return cabeceraYpie;
}


$(document).ready(function() {
	var dt = $('#tablaRubros').DataTable({
		"processing": true,
        // "serverSide": true,
        "ajax": "{{route('jsonRubrosMateriales')}}",
        "columns": [
        {
        	"class":          "details-control",
        	"orderable":      false,
        	"data":           null,
        	"defaultContent": "",
        	width: "5%"
        },
        {
        	targets: 0,
        	data: null,
        	className: 'text-center',
        	searchable: false,
        	orderable: false,
        	render: function (data, type, full, meta) {

        		return '<input class="form-check-input" type="checkbox" name="checkRubroesAsignado['+data.id+']" value="' + data.id + '">';
        	},
        	width: "5%"
        },
            // { "data": "Elegir" },
            // { "data": "Nro" },
            // { "data": "Rubro" },
            // { "data": "Mano de Obra" },
            // { "data": "Unidad" }
            // { "data": "Elegir" },
            { "data": "id" },
            { "data": "nombre" },
            { "data": "mano_obra" },
            { "data": "unidad_medida" }
            ],
            "order": [[1, 'asc']]

        } );


    // Array to track the ids of the details displayed rows
    var detailRows = [];

    $('#tablaRubros tbody').on( 'click', 'tr td.details-control', function () {
    	var tr = $(this).closest('tr');
    	var row = dt.row( tr );
    	var idx = $.inArray( tr.attr('id'), detailRows );

    	if ( row.child.isShown() ) {
    		tr.removeClass( 'details' );
    		row.child.hide();

            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
        }
        else {
        	tr.addClass( 'details' );
        	row.child( format( row.data() ) ).show();

            // Add to the 'open' array
            if ( idx === -1 ) {
            	detailRows.push( tr.attr('id') );
            }
        }
    } );

    // On each draw, loop over the `detailRows` array and show any child rows
    dt.on( 'draw', function () {
    	$.each( detailRows, function ( i, id ) {
    		$('#'+id+' td.details-control').trigger( 'click' );
    	} );
    } );
} );



	// $(document).ready(function(response) {
	// 	var t = $('#tablaRubros').DataTable({	
	// 		// "processing": true,
 //   //          "serverSide": true,
	// 		"ordering": false,
	// 		"ajax":{
    			// url: "route('prueba')",
 //    			type: "GET",
	// 		},  
	// 		"columns": [
	// 		{
	// 			"className": "details-control",
	// 			"orderable": false,
	// 			"data": null,
	// 			"defaultContent": ""
	// 		},
	// 		{ "data": "Elegir"},
	// 		{ "data": "Nro"},
	// 		{ "data": "Nombre Rubro" },
	// 		{ "data": "Familia" },
	// 		// { "data": "salida" },
	// 		// { "data": "m_unidad_medida" },

	// 		],
	// 	});
	// 		// console.log(t.columns);

	// var detailRows = [];

	// $('#recibidos tbody').on( 'click', 'tr td.details-control', function () {
	// 	var tr = $(this).closest('tr');
	// 	var row = t.row( tr );
	// 	var idx = $.inArray( tr.attr('id'), detailRows );
	// 	if ( row.child.isShown() ) {
	// 		tr.removeClass('details');
	// 		row.child.hide();

 //            // Remove from the 'open' array
 //            detailRows.splice( idx, 1 );
 //        }
 //        else {
 //        	tr.addClass('details');
 //        	console.log( row.index());
 //        	row.child( format( row.data() ) ).show();
 //            // Add to the 'open' array
 //            if ( idx === -1 ) {
 //            	detailRows.push( tr.attr('id') );
 //            }
 //        }
 //    } );

 //    // On each draw, loop over the `detailRows` array and show any child rows
 //    t.on( 'draw', function () {
 //    	$.each( detailRows, function ( i, id ) {
 //    		$('#'+id+' td.details-control').trigger( 'click' );
 //    	} );
 //    } );	
 //    function format ( d ) {
 //    	// console.log(d);
 //    	var text ='';
 //    	for (i = 0; i < d.materiales.length; i++) { 
	// 	  text += d.materiales[i].m_descripcion + "<br>";
	// 	}
 //    	return 'el detalle es ' + text ;
 //    }	
// })

</script>
@endpush
@endsection