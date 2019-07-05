@extends('layout')

@section('contenido')
<form id="reporteAvance" method="GET" action="{{ route('exportarPdf') }}">
	{{csrf_field()}}
	<div class="x_panel">
		<h1>Reporte de Avance</h1>
		<div class="x_title"></div>
		<div class="x_content">
			<h3>Parametros de filtros</h3>
		</div>
		<br>
		<div class="row">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Elija una obra</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<select id="obra_id" name="obra_id" class="select2_single form-control" tabindex="-1">
					<option></option>
					@foreach ($obras as $obra)
					<option value="{{$obra->id}}">{{$obra->nombre_proyecto}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<br>
		<div class="row">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Seleccione un rango de fecha</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" id="periodo" name="periodo" value="" class="form-control">
			</div>
		</div>
		<br>

		<div class="col-md-9 col-md-offset-3">
			{{-- <button type="submit" class="btn btn-success"  id="submitReporteAvance" name="submitReporteAvance" value="1" onclick="changeMethod2()">Generar Reporte</button> --}}
			{{-- <button type="submit" class="btn btn-primary">Cancelar</button> --}}
			<button type="submit" class="btn btn-info" id="submitReporteAvance2" name="submitReporteAvance2" value="2">Exportar a PDF</button>
			{{-- <a href="{{ route('exportarPdf') }}" class="btn btn-info">Exportar a PDF link</a> --}}
		</div>
		<br><br>
		@isset ($proyecto)
			<h3>Obra</h3>
			<label>{{$proyecto->nombre_proyecto}}</label>
			<input type="hidden" id="proyecto" value ="{{$proyecto->id}}">
			<h4>Periodo</h4>
			<label id="fechas">{{$periodo}}</label>
		@endisset
		@include('reportes.partials.reportAvanceBody-part')
		<div class="x_title"></div>
		
	</div>
</form>
@endsection

@push('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$(function() {
			var start = moment().subtract(29, 'days');
			var end = moment();
			$('input[name="periodo"]').daterangepicker({
				autoUpdateInput: false,
				startDate: start,
				endDate: end,
				ranges: {
					'Hoy': [moment(), moment()],
					'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
					'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
					'Este Mes': [moment().startOf('month'), moment().endOf('month')],
					'Últimos Mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				},
		      // alwaysShowCalendars:'true',
		      locale: {
		      	cancelLabel: 'Limpiar',
		      	applyLabel: 'Aplicar',
		      	customRangeLabel: "Elija rango",
		      }
		  });

			$('input[name="periodo"]').on('apply.daterangepicker', function(ev, picker) {
				$(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
			});

			$('input[name="periodo"]').on('cancel.daterangepicker', function(ev, picker) {
				$(this).val('');
			});
		});

		// $('#submitReporteAvance2').click(function(){
	 //      $("#reporteAvance").attr("method", "get");
	 //      $("#reporteAvance").attr("action", {{ route('exportarPdf') }});
	 //      alert('llega');

		// });

		// $('#reporteAvance').submit(function(event){
	 //      $(this).attr("method", "get");
	 //      // alert('llega');
	      
	 //    });
		

		// function changeMethod2(){
	 //      $("#reporteAvance").attr("method", "post");
		// };
	} );
</script>
@endpush