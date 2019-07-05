@extends('layout')

@section('contenido')

<style type="text/css">
	/*#modalWidth{
  		width:90% !important;

	}*/
</style>

<form method="POST" action="{{ route('rubros.store') }}">
	{!! csrf_field() !!}
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Rubros</h1>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-offset-11">
							<button type="button"class="btn button-primary" title="Agregar Nueva Familia Rubro" data-toggle="modal" data-target="#myModal" style="margin-top: 10px"><i class="fa fa-plus" style="font-size:30px;"></i></button>
						</div>
					</div>		


					<div class="row">
						<div class="col-md-2 col-md-offset-1">
							<label for="nombre" style="margin-top: 10px">Familia Rubros</label>

							<select class="form-control input-sm select2" id="familia_rubro_id" name="familia_rubro_id">
								@foreach ($fliaRubros as $fliaRubro) 
								<option value={{$fliaRubro->id}}>{{$fliaRubro->nombre}}</option> 
								@endforeach
							</select>

						</div>

						<div class="col-md-4">
							<label for="nombre" style="margin-top: 10px">Rubro</label>
							<input type="text" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="" placeholder="Nombre del Rubro" required>

							@if ($errors->has('nombre'))
							<span class="invalid-feedback errors" role="alert">
								<strong>{{ $errors->first('nombre') }}</strong>
							</span>
							@endif
						</div>

						<div class="col-md-2">
							<label for="nombre" style="margin-top: 10px">Mano de obra</label>
							<input type="text" class="form-control numeric {{ $errors->has('mano_obra') ? ' is-invalid' : '' }}" name="mano_obra" value="" placeholder="Monto en Gs." required>

							@if ($errors->has('mano_obra'))
							<span class="invalid-feedback errors" role="alert">
								<strong>{{ $errors->first('mano_obra') }}</strong>
							</span>
							@endif
						</div>

						<div class="col-md-2">
							<label for="nombre" style="margin-top: 10px">Unidad de medida</label>
							<input type="text" class="form-control {{ $errors->has('unidad_medida') ? ' is-invalid' : '' }}" name="unidad_medida" value="" placeholder="Unidad de medida" required>

							@if ($errors->has('unidad_medida'))
							<span class="invalid-feedback errors" role="alert">
								<strong>{{ $errors->first('unidad_medida') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="row">
						<div class="col-md-4 col-md-offset-4" style="margin-top: 20px">
							<button type="submit" class="btn button-primary">Guardar</button>
							<a class="btn button-primary" href="{{ route('rubros.create') }}">Cancelar</a>
							<button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
						</div>
					</div>
				</form>
				<br>

				<table id="listado" class="table table-responsive">
					<thead>
						<tr>
							<th  style="text-align: center;">Familia Rubros</th>
							<th  style="text-align: center;">Rubro</th>
							<th  style="text-align: center;">Unidad de medida</th>
							<th  style="text-align: center;">Mano de obra</th>
							<th  style="text-align: center;">Agregar Materiales</th>
							<th  style="text-align: center;">Detalles</th>
						</tr>
					</thead>

					<tbody style="text-align: center">
						@foreach($rubros as $rubro)
						<tr>
							<td>{{ $rubro->familiaRubro->nombre }}</td>
							<td>{{ $rubro->nombre }}</td>
							<td>{{ $rubro->unidad_medida }}</td>
							<td>{{ number_format($rubro->mano_obra,2,",",".") }} Gs.</td>

							<td>
								<button type="button"class="btn button-primary" id="modalMateriales{{$rubro->id}}" title="Agregar materiales a rubros" data-toggle="modal" data-target="#myModal1{{ $rubro->id }}"><i class="fa fa-plus" style="font-size:20px;"></i></button>
							</td>

							<td>
								<button id="myModal2" type="button" class="btn button-primary" data-toggle="modal" data-target="#myModal2{{ $rubro->id }}">Ver</button> 
							</td>
						</tr>
						@endforeach 
					</tbody>
				</table>

			</div>
		</div>	
	</div>		
</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<div class="panel panel-default">
					<form method="post" action="{{route('familiaRubros.store')}}">
						{!! csrf_field() !!}

						<div class="panel-heading">
							<h2 style="text-align: center;">Familia de Rubros</h2>
						</div>

						<div class="panel-body">
							<div class="row">
								<div class="col-md-5 col-md-offset-4">
									<label for="Descripcion">Nombre del rubro</label>
									<input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="" placeholder="Nombre" required>
									@if ($errors->has('nombre'))
									<span class="invalid-feedback errors" role="alert">
										<strong>{{ $errors->first('nombre') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="row">
								<div class="col-md-5 col-md-offset-4">
									<input class="btn button-primary" value="Guardar" type="submit" style="margin-top: 20px">
									<button type="button" class="btn button-primary" data-dismiss="modal"  name="button" style="margin-top: 20px">Cancelar</button>
								</div>
							</div>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@foreach($rubros as $rubro)
<div id="myModal1{{$rubro->id}}" class="modal fade" role="dialog">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-body">
 				<div class="panel panel-default">
 				 <form method="post" action="{{ route('storeMaterialesRubros', $rubro->id) }}">
 						{!! csrf_field() !!}

 						<div class="panel-heading">
							<h2 align="center">Agregar materiales a: {{$rubro->nombre}}</h2>
						</div>

						<div class="panel-body">
							<div class="row">
								<table class="table table-responsive" id="listaMateriales">
									<thead>
										<tr>
											<th>Material</th>
											<th>Unidad de medida</th>
											<th>Precio</th>
											<th>Cantidad</th>
											<th>Elegir</th>
										</tr>
									</thead>

									<tbody>
									@foreach($materiales as $material)
									<tr>
										<td>{{ $material->m_descripcion }}</td>
										<td>{{ $material->m_unidad_medida }}</td>
										<td>{{ $material->m_costo }}</td>
										<td>
											{{-- @if() --}}
											<input type="text" class="form-control" name="materiales[{{ $material->id }}]" value=>
											{{-- @endif --}}
										</td>
										<td></td>
									</tr>
									@endforeach
								</tbody>
								</table>
							</div>

							<div class="row">
								<div class="col-md-8 col-md-offset-4">
									<input class="btn button-primary" value="Asignar" type="submit" name="asignar" style="margin-top: 20px">
									<button type="button" class="btn button-primary" data-dismiss="modal"  name="button" style="margin-top: 20px">Cancelar</button>
								</div>
							</div>
						</div>
 					</form>
 				</div>
 			</div>
 		</div>
 	</div>
</div>
@endforeach


@foreach($rubros as $rubro)
<div id="myModal2{{ $rubro->id }}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title" style="text-align: center;">Materiales asignados al rubro: {{$rubro->nombre}}</h2>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-10 col-md-offset-1" style="margin-top: 15px">
          	<table class="table table-responsive" id="materiales_asignados">
				<thead>
					<tr>
						<th style="text-align: center;">Material</th>
						<th style="text-align: center;">Cantidad</th>
					</tr>
				</thead>

				<tbody>
					@foreach($materialesRubros as $materialRubro)
	            		@foreach($materialRubro['materiales'] as $key => $material)
	            			{{-- <td>{{$material['pivot']['rubro_id']}}</td> --}}
	            			@if($material['pivot']['rubro_id'] == $rubro->id)
		            			<tr>	
		            				<td>{{$material['m_descripcion']}}</td>
		            				<td>{{$material['pivot']['cantidad_material']}}</td>
		            			</tr>
	            			@endif
            			@endforeach
          			@endforeach
				</tbody>
			</table>

           
          


          </div>
        </div>

        <div class="row">
          <div class="col-md-4 col-md-offset-5">
            <button type="button" style="margin-top: 20px" class="btn button-primary" data-dismiss="modal"  name="button" style="margin-top: 20px">Aceptar</button>
          </div>
          
        </div>
      </div>
    </div>

  </div>
</div>

@endforeach

@push('scripts')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

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

		$("#listado").dataTable({
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

		$("#listaMateriales").dataTable({
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

        $("#materiales_asignados").dataTable({
                 "aaSorting":[[0,"desc"]],
                                language: {
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