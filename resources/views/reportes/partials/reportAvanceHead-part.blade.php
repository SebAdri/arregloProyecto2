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
		<h1 style="text-align: center">Reporte de Avance</h1>
		<hr>
		<div class="x_content">
			<h5>Obra: <small>{{$obra->nombre_proyecto}}</small> </h5>
			<h5>Fecha Desde: <small>{{$fecha_desde}}</small> </h5>
			<h5>Fecha Hasta: <small>{{$fecha_hasta}}</small> </h5>

		</div>

		@include('reportes.partials.reporteHerramientaBody-part')	
	</div>
</body>
</html>