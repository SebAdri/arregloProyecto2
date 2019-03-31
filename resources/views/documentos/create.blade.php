@extends('layout')

@section('contenido')

	<form method="POST" action="{{ route('documentos.store') }}">
    {!! csrf_field() !!}
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
                <input type="text"class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}" name="nombre" value="" placeholder="Nombre del documento" required>
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
				<select class="form-control" id="sel1" name="tipo_doc">
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
					<input type="date" class="form-control" name="fecha_emision" value="">
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
                <input type="text"class="form-control" name="ubicacion" value="" placeholder="Ubicación física">
              </div>
            </div>

            <input type="hidden"class="form-control" name="obra_id" value={{$id_obra}}>



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

    <table class="table table-responsive">
    <thead>
      <tr>
        <th>Documento</th>
        <th>Tipo de Documento</th>
        <th>Fecha de emisión</th>        
        <th>Ubicación</th>
        <th>Acción</th>
      </tr>
    </thead>

      <tbody>
             @foreach($obraDocumentos as $obraDocumento)
             @foreach($obraDocumento as $documento)
             	<tr>
            			<td>{{ $documento->nombre }}</td>
              			<td>{{ $documento->tipo_doc }}</td>
              			<td>{{ $documento->fecha_emision }}</td>
              			<td>{{ $documento->ubicacion }}</td>
              			<td>
                			<a class="btn btn-link" href="{{ route('documentos.edit', $documento->id) }}">Editar</a>
                		</td>
            	</tr>
            @endforeach
            @endforeach
    </tbody>
  </table>

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