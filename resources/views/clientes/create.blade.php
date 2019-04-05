@extends('layout')

@section('contenido')

	<form method="POST" action="{{ route('clientes.store') }}">
    {!! csrf_field() !!}
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
                    <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" value="" name="nombre" placeholder="Nombre - Razón Social" required>
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
                  <input type="text" size="35" class="form-control {{ $errors->has('cedula') ? ' is-invalid' : '' }}" name="cedula" value="" placeholder="Cédula">
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
                  <input type="text" size="35" class="form-control {{ $errors->has('ruc') ? ' is-invalid' : '' }}" name="ruc" value="" placeholder="RUC">
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
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Correo Electrónico" required>
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
                  <input type="text" size="35" class="form-control {{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" value="" placeholder="Dirección">
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
                  <input type="date"class="form-control {{ $errors->has('fecha_inscripcion') ? ' is-invalid' : '' }}" name="fecha_inscripcion" value="" required>
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
                  <input type="text" size="19"  name="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" value="" placeholder="Teléfono" required>
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
                <div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
                  <button type="submit" class="btn button-primary">Guardar</button>
                  <a class="btn button-primary" href="{{ route('clientes.create') }}">Cancelar</a>
                  <button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
                </div>
              </div>

              <br>
</form>

    <table class="table table-responsive">
    <thead>
      <tr>
        <th>Cliente</th>
        <th>RUC</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Acción</th>
      </tr>
    </thead>

      <tbody>
        @foreach($clientes as $cliente)
          @if($cliente->estado == 1)
            <tr>
              <td>{{ $cliente->nombre }}</td>
              <td>{{ $cliente->ruc }}</td>
              <td>{{ $cliente->direccion }}</td>
              <td>{{ $cliente->telefono }}</td>
              <td>{{ $cliente->email }}</td>
              <td>
                <a class="btn btn-link" href="{{ route('clientes.edit', $cliente->id) }}">Editar</a>

                <form style="display: inline" method="POST" action="{{ route('clientes.destroy', $cliente->id) }}">
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