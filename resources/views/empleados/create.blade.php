@extends('layout')

@section('contenido')
  <form method="POST" action="{{ route('empleados.store') }}">
    {!! csrf_field() !!}
    <div class="container">
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1>Empleados</h1>
          </div>

          <div class="panel-body">
            <div class="col-md-2 col-md-offset-2">
              <label for="">Primer Nombre</label>
                <div class="form-group">
                  <input type="text" size="19"  class="form-control{{ $errors->has('primerNombre') ? ' is-invalid' : '' }}" value="" id="primerNombre" name="primerNombre" placeholder="Primer Nombre" required>
                    @if ($errors->has('primerNombre'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('primerNombre') }}</strong>
                      </span>
                    @endif
                </div>
            </div>

            <div class="col-md-2">
              <label for="">Segundo Nombre</label>
              <div class="form-group">
                <input type="text" size="19"  class="form-control" name="segundoNombre" value="" placeholder="Segundo Nombre">
              </div>
            </div>

            <div class="col-md-2">
              <label for="" >Primer Apellido</label>
              <div class="form-group">
                <input type="text" size="19" class="form-control{{ $errors->has('primerApellido') ? ' is-invalid' : '' }}" name="primerApellido" value="" placeholder="Primer Apellido" required>
                    @if ($errors->has('primerApellido'))
                      <span class="invalid-feedback errors" role="alert">
                          <strong>{{ $errors->first('primerApellido') }}</strong>
                      </span>
                    @endif
              </div>
            </div>

            <div class="col-md-2">
              <label for="">Segundo Apellido</label>
              <div class="form-group">
                <input type="text" size="19" class="form-control" name="segundoApellido" value="" placeholder="Segundo Apellido">
              </div>
            </div>

            <div class="col-md-3 col-md-offset-2">
              <label for=""  style="margin-top: 10px">Dirección</label>
              <div class="form-group">
                <input type="text" size="35" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" value="" placeholder="Dirección" required>
                  @if ($errors->has('direccion'))
                    <span class="invalid-feedback errors" role="alert">
                      <strong>{{ $errors->first('direccion') }}</strong>
                    </span>
                  @endif
              </div>
            </div>

            <div class="col-md-2">
              <label for="" style="margin-top: 10px">Teléfono</label>
              <div class="form-group">
                <input type="text" size="19" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="" placeholder="Teléfono" numeric>
                @if ($errors->has('telefono'))
                    <span class="invalid-feedback errors" role="alert">
                      <strong>{{ $errors->first('telefono') }}</strong>
                    </span>
                  @endif
              </div>
            </div>

            <div class="col-md-2">
              <label for="sel1" style="margin-top: 10px">Profesión</label>
                <div class="form-group">
                  <select class="form-control" id="profesion_id" name="profesion_id">
                      @foreach ($profesiones as $profesion) 
                         <option value={{$profesion->id}}>{{$profesion->nombre}}</option> 
                      @endforeach
                  </select>
                </div>
            </div>

            <div class="row">
              <br>
            </div>

            <div class="row">
              <div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
                <button type="submit" class="btn button-primary">Guardar</button>
                <a class="btn button-primary" href="{{ route('empleados.create') }}">Cancelar</a>
                <button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
              </div>
            </div>

              <br>
</form>

    <table id="lista_empleados" class="table table-responsive">
    <thead>
      <tr>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Profesión</th>
        <th>Acciones</th>
        <th>Obras Asigandas</th>
      </tr>
    </thead>

      <tbody>
        @foreach($empleados as $empleado)
          {{-- @if($empleado->estado == 1) --}}
            <tr>
              <td>{{ $empleado->primerNombre .' '.$empleado->segundoNombre }}</td>
              <td>{{ $empleado->primerApellido .' '.$empleado->segundoApellido }}</td>
              <td>{{ $empleado->direccion }}</td>
              <td>{{ $empleado->telefono }}</td>
              <td>{{ $empleado->profesion->nombre }}</td>
              <td>
                <a ><button type="button" title="Editar" data-toggle="modal" data-target="#editar{{ $empleado->id }}" href="{{ route('empleados.edit', $empleado->id) }}" class="btn button-primary btn-rounded btn-sm my-0"><i class="fa fa-edit" style="font-size:20px;"></i></button></a>

                {{-- <form style="display: inline" method="POST" action="{{ route('empleados.destroy', $empleado->id) }}">
                      {!! csrf_field() !!}
                      {!! method_field('DELETE') !!}
                      <button type="submit" class="btn button-primary"><i class="fa fa-trash" style="font-size:20px;"></i></button>
                </form> --}}
                <button id="myModal" type="button" class="btn button-primary" title="Asignar a Obra" data-toggle="modal" data-target="#myModal{{ $empleado->id }}"><i class="fa fa-plus" style="font-size:17px;"></i></button> 
              </td>

              <td>
                <button id="detalle" type="button" class="btn button-primary" data-toggle="modal" data-target="#detalle{{ $empleado->id }}">Ver</button> 
              </td>
 
            </tr>
          {{-- @endif --}}
          @endforeach
    </tbody>
  </table>
    </div>
  </div>
</div>
</div>
</div>
{{-- Pop up de Asignacion a Obras --}}
@foreach($empleados as $empleado)
  <div id="myModal{{$empleado->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;">Asignar empleados a obras</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('empleadosObras', $empleado->id) }}">
        {!! csrf_field() !!}
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <label for="nombre">Empleado</label>
            <input type="text" class="form-control" name="empleado" readonly value="{{$empleado->primerNombre .' '.$empleado->primerApellido}}">
          </div>

          <div class="col-md-5 col-md-offset-4">
            <label for="Coste" style="margin-top: 10px">Obras</label>
              <div class="form-group">
                <select class="form-control" id="obra" name="obra">
                  @foreach ($obras as $obra) 
                    <option value={{$obra->id}}>{{$obra->nombre_proyecto}}</option> 
                  @endforeach
                </select>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <input class="btn button-primary" value="Asignar" type="submit" name="asignar" style="margin-top: 20px">
            <button type="button" class="btn button-primary" data-dismiss="modal"  name="button" style="margin-top: 20px">Cancelar</button>
          </div>
        </div>
      </div>
    </form>

    </div>

  </div>
</div>
@endforeach

</div>

{{-- Pop up de lista de obras asignadas --}}
@foreach($empleados as $empleado)
<div id="detalle{{ $empleado->id }}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;">Obras Asignadas</h4>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <label for="nombre">Empleado</label>
            <input type="text" class="form-control" name="empleado" readonly value="{{$empleado->primerNombre .' '.$empleado->primerApellido}}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-5 col-md-offset-4" style="margin-top: 15px">
            <label for="nombre">Se encuentra en la(s) obra(s):</label>
            @foreach($empleadosObras as $empleados)
             @foreach($empleados as $empleadoObra)
               @if($empleadoObra->pivot->empleado_id == $empleado->id)
                  <li>{{$empleadoObra->nombre_proyecto}}</li>
               @endif
            @endforeach
          @endforeach
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


    $("#lista_empleados").dataTable({
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