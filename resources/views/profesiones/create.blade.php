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

			<table id="lista_profesiones" class="table table-responsive">
				<thead>
					<tr>
						<th>Profesión</th>
						<th>Descripción</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($profesiones as $profesion)
						@if($profesion->estado == 1)
					<tr>
						<td>{{ $profesion->nombre }}</td>
						<td>{{ $profesion->detalle }}</td>
						<td>
							 <a ><button type="button" title="Editar" href="{{ route('profesiones.edit', $profesion->id) }}" class="btn button-primary btn-rounded btn-sm my-0"><i class="fa fa-edit" style="font-size:20px;"></i></button></a>

							
							<form style="display: inline" method="POST" action="{{ route('profesiones.destroy', $profesion->id) }}">
					          {!! csrf_field() !!}
					          {!! method_field('DELETE') !!}
					          <button class="btn button-primary" type="submit"><i class="fa fa-trash" style="font-size:20px;"></i></button>
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
@push('scripts')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

<script>
  $(document).ready(function() {
    $('.numeric').inputmask("numeric", {
            radixPoint: ",",
            groupSeparator: ".",
            digits: 2,
            autoGroup: true,
            // prefix: '$', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () { self.Value(''); }
      });

    $('.select2').select2(); 


    $("#lista_profesiones").dataTable({
      dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf'
        ],
        "aaSorting":[[0,"desc"]],       
        language: {
                  "search": "Buscar:",
                  "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
              "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
              "lengthMenu":     "Mostrar _MENU_ registros",
              "paginate": {
                  "first": "Primero",
                  "last": "Último",
                  "next": "Siguiente",
                  "previous": "Anterior"
              }
              }
    });   

    $("#itemList").select2({
      ajax: {
        
        delay: 0,
        data: function (params) {
          return {
                              q: params.term, // search term
                              page: params.page
                          };
                      },
                      processResults: function (data, params){
                        var results = $.map(data, function (value, key) {
                          return {
                            children: $.map(value, function (v) {
                              return {
                                id: key,
                                text: v
                              };
                            })
                          };
                        });
                        return {
                          results: results,
                        };
                      },
                      cache: true
                  },
                  escapeMarkup: function (markup) {
                    return markup;
                  }, // let our custom formatter work
                  minimumInputLength: 3,
              });

  });
</script>
@endpush
@endsection