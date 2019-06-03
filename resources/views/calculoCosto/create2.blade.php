@extends('layout')

@section('contenido')
<div class="row">
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-7 col-md-offset-3">
							<h2>Cálculo de costo de obra</h2>
						</div>
					</div>
				</div>

				<form method="POST" action="{{ route('calculoCosto.store') }}">
					{{csrf_field()}}
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
									<!--Check de lo splanos -->
									<label class="form-label">Planos de la obra {{$obras->nombre_proyecto}}</label>
									<div class="form-check form-check-inline">
										@foreach ($planos as $plano)
										{{-- <input type="checkbox" class="form-check-input" id="{{$plano->id}}"> --}}
										<input type="radio" name="plano_seleccionado" value="{{$plano->id}}"> 
										<label class="form-check-label" for="{{$plano->id}}">{{$plano->nombre}}</label>
										@endforeach
									</div>
									
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
	$(document).ready(function() {

		calcular_total();
		$('.produccion').keyup(function(){
			let cantidad = parseInt($(this).val());
			let precio = parseInt($(this).parent().parent().find('.costo_rubro').first().val());
			let costo = $(this).parent().parent().find('.costo_produccion').first();
			let all_costo = $(this).parent().parent().find('.costo_produccion');
			costo.text(precio * cantidad);

			calcular_total();

		});

		function calcular_total()
		{
			var sum = 0;
			$(".costo_produccion").each(function() {
				sum += Number($(this).text());
          // sum += Number($(this).attr("precio").replace(/,/g, "") * $(this).attr("cantidad").replace(/,/g, ""));

          // compare id to what you want
      });
			$(".costo_sub_total_obra").text(sum);
			console.log('a ver' + sum);
		}

		$('#beneficio').keyup(function(){
			let beneficio = parseInt($(this).val());
			let iva = parseInt($("#iva").val());
			let subtotal = parseInt($(".costo_sub_total_obra").text());
		// console.log(all_costo);
		// alert($("#iva").val());
		$("#costo_total_obra").val((parseInt($(".costo_sub_total_obra").text()) * (1+parseFloat($("#iva").val())))+parseInt($(this).val()));
		$("#costo_total_obra").text((parseInt($(".costo_sub_total_obra").text()) * (1+parseFloat($("#iva").val())))+parseInt($(this).val()));
	});

	//Aqui empieza la parte de grilla detalle de los rubros

	var dt = $('#tablaRubros').DataTable({
		language: {
			"search": "Buscar:",
			"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
			"infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
			"lengthMenu":     "Mostrar _MENU_ registros",
			"paginate": {
				"first": "Primero",
				"last": "Último",
				"next": "Siguiente",
				"previous": "Anterior"
			}
		},
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
				// return '<label> <input type="checkbox" name="checkRubroesAsignado['+data.id+']" value="' + data.id + '"/> <span> </span> </label>';
				return '<input type="checkbox" name="checkRubroesAsignado['+data.id+']" value="' + data.id + '">';
			},
			width: "5%"
		},
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
	};
	
</script>
@endpush
@endsection