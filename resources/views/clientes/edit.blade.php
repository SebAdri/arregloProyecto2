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
          <div class="col-md-3 col-md-offset-1">
                <label for="" style="margin-top: 10px">Nombre - Razón Social</label>
                  <div class="form-group">
                    <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" value="{{ $cliente->nombre }}" name="nombre" placeholder="Nombre - Razón Social" required>
                    @if ($errors->has('nombre'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('nombre') }}</strong>
                      </span>
                    @endif
                  </div>
              </div>

              <div class="col-md-2">
                <label for=""  style="margin-top: 10px">Cédula</label>
                <div class="form-group">
                  <input type="text" size="35" class="form-control {{ $errors->has('cedula') ? ' is-invalid' : '' }}" name="cedula" value="{{ $cliente->cedula }}" placeholder="Cédula">
                    @if ($errors->has('cedula'))
                <span class="invalid-feedback errors" role="alert">
                  <strong>{{ $errors->first('cedula') }}</strong>
                </span>
              @endif
                </div>
              </div>

              <div class="col-md-2">
                <label for=""  style="margin-top: 10px">RUC</label>
                <div class="form-group">
                  <input type="text" size="35" class="form-control {{ $errors->has('ruc') ? ' is-invalid' : '' }}" name="ruc" value="{{ $cliente->ruc }}" placeholder="RUC">
                    @if ($errors->has('ruc'))
                <span class="invalid-feedback errors" role="alert">
                  <strong>{{ $errors->first('ruc') }}</strong>
                </span>
              @endif
                </div>
              </div>

               <div class="col-md-2">
          <label for="func" style="margin-top: 10px">Email</label>         
          <div class="form-group">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $cliente->email }}" placeholder="Correo Electrónico" required>
              @if ($errors->has('email'))
                <span class="invalid-feedback errors" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
          </div>
        </div>


              <div class="col-md-3 col-md-offset-1">
                <label for=""  style="margin-top: 10px">Dirección</label>
                <div class="form-group">
                  <input type="text" size="35" class="form-control {{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" value="{{ $cliente->direccion }}" placeholder="Dirección">
                   @if ($errors->has('direccion'))
                <span class="invalid-feedback errors" role="alert">
                  <strong>{{ $errors->first('direccion') }}</strong>
                </span>
              @endif
                </div>
              </div>

              <div class="col-md-3">
                <label for=""  style="margin-top: 10px">Fecha de inscripción</label>
                <div class="form-group">
                  <input type="date"class="form-control {{ $errors->has('fecha_inscripcion') ? ' is-invalid' : '' }}" name="fecha_inscripcion" value="{{ $cliente->fecha_inscripcion }}" required>
                    @if ($errors->has('fecha_inscripcion'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('fecha_inscripcion') }}</strong>
                      </span>
                      @endif
                </div>
              </div>


              <div class="col-md-3">
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