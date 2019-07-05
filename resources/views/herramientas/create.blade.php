@extends('layout')

@section('contenido')

  <form method="POST" action="{{ route('herramientas.store') }}">
    {!! csrf_field() !!}
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
            <input type="text" size="15" name="h_nombre" class="form-control{{ $errors->has('h_nombre') ? ' is-invalid' : '' }}" value="" placeholder="Nombre de la herramienta" required>
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
            <input type="text" size="15" name="h_marca" class="form-control{{ $errors->has('h_marca') ? ' is-invalid' : '' }}" value="" placeholder="Marca" required>
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
            <input type="text" size="15" name="h_modelo" class="form-control" value="" placeholder="Modelo">
          </div>
        </div>

        <div class="col-md-2">
          <label for="func">Serie</label>
          <div class="form-group">
            <input type="text" size="15" name="h_nro_serie" class="form-control" value="" placeholder="Nro de Serie">
          </div>
        </div>

        <div class="col-md-2">
          <label for="func">Fecha de Adquisición</label>
          <div class="form-group">
            <input type="date" name="h_fecha_adquisicion" class="form-control{{ $errors->has('h_fecha_adquisicion') ? ' is-invalid' : '' }}" value="" placeholder="Fecha de Adquisición" required>
                @if ($errors->has('h_fecha_adquisicion'))
                  <span class="invalid-feedback errors" role="alert">
                    <strong>{{ $errors->first('h_fecha_adquisicion') }}</strong>
                  </span>
                @endif
          </div>
        </div>

        {{-- <div class="col-md-3">
          <label for="func">Ubicación</label>
          <div class="input-group">
            <input type="text" name="h_ubicacion" class="form-control" value="" placeholder="Ubicación">
          </div>
        </div> --}}

        <div class="row">
          <br><br><br><br>
        </div>
        <div class="row">
          <div class="col-md-5 col-md-offset-4">
            <input class="btn button-primary" value="Guardar" type="submit">
            <a class="btn button-primary" href="{{ route('herramientas.create') }}">Cancelar</a>
            <button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
          </div>
        </div>
       <br>
  </form>

    <table id="lista_herramientas" class="table table-responsive">
    <thead>
      <tr>
          <th>Nombre de la herramienta</th>
          <th>Marca</th>
          <th>Modelo</th>
          <th>Nro de Serie</th>
          <th>Fecha de Adquisición</th>
          <th>Ubicación</th>
          <th>Acciones</th>
      </tr>
    </thead>
          
    <tbody>
      @foreach($herramientas as $herramienta)
        @if($herramienta->h_estado)
        
        <tr>
          <td>{{ $herramienta->h_nombre }}</td>
          <td>{{ $herramienta->h_marca}}</td>
          <td>{{ $herramienta->h_modelo }}</td>
          <td>{{ $herramienta->h_nro_serie }}</td>
          <td>{{ $herramienta->h_fecha_adquisicion }}</td>
          <td>{{ $herramienta->h_ubicacion }}</td>
          <td>
             <a ><button type="button" title="Editar"  href="{{ route('herramientas.edit', $herramienta->id) }}" class="btn button-primary btn-rounded btn-sm my-0"><i class="fa fa-edit" style="font-size:20px;"></i></button></a>
          
            <form style="display: inline" method="POST" action="{{ route('herramientas.destroy', $herramienta->id) }}">
                  {!! csrf_field() !!}
                  {!! method_field('DELETE') !!}
              <button type="submit" class="btn button-primary"><i class="fa fa-trash" style="font-size:20px;"></i></button>
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


    $("#lista_herramientas").dataTable({
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