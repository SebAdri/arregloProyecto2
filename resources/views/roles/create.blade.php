  @extends('layout')

@section('contenido')


<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-7 col-md-offset-3">
            <h1>Administración de Roles</h1>
          </div>
          
        </div>
      </div>
     
      <div class="panel-body">
      <form method="POST" action="{{ route('roles.store') }}">
        {!! csrf_field() !!}
        
        <div class="row">
          <div class="col-md-2">
            <label for="func">Rol</label>
            <div class="input-group">
              <input type="text" name="rol" class="form-control" value="" placeholder="Rol">
            </div>
          </div>
          <div class="col-md-2">
            <label for="func">Nombre</label>
            <div class="input-group">
              <input type="text" name="nombre_rol" class="form-control" value="" placeholder="Nombre del rol">
            </div>
          </div>
          <div class="col-md-2">
            <label for="func">Descripción</label>
            <div class="input-group">
              <input type="text" name="desc" class="form-control" value="" placeholder="Breve descripción">
            </div>
          </div>  
        </div>
        <hr>
        <div class="row">
          <div class="col-md-3 col-md-offset-5">
            <input type="submit" class="btn button-primary" value="Guardar">
            <button type="button" class="btn button-primary" id="btnCancel" name="button">Cancelar</button>
            <button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
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
              <input type="checkbox" name="per[]" value="addDoc" >Agregar Documento<br>
              <input type="checkbox" name="per[]" value="ediDoc">Editar Documento<br>
              <input type="checkbox" name="per[]" value="delDoc">Eliminar Documento<br>
            </div>  
            <br>
            <div id="almacen" class=" panel-collapse collapse">
              <input type="checkbox" name="per[]" value="addPed">Realizar Pedido<br>
              <input type="checkbox" name="per[]" value="ctrlSto">Controlar el Stock<br>
              <input type="checkbox" name="per[]" value="AD">a determinar<br>
            </div>
            <br>
            <div id="empleado" class="panel-collapse collapse">
              <input type="checkbox" name="per[]" value="asigEmpl">Asignar Empleado<br>
              <input type="checkbox" name="per[]" value="desvEml">Desvincular Empleado<br>
              <input type="checkbox" name="per[]" value="AD">a determinar<br>
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
              <input type="checkbox" name="per[]" value="addEmpl">Agregar Empleados<br>
              <input type="checkbox" name="per[]" value="ediEmpl">Editar Empleados<br>
              <input type="checkbox" name="per[]" value="delEmpl">Eliminar Empleados<br>
            </div>
            <br>
            <div id="rubro" class="collapse">
              <input type="checkbox" name="per[]" value="addRub">Agregar Rubros<br>
              <input type="checkbox" name="per[]" value="ediRub">Editar Rubros<br>
              <input type="checkbox" name="per[]" value="delRub">Eliminar Rubros<br>    
            </div>
            <br> 
            <div id="mate" class="collapse">
              <input type="checkbox" name="per[]" value="addMate">Agregar Materiales<br>
              <input type="checkbox" name="per[]" value="ediMate">Editar Materiales<br>
              <input type="checkbox" name="per[]" value="delMate">Eliminar Materiales<br>
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
              <input type="checkbox" name="per[]" value="addUse">Agregar Usuario<br>
              <input type="checkbox" name="per[]" value="ediUse">Editar Usuario<br>
              <input type="checkbox" name="per[]" value="delUse">Eliminar Usuario<br>
            </div>
            <br>
            <div id="roles" class="collapse">
              <input type="checkbox" name="per[]" value="addRol">Agregar Rol<br>
              <input type="checkbox" name="per[]" value="ediRol">Editar Rol<br>
              <input type="checkbox" name="per[]" value="delRol">Eliminar Rol<br>
            </div> 
          </div>
        </div>
        </form>
        <hr>
        <table class="table table-responsive">
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
</div>


@push('scripts')
  <script type="text/javascript">
    $("#volver").click(function(){
      $.ajax({
        url: "{{url()->current()}}",
        success: function(){
          window.location.replace("{{ route('userRole') }}");
        }
      })
    })
  </script>
@endpush
@endsection