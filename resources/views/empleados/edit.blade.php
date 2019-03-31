@extends('layout')

@section('contenido')

@include('errors')

<form method="POST" action="{{ route('empleados.update', $empleado->id) }}">
  {!! csrf_field() !!}
  {!! method_field('PUT') !!}
  
  <div class="container">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1>Empleados</h1>
        </div>

        <div class="panel-body">
          <div class="col-md-2 col-md-offset-2">
            <label for="func">Primer Nombre</label>
            <div class="form-group">
              <input type="text" name="primerNombre" class="form-control{{ $errors->has('primerNombre') ? ' is-invalid' : '' }}" value="{{ $empleado->primerNombre }}" placeholder="Primer Nombre del empleado" required>
                @if ($errors->has('primerNombre'))
                  <span class="invalid-feedback errors" role="alert">
                      <strong>{{ $errors->first('primerNombre') }}</strong>
                  </span>
                @endif
            </div>
          </div>

          <div class="col-md-2">
            <label for="func">Segundo Nombre</label>
            <div class="form-group">
              <input type="text" name="segundoNombre" class="form-control" value="{{ $empleado->segundoNombre }}" placeholder="Segundo Nombre">
            </div>
          </div>

          <div class="col-md-2">
            <label for="func">Primer Apellido</label>
            <div class="form-group">
              <input type="text" name="primerApellido" class="form-control{{ $errors->has('primerApellido') ? ' is-invalid' : '' }}" value="{{ $empleado->primerApellido }}" placeholder="Primer Apellido" required>
                @if ($errors->has('primerApellido'))
                  <span class="invalid-feedback errors" role="alert">
                    <strong>{{ $errors->first('primerApellido') }}</strong>
                  </span>
                @endif
            </div>
          </div>

          <div class="col-md-2">
            <label for="func">Segundo Apellido</label>
            <div class="input-group">
              <input type="text" name="segundoApellido" class="form-control" value="{{ $empleado->segundoApellido }}" placeholder="Segundo Apellido">
            </div>
          </div>

          <div class="col-md-3 col-md-offset-2">
            <label for=""  style="margin-top: 10px">Dirección</label>
            <div class="form-group">
              <input type="text" size="35" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" value="{{ $empleado->direccion }}" placeholder="Dirección" required>
                  @if ($errors->has('direccion'))
                    <span class="invalid-feedback errors" role="alert">
                      <strong>{{ $errors->first('direccion') }}</strong>
                    </span>
                  @endif
            </div>
          </div>

          <div class="col-md-2">
            <label for="" style="margin-top: 10px">Teléfono</label>
            <div class="form-group">
<<<<<<< HEAD
              <select class="form-control" id="rubro_id" name="rubro_id">

                @foreach ($rubros as $rubro)
                  <label for="seleccionado"> algo</label>
                  <option value={{$rubro->id}} @if($empleado->rubro->id == $rubro->id) id="seleccionado" selected @endif>{{$rubro->nombre_rubro}}</option> 
                @endforeach
=======
              <input type="text" size="19"  name="telefono" class="form-control" value="{{ $empleado->telefono }}" placeholder="Teléfono">
            </div>
          </div>

         <div class="col-md-2">
            <label for="sel1" style="margin-top: 10px">Rubro</label>
            <div class="form-group">
              <select class="form-control" name="rubro" id="rubro">
                <optgroup label="Rubro actual"></optgroup>
                <option>{{$empleado->rubro->nombre_rubro}}</option>
                <optgroup label="Rubro a asignar"></optgroup>
                  @foreach ($rubros as $rubro)
                    <option value={{$rubro->id}}>{{$rubro->nombre_rubro}} </option>
                  @endforeach
>>>>>>> 426628a6eec38e768fe13648b3740546a40194d0
              </select>
            </div>
          </div>
         
          <div class="row">
            <br>
          </div>

          <div class="row">
            <div class="col-md-5 col-md-offset-4">
              <button type="submit" class="btn button-primary">Guardar</button>
              <a class="btn button-primary" href="{{ route('empleados.edit', $empleado->id) }}">Cancelar</a>
              <a class="btn button-primary" href="{{ route('empleados.create') }}">Volver</a>
            </div>
          </div>
          <br>

        </form>
      </div>
    </div>
  </div>
</div>

@stop