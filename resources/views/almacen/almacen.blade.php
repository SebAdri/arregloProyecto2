@extends('layout')

@section('contenido')
<div class="container">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<h2>ALMACEN DE OBRA</h2>
				<hr>
				<section class="content">
					<div class="row">
						<div class="col-md-3">
							@include('almacen.partials.submenu-part')
						</div>  
						<div class="col-md-9">
							<div class="tab-content">
								<div class="tab-pane fade  in active" id="stock">
									@include('almacen.partials.stock-part')
								</div>
								<div class="tab-pane fade" id="redactar">
									@include('almacen.partials.redactar-part')
								</div>
								<div class="tab-pane fade"  id="recibido">
									@include('almacen.partials.recibido-part')
								</div>
								<div class="tab-pane fade"  id="solicitado">
									@include('almacen.partials.solicitado-part')
								</div>
								<div class="tab-pane fade" id="compra">
									@include('almacen.partials.compra-part')
								</div>
								<div class="tab-pane fade" id="egreso">
									@include('almacen.partials.egreso-part')
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>


@endsection


