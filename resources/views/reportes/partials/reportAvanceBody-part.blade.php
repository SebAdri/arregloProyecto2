
<table id="tableReporteAvance" class="table table-hover table-bordered">
	<thead>
		<tr>
			<th>Planos</th>
			<th>Rubros</th>
			<th>Avances</th>
			<th>Fecha Control</th>		
		</tr>
	</thead>
	<tbody>
		@isset ($planos)
			@foreach ($planos as $plano)
			<tr class="corte">
				<td colspan="4">{{$plano->nombre}}</td>
	    		{{-- <td>--</td> 
	    		<td>--</td>
	    		<td>--</td>  --}}
	    	</tr>
		    	@isset ($reportes)
			    	@foreach ($reportes as $reporte)
			    	<tr>
			    		<td class="well"></td>
			    		<td>{{App\Rubro::find($reporte->rubro_id)->nombre}}</td>
			    		<td>{{$reporte->avance}}</td>
			    		<td>{{date_format(date_create($reporte->fecha_control), "d/m/Y")}}</td>
			    	</tr>
			    	@endforeach
		    	@endisset
	    	@endforeach
    	@endisset 	

    </tbody>
</table>