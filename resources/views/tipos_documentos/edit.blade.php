@extends('layout')

@section('contenido')


<form method="POST" action="{{ route('tipos_documentos.update', $tipos_documentos->id) }}">
    {!! csrf_field() !!}
    {!! method_field('PUT') !!}
		<div class="container">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h1>Tipos de documentos</h1>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3 col-md-offset-3">
								<label for="">Nombre</label>
								<input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{$tipos_documentos->nombre}}" placeholder="Nombre del documento" required>
                  					@if ($errors->has('nombre'))
                    					<span class="invalid-feedback errors" role="alert">
                      					<strong>{{ $errors->first('nombre') }}</strong>
                    					</span>
                  					@endif
							</div>
							
							<div class="col-md-3">
								<label for="">Descripción</label>
								<input type="text" class="form-control" name="descripcion" value="{{$tipos_documentos->descripcion}}" placeholder="Descripción">
							</div>
						</div>
			</div>
			
			<div class="row">
                <div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
                  <button type="submit" class="btn button-primary">Guardar</button>
                  <a class="btn button-primary" href="{{ route('tipos_documentos.create') }}">Cancelar</a>
                  <button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
                </div>
            </div>
            <br>
</form>


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