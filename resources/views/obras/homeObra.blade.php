@extends('layout')

@section('contenido')

<div class="row">
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-7 col-md-offset-3">
							<h1>Avance de la Obra</h1>
						</div>
					</div>
				</div>

				<form method="POST" action="{{ route('avance.store') }}">
					{{csrf_field()}}
					<dir></dir>
					<div class="tab-content" id="myTabContent">
						{{-- Primera pestaña detalle--}}
						<div class="tab-pane fade in active" id="rubros" role="tabpanel" aria-labelledby="rubros-tab">
							<div class="panel-body">
								@include('obras.partials.avance-part')
							</div>
						</div>
						{{-- Segunda pestaña detalle--}}
						<div class="tab-pane fade" id="almacen" role="tabpanel" aria-labelledby="almacen-tab">
							<div class="panel-body">
								{{"LLego a almacen"}}
							</div>
						</div>
					</div>
				</form>
			</div>    
		</div>
	</div>
</div>

{{-- </body> --}}
@push('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		document.getElementById('fecha_avance').value = new Date().toISOString().substring(0, 10);
		calcular_porcentaje_final();
		

		$('.produccion').keyup(function(){
			// alert('llego');
			let area = parseInt($(this).parent().parent().find('.area').first().text());
			let produccion = parseInt($(this).val());
			let porcentaje = $(this).parent().parent().find('.porcentaje').first();
			let porcentaje2 = $(this).parent().children().find('.porcentaje').first().val();

			if (produccion != 0) {
				console.log(produccion +' '+ area +' '+ porcentaje2);
				// porcentaje.val((area/produccion)*100);
				porcentaje.css('width',((produccion/area)*100).toFixed(1)+'%');
				porcentaje.text(((produccion/area)*100).toFixed(1) + '%');

				calcular_porcentaje_final();
			}
			else
			{
				porcentaje.css('width',(0).toFixed(1)+'%');
				porcentaje.text(0 + '%');
				
			}
		});

		$('.produccionDos').keyup(function(){
			var sumProd = 0;
			var sumArea = 0;
			$(".produccionDos").each(function() {
				sumProd += Number($(this).val());
				if (Number($(this).val()) == 0) {
					$(this).parent().parent().find('.porcentaje').first().css('width',(0).toFixed(1)+'%');
					$(this).parent().parent().find('.porcentaje').first().text(0 + '%');
				}
				else
				{
					let area = parseInt($(this).parent().parent().find('.area').first().text());
					let produccion = parseInt($(this).val());
					console.log(Number($(this).val()));
					let porcentaje = $(this).parent().parent().find('.porcentaje').first();
					porcentaje.css('width',((produccion/area)*100).toFixed(1)+'%');
					porcentaje.text(((produccion/area)*100).toFixed(1) + '%');			
				}

			});
			$(".area").each(function() {
				sumArea += Number($(this).text());
			});
			if (sumProd != 0) {
				$(".total_porcentaje").css('width',((sumProd/sumArea)*100).toFixed(1) + '%');
				$(".total_porcentaje").text('TOTAL PORCENTAJE DEL AVANCE DE LA OBRA: '+((sumProd/sumArea)*100).toFixed(1) + '%');
			}
			else
			{
				$(".total_porcentaje").css('width',(0).toFixed(1)+'%');
				$(".total_porcentaje").text('TOTAL PORCENTAJE DEL AVANCE DE LA OBRA: '+0+ '%');
			}
		});


		function calcular_porcentaje_final()
		{
			var sumProd = 0;
			var sumArea = 0;
			$(".produccion").each(function() {
				sumProd += Number($(this).val());
				if (Number($(this).val()) == 0) {
					$(this).parent().parent().find('.porcentaje').first().css('width',(0).toFixed(1)+'%');
					$(this).parent().parent().find('.porcentaje').first().text(0 + '%');
				}
				else
				{
					let area = parseInt($(this).parent().parent().find('.area').first().text());
					let produccion = parseInt($(this).val());
					console.log(Number($(this).val()));
					let porcentaje = $(this).parent().parent().find('.porcentaje').first();
					porcentaje.css('width',((produccion/area)*100).toFixed(1)+'%');
					porcentaje.text(((produccion/area)*100).toFixed(1) + '%');			
				}

			});
			$(".area").each(function() {
				sumArea += Number($(this).text());
			});
			if (sumProd != 0) {
				$(".total_porcentaje").css('width',((sumProd/sumArea)*100).toFixed(1) + '%');
				$(".total_porcentaje").text('TOTAL PORCENTAJE DEL AVANCE DE LA OBRA: '+((sumProd/sumArea)*100).toFixed(1) + '%');
			}
			else
			{
				$(".total_porcentaje").css('width',(0).toFixed(1)+'%');
				$(".total_porcentaje").text('TOTAL PORCENTAJE DEL AVANCE DE LA OBRA: '+0+ '%');
			}

		}

		$('#beneficio').keyup(function(){
			let beneficio = parseInt($(this).val());
			let iva = parseInt($("#iva").val());
			let subtotal = parseInt($(".costo_sub_total_obra").text());
			$("#costo_total_obra").val((parseInt($(".costo_sub_total_obra").text()) * (1+parseFloat($("#iva").val())))+parseInt($(this).val()));
		});

	});
</script>
@endpush

@stop



{{-- hasta aca --}}
