@extends('layout')

@section('contenido')


<form method="POST" action="{{ route('profesiones.update', $profesiones->id) }}">
    {!! csrf_field() !!}
    {!! method_field('PUT') !!}

    <div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1>Profesiones</h1>
      </div>
     
      <div class="panel-body">
        <div class="row">
          <div class="col-md-2 col-md-offset-3">
            <label for="">Profesión</label>
            <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $profesiones->nombre }}" placeholder="Nombre del rubro" required>
              @if ($errors->has('nombre'))
                <span class="invalid-feedback errors" role="alert">
                  <strong>{{ $errors->first('nombre') }}</strong>
                </span>
              @endif
          </div>

          <div class="col-md-3">
            <label for="">Descripción</label>
            <input type="text" class="form-control" name="detalle" value="{{ $profesiones->detalle }}" placeholder="Descripción">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
            <button type="submit" class="btn button-primary">Guardar</button>
            <a class="btn button-primary" href="{{ route('profesiones.edit', $profesiones->id) }}">Cancelar</a>
            <a class="btn button-primary" href="{{ route('profesiones.create') }}">Volver</a>
          </div>
        </div>
            <br>

</form>
    </div>
  </div>
</div>
</div>

@stop