@extends('layout')

@section('contenido')

  <form method="POST" action="{{ route('maquinarias.store') }}">
    {!! csrf_field() !!}
    <div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1>Maquinarias</h1>
      </div>
     
      <div class="panel-body">
        <div class="col-md-2">
          <label for="func">Maquinaria</label>
          <div class="form-group">
            <input type="text" name="ma_nombre" class="form-control{{ $errors->has('ma_nombre') ? ' is-invalid' : '' }}" value="" placeholder="Nombre Maquinaria" required>
                @if ($errors->has('ma_nombre'))
                  <span class="invalid-feedback errors" role="alert">
                    <strong>{{ $errors->first('ma_nombre') }}</strong>
                  </span>
                @endif
          </div>
        </div>

        <div class="col-md-2">
          <label for="func">Marca</label>
          <div class="form-group">
            <input type="text" name="ma_marca" class="form-control{{ $errors->has('ma_marca') ? ' is-invalid' : '' }}" value="" placeholder="Marca de la maquinaria" required>
              @if ($errors->has('ma_marca'))
                <span class="invalid-feedback errors" role="alert">
                  <strong>{{ $errors->first('ma_marca') }}</strong>
                </span>
              @endif
          </div>
        </div>

        <div class="col-md-2">
          <label for="func">Modelo</label>
          <div class="form-group">
            <input type="text" name="ma_modelo" class="form-control" value="" placeholder="Modelo">
          </div>
        </div>
        
        <div class="col-md-2">
          <label for="func">Fecha de Adquisición</label>
          <div class="form-group">
            <input type="date" name="ma_fecha_adquisicion" class="form-control{{ $errors->has('ma_fecha_adquisicion') ? ' is-invalid' : '' }}" value="" required="">
            @if ($errors->has('ma_fecha_adquisicion'))
                <span class="invalid-feedback errors" role="alert">
                  <strong>{{ $errors->first('ma_fecha_adquisicion') }}</strong>
                </span>
              @endif
          </div>
        </div>        

        <div class="col-md-2">
          <label for="func">Distancia realizada</label>
          <div class="form-group">
            <input type="text" name="ma_distancia" class="form-control" value="" placeholder="Kilometraje">
          </div>
        </div>

        <div class="col-md-2">
          <label for="func">Fecha Mantenimiento</label>
          <div class="form-group">
            <input type="date"  name="ma_fecha_mantenimiento" class="form-control" value="" placeholder="Fecha de mantenimiento de la maquinaria">
          </div>
        </div>

        <div class="row">
          <br><br><br><br>
        </div>

        <div class="row">
          <div class="col-md-5 col-md-offset-4">
            <input class="btn button-primary" value="Guardar" type="submit">
            <a class="btn button-primary" href="{{ route('maquinarias.create') }}">Cancelar</a>
            <button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
          </div>
        </div>
       <br>
  </form>

    <table id="lista_maquinarias" class="table table-responsive">
    <thead>
      <tr>
          <th>Nombre Maquinaria</th>
          <th>Marca</th>
          <th>Modelo</th>
          <th>Fecha Adquisición</th>
          <th>Distancia realizada</th>
          <th>Fecha de Mantenimiento</th>
          <th>Acciones</th>
      </tr>
    </thead>
          
    <tbody>
      @foreach($maquinarias as $maquinaria)
        <tr>
          <td>{{ $maquinaria->ma_nombre }}</td>
          <td>{{ $maquinaria->ma_marca }}</td>
          <td>{{ $maquinaria->ma_modelo }}</td>
          <td>{{ $maquinaria->ma_fecha_adquisicion }}</td>
          <td>{{ $maquinaria->ma_distancia }}</td>
          <td>{{ $maquinaria->ma_fecha_mantenimiento }}</td>
          <td>
            <a><button type="button" title="Editar" href="{{ route('maquinarias.edit', $maquinaria->id) }}" class="btn button-primary btn-rounded btn-sm my-0"><i class="fa fa-edit" style="font-size:20px;"></i></button></a>

            <form style="display: inline" method="POST" action="{{ route('maquinarias.destroy', $maquinaria->id) }}">
                  {!! csrf_field() !!}
                  {!! method_field('DELETE') !!}
              <button type="submit" class="btn button-primary"><i class="fa fa-trash" style="font-size:20px;"></i></button>
            </form>
          </td>
        </tr>
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


    $("#lista_maquinarias").dataTable({
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