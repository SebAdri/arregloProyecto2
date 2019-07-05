@extends('layout')

@section('contenido')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Datos para la Factura</h3>
		</div>
		<div class="panel-body">
			<form method="POST" action="{{ route('parametros') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-3">
						<img src="{{Storage::url($parametro->imagen)}}" width="50%" height="50%">
						<label>Logo Actual</label>
						<input class="form-control" type="file" name="logo">
					</div>
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-6">
								<label for="empresa">Nombre de la empresa</label>
								<input class="form-control" type="text" name="empresa" placeholder="nombre de la empresa" value="{{$parametro->empresa_nombre}}">
							</div>
							<div class="col-md-6">
								<label for="eslogan">Eslogan de la empresa</label>
								<input class="form-control" type="text" name="eslogan" placeholder="eslogan de la empresa" value="{{$parametro->empresa_eslogan}}">
							</div>	
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="telefono">Telefono</label>
								<input class="form-control" type="text" name="telefono" placeholder="telefono de la empresa" value="{{$parametro->telefono}}">
							</div>
							<div class="col-md-6">
								<label for="direccion">Direccion</label>
								<input class="form-control" type="text" name="direccion" placeholder="Direccion de la empresa" value="{{$parametro->direccion}}">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="correo">Correo</label>
								<input class="form-control" type="email" name="correo" placeholder="correo de la empresa">
							</div>
							<div class="col-md-6">
								<label for="ciudad">Ciudad</label>
								<input class="form-control" type="text" name="ciudad" placeholder="ciudad de la empresa">
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="ruc">RUC</label>
								<input class="form-control" type="text" name="ruc" placeholder="ruc de la empresa">
							</div>
							<div class="col-md-6">
								<label for="timbrado">Timbrado</label>
								<input class="form-control" type="text" name="timbrado" placeholder="Timbrado de la empresa">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="fechaIni">Inicio Vigencia</label>
								<input class="form-control" type="date" name="fechaIni" placeholder="Inicio Vigencia">
							</div>
							<div class="col-md-6">
								<label for="fechaFin">Fin Vigencia</label>
								<input class="form-control" type="date" name="fechaFin" placeholder="Fin Vigencia">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="pais">Pais</label>
								<input class="form-control" type="text" name="pais" placeholder="Pais">
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-2 col-md-offset-5">
						<button class="btn button-primary btn-block" type="submit">Aceptar</button>
						
					</div>
				</div>	
			</form>
		</div>
	</div>
</div>
@endsection
@push('scripts')

@endpush