<div class="box box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Almacen</h3>
		<div class="box-tools">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
		</div>
	</div>

	<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			<li class="active"><a data-toggle="tab" href="#stock"><i class="fa fa-circle-o text-red"></i>Stock Actual</a></li>

			<h5 class="text-bold">Pedidos</h5>
			<li><a data-toggle="tab" href="#redactar">Redactar Pedido</a></li>
			<li><a data-toggle="tab" href="#recibido"><i class="fa fa-inbox text-red"></i>Pedidos Recibidos<span class="label label-primary pull-right">@isset ($bandejaEntrada){{count($bandejaEntrada)}}@endisset</span></a></li>
			<li><a data-toggle="tab" href="#solicitado"><i class="fa fa-envelope-o text-red"></i>Pedidos Enviados <span class="label label-primary pull-right">@isset ($bandejaEnviado){{count($bandejaEnviado)}}@endisset</span></a></li>

			<h5 class="text-bold">Compras</h5>
			<li><a  data-toggle="tab" href="#compra"><i class="fa fa-inbox text-red"></i>Compras Realizadas<span class="label label-primary pull-right">@isset ($compras){{count($compras)}}@endisset</span></a></li>

			<h5 class="text-bold">Egresos</h5>
			<li><a data-toggle="tab" href="#egreso"><i class="fa fa-inbox text-red"></i>Mercaderias Salientes<span class="label label-primary pull-right">@isset ($compras){{count($compras)}}@endisset</span></a></li>									
		</ul>
	</div>
</div>