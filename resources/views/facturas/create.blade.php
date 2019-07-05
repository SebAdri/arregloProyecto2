@extends('layout')

@section('contenido')
<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1>Factura</h1>
      </div>
      <div class="panel-body">
        <form method="post" id="factura" action="{{ route('facturas.store') }}">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-3 ">
              <label for="">RUC</label>
              <input type="text" class="form-control" name="fc_ruc" value="@if ($cliente->ruc != '')
                {{$cliente->ruc}} @else {{$cliente->cedula}}
              @endif " placeholder="RUC">
            </div>
            <div class="col-md-3 ">
              <label for="">Nombre o Razon Social</label>
              <input type="text" class="form-control" name="fc_nombre" value="{{$cliente->nombre}}" placeholder="Nombre o Razon Social">
            </div>
            <div class="col-md-3">
              <label for="">Direccion</label>
              <input type="text" class="form-control" name="fc_fecha_emision" value="{{$cliente->direccion}}" placeholder="">
            </div>
            <div class="col-md-3 ">
              <label for="">Fecha de Emision</label>
              <input type="date" class="form-control" name="fc_fecha_emision" value="" placeholder="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="selectPago">Forma de Pago</label>
                <select class="form-control select2" id="formaPago" name="selectPago" style="width: 100%">
                  <option value="0">Seleccione el tipo Pago</option>
                  @foreach ($tiposPagos as $tipoPago)
                  <option id="tipoPago" value="{{$tipoPago->id}}">{{$tipoPago->descripcion}}</option>
                  @endforeach
                </select> 
              </div>
            </div>
            <div class="col-md-2">
              <label for="Monto">Monto</label>
              <input class="form-control" type="text" id="monto" name="Monto" disabled>
            </div>
            <div class="col-md-2">
              <label for="Entidad">Entidad Bancaria</label>
              <input class="form-control" type="text" id="entidad" name="Entidad" disabled>
            </div>
            <div class="col-md-2">
              <label for="referencia">Nro referencia</label>
              <input class="form-control" type="text" id="referencia" name="referencia" disabled>
            </div>
            <div class="col-md-2">
              <label for="tarjeta">Nro Tarjeta</label>
              <input class="form-control" type="text" id="tarjeta" name="tarjeta" disabled>
            </div>
            <div class="col-md-2">
              <label for="add">Agregar Detalle Pago</label>
              <button class="btn button-primary btn-block" name="add" id="add" type="button"><i class="fa fa-plus"></i></button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label>Detalle de Pago</label>
              <div id="formaPago">
                <table id="detalle_pagos" class="table table-responsive">
                  <thead>
                    <tr>
                      <th>Forma</th>
                      <th>Monto</th>
                      <th>Entidad</th>
                      <th>Nro Referencia</th>
                      <th>Nro Tarjeta</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <hr>
          <div>
            <label for="">Detalle de la factura</label>
          </div>
          <div class="row">
            <div class="col-md-9">
              <label for="">Concepto de Pago</label>
              <input type="text" class="form-control" name="concepto" id="concepto" value="" placeholder="Pago por {{$pago->nro_pago}}">
            </div>
            <div class="col-md-3">
              <label for="">Monto de Pago</label>
              <input type="text" class="form-control" name="monto_pago" readonly id="monto_pago" onkeyup="commaSeparateNumber($(this).val())" value="{{$pago->monto_pago}}" placeholder="Precio unitario">
            </div>

          </div>
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <table id="detalles_productos" class="table table-responsive">
                <thead>
                  <hr>
                  <tr>
                    <td></td>
                    <td>IVA 5%:<span id="iva5">0</span></td>
                    <td>IVA 10%:<span id="iva10">0</span></td>
                    {{-- <td>Subtotal: </td> --}}
                    <td>Total: <span id="total_venta">0</span></td>

                  </tr>
                </thead>
              </table>
            </div>

          </div>
          <div class="row">
            <hr>
            <div class="col-md-8 col-md-offset-4">
              <button type="submit" class="btn button-primary" id="generarFactura" name="documento_id" value="{{$pago->documento_id}}">Generar Factura</button>
              <a class="btn button-primary" href="{{ route('facturas.create') }}">Cancelar</a>
              <input type="hidden" name="pago" value="{{$pago->id}}">
            </div>
          </div>
        </form>


      </div>
      <div class="panel-footer">

      </div>
    </div>

  {{-- </div> --}}
</div>
@endsection
@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    var t = $('#detalle_pagos').DataTable({
      "paging":   false,
      "ordering": false,
      "info":     false,
      "searching": false,
      "language":{
        "sEmptyTable": "No se agregó ninguna forma de pagos"
      },
        "emptyTable":     "No se ha agregado ninguna forma de pago",
      "info":           false,
      "infoEmpty":      "No se ha agregado ninguna forma de pagos",
      "infoFiltered":   "(filtered from _MAX_ total entries)",
      "infoPostFix":    "",
      "thousands":      ",",
      "lengthMenu":     false,
      "loadingRecords": "Loading...",
      "processing":     "Processing...",
      "searching":       false,
      "zeroRecords":    "No se ha agregado ninguna forma de pago",
      "paginate": {
          "first":      "First",
          "last":       "Last",
          "next":       "Next",
          "previous":   "Previous"
      },
      "aria": {
          "sortAscending":  ": activate to sort column ascending",
          "sortDescending": ": activate to sort column descending"
      }
    });
    // console.log(monto); 
    $('#add').on( 'click', function () {
      var forma = $("#formaPago option:selected").text();
      var monto = $("#monto").val();     
      var referencia = $("#referencia").val(); 
      var entidad = $("#entidad").val();
      var tarjeta = $("#tarjeta").val();
      if (monto !=='') {
        t.row.add( [
            forma,      
            monto,
            referencia,
            entidad, tarjeta
        ] ).draw( false );
      }
      var monto_pago = 0;
      $.each(t.rows().data(), function(){
        monto_pago = parseInt(this[1])+ monto_pago;
      });
      $('#monto_pago').val(monto_pago);
      $("#monto").val('');     
      $("#referencia").val(''); 
      $("#entidad").val('');
      $("#tarjeta").val('');
      $("#formaPago").val(0);
      $("#monto").prop("disabled", true);     
      $("#referencia").prop("disabled", true); 
      $("#entidad").prop("disabled", true);
      $("#tarjeta").prop("disabled", true);
    } );
    $('#concepto').on('change', function(){
      calcular_valores();
    });
    $('#factura').submit(function(event){
      var datos = t.rows().data();
      var form = this;
      $.each(datos, function(){
        console.log(this);
         // If element doesn't exist in DOM
         if(!$.contains(document, form[this.name])){
            // Create a hidden element
            $(form).append(
               $('<input>')
                  .attr('type', 'hidden')
                  .attr('name', 'detalles[]')
                  .val(this)
            );
         }
        });
    });
  });
  function commaSeparateNumber(val){
    val=val.replace(/,/g, "");
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    $("#precio").val(val);
  }
  $("#formaPago").change( function() {
    if ($(this).val()!='0') {
      switch($(this).val()) {
        case '2':
          $("#monto").prop("disabled", false);     
          $("#referencia").prop("disabled", false);
          $("#entidad").prop("disabled", false);
          break;
        case '3':
          // var element = document. getElementById('monto');
          // element.parentNode.removeChild(element);
          $("#monto").prop("disabled", false);     
          $("#referencia").prop("disabled", false); 
          $("#entidad").prop("disabled", false);
          break;
        case '4':
          $("#monto").prop("disabled", false);     
          $("#referencia").prop("disabled", false); 
          $("#entidad").prop("disabled", false);
          $("#tarjeta").prop("disabled", false);
        default:
          $("#monto").prop("disabled", false); 
          $("#referencia").prop("disabled", true); 
          $("#entidad").prop("disabled", true);   
  }
}
});

  function calcular_valores()
  {
    var sum = 0;
    var iva5 = 0;
    var iva10 = 0;
    sum = $('#monto_pago').val();
    $("#iva10").text(Math.round(sum/11));
    $("#total_venta").text(sum);
  }
</script>

@endpush
