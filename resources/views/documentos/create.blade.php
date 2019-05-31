@extends('layout')

@section('contenido')

<form method="POST" action="{{ route('documentos.store') }}">
  {!! csrf_field() !!}
  <div class="container">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1>Documentos</h1>
        </div>

        <div class="panel-body">
          <div class="panel-heading">
            <h4>Cabecera</h4>
          </div>

          <div class="col-md-3 col-md-offset-1">
            <label for="">Documento</label>
            <div class="form-group">
              <input type="text"class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}" name="nombre" id="nombreDoc" value="" placeholder="Nombre del documento" required>
              @if ($errors->has('documento'))
              <span class="invalid-feedback errors" role="alert">
                <strong>{{ $errors->first('documento') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="col-md-2">
            <label for="">Tipo de documento</label>
            <div class="form-group">
              <select class="form-control" id="tipo_documento_id" name="tipo_documento_id">
                @foreach ($tipo_documentos as $tipo_doc) {       
                <option value={{ $tipo_doc->id }}>{{ $tipo_doc->nombre }}</option> 
                @endforeach       				
              </select>
            </div>
          </div>



          <div class="col-md-2">
            <label for="">Fecha de emisión</label>
            <div class="input-group{{ $errors->has('fecha_emision') ? ' is-invalid' : '' }}">
              <input type="date" class="form-control pull-right fecha" name="fecha_emision" value="" id="fecha_emision">
              @if ($errors->has('fecha_emision'))
              <span class="invalid-feedback errors" role="alert">
                <strong>{{ $errors->first('fecha_emision') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <input type="hidden"class="form-control" name="obra_id" value={{$id_obra}}>



            {{-- <div class="row">
              <br>
            </div> --}}

            <div class="col-md-2">
              <button type="submit" class="btn button-primary" style="margin-top: 24px; margin-left: 15px;">Agregar Detalle</button>
            </div>
            
            <div class="row"><br></div>

            <div class="panel-heading">
              <h4>Detalle</h4>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label for="monto_total"> Monto de la Obra</label>
                <input type="text" class="form-control numeric" id="monto" name="monto_total" value="1000000" disabled="disabled">
              </div>
              <div class="col-md-4">
                <label for="prod">Produccion</label>
                <input type="text" class="form-control numeric" id="prod" name="prod" value="">
              </div>
              <div class="col-md-4">
                <span></span>
                <button type="button"class="btn button-primary" id="addRow" title="Agregar"><i class="fa fa-plus" style="font-size:20px;"></i></button>
                <button type="button"class="btn button-primary" id="rmvrow" title="Eliminar"><i class="fa fa-minus" style="font-size:20px;"></i></button>
              </div>
            </div>
            <div class="row">
              <br>
            </div>

            <table id="detalle" class="table table-responsive">
              <thead>
                <tr>
                  <th style="text-align: center;">Nro.</th>
                  <th style="text-align: center;">Saldo</th>
                  <th  style="text-align: center;">Monto pago</th>
                  <th  style="text-align: center;">Producción(%)</th>
                  {{-- <th  style="text-align: center;"></th> --}}
                </tr>
              </thead>

              <tbody style="text-align: center">
              </tbody>
            </table>

            <div class="row">
              <div class="col-md-4 col-md-offset-4" style="margin-top: 20px">
                <button type="submit" id="btnGuardar" class="btn button-primary">Guardar</button>
                <a class="btn button-primary" href="">Cancelar</a>
                <button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  @stop

  @push('scripts')
  {{-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></script> --}}
  <script>
    $(document).ready(function() {
      var t = $('#detalle').DataTable();
      var counter = 1;
      var montoTotal = Number($('#monto').val());
      var saldo = montoTotal;

      $('#addRow').on('click', function () {
        var prod = Number($('#prod').val());
        var porcentaje = 100;
        saldo = saldo - montoTotal*(prod/100);
        // for (var i = 0; i < (porcentaje/prod); i++) {
        //   monto = monto - montoTotal/(porcentaje/prod) ;
        //   t.row.add( [
        //     counter,
        //     monto, 
        //     montoTotal/(porcentaje/prod),
        //     prod
        //     ] ).draw( false );
        //   counter++;
        // }
        // if (monto !='' && prod != '' ) {
        //   t.row.add( [
        //     counter,
        //     monto - monto*(prod/100), 
        //     monto*(prod/100),
        //     prod
        //     ] ).draw( false );
        //   $('#monto').val(monto - monto*(prod/100));
        // }

        if (montoTotal !='' && prod != '' ) {
          // saldo = saldo - montoTotal*(prod/100);
          t.row.add( [
            counter,
            saldo, 
            montoTotal*(prod/100),
            prod
            ] ).draw( false );
          // $('#monto').val(monto - monto*(prod/100));
          counter++;
        }
      } );
      $('#btnGuardar').on('click', function(event){
        event.preventDefault();
        var nombreDoc = $('#nombreDoc').val();
        var fecha_emision = $('#fecha_emision').val();
        var tipo_documento = $('#tipo_documento_id').val();
        var cuotas = [];
        // console.log(t.data());
        for (i = 0; i <t.data().length; i++ ){
         cuotas.push(t.rows().data()[i]); 
        }
        $.ajax({
          headers: {
            'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')
          },
          url:"{{ route('documentos.store') }}",
          method: 'post', 
          data: {
            cuotas: cuotas,
            nombreDoc: nombreDoc,
            fecha_emision: fecha_emision,
            tipo_documento: tipo_documento,
          },
          // dataType: 'json',
          // processData: false
        })
        .done(function (response){
          $("#pedido").modal('hide');
          $("#message").html('<p>Se ha enviado la solicitud</p>');
          $("#message").show();
          $("#message").hide(1500);
          // location.reload();
        })
        .fail(function(){
          alert('ocurrio un error interno, contacte con Rolo');
        })
      })
      $('#rmvrow').on('click', function(){
        var indice = t.rows().count() -1; 
        t.row(indice).remove().draw();
      });

    // Automatically add a first row of data
      
  } );
</script>
@endpush