@extends('layout')
@section('contenido')
	<div class="row">
		<div class="container">
			<div class="row">
				<div class="panel panel-default">
		  			<div class="panel-heading"><h1>Administración de Roles</h1></div>
		  			<div class="panel-body">
		  				<a href="{{ route('roles.create') }}"><button class="btn btn-primary"><i class="fa fa-pencil"></i>Nuevo Rol</button></a>
						<table class="table" id="tablaRole">
					          <thead>
					            <tr>
					                <th>ID</th>
					                <th>Rol</th>
					                <th>Descripción</th>
					                <th>Fecha de Creación</th>
					                <th>Fecha de Actualización</th>
					                {{-- <th>Estado</th> --}}
					                <th>Acción</th>
					            </tr>
					          </thead> 
					          <tbody>
					            @foreach($roles as $role)
					              <tr>
					                <td>{{ $role->id }}</td>
					                <td>{{ $role->role_name }}</td>
					                <td>{{ $role->role_description }}</td>
					                <td>{{ $role->created_at }}</td>
					                <td>{{ $role->updated_at }}</td>
					                {{-- <td>--</td> --}}
					                <td>
					                  <a href="{{ route('roles.edit', $role->id) }}">Editar</a>
					                  <form style="display: inline" method="POST" action="{{ route('roles.destroy', $role->id) }}">
					                    {!! csrf_field() !!}
					                    {!! method_field('DELETE') !!}
					                    <button type="submit">Eliminar</button>
					                  </form>
					                </td>
					            </tr>
					            @endforeach
					          </tbody>     
					        </table>
					
		  			</div>
				</div>
			</div>
			
		</div>
		
	</div>
@push('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			var TabRol = $("#tablaRole").DataTable( {	
	            "lengthChange": false,
		        "language": {
	            "zeroRecords": "Nothing found - sorry",
				"search": "Buscar", 
	            "info": "Mostrando _PAGE_ de _PAGES_",
	            "Searching": "Buscar",
	            "infoFiltered": "(filtered from _MAX_ total records)",
	            "paginate": {
			        "first": "Primero",
			        "last":       "Ultimo",
			        "next":       ">>",
			        "previous":   "<<"
	    			}
        		}
        	});
	    });
	</script>
@endpush
@endsection