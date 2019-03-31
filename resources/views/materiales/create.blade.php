@extends('layout')

@section('contenido')

	<form method="POST" action="{{ route('materiales.store') }}">
    {!! csrf_field() !!}
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
                <input type="text"  class="form-control{{ $errors->has('m_descripcion') ? ' is-invalid' : '' }}" value="" name="m_descripcion" placeholder="Nombre del Material" required>
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
                  <input type="text" size="19"  class="form-control{{ $errors->has('m_unidad_medida') ? ' is-invalid' : '' }}" name="m_unidad_medida" value="" placeholder="Unidad de medida" required>
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
                  <input type="text" class="form-control{{ $errors->has('m_costo') ? ' is-invalid' : '' }}" name="m_costo" value="" placeholder="Costo Unitario" required>
                    @if ($errors->has('m_costo'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('m_costo') }}</strong>
                      </span>
                    @endif
                </div>
              </div>

            {{-- <div class="col-md-2">
              <label for="">Cantidad Actual</label>
              <div class="form-group">
                <input type="text" class="form-control{{ $errors->has('m_cantidad_actual') ? ' is-invalid' : '' }}" name="m_cantidad_actual" value="" placeholder="Cantidad Actual" required>
                    @if ($errors->has('m_cantidad_actual'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('m_cantidad_actual') }}</strong>
                      </span>
                    @endif
              </div>
            </div> --}}

            <div class="row">
              <br>
            </div>

            <div class="row">
              <div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
                <button type="submit" class="btn button-primary">Guardar</button>
                <a class="btn button-primary" href="{{ route('materiales.create') }}">Cancelar</a>
                <button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
                
              </div>
            </div>
              <br>
</form>

    <table class="table table-responsive">
    <thead>
      <tr>
        <th>Material</th>
        <th>Unidad de medida</th>
        <th>Costo</th>
        {{-- <th>Cantidad Actual</th>      --}}
        <th>Acción</th>
      </tr>
    </thead>

      <tbody>
        @foreach($materiales as $material)
          @if($material->m_estado == 1)
            <tr>
              <td>{{ $material->m_descripcion }}</td>
              <td>{{ $material->m_unidad_medida }}</td>
              <td>{{ $material->m_costo }}</td>
              {{-- <td>{{ $material->m_cantidad_actual }}</td>               --}}
              <td>
                <a class="btn btn-link" href="{{ route('materiales.edit', $material->id) }}">Editar</a>

                <form style="display: inline" method="POST" action="{{ route('materiales.destroy', $material->id) }}">
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
    $("#volver").click(function(){
      $.ajax({
        url: "{{url()->current()}}",
        success: function(){
          window.location.replace("{{url()->previous()}}");
        }
      })
    })
  </script>
  {{-- expr --}}
@endpush
@endsection