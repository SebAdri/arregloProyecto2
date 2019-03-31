@extends('layout')

@section('contenido')


<form method="POST" action="{{ route('herramientas.update', $herramienta->id) }}">
    {!! csrf_field() !!}
    {!! method_field('PUT') !!}

    <div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1>Herramientas</h1>
      </div>
     
      <div class="panel-body">
        <div class="col-md-3">
          <label for="func">Herramienta</label>
          <div class="form-group">
            <input type="text" name="h_nombre" class="form-control{{ $errors->has('h_nombre') ? ' is-invalid' : '' }}" value="{{ $herramienta->h_nombre }}" placeholder="Nombre de la herramienta" required>
                @if ($errors->has('h_nombre'))
                  <span class="invalid-feedback errors" role="alert">
                    <strong>{{ $errors->first('h_nombre') }}</strong>
                  </span>
                @endif
          </div>
        </div>

        <div class="col-md-2">
          <label for="func">Marca</label>
          <div class="form-group">
            <input type="text" name="h_marca" class="form-control{{ $errors->has('h_marca') ? ' is-invalid' : '' }}" value="{{$herramienta->h_marca}}" placeholder="Marca" required>
                @if ($errors->has('h_marca'))
                  <span class="invalid-feedback errors" role="alert">
                    <strong>{{ $errors->first('h_marca') }}</strong>
                  </span>
                @endif
          </div>
        </div>

        <div class="col-md-2">
          <label for="func">Modelo</label>
          <div class="form-group">
            <input type="text" size="15" name="h_modelo" class="form-control" value="{{$herramienta->h_modelo}}" placeholder="Modelo">
          </div>
        </div>

        <div class="col-md-2">
          <label for="func">Nro de Serie</label>
          <div class="input-group">
            <input type="text" name="h_nro_serie" class="form-control" value={{"$herramienta->h_nro_serie"}} placeholder="Nro de Serie">
          </div>
        </div>

        <div class="col-md-2">
          <label for="func">Fecha de Adquisición</label>
          <div class="form-group">
            <input type="date" name="h_fecha_adquisicion" class="form-control{{ $errors->has('h_fecha_adquisicion') ? ' is-invalid' : '' }}" value="{{$herramienta->h_fecha_adquisicion}}" placeholder="Fecha de Adquisición" required>
                @if ($errors->has('h_fecha_adquisicion'))
                  <span class="invalid-feedback errors" role="alert">
                    <strong>{{ $errors->first('h_fecha_adquisicion') }}</strong>
                  </span>
                @endif
          </div>
        </div>

        <div class="row">
          <br><br><br><br>
        </div>
        <div class="row">
          <div class="col-md-5 col-md-offset-4">
            <button type="submit" class="btn button-primary">Guardar</button>
            <a class="btn button-primary" href="{{ route('herramientas.edit', $herramienta->id) }}">Cancelar</a>
            <a class="btn button-primary" href="{{ route('herramientas.create') }}">Volver</a>
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