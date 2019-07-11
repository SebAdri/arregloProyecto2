@extends('layout')

@section('contenido')
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>Compras Realizadas</h3>
    </div>
    <div class="panel-body">
      <form action="{{ route('consultarCompras') }}" method="post">
        {{csrf_field()}}
        <div class="row">
          <div class="col-md-3 col-md-offset-3">
            <label for="">Seleccione la Obra</label>
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
          <div class="col-md-3">
            
          </div>

        </div>
        <div class="row">
          <div class="col-md-3 col-md-offset-4">
            <button type="submit" name="procesar" value ="1" class="btn btn-block button-primary">Consular</button>
          </div>
          <div class="col-md-3 col-md-offset-4">
            <button type="submit" formtarget="_blank" name="procesar" value ="2" class="btn btn-block button-primary">Generar PDF</button>
          </div>
        </div>
      </form>
      <hr>
      <div class="col-md-12">
        @include('reportes.partials.reportCompras-part')

      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
  $('input[name="periodo"]').daterangepicker({
    autoUpdateInput: false,
    locale:{
      format:'DD/MM/YYYY'
    }
  });
  $('input[name="periodo"]').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
  });

  $('input[name="periodo"]').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
  });
  $(".select2").select2({
    tags: true,
      // maximumSelectionLength : 1
    });
  $('#Compras').DataTable({
    dom: 'Bfrtip',
    buttons: [
    'excel', 'print'
    ],
    "aaSorting":[[0,"desc"]],       
    language: {
      "search": "Buscar:",
      "info": "Mostrando START a END de TOTAL Entradas",
      "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
      "lengthMenu":     "Mostrar MENU registros",
      "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
      }
    }
  });
</script>
@endpush