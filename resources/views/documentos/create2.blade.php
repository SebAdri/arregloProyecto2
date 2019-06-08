@extends('layout')

@section('contenido')

<form method="POST" action="{{ route('calculoCosto.store') }}">
  {!! csrf_field() !!}
  <div class="container">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1>Documentos</h1>
        </div>

        <div class="panel-body">
          <ul class="nav nav-tabs" id="tab_proyecto">
            <!--top level tabs-->
            <li><a href="#tabPlano" data-toggle="tab">Planos</a></li>
            <li><a href="#tabContrato" data-toggle="tab">Contrato</a></li>
          </ul>

          <!--top level tab content-->
          <div class="tab-content">
            <!--all tab menu-->
            <div id="tabPlano" class="tab-pane fade in active">
              <ul class="nav nav-tabs" id="all_tabs">
                <li><a href="#tabRubro" data-toggle="tab">Rubros</a></li>
                <li><a href="#tabCalculo" data-toggle="tab">Cálculos</a></li>
              </ul>

              <div class="tab-content">
                <!--all subtab menu-->
                <!--subtab rubros-->
                <div id="tabRubro" class="tab-pane fade in active">
                  <br>
                  <div class = "form-label">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <button type="button" class="btn button-primary" title="Agregar Nuevo" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" style="font-size:10px; margin-top: 10%; margin-bottom: 10%"></i></button>
                      <label>Desea agregar planos a la obra?</label>
                      </div>
                    </div>
                  </div>
                  {{-- <p>Mostrando rubros</p> --}}
                  {{-- <iframe class="embed-responsive-item" id="iframCalculo" src="http://arregloproyecto2.test/calculoCosto/create"></iframe> --}}
                  <br>
                  <label class="form-label">Planos de la obra {{$obras->nombre_proyecto}}</label>
                  <div class="form-check form-check-inline">
                    @foreach ($planos as $plano)
                    {{-- <input type="checkbox" class="form-check-input" id="{{$plano->id}}"> --}}
                    <input type="radio" name="plano{{$plano->id}}" value="{{$plano->id}}"> 
                    <label class="form-check-label" for="plano{{$plano->id}}">{{$plano->nombre}}</label>
                    @endforeach
                  </div>
                  <br>
                  @include('calculoCosto.partials.rubro-part2')
                </div>

                <!--sub-tab calculo-->
                <div id="tabCalculo" class="tab-pane">
                  {{-- <p>Mostrando calculos</p> --}}
                  @include('calculoCosto.partials.calcul-part')
                </div>         
              </div>
            </div>

            <!--brands tab menu-->
            <div id="tabContrato" class="tab-pane">
              <p>mostrar contrato</p>
            </div>         
            
          </div>

        </div>
      </div>
    </div>
  </div>
</form>
</div>



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="panel panel-default">
          <form method="POST" action="{{ route('documentos.store') }}">
            {!! csrf_field() !!}

            <div class="panel-heading">
              <h1>Nuevo Plano</h1>
            </div>

            <div class="panel-body">
              <div class="row">
                <div class="col-md-5 col-md-offset-4">
                  <label for="nombre">Nombre del Plano</label>
                  <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="" placeholder="Nombre del Plano" required>
                  @if ($errors->has('nombre'))
                  <span class="invalid-feedback errors" role="alert">
                    <strong>{{ $errors->first('nombre') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="col-md-5 col-md-offset-4">
                  <label for="cliente_id" style="margin-top: 10px">Cliente</label>
                  <div class="form-group">
                    <select class="form-control" id="cliente_id" name="cliente_id">
                            <option value={{$obras->cliente_id}}>{{$obras->cliente->nombre}}</option> 
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-5 col-md-offset-4">
                  <label for="fecha" style="margin-top: 10px">Fecha</label>
                  <input type="date" class="form-control {{ $errors->has('fecha_inicio') ? ' is-invalid' : '' }}" name="fecha" value="" required>
                  @if ($errors->has('fecha'))
                  <span class="invalid-feedback errors" role="alert">
                    <strong>{{ $errors->first('fecha') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="row">
                <div class="col-md-5 col-md-offset-4">
                  <input class="btn button-primary" value="Guardar" type="submit" style="margin-top: 20px">
                  <button type="button" class="btn button-primary" data-dismiss="modal"  name="button" style="margin-top: 20px">Cancelar</button>
                </div>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>






@push('scripts')
<script type="text/javascript">
  $("#volver").click(function(){
    $.ajax({
      url: "{{url()->current()}}",
      success: function(){
        window.location.replace("{{url()->previous()}}");
      }
    })
  });
  $(document).ready(function() {

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
    { "data": "mano_obra",
      render: $.fn.dataTable.render.number( '.', ',', 0, 'Gs ' )
    },
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
  
</script>
@endpush
@endsection