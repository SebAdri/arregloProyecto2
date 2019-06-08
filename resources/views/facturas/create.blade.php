@extends('layout')

@section('contenido')
<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1>Factura</h1>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4 ">
            <label for="">RUC</label>
            <input type="text" class="form-control" name="fc_ruc" value="" placeholder="RUC">
          </div>
          <div class="col-md-4 ">
            <label for="">Nombre o Razon Social</label>
            <input type="text" class="form-control" name="fc_nombre" value="" placeholder="Nombre o Razon Social">
          </div>
          <div class="col-md-4 ">
            <label for="">Fecha de Emision</label>
            <input type="date" class="form-control" name="fc_fecha_emision" value="" placeholder="">
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-10">
            <div class="form-group" >
              <label for="">Forma de Pago</label><br>
              <input class="radio-inline" type="radio" name="fc_contadoCredito" value="true" checked onclick="mostrarCuota(this.form,1)"> Efectivo
              <input class="radio-inline" type="radio" name="fc_contadoCredito" value="false" onclick="mostrarCuota(this.form,0)"> Cheque
              <input class="radio-inline" type="radio" name="fc_contadoCredito" value="false" onclick="mostrarCuota(this.form,0)"> Transferencia Bancaria
              <input class="radio-inline" type="radio" name="fc_contadoCredito" value="false" onclick="mostrarCuota(this.form,0)"> Cheque y Efectivo
              <input class="radio-inline" type="radio" name="fc_contadoCredito" value="false" onclick="mostrarCuota(this.form,0)"> Transferencia Bancaria y Efectivo
            </div>
          </div>
        </div>
        <hr>
        <div>
          <label for="">Cargar detalle de la factura</label>
        </div>
        <div class="row">
          <div class="col-md-9">
            <label for="">Concepto de Pago</label>
            <input type="text" class="form-control" name="descripcion" id="descripcion" value="" placeholder="Descripcion">
          </div>
          <div class="col-md-3">
            <label for="">Monto de Pago</label>
            <input type="text" class="form-control" name="precio" id="precio" onkeyup="commaSeparateNumber($(this).val())" value="" placeholder="Precio unitario">
          </div>

        </div>
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <table id="detalles_productos" class="table table-responsive">
              <thead>
                <tr>
                  <th></th>
                  <th>Descripcion</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Accion</th>
                </tr>
              </thead>
              <tbody id="body">
              </tbody>
              <tfoot>
                <hr>
                <tr>
                  <td></td>
                  <td>IVA 5%:<span id="iva5"></span>0</td>
                  <td>IVA 10%:<span id="iva10"></span>0</td>
                  {{-- <td>Subtotal: </td> --}}
                  <td>Total: <span id="total_venta">0</span></td>

                </tr>
              </tfoot>
            </table>
          </div>

        </div>
        <div class="row">
          <hr>
          <div class="col-md-8 col-md-offset-4">
            <button type="button" class="btn button-primary" name="button">Generar Factura</button>
            <a class="btn button-primary" href="{{ route('facturas.create') }}">Cancelar</a>
          </div>
        </div>


      </div>
      <div class="panel-footer">

      </div>
    </div>

  {{-- </div> --}}
</div>

{{-- <script type="text/javascript">
  $("#mostrarCuota").click(function(frm, num){
  dd(num);
  if(num!=0) { 
    frm.fc_cuota.style.visibility='visible'; 
    frm.labelCuota.style.visibility='visible'; 
  } 
  else { 
    frm.fc_cuota.style.visibility='hidden'; 
    frm.labelCuota.style.visibility='hidden'; 
  } 
} 
</script>  --}}
@endsection
@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
        /**
         * Funcion para añadir una nueva columna en la tabla
         */
         $("#add").click(function(){
            // var cantidad_ln = $('#detalles_productos tbody tr').length + 1; 
            $("#detalles_productos").append("<tr><td class='detalle' precio="+$("#precio").val()+" cantidad="+$("#cantidad").val()+"></td><td>"+$("#descripcion").val()+"</td><td>"+$("#cantidad").val()
              +"</td><td>"+$("#precio").val()+"</td><td><input type='button' value='Borrar' class='borrar_detalle btn-danger'/></td></tr>");
            calcular_valores();
            $("#descripcion").val("");
            $("#descripcion").focus();

          });
         $(document).on('click', 'input.borrar_detalle', function () {
           $(this).closest('tr').remove();             
           return false;
         });

        /**
         * Funcion para eliminar la ultima columna de la tabla.
         * Si unicamente queda una columna, esta no sera eliminada
         */
         $("#del").click(function(){
            // Obtenemos el total de columnas (tr) del id "tabla"
            var trs=$("#tabla tr").length;
            if(trs>1)
            {
                // Eliminamos la ultima columna
                $("#tabla tr:last").remove();
              }
            });
       });
  function commaSeparateNumber(val){
    val=val.replace(/,/g, "");
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    $("#precio").val(val);
  }
  function calcular_valores()
  {
    var sum = 0;
    var iva5 = 0;
    var iva10 = 0;
    $("td.detalle").each(function() {
      sum += Number($(this).attr("precio").replace(/,/g, "") * $(this).attr("cantidad").replace(/,/g, ""));

          // compare id to what you want
        });
    $("#iva10").text(Math.round(sum/11));
    $("#total_venta").text(sum);
  }
</script>

@endpush
