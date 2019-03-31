@extends('layout')

@section('contenido')


<form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
  {!! csrf_field() !!}
  {!! method_field('PUT') !!}

  <div class="container">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1>Clientes</h1>
        </div>

        <div class="panel-body">
          <div class="col-md-2 col-md-offset-2">
            <label for="" style="margin-top: 10px">Cliente</label>
              <div class="form-group">
                <input type="text" size="19"  class="form-control{{ $errors->has('nombre_cliente') ? ' is-invalid' : '' }}" value="{{ $cliente->nombre }}" name="nombre_cliente" placeholder="Nombre de la entidad" required>
                @if ($errors->has('nombre_cliente'))
                  <span class="invalid-feedback errors" role="alert">
                    <strong>{{ $errors->first('nombre_cliente') }}</strong>
                  </span>
                @endif
              </div>
          </div>

          <div class="col-md-3">
            <label for=""  style="margin-top: 10px">Dirección</label>
            <div class="form-group">
                  <input type="text" size="35" class="form-control" name="direccion" value="{{ $cliente->direccion }}" placeholder="Dirección">
            </div>
          </div>

          <div class="col-md-2">
            <label for="" style="margin-top: 10px">Teléfono</label>
            <div class="form-group">
              <input type="text" size="19"  name="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" value="{{ $cliente->telefono }}" placeholder="Teléfono" required>
                @if ($errors->has('telefono'))
                  <span class="invalid-feedback errors" role="alert">
                      <strong>{{ $errors->first('telefono') }}</strong>
                  </span>
                @endif
            </div>
          </div>

          <div class="row">
            <br>
          </div>

          <div class="row">
            <div class="col-md-5 col-md-offset-4">
              <button type="submit" class="btn button-primary">Guardar</button>
              <a class="btn button-primary" href="{{ route('clientes.edit', $cliente->id) }}">Cancelar</a>
              <a class="btn button-primary" href="{{ route('clientes.create') }}">Volver</a>
            </div>
          </div>
          <br>

        </form>
      </div>
    </div>
  </div>
</div>

@stop