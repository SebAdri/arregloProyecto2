@extends('layout')

@section('contenido')

<form method="post" action="{{ route('reporteMaquinarias') }}">
  {!! csrf_field() !!}
  <div class="container">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1>Maquinarias por Obra</h1>
        </div>

        <div class="panel-body">
          <div class="row">
            <div class="col-md-3 col-md-offset-3">
              <label>Seleccione Obra</label>
              <select class="form-control input-sm select2" id="obra_id" name="obra_id">
                @foreach ($obras as $obra) 
                <option value={{$obra->id}}>{{$obra->nombre_proyecto}}</option> 
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Fecha Inicial/Final</label>             
                <div class="input-group">
                  <div class="input-group-addon" style="padding-top: 8px;padding-bottom: 10px;height: 32.992188px;">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right fecha" name="periodo" id="periodo">
                </div>
              </div>
            </div>
          </div>    

        <div class="row">
          <br>
        </div>
        <div class="row">
          <div class="col-md-5 col-md-offset-5">
            <input class="btn button-primary" value="Generar Reporte" type="submit">
          </div>
        </div>
        <br>
        <table id="lista_herramientas" class="table table-responsive">
          <thead>
            <tr>
              <th>Obra</th>
              <th>Maquinaria</th>
              <th>Modelo</th>
              <th>Fecha de Adquisición</th>
            </tr>
          </thead>
          <tbody>

            @foreach($obraMaquinarias as $obraMaquinaria)
              <tr>
                <td>{{$obraMaquinaria->obra->nombre_proyecto}}</td>
                <td>{{$obraMaquinaria->maquinarias[0]->ma_nombre}}</td>
                <td>{{$obraMaquinaria->maquinarias[0]->ma_modelo}}</td>
                <td>{{$obraMaquinaria->maquinarias[0]->ma_fecha_adquisicion}}</td>
              </tr>
            @endforeach 
              
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</form>

{{-- </div>
</div>
</div>
</div> --}}



@push('scripts')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script>
  $(document).ready(function() {
    $('input[name="periodo"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
              format: 'DD/MM/YYYY '//H:mm'
            }
          });
    $('input[name="periodo"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
  });

  $('input[name="periodo"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });
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