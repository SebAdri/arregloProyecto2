@extends('layout')

@section('contenido')

	<form method="POST" action="{{ route('materiales.store') }}">
    {!! csrf_field() !!}
    <div class="container">
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1>Materiales</h1>
          </div>
          <div class="panel-body">
            <div class="col-md-2 col-md-offset-3">
              <label for="">Material</label>
              <div class="form-group">
                <input type="text"  class="form-control{{ $errors->has('m_descripcion') ? ' is-invalid' : '' }}" value="" name="m_descripcion" placeholder="Nombre del Material" required>
                @if ($errors->has('m_descripcion'))
                  <span class="invalid-feedback errors" role="alert">
                    <strong>{{ $errors->first('m_descripcion') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="col-md-2">
              <label for="">Unidad de medida</label>
              <div class="form-group">
                  <input type="text" size="19"  class="form-control{{ $errors->has('m_unidad_medida') ? ' is-invalid' : '' }}" name="m_unidad_medida" value="" placeholder="Unidad de medida" required>
                    @if ($errors->has('m_unidad_medida'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('m_unidad_medida') }}</strong>
                      </span>
                    @endif
              </div>
            </div>

            <div class="col-md-2">
              <label for="" >Costo</label>
              <div class="form-group">
                  <input type="text" class="form-control{{ $errors->has('m_costo') ? ' is-invalid' : '' }}" name="m_costo" value="" placeholder="Costo Unitario" required>
                    @if ($errors->has('m_costo'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('m_costo') }}</strong>
                      </span>
                    @endif
                </div>
              </div>

            {{-- <div class="col-md-2">
              <label for="">Cantidad Actual</label>
              <div class="form-group">
                <input type="text" class="form-control{{ $errors->has('m_cantidad_actual') ? ' is-invalid' : '' }}" name="m_cantidad_actual" value="" placeholder="Cantidad Actual" required>
                    @if ($errors->has('m_cantidad_actual'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('m_cantidad_actual') }}</strong>
                      </span>
                    @endif
              </div>
            </div> --}}

            <div class="row">
              <br>
            </div>

            <div class="row">
              <div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
                <button type="submit" class="btn button-primary">Guardar</button>
                <a class="btn button-primary" href="{{ route('materiales.create') }}">Cancelar</a>
                <button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
                
              </div>
            </div>
              <br>
</form>

    <table id="lista_materiales" class="table table-responsive">
    <thead>
      <tr>
        <th>Material</th>
        <th>Unidad de medida</th>
        <th>Costo</th>
        {{-- <th>Cantidad Actual</th>      --}}
        <th>Acciones</th>
      </tr>
    </thead>

      <tbody>
        @foreach($materiales as $material)
          @if($material->m_estado == 1)
            <tr>
              <td>{{ $material->m_descripcion }}</td>
              <td>{{ $material->m_unidad_medida }}</td>
              <td>{{ $material->m_costo }}</td>
              {{-- <td>{{ $material->m_cantidad_actual }}</td>               --}}
              <td>
                <a ><button type="button" title="Editar" data-toggle="modal" data-target="#editar{{ $material->id }}" href="{{ route('materiales.edit', $material->id) }}" class="btn button-primary btn-rounded btn-sm my-0"><i class="fa fa-edit" style="font-size:20px;"></i></button></a>

                <form style="display: inline" method="POST" action="{{ route('materiales.destroy', $material->id) }}">
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


    $("#lista_materiales").dataTable({
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