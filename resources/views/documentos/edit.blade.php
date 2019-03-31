@extends('layout')

@section('contenido')

@include('errors')

<form method="POST" action="{{ route('documentos.update', $documento->id) }}">
  {!! csrf_field() !!}
  {!! method_field('PUT') !!}

     <div class="container">
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1>Documentos</h1>
          </div>

          <div class="panel-body">

            <div class="col-md-3 col-md-offset-1">
              <label for="">Documento</label>
                <div class="form-group">
                <input type="text"class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}" name="nombre" value="{{ $documento->nombre }}" placeholder="Nombre del documento" required>
                 @if ($errors->has('documento'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('documento') }}</strong>
                      </span>
                      @endif
              </div>
            </div>

            <div class="col-md-2">
              <label for="">Tipo de documento</label>
              <div class="form-group">
              <select class="form-control" name="tipo_doc" id="tipo_doc">
                <optgroup label="Tipo de documento actual"></optgroup>
                <option>{{$documento->tipo_doc}}</option>
                <optgroup label="Tipo de documento a asignar"></optgroup>
                  <option>Contrato</option>
                    <option>Licitación</option>
                    <option>Factura</option>
                    <option>Otros</option>
              </select>
              </div>
            </div>

            <div class="col-md-2">
              <label for="">Fecha de emisión</label>
                <div class="form-group{{ $errors->has('fechaDoc') ? ' is-invalid' : '' }}">
                  <input type="date" class="form-control" name="fecha_emision" value="{{ $documento->fecha_emision }}">
                  @if ($errors->has('fechaDoc'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('fechaDoc') }}</strong>
                      </span>
                      @endif
                </div>
            </div>

            <div class="col-md-2">
              <label for="" >Ubicación</label>
              <div class="form-group">
                <input type="text"class="form-control" name="ubicacion" value="{{ $documento->ubicacion }}" placeholder="Ubicación física">
              </div>
            </div>

            <input type="hidden"class="form-control" name="obra_id" value={{$documento->obra_id}}>



            <div class="row">
              <br>
            </div>

            <div class="row">
              <div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
                <button type="submit" class="btn button-primary">Guardar</button>
                <a class="btn button-primary" href="{{ route('documentos.create') }}">Cancelar</a>
                <button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
              </div>
            </div>

              <br>

</form>
@stop