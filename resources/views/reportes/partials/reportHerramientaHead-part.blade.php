<!DOCTYPE html>
<html>
<head>
	<title>PDF</title>
	<!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <style type="text/css">
    	.corte {
    		background-color:#DFF0D8;
    	}
    </style>
</head>
<body>
	<div class="x_panel">
		<h1 style="text-align: center">Reporte de Herramientas por Obra</h1>
		<hr>
		<div class="x_content">
			<h5>Obra: <small>{{$obra[0]->nombre_proyecto}}</small> </h5>
			<h5>Fecha Desde: <small>{{date_format(date_create($fecha_desde), "d/m/Y")
}}</small> </h5>
			<h5>Fecha Hasta: <small>{{date_format(date_create($fecha_hasta), "d/m/Y")
}}</small> </h5>
		</div>


		@include('reportes.partials.reportHerramientaBody-part')	
	</div>
</body>
</html>