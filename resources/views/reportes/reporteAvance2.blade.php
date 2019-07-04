@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('generarAvance') }}">
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
				<input type="text" name="periodo" value="" class="form-control"/>
				{{-- <div id="reportrange_right" name="reportrange_right" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
					<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
					<span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
				</div> --}}
			</div>
		</div>
		<br>

		<div class="col-md-9 col-md-offset-3">
			<button type="submit" class="btn btn-success">Generar Reporte</button>
			<button type="submit" class="btn btn-primary">Cancelar</button>
		</div>
		<br><br>
		<div class="x_title"></div>
		<table id="tableReporteAvance" class="table table-responsive table-hover table-bordered">
			<thead>
				<td>Planos</td>
				<td>Rubros</td>
				<td>Avances</td>
				<td>Fecha Control</td>
			</thead>
			<tbody>
				@isset ($planos)
				    @foreach ($planos as $plano)
				    	<tr>
				    		<td class="well" colspan="4">{{$plano->nombre}}</td>
				    		{{--<td class="well"></td> 
				    		<td class="well"></td>
				    		<td class="well"></td> --}}
				    	</tr>
				    	@isset ($reportes)
							@foreach ($reportes as $reporte)
								<tr>
									<td class="well"></td>
									{{-- <td>{{App\Plano::find($reporte->plano_id)->nombre}}</td> --}}
									<td>{{App\Rubro::find($reporte->rubro_id)->nombre}}</td>
									<td>{{$reporte->avance}}</td>
									<td>{{$reporte->fecha_control}}</td>
								</tr>
							@endforeach
						@endisset
				    @endforeach
				@endisset
				
			</tbody>
		</table>
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
	} );
</script>
@endpush