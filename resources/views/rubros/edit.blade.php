@extends('layout')

@section('contenido')

<div class="container">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Rubros</h1>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-2 col-md-offset-2">
						<label for="nombre">Familia Rubros</label>
						<input type="text" class="form-control" name="fliaRubro" readonly value="{{$fliaRubros->nombre}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-2 col-md-offset-2">
						<label for="nombre">Rubros</label>
						<input type="text" class="form-control" name="rubro" value="" placeholder="Nombre del Rubro">

						@if ($errors->has('rubro'))
                      		<span class="invalid-feedback errors" role="alert">
                        		<strong>{{ $errors->first('rubro') }}</strong>
                      		</span>
                    	@endif

					</div>
				</div>

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