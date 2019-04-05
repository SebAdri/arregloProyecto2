@extends('layout')

@section('contenido')

	<form method="POST" action="{{route('profesiones.store')}}">
		{!! csrf_field() !!}
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
								<input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="" placeholder="Profesión" required>
                  					@if ($errors->has('nombre'))
                    					<span class="invalid-feedback errors" role="alert">
                      					<strong>{{ $errors->first('nombre') }}</strong>
                    					</span>
                  					@endif
							</div>
							
							<div class="col-md-3">
								<label for="">Descripción</label>
								<input type="text" class="form-control" name="detalle" value="" placeholder="Descripción">
							</div>
						</div>
			</div>
			
			<div class="row">
                <div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
                  <button type="submit" class="btn button-primary">Guardar</button>
                  <a class="btn button-primary" href="{{ route('profesiones.create') }}">Cancelar</a>
                  <button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
                </div>
            </div>
            <br>
</form>
			<table class="table table-responsive">
				<thead>
					<tr>
						<th>Profesión</th>
						<th>Descripción</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					@foreach($profesiones as $profesion)
						@if($profesion->estado == 1)
					<tr>
						<td>{{ $profesion->nombre }}</td>
						<td>{{ $profesion->detalle }}</td>
						<td>
							<a  class="btn btn-link" href="{{ route('profesiones.edit', $profesion->id) }}" >Editar</a>	
							<form style="display: inline" method="POST" action="{{ route('profesiones.destroy', $profesion->id) }}">
					          {!! csrf_field() !!}
					          {!! method_field('DELETE') !!}
					          <button class="btn button-primary" type="submit">Eliminar</button>
					        </form>
						</td>
					</tr>
					@endif
					@endforeach
				</tbody>
			</table>      
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