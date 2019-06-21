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
            <div class="col-md-10">
              <div class="form-group" >
                <label for="">Forma de Pago</label><br>
                <input class="radio-inline" type="radio" name="fc_formaPago" id="fc_formaPago" value="Efectivo"> Efectivo
                <input class="radio-inline" type="radio" name="fc_formaPago" id="fc_formaPago" value="Cheque"> Cheque
                <input class="radio-inline" type="radio" name="fc_formaPago" id="fc_formaPago" value="Transferencia"> Transferencia Bancaria
                <input class="radio-inline" type="radio" name="fc_formaPago" id="fc_formaPago" value="ChequeEfectivo"> Cheque y Efectivo
                <input class="radio-inline" type="radio" name="fc_formaPago" id="fc_formaPago" value="TransferenciaEfectivo"> Transferencia Bancaria y Efectivo
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div id="formaPago"></div>
            </div>
          </div>
          <hr>
          <div>
            <label for="">Cargar detalle de la factura</label>
          </div>
          <div class="row">
            <div class="col-md-9">
              <label for="">Concepto de Pago</label>
              <input type="text" class="form-control" name="concepto" id="concepto" value="" placeholder="Pago por {{$pago->nro_pago}}">
            </div>
            <div class="col-md-3">
              <label for="">Monto de Pago</label>
              <input type="text" class="form-control" name="monto_pago" id="monto_pago" onkeyup="commaSeparateNumber($(this).val())" value="{{$pago->monto_pago}}" placeholder="Precio unitario">
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
    $('#concepto').on('change', function(){
      calcular_valores();
    });
  });
  function commaSeparateNumber(val){
    val=val.replace(/,/g, "");
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    $("#precio").val(val);
  }
  $('#factura').submit(function(event){
    // var monto_pago = $('#monto_pago').val();
    // if ( typeof monto_banco !== "undefined") {
    //   var monto_banco = $('monto_banco').val();
    // }
    // if ( typeof monto_efectivo !== "undefined") {
    //   var monto_efectivo = $('monto_efectivo').val();
    // }
    // if (monto_pago != monto_banco || monto_pago != ()) {}
    // event.preventDefault();
  });
  $('.radio-inline').on('click', function(){ 
   var html = '';
   if ($(this).val() == 'Cheque' || $(this).val() =='Transferencia') {
    html += '<div class="col-md-3">';
    html += '<input type="text" class="form-control" name="banco" value="" placeholder="Entidad Bancaria">';
    html += '</div>';
    html += '<div class="col-md-3">';
    html += '<input type="text" class="form-control" name="referencia" value="" placeholder="Nro de referencia">';
    html += '</div>';
    html += '<div class="col-md-3">';
    html += '<input type="text" class="form-control" name="cuenta" value="" placeholder="Nro de cuenta">';
    html += '</div>';
    html += '<div class="col-md-3">';
    html += '<input type="text" class="form-control" id="monto_banco" name="monto_banco" value="" placeholder="Monto">';
    html += '</div>';
    $('#formaPago').html(html);
   }else if($(this).val() == 'ChequeEfectivo' || $(this).val() == 'TransferenciaEfectivo'){
    html += '<div class="col-md-3">';
    html += '<input type="text" class="form-control" name="banco" value="" placeholder="Entidad Bancaria">';
    html += '</div>';
    html += '<div class="col-md-3">';
    html += '<input type="text" class="form-control" name="referencia" value="" placeholder="Nro de referencia">';
    html += '</div>';
    html += '<div class="col-md-2">';
    html += '<input type="text" class="form-control" name="cuenta" value="" placeholder="Nro de cuenta">';
    html += '</div>';
    html += '<div class="col-md-2">';
    html += '<input type="text" class="form-control" id="monto_banco" name="monto_banco" value="" placeholder="Monto en Cuenta">';
    html += '</div>';
    html += '<div class="col-md-2">';
    html += '<input type="text" class="form-control" id="monto_efectivo" name="monto_efectivo" value="" placeholder="Monto en Efectivo">';
    html += '</div>';
    // html +='<div class="row">';
    // html += '<>'
    // html += '</div>';
    $('#formaPago').html(html);
   }else{
    $('#formaPago').html(html);

   }
 })
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
