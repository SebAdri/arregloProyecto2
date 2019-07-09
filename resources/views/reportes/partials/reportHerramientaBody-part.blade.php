
<table id="tableReporteAvance" class="table table-hover table-bordered">
	<thead>
		<tr>
			<th>Herramienta</th>
			<th>Modelo</th>
			<th>Nro de Serie</th>
			<th>Fecha de Adquisición</th>
			<th>Ubicación</th>
		</tr>
	</thead>
	<tbody>
		@isset ($obraHerramientas)
		@foreach($obraHerramientas as $obraHerramienta)
		<tr>
			<td>{{$obraHerramienta->herramientas[0]->h_nombre}}</td>
			<td>{{$obraHerramienta->herramientas[0]->h_modelo}}</td>
			<td>{{$obraHerramienta->herramientas[0]->h_nro_serie}}</td>
			<td>{{date_format(date_create($obraHerramienta->herramientas[0]->h_fecha_adquisicion), "d/m/Y")}}</td>
			<td>{{$obraHerramienta->herramientas[0]->h_ubicacion}}</td>

		</tr>
		@endforeach 
	    	@endisset 	

	    </tbody>
	</table>