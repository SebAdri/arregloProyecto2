<!DOCTYPE html>
<html>
<head>
	<title>PDF</title>
	<!-- Bootstrap -->
	{{-- <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"> --}}
	<style type="text/css">
		.corte {
			background-color:#DFF0D8;
		}
		/*th:after {
			border-top: 1px solid black;
		}
		td{
			border-collapse: collapse;
			border-top: 1px solid black;
		}*/
		td {
			height: 15px;
		}
		table .principal{
			width: 100%;
		}
		.subTabla th td {
			width: 10;	
		}

	</style>
</head>
<body>
	<div class="x_panel">
		<h1 style="text-align: center">Reporte de Compras por Obra</h1>
		<hr>
		<div class="x_content">
			<h5>Obra: <small>{{$compras[0]->obra->nombre_proyecto}}</small> </h5>
			<h5>Rango de Fecha: <small> @isset ($periodo)
				{{$periodo}}
			@endisset</small> </h5>
		</div>
		@include('reportes.partials.reportCompras-part')	
	</div>
</body>
</html>