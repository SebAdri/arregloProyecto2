@extends('layout')

@section('contenido')

<form method="POST" action="{{ route('roles.update', $role->id) }}">
	{!! csrf_field() !!}
	{!! method_field('PUT') !!}
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<label for="func">Rol</label>
				<div class="input-group">
					<input type="text" name="rol" class="form-control" value="{{$role->role}}" placeholder="Rol">
				</div>
			</div>
			<div class="col-md-2">
				<label for="func">Nombre</label>
				<div class="input-group">
					<input type="text" name="nombre_rol" class="form-control" value="{{$role->role_name}}" placeholder="Nombre del rol">
				</div>
			</div>
			<div class="col-md-2">
				<label for="func">Descripción</label>
				<div class="input-group">
					<input type="text" name="desc" class="form-control" value="{{$role->role_description}}" placeholder="Breve descripción">
				</div>
			</div>  
		</div>
		<hr>
		<div class="row">
			<div class="col-md-3 col-md-offset-5">
				<input type="submit" class="btn button-primary" value="Guardar">
				<button type="button" class="btn button-primary" name="button">Cancelar</button>
				{{-- <a href="{{ route('home') }}"><button type="button" class="btn button-primary" name="button">Volver</button></a> --}}
			</div>
		</div>
		<hr>
		<div class="row">

			<div class="col-md-3">
				<button type="button" class="btn button-primary btn-block" data-toggle="collapse" data-target="#obras" data-parent="#accordion">Obras</button>
			</div>
			<div class="col-md-3">
				<div id="obras" class="panel-collapse collapse">
					<button type="button" class="btn button-primary btn-block" data-toggle="collapse" data-target="#doc">Documentos</button>
					<button type="button" class="btn button-primary btn-block" data-toggle="collapse" data-target="#almacen" data-parent="#accordion">Almacén</button>
					<button type="button" class="btn button-primary btn-block" data-toggle="collapse" data-target="#empleado" data-parent="#accordion">Empleados</button>
				</div>
			</div>
			<div class="col-md-3">
				<div id="doc" class="panel-collapse collapse">
					<input type="checkbox" name="per[]" value="addDoc" @if(in_array("addDoc", $per)) {{'checked'}} @endif>Agregar Documento<br>
					<input type="checkbox" name="per[]" value="ediDoc" @if(in_array("ediDoc", $per)) {{'checked'}} @endif>Editar Documento<br>
					<input type="checkbox" name="per[]" value="delDoc" @if(in_array("delDoc", $per)) {{'checked'}} @endif>Eliminar Documento<br>
				</div>  
				<br>
				<div id="almacen" class=" panel-collapse collapse">
					<input type="checkbox" name="per[]" value="addPed" @if(in_array("addPed", $per)) {{'checked'}} @endif>Realizar Pedido<br>
					<input type="checkbox" name="per[]" value="ctrlSto" @if(in_array("ctrlSto", $per)) {{'checked'}} @endif>Controlar el Stock<br>
					{{-- <input type="checkbox" name="per[]" value="AD" @if(in_array("AD") {{, $per')checked'}} @endif>a determinar<br> --}}
				</div>
				<br>
				<div id="empleado" class="panel-collapse collapse">
					<input type="checkbox" name="per[]" value="asigEmpl" @if(in_array("addUSe", $per)) {{'checked'}} @endif>Asignar Empleado<br>
					<input type="checkbox" name="per[]" value="desvEml" @if(in_array("delUSe", $per)) {{'checked'}} @endif>Desvincular Empleado<br>
					{{-- <input type="checkbox" name="per[]" value="AD" @if(in_array("delUSe", $per)) {{'checked'}} @endif>a determinar<br> --}}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<button type="button" class="btn button-primary btn-block" data-toggle="collapse" data-target="#mant" data-parent="#accordion">Mantenimiento</button>
			</div>
			<div class="col-md-3">
				<div id="mant" class="collapse">
					<button type="button" class="btn button-primary btn-block" data-toggle="collapse" data-target="#empl" data-parent="#accordion">Empleados</button>
					<button type="button" class="btn button-primary btn-block" data-toggle="collapse" data-target="#rubro" data-parent="#accordion">Rubros</button>
					<button type="button" class="btn button-primary btn-block" data-toggle="collapse" data-target="#mate" data-parent="#accordion">Materiales</button>   
				</div>
			</div>
			<div class="col-md-3">
				<div id="empl" class="collapse">
					<input type="checkbox" name="per[]" value="addEmpl" @if(in_array("addEmpl", $per)) {{'checked'}} @endif @if(in_array("delUSe", $per)) {{'checked'}} @endif>Agregar Empleados<br>
					<input type="checkbox" name="per[]" value="ediEmpl" @if(in_array("ediEmpl", $per)) {{'checked'}} @endif @if(in_array("delUSe", $per)) {{'checked'}} @endif>Editar Empleados<br>
					<input type="checkbox" name="per[]" value="delEmpl" @if(in_array("delEmpl", $per)) {{'checked'}} @endif @if(in_array("delUSe", $per)) {{'checked'}} @endif>Eliminar Empleados<br>
				</div>
				<br>
				<div id="rubro" class="collapse">
					<input type="checkbox" name="per[]" value="addRub" @if(in_array("addRub", $per)) {{'checked'}} @endif>Agregar Rubros<br>
					<input type="checkbox" name="per[]" value="ediRub" @if(in_array("ediRub", $per)) {{'checked'}} @endif>Editar Rubros<br>
					<input type="checkbox" name="per[]" value="delRub" @if(in_array("delRub", $per)) {{'checked'}} @endif>Eliminar Rubros<br>    
				</div>
				<br> 
				<div id="mate" class="collapse">
					<input type="checkbox" name="per[]" value="addMate" @if(in_array("addMate", $per)) {{'checked'}} @endif>Agregar Materiales<br>
					<input type="checkbox" name="per[]" value="ediMate" @if(in_array("ediMate", $per)) {{'checked'}} @endif>Editar Materiales<br>
					<input type="checkbox" name="per[]" value="delMate" @if(in_array("delMate", $per)) {{'checked'}} @endif>Eliminar Materiales<br>
				</div>
			</div>

		</div>
		<div class="row">
			<div class="col-md-3">
				<button type="button" class="btn button-primary btn-block" data-toggle="collapse" data-target="#seguridad" data-parent="#accordion">Seguridad</button>
			</div>
			<div class="col-md-3">
				<div id="seguridad" class="collapse">
					<button type="button" class="btn button-primary btn-block" data-toggle="collapse" data-target="#usuario" data-parent="#accordion">Usuario</button>
					<button type="button" class="btn button-primary btn-block" data-toggle="collapse" data-target="#roles" data-parent="#accordion">Roles</button>   
				</div>
			</div>
			<div class="col-md-3">
				<div id="usuario" class="collapse">
					<input type="checkbox" name="per[]" value="addUse" @if(in_array("addUse", $per)) {{'checked'}} @endif>Agregar Usuario<br>
					<input type="checkbox" name="per[]" value="ediUse" @if(in_array("ediUse", $per)) {{'checked'}} @endif>Editar Usuario<br>
					<input type="checkbox" name="per[]" value="delUse" @if(in_array("delUse", $per)) {{'checked'}} @endif>Eliminar Usuario<br>
				</div>
				<br>
				<div id="roles" class="collapse">
					<input type="checkbox" name="per[]" value="addRol" @if(in_array("addRol", $per)) {{'checked'}} @endif>Agregar Rol<br>
					<input type="checkbox" name="per[]" value="ediRol" @if(in_array("ediRol", $per)) {{'checked'}} @endif>Editar Rol<br>
					<input type="checkbox" name="per[]" value="delRol" @if(in_array("delRol", $per)) {{'checked'}} @endif>Eliminar Rol<br>
				</div> 
			</div>
		</div>
	</div>
	
</form>

@stop