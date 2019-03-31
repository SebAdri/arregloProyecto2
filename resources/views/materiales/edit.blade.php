@extends('layout')

@section('contenido')


<form method="POST" action="{{ route('materiales.update', $material->id) }}">
  {!! csrf_field() !!}
  {!! method_field('PUT') !!}

  <div class="container">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1>Materiales</h1>
        </div>

        <div class="panel-body">
            <div class="col-md-2 col-md-offset-3">
              <label for="">Material</label>
              <div class="form-group">
                <input type="text"  class="form-control{{ $errors->has('m_descripcion') ? ' is-invalid' : '' }}" value="{{ $material->m_descripcion}}" name="m_descripcion" placeholder="Nombre del Material" required>
                @if ($errors->has('m_descripcion'))
                  <span class="invalid-feedback errors" role="alert">
                    <strong>{{ $errors->first('m_descripcion') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="col-md-2">
              <label for="">Unidad de medida</label>
              <div class="form-group">
                  <input type="text" size="19"  class="form-control{{ $errors->has('m_unidad_medida') ? ' is-invalid' : '' }}" name="m_unidad_medida" value="{{ $material->m_unidad_medida}}" placeholder="Unidad de medida" required>
                    @if ($errors->has('m_unidad_medida'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('m_unidad_medida') }}</strong>
                      </span>
                    @endif
              </div>
            </div>

            <div class="col-md-2">
              <label for="" >Costo</label>
              <div class="form-group">
                  <input type="text" class="form-control{{ $errors->has('m_costo') ? ' is-invalid' : '' }}" name="m_costo" value="{{ $material->m_costo}}" placeholder="Costo Unitario" required>
                    @if ($errors->has('m_costo'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('m_costo') }}</strong>
                      </span>
                    @endif
                </div>
              </div>

              {{-- div class="col-md-3">
                <label for="" >Cantidad Mínima Requerida</label>
                <div class="form-group">
                  <input type="text" size="19" class="form-control" name="m_min_stock" value="{{ $material->m_min_stock}}" placeholder="Cantidad Minima">
                </div>
              </div>

              <div class="col-md-2">
                <label for="">Cantidad Actual</label>
                <div class="form-group">
                  <input type="text" size="19" class="form-control" name="m_cantidad_actual" value="{{ $material->m_cantidad_actual}}" placeholder="Cantidad Actual">
                </div>
              </div> --}}

              <div class="row">
                <br>
              </div>

              <div class="row">
                <div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
                  <button type="submit" class="btn button-primary">Guardar</button>
                  <a class="btn button-primary" href="{{ route('materiales.edit', $material->id) }}">Cancelar</a>
                  <a class="btn button-primary" href="{{ route('materiales.create') }}">Volver</a>
                </div>
              </div>
          <br>

        </form>
      </div>
    </div>
  </div>
</div>

@stop