@extends('layout')

@section('contenido')

  <form method="POST" action="{{ route('users.store') }}">
    {!! csrf_field() !!}

<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1>Administración de Usuarios</h1>
      </div>
     
      <div class="panel-body">
        <div class="col-md-2 col-md-offset-1">
          <label for="func">Empleado</label>
          
          <div class="form-group">
            <input id="nombre" type="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre del empleado" required>
                @if ($errors->has('nombre'))
                  <span class="invalid-feedback errors" role="alert">
                      <strong>{{ $errors->first('nombre') }}</strong>
                  </span>
                @endif
          </div>
        </div>

        <div class="col-md-2">
          <label for="func">Usuario</label>         
          <div class="form-group">
            <input id="usuario" type="usuario" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" placeholder="Nombre de Usuario" required>
                @if ($errors->has('usuario'))
                  <span class="invalid-feedback errors" role="alert">
                      <strong>{{ $errors->first('usuario') }}</strong>
                  </span>
                @endif
          </div>
        </div>

        <div class="col-md-2">
          <label for="func">Email</label>         
          <div class="form-group">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Correo Electrónico" required>
              @if ($errors->has('email'))
                <span class="invalid-feedback errors" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
          </div>
        </div>

        <div class="col-md-2">
          <label for="password">Contraseña</label>
            <div class="form-group">
              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Contraseña" required>
              {{-- {!! $errors->first('password', '<span class=error>:message</span>') !!} --}}
                @if ($errors->has('password'))
                  <span class="invalid-feedback errors error" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
            </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            <label for="exampleFormControlSelect1">Rol</label>
            <select class="form-control" id="idrole" name="idrole">
                @foreach ($roles as $role) {       
                  <option value={{ $role->id }}>{{ $role->role_name }}</option> 
                @endforeach 
            </select>
          </div>
        </div>

        <div class="row">
          <br>
        </div>

        <div class="row">
          <div class="col-md-5 col-md-offset-4">
            <input class="btn button-primary" value="Guardar" type="submit">
            <a class="btn button-primary" href="{{ route('users.create') }}">Cancelar</a>
            <button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
          </div>
        </div>
       <br>
  </form>

    <table class="table table-responsive" id="empleados">
    <thead>
      <tr>
          <th>Empleado</th>
          <th>Usuario</th>
          <th>Fecha de Asignación</th>
          <th>Rol</th>
          <th>Acción</th>
      </tr>
    </thead>
          
    <tbody>
      @foreach($users as $user)
        @if($user->estado == 1)
        
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->created_at }}</td>
          <td>{{ $user->role->role_name }}</td>
          <td>
            <a class="btn btn-link" href="{{ route('users.edit', $user->id) }}">Editar</a>

            <form style="display: inline" method="POST" action="{{ route('users.destroy', $user->id) }}">
                  {!! csrf_field() !!}
                  {!! method_field('DELETE') !!}
              <button type="submit" class="btn button-primary">Eliminar</button>
            </form>
          </td>
        </tr>
        @endif
      @endforeach
    </tbody>
  </table>

    </div>
  </div>
</div>
</div>
@push('scripts')
  <script type="text/javascript">
    var t = $('#empleados').DataTable();
    $("#volver").click(function(){
      $.ajax({
        url: "{{url()->current()}}",
        success: function(){
          window.location.replace("{{url()->previous()}}");
        }
      })
    })
  </script>
@endpush
@endsection