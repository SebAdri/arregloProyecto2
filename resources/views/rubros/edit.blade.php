@extends('layout')

@section('contenido')


<form method="POST" action="{{ route('rubros.update', $rubro->id) }}">
    {!! csrf_field() !!}
    {!! method_field('PUT') !!}

      <div class="container">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1>Rubros</h1>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-offset-11">
              <button type="button"class="btn button-primary" title="Agregar Nueva Familia Rubro" data-toggle="modal" data-target="#myModal" style="margin-top: 10px"><i class="fa fa-plus" style="font-size:30px;"></i></button>
            </div>
          </div>        

          <div class="row">
            <div class="col-md-2 col-md-offset-1">
              <label for="nombre" style="margin-top: 10px">Familia Rubros</label>

              <select class="form-control" name="familia_rubro_id" id="familia_rubro_id">
                <optgroup label="Profesión actual"></optgroup>
                <option>{{$rubro->familiaRubro->nombre}}</option>
                <optgroup label="Profesión a asignar"></optgroup>
                  @foreach ($fliaRubros as $fliaRubro)
                    <option value={{$fliaRubro->id}}>{{$fliaRubro->nombre}} </option>
                  @endforeach
              </select>

            </div>

            <div class="col-md-2">
              <label for="nombre" style="margin-top: 10px">Rubro</label>
              <input type="text" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{$rubro->nombre}}" placeholder="Nombre del Rubro" required>

              @if ($errors->has('nombre'))
              <span class="invalid-feedback errors" role="alert">
                <strong>{{ $errors->first('nombre') }}</strong>
              </span>
              @endif
            </div>

            <div class="col-md-3">
              <label for="nombre" style="margin-top: 10px">Mano de obra</label>
              <input type="text" class="form-control {{ $errors->has('mano_obra') ? ' is-invalid' : '' }}" name="mano_obra" value="{{$rubro->mano_obra}}" placeholder="Costo de mano de obra" required>

              @if ($errors->has('mano_obra'))
              <span class="invalid-feedback errors" role="alert">
                <strong>{{ $errors->first('mano_obra') }}</strong>
              </span>
              @endif
            </div>

            <div class="col-md-3">
              <label for="nombre" style="margin-top: 10px">Unidad de medida</label>
              <input type="text" class="form-control {{ $errors->has('unidad_medida') ? ' is-invalid' : '' }}" name="unidad_medida" value="{{$rubro->unidad_medida}}" placeholder="Unidad de medida" required>

              @if ($errors->has('unidad_medida'))
              <span class="invalid-feedback errors" role="alert">
                <strong>{{ $errors->first('unidad_medida') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 col-md-offset-4" style="margin-top: 20px">
              <button type="submit" class="btn button-primary">Guardar</button>
              <a class="btn button-primary" href="{{ route('rubros.create') }}">Cancelar</a>
              <button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
            </div>
          </div>
        

</form>

@stop