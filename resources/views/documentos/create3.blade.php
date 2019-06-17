@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('documentos.store') }}">
  {!! csrf_field() !!}
<!-- Smart Wizard -->
<div class="x_title">
  <h1>Documentación de la obra <small>F&C</small></h1>
  <div class="clearfix"></div>
</div>
<p>Siga los pasos para poder crear planos, elegir rubros, calcular costos y definir el contrato.</p>
<div id="wizard" class="form_wizard wizard_horizontal">
  <ul class="wizard_steps">
    <li>
      <a href="#step-1">
        <span class="step_no">1</span>
        <span class="step_descr">
                          Paso 1<br />
                          <small>Paso 1 - Agregar planos a la obra</small>
                      </span>
      </a>
    </li>
    <li>
      <a href="#step-2">
        <span class="step_no">2</span>
        <span class="step_descr">
                          Paso 2<br />
                          <small>Paso 2 - Elegir rubros para el plano</small>
                      </span>
      </a>
    </li>
    <li>
      <a href="#step-3">
        <span class="step_no">3</span>
        <span class="step_descr">
                          Paso 3<br />
                          <small>Paso 3 - Calcular Costos</small>
                      </span>
      </a>
    </li>
    <li>
      <a href="#step-4">
        <span class="step_no">4</span>
        <span class="step_descr">
                          Paso 4<br />
                          <small>Paso 4 - Cargar Contrato</small>
                      </span>
      </a>
    </li>
  </ul>
  <div id="step-1">
    <h2 class="StepTitle">Cargue los planos necesarios para la obra</h2>
    <br>
    @include('documentos.partials.plano-part')
  </div>
  <div id="step-2">
    <br>
    <div class="form-group">
      <h2 class="StepTitle">Seleccione un plano y luego checkea los rubros para dicho plano</h2>
      @include('calculoCosto.partials.rubro-part2')
    </div>
  </div>
  <div id="step-3">
    <h2 class="StepTitle">Ingrese el áreaa producir</h2>
    @include('calculoCosto.partials.calcul-part')
  </div>
  <div id="step-4">
    <h2 class="StepTitle">Establezca los montos a pagar</h2>
    @include('documentos.partials.contrato-part')
  </div>

</div>
<!-- End SmartWizard Content -->
</form>
@stop

@push('scripts')
{{-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></script> --}}
<script src="{{asset('fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('jQuery-Smart-Wizard/js/jquery.smartWizard.js')}}"></script>
<script>
  $(document).ready(function() {
    var t = $('#detalle').DataTable();
    var counter = 1;
    var montoTotal = Number($('#monto').val());
    var saldo = montoTotal;
    $('#contenedorContrato').hide();
    // $('#contenedorPlano').hide();
    $('#addRow').on('click', function () {
      var porcentajePago = Number($('#porcentajePago').val());
      var porcentaje = 100;
      var produccion = Number($('#prod').val());
      saldo = saldo - montoTotal*(porcentajePago/100);

      if (montoTotal !='' && porcentajePago != '' ) {
          // saldo = saldo - montoTotal*(prod/100);
          t.row.add( [
            counter,
            saldo, 
            montoTotal*(porcentajePago/100),
            porcentajePago, produccion
            ] ).draw( false );
          // $('#monto').val(monto - monto*(prod/100));
          counter++;
        }
      } );
    $('#tipo_documento_id').on('change', function(){
      var tipo = $(this).val();
      if (tipo == 1) {
        $('#contenedorContrato').show();
        $('#contenedorPlano').hide();

      }else if (tipo==2) {
        $('#contenedorPlano').show();
        $('#contenedorContrato').hide();
      }
    });

    // $('#tipo_documento_id').trigger("change");

    $('#btnGuardar').on('click', function(event){
      event.preventDefault();
      var nombreDoc = $('#nombreDoc').val();
      var fecha_emision = $('#fecha_emision').val();
      var tipo_documento = $('#tipo_documento_id').val();
      var obra = $('#obra').val();
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
          obra: obra,
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

    //parte de rubros y calculo
    calcular_total();
    $('.produccion').keyup(function(){
      let cantidad = parseInt($(this).val());
      let precio = parseInt($(this).parent().parent().find('.costo_rubro').first().val());
      let costo = $(this).parent().parent().find('.costo_produccion').first();
      let all_costo = $(this).parent().parent().find('.costo_produccion');
      costo.text(precio * cantidad);

      calcular_total();

    });

    function calcular_total()
    {
      var sum = 0;
      $(".costo_produccion").each(function() {
        sum += Number($(this).text());
          // sum += Number($(this).attr("precio").replace(/,/g, "") * $(this).attr("cantidad").replace(/,/g, ""));

          // compare id to what you want
      });
      $(".costo_sub_total_obra").text(sum);
      console.log('a ver' + sum);
    }

    $('#beneficio').keyup(function(){
      let beneficio = parseInt($(this).val());
      let iva = parseInt($("#iva").val());
      let subtotal = parseInt($(".costo_sub_total_obra").text());
    // console.log(all_costo);
    // alert($("#iva").val());
    $("#costo_total_obra").val((parseInt($(".costo_sub_total_obra").text()) * (1+parseFloat($("#iva").val())))+parseInt($(this).val()));
    $("#costo_total_obra").text((parseInt($(".costo_sub_total_obra").text()) * (1+parseFloat($("#iva").val())))+parseInt($(this).val()));
  });

  //Aqui empieza la parte de grilla detalle de los rubros

  var dt = $('#tablaRubros').DataTable({
    language: {
      "search": "Buscar:",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
      "lengthMenu":     "Mostrar _MENU_ registros",
      "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
      }
    },
    "processing": true,
        // "serverSide": true,
        "ajax": "{{route('jsonRubrosMateriales')}}",
        "columns": [
        {
          "class":          "details-control",
          "orderable":      false,
          "data":           null,
          "defaultContent": "",
          width: "5%"
        },
        {
          targets: 0,
          data: null,
          className: 'text-center',
          searchable: false,
          orderable: false,
          render: function (data, type, full, meta) {
        // return '<label> <input type="checkbox" name="checkRubroesAsignado['+data.id+']" value="' + data.id + '"/> <span> </span> </label>';
        return '<input type="checkbox" name="checkRubroesAsignado['+data.id+']" value="' + data.id + '">';
      },
      width: "5%"
    },
    { "data": "id" },
    { "data": "nombre" },
    { "data": "mano_obra" },
    { "data": "unidad_medida" }
    ],
    "order": [[1, 'asc']]

  } );


    // Array to track the ids of the details displayed rows
    var detailRows = [];

    $('#tablaRubros tbody').on( 'click', 'tr td.details-control', function () {
      var tr = $(this).closest('tr');
      var row = dt.row( tr );
      var idx = $.inArray( tr.attr('id'), detailRows );

      if ( row.child.isShown() ) {
        tr.removeClass( 'details' );
        row.child.hide();

            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
        }
        else {
          tr.addClass( 'details' );
          row.child( format( row.data() ) ).show();

            // Add to the 'open' array
            if ( idx === -1 ) {
              detailRows.push( tr.attr('id') );
            }
        }
    } );

    // On each draw, loop over the `detailRows` array and show any child rows
    dt.on( 'draw', function () {
        $.each( detailRows, function ( i, id ) {
          $('#'+id+' td.details-control').trigger( 'click' );
        } );
      } );

  function format ( d ) {
    var i = 0;
    var cuerpo = '';
      // console.log(d.length);
      for (i = 0; i < d.material.length; i++){
        console.log(d.material[i]);
        cuerpo = '<tr><td>'+d.material[i].m_descripcion+'</td>'+
        '<td>'+d.material[i].m_costo+'</td>'+
        '<td>'+d.material[i].pivot.cantidad_material+'</td>'
        +'<td>'+d.material[i].m_costo * d.material[i].pivot.cantidad_material+'</td></tr>'+ cuerpo;
      }
      var cabeceraYpie = '<table class="table table-striped table-bordered table-hover table-condensed" id="tablaRubrosHijo" name="tablaRubrosHijo" >'+
      '<thead>'+
      '<tr>'+
      '<th>Material</th>'+
      '<th>Costo Material</th>'+
      '<th>Cantidad Requerida</th>'+
      '<th>Total</th>'+
      '</tr>'+
      '</thead>'+
      '<tbody>'+
      cuerpo
      '</tbody>'+
      '</table>  '+
      '</div>';

      return cabeceraYpie;
  };
  } );
</script>
@endpush