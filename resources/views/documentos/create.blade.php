@extends('layout')

@section('contenido')

<form method="POST" action="{{ route('documentos.store') }}">
  {!! csrf_field() !!}
  <div class="container">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1>Contratos</h1>
        </div>

        <div class="panel-body">
          <div class="panel-heading">
            <h4>Agregue primeramente los planos a las obras en caso que no haya hecho</h4>
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
                @foreach ($tipo_documentos as $tipo_doc)       
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

          <input type="hidden"class="form-control" id="obra" name="obra_id" value={{$id_obra}}>

          <div class="col-md-2">
            <button type="submit" name="submitPlanoContrato" value="1" class="btn button-primary" style="margin-top: 24px; margin-left: 15px;">Agregar</button>
          </div>

          <div class="row"><br></div>

          <div class="row">
            <div id="contenedorContrato"> 
              @include('documentos.partials.contrato-part');
            </div>
            <div id="contenedorPlano">
              {{--  desde aca--}}
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                {{-- Primera pestaña --}}
                <li class="nav-item">
                  <a class="nav-link active" id="rubros-tab" data-toggle="tab" href="#rubros" role="tab" aria-controls="rubros" aria-selected="true">Rubros</a>
                </li>
                {{-- Segunda pestaña --}}
                <li class="nav-item">
                  <a class="nav-link" id="calculo-tab" data-toggle="tab" href="#calculo" role="tab" aria-controls="calculo" aria-selected="false">Cálculo</a>
                </li>
              </ul>

              <div class="tab-content" id="myTabContent">

                {{-- Primera pestaña detalle--}}
                <div class="tab-pane fade in active" id="rubros" role="tabpanel" aria-labelledby="rubros-tab">
                  {{-- <div class="tab-pane fade show active" id="rubros" role="tabpanel" aria-labelledby="rubros-tab"> --}}
                    <div  class="form-control">
                      <!--Check de lo splanos -->
                      {{-- <label class="form-label">Planos de la obra {{$obras->nombre_proyecto}}</label> --}}
                        {{-- <input type="checkbox" class="form-check-input" id="{{$plano->id}}"> --}}
                      {{-- <div class="form-check form-check-inline">
                        @foreach ($planos as $plano)
                        <input type="radio" name="plano_seleccionado" value="{{$plano->id}}"> 
                        <label class="form-check-label" for="{{$plano->id}}">{{$plano->nombre}}</label>
                        @endforeach
                      </div> --}}
                      
                      {{-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name"> --}}
                      @include('calculoCosto.partials.rubro-part2')
                    </div>
                  </div>
                  {{-- Segunda pestaña detalle--}}
                  <div class="tab-pane fade" id="calculo" role="tabpanel" aria-labelledby="calculo-tab">
                    @if ($obras == null)
                    <h2>No ha seleccionado y guardado ningun rubro para este proyecto. Favor elija algunos rubros para empezar el calculo</h2>
                    @else
                    <div class="panel-body">
                      {{-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name"> --}}
                      @include('calculoCosto.partials.calcul-part')
                    </div>
                    @endif
                  </div>
                </div>

              {{-- hasta aca --}}
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