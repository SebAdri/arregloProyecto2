@extends('layout')

@section('contenido')


<form method="POST" action="{{ route('users.update', $user->id) }}">
    {!! csrf_field() !!}
    {!! method_field('PUT') !!}

<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1>Administración de Usuarios</h1>
      </div>
     
      <div class="panel-body">
        <div class="col-md-2 col-md-offset-1">
          <label for="func">Nombre</label>
          <div class="form-group">
            <input type="text" name="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" value="{{ $user->name }}" placeholder="Nombre del empleado" required>
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
            <input type="text" name="usuario" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" value="{{ $user->username }}" placeholder="Usuario" required>
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
            <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $user->email }}" placeholder="Email" required>
              @if ($errors->has('email'))
                <span class="invalid-feedback errors" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
          </div>
        </div>

         <div class="col-md-2">
            <label for="sel1">Rol</label>
            <div class="form-group">
              <select class="form-control" id="idrole" name="idrole">
                 <optgroup label="Rol actual"></optgroup>
                <option>{{$user->role->role_name}}</option>
                <optgroup label="Rol a asignar"></optgroup>
                  @foreach ($roles as $role)
                    
                    <option value={{$role->id}}> {{$role->role_name}} </option>
                  @endforeach
              </select>
            </div>
          </div>
  
        <div class="row">
          <br>
        </div>
        <div class="row">
          <div class="col-md-5 col-md-offset-4">
            <button type="submit" class="btn button-primary">Guardar</button>
            <a class="btn button-primary" href="{{ route('users.edit', $user->id) }}">Cancelar</a>
            <a class="btn button-primary" href="{{ route('users.create') }}">Volver</a>
          </div>
        </div>
        <br>

</form>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
  $("#volver").click(function(){
    $.ajax({
      url: "{{url()->current()}}",
      success: function(){
        window.location.replace("{{url()->previous()}}");
      }
    })
  })
</script>

@stop