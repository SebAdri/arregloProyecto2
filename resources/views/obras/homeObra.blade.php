@extends('layout')

@section('contenido')


{{-- desde aca --}}

<div class="row">
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-7 col-md-offset-3">
							<h1>Gestión de obras</h1>
						</div>
					</div>
				</div>

				{{-- <form method="POST" action="{{ route('obra') }}"> --}}
					{{csrf_field()}}
					<dir></dir>

					<!-- Main content -->
					<section class="content">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							{{-- Primera pestaña --}}
							<div class="row">
								<div class="col-md-3">
									<li class="nav-item">
										<!-- ./col -->
										<!-- small box -->
										<div class="small-box bg-green">
											<div class="inner">
												<h3>53<sup style="font-size: 20px">%</sup></h3>
												<p>Avance</p>
											</div>
											<div class="icon">
												<i class="ion ion-stats-bars"></i>
											</div>
											{{-- <a class="nav-link active" id="rubros-tab" data-toggle="tab" href="#rubros" role="tab" aria-controls="rubros" aria-selected="true">Rubros</a> --}}
											<a class="nav-link active" id="rubros-tab" data-toggle="tab" href="#rubros" role="tab" aria-controls="rubros" aria-selected="true" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</li>
								</div>
								<div class="col-md-3">
									<li class="nav-item">
										{{-- <a class="nav-link" id="calculo-tab" data-toggle="tab" href="#calculo" role="tab" aria-controls="calculo" aria-selected="false">Cálculo</a> --}}
										<!-- small box -->
										<div class="small-box bg-yellow">
											<div class="inner">
												<h3>53<sup style="font-size: 20px">%</sup></h3>
												<p>Almacen</p>
											</div>
											<div class="icon">
												<i class="ion ion-stats-bars"></i>
											</div>
											{{-- <a class="nav-link active" id="rubros-tab" data-toggle="tab" href="#rubros" role="tab" aria-controls="rubros" aria-selected="true">Rubros</a> --}}
											<a class="nav-link active" id="almacen-tab" data-toggle="tab" href="#almacen" role="tab" aria-controls="almcacen" aria-selected="true" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</li>	
								</div>
								<div class="col-md-3">
									<li class="nav-item">
										{{-- <a class="nav-link" id="calculo-tab" data-toggle="tab" href="#calculo" role="tab" aria-controls="calculo" aria-selected="false">Cálculo</a> --}}

										<!-- small box -->
										<div class="small-box bg-red">
											<div class="inner">
												<h3>53<sup style="font-size: 20px">%</sup></h3>
												<p>Empleados</p>
											</div>
											<div class="icon">
												<i class="ion ion-stats-bars"></i>
											</div>
											{{-- <a class="nav-link active" id="rubros-tab" data-toggle="tab" href="#rubros" role="tab" aria-controls="rubros" aria-selected="true">Rubros</a> --}}
											<a class="nav-link active" id="rubros-tab" data-toggle="tab" href="#rubros" role="tab" aria-controls="rubros" aria-selected="true" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</li>
								</div>
								<div class="col-md-3">
									<li class="nav-item">
										{{-- <a class="nav-link" id="calculo-tab" data-toggle="tab" href="#calculo" role="tab" aria-controls="calculo" aria-selected="false">Cálculo</a> --}}
										<!-- small box -->
										<div class="small-box bg-aqua">
											<div class="inner">
												<h3>53<sup style="font-size: 20px">%</sup></h3>
												<p>Documentos</p>
											</div>
											<div class="icon">
												<i class="ion ion-stats-bars"></i>
											</div>
											{{-- <a class="nav-link active" id="rubros-tab" data-toggle="tab" href="#rubros" role="tab" aria-controls="rubros" aria-selected="true">Rubros</a> --}}
											<a class="nav-link active" id="rubros-tab" data-toggle="tab" href="#rubros" role="tab" aria-controls="rubros" aria-selected="true" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</li>
								</div>
							</div>

						</ul>
					</section>

					<div class="tab-content" id="myTabContent">
						{{-- Primera pestaña detalle--}}
						<div class="tab-pane fade in active" id="rubros" role="tabpanel" aria-labelledby="rubros-tab">
							{{-- <div class="tab-pane fade show active" id="rubros" role="tabpanel" aria-labelledby="rubros-tab"> --}}
								<div class="panel-body">
									{{-- <br></br> --}}
									{{-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name"> --}}
									@include('obras.partials.avance-part')
								</div>
							</div>
							{{-- Segunda pestaña detalle--}}
							<div class="tab-pane fade" id="almacen" role="tabpanel" aria-labelledby="almacen-tab">
								{{-- @if ($obras == null)
								<h2>No ha seleccionado y guardado ningun rubro para este proyecto. Favor elija algunos rubros para empezar el calculo</h2>
								@else --}}
								<div class="panel-body">
									{{-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name"> --}}
									{{-- @include('obras.partials.avance-part') --}}
									{{"LLego a almacen"}}
								</div>
								{{-- @endif --}}
							</div>
						</div>

						

					</div>
				{{-- </form> --}}
			</div>    

		</div>
	</div>
</div>
</div>
</div>

  </div>

@push('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		calcular_porcentaje();

		$('.produccion').keyup(function(){
			let produccion = parseInt($(this).val());
			let area = parseInt($(this).parent().parent().find('.area').first().text());
			let porcentaje = $(this).parent().parent().find('.porcentaje').first();
			let porcentaje2 = $(this).parent().children().find('.porcentaje').first().val();
			console.log(produccion +' '+ area +' '+ porcentaje2);
			// porcentaje.val((area/produccion)*100);
			porcentaje.css('width',((produccion/area)*100).toFixed(1)+'%');
			porcentaje.text(((produccion/area)*100).toFixed(1) + '%');

			calcular_porcentaje();
		});

		function calcular_porcentaje()
		{
			var sumProd = 0;
			var sumArea = 0;
			$(".produccion").each(function() {
				sumProd += Number($(this).val());
			});
			$(".area").each(function() {
				sumArea += Number($(this).text());
			});
			$(".total_porcentaje").val(((sumProd/sumArea)*100).toFixed(1));
			$(".total_porcentaje").text('TOTAL PORCENTAJE DEL AVANCE DE LA OBRA: '+((sumProd/sumArea)*100).toFixed(1) + '%');
			// console.log('a ver' + sumProd);
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
	