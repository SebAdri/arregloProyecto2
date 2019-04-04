@extends('layout')

@section('contenido')

<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1>Almacen General</h1>
      </div>
      <div class="container">
        <h2>Recordatorio</h2>
        <p><strong>Nota:</strong> Las <strong>herramientas, maquinarias y materiales asignadas</strong> podran ser vistas desde cada una de las obras.</p>
        <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Herramientas</a>
              </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse in">
              <div>
                <button type="button" class="btn button-primary" data-toggle="modal" data-target="#myModal">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Asignar Herramientas
                </button>
              </div>
              <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Detalle</th>
                    <th>Serie</th>
                    <th>Fecha Adquisición</th>
                    <th>Obra asignada</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($herramientas as $herramienta)
                  <tr>
                    <td>{{ $herramienta->h_nombre }}</td>
                    <td>{{ $herramienta->h_marca .' '. $herramienta->h_modelo }}</td>
                    <td>{{ $herramienta->h_nro_serie }}</td>
                    <td>{{ $herramienta->h_fecha_adquisicion }}</td>
                    <td>
                      @foreach($herramienta->obras as $obrasHerramienta)
                      {{$obrasHerramienta->nombre_proyecto}}
                      @endforeach
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Maquinarias</a>
              </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse ">
              <div>
                <button type="button" class="btn button-primary" data-toggle="modal" data-target="#myModalMaquinaria">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Asignar Maquinaria
                </button>
              </div>
              <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Detalle</th>
                    <th>Fecha asignación</th>
                    <th>Obra asignada</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($maquinarias as $maquinaria)
                  <tr>
                    <td>{{ $maquinaria->ma_nombre }}</td>
                    <td>{{ $maquinaria->ma_marca .' '. $maquinaria->ma_modelo }}</td>
                    <td>{{ $maquinaria->ma_fecha_adquisicion }}</td>
                    <td>
                      @foreach($maquinaria->obras as $obrasMaquinaria)
                      {{$obrasMaquinaria->nombre_proyecto}}
                      @endforeach
                    </td>

                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Materiales</a>
              </h4>
            </div>
            <div id="collapse3" class="panel-collapse collapse">
              <div>
                <button type="button" class="btn button-primary" data-toggle="modal" data-target="#myModalMaterial">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Asignar Material
                </button>
              </div>
              <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Unidad</th>
                    <th>Costo</th>
                    {{-- <th>Cantidad total</th> --}}
                    <th>Cantidad dispobible</th>
                    <th>Obra asignada</th>
                  </tr>
                </thead>

                <tbody>

                  @foreach($materiales as $material)
                  <tr>
                    <td>{{ $material->m_descripcion }}</td>
                    <td>{{ $material->m_unidad_medida }}</td>
                    <td>{{ $material->m_costo }}</td>
                    {{dd($material->obras)}}
                    {{-- <td>
                      @foreach($material->obras as $obrasMaterial)
                      {{$obrasMaterial->pivot->cantidad_inicial}}
                      @endforeach
                    </td> --}}
                    <td>
                      @foreach($material->obras as $obrasMaterial)
                      {{$obrasMaterial->pivot->cantidad_disponible}}
                      @endforeach
                    </td>
                    <td>
                      @foreach($material->obras as $obrasMaterial)
                      {{$obrasMaterial->nombre_proyecto}}
                      @endforeach
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div> 
      </div>
      <div class="row">
        <br>
      </div>
      <br>
    </div>
  </div>




</div>
</div>


<!-- Modal Herramienta-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Elija las herramientas para asignar a una obra</h4>
      </div>
      {{-- <div class="modal-body">
        <p>Some text in the modal.</p>
      </div> --}}
      <form method="POST" id="form-obra-maquinaria" action="{{ route('almacenGeneral.store') }}">
        {!! csrf_field() !!}
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <select class="form-control" id="obra_id" name="obra_id">
              @foreach ($obras as $obra) {
              <option value={{$obra->id}}>{{$obra->nombre_proyecto}}</option> 
              @endforeach
            </select>
          </div>
        </div>
        <table class="table table-responsive">
          <thead>
            <tr>
              <th>Elegir</th>
              <th>Nombre</th>
              <th>Modelo</th>
              <th>Marca</th>
              <th>Ubicación Actual</th>
              {{-- <th>Cantidad</th> --}}
              {{-- <th>Obra asignada</th> --}}
              {{-- <th>Asignar/desvincular a</th> --}}
            </tr>
          </thead>

          <tbody>
            @foreach($herramientas as $key => $herramienta)
            <tr>
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="{{$herramienta->id}}" id="checkHerramientasAsignado_{{ $herramienta->id }}" name="checkHerramientasAsignado[{{ $herramienta->id }}]">
                </div>
              </td>
              <td>{{ $herramienta->h_nombre }}</td>
              <td>{{ $herramienta->h_modelo }}</td>
              <td>{{ $herramienta->h_marca }}</td>
              {{-- <td>{{ $herramienta->obras}}</td> --}}
              <td>
                @foreach($herramienta->obras as $obrasHerramienta)
                {{$obrasHerramienta->nombre_proyecto}}
                @endforeach
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="modal-footer">
          <button style="display: inline" type="submit" class="btn btn-default" id="confirmar" aria-label="Left Align">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
          Confirmar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal MAquinaria-->
{{-- <div id="myModalMaquinaria" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Elija las maquinarias para asignar a una obra</h4>
      </div>
      <form method="POST" action="{{ route('maquinariasObras', $obra->id) }}">
        {!! csrf_field() !!}
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <select class="form-control" id="obra_id" name="obra_id">
              @foreach ($obras as $obra) {
              <option value={{$obra->id}}>{{$obra->nombre_proyecto}}</option> 
              @endforeach
            </select>
          </div>
        </div>
        <table class="table table-responsive">
          <thead>
            <tr>
              <th>Elegir</th>
              <th>Nombre</th>
              <th>Detalle</th>
              <th>Dsitancia</th>
              <th>Ubicación Actual</th>
            </tr>
          </thead>

          <tbody>
            @foreach($maquinarias as $key => $maquinaria)
            <tr>
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="{{$maquinaria->id}}" id="checkMaquinariasAsignado_{{ $maquinaria->id }}" name="checkMaquinariasAsignado[{{ $maquinaria->id }}]">
                </div>
              </td>
              <td>{{ $maquinaria->ma_nombre }}</td>
              <td>{{ $maquinaria->ma_modelo .' '. $maquinaria->ma_marca}}</td>
              <td>{{ $maquinaria->ma_distancia }}</td>
              <td>
                @foreach($maquinaria->obras as $obrasmaquinaria)
                {{$obrasmaquinaria->nombre_proyecto}}
                @endforeach
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="modal-footer">
          <button style="display: inline" type="submit" class="btn btn-default" id="confirmar" aria-label="Left Align">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
          Confirmar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div> --}}



<!-- Modal Material-->
{{-- @foreach($obras as $obra) --}}
<div id="myModalMaterial" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Elija los materiales para asignar a una obra</h4>
      </div>
      <form method="POST" id="form-obra-material" action="{{ route('materialesObras', $obra->id) }}">
        {!! csrf_field() !!}
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <select class="form-control" id="materialObra_id" name="materialObra_id">
              @foreach ($obras as $obra)  
              <option value={{$obra->id}}>{{$obra->nombre_proyecto}}</option> 
              @endforeach
            </select>
          </div>
        </div>
        <table class="table table-responsive">
          <thead>
            <tr>
              <th>Elegir</th>
              <th>Nombre</th>
              <th>Unidad</th>
              <th>Costo</th>
              <th>Cantidad dispobible</th>
              <th>Cantidad Solicitada</th>
            </tr>
          </thead>

          <tbody>
            @foreach($materiales as $material)
            <tr>
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="{{$material->id}}" id="checkMaterialesAsignado_{{ $material->id }}" name="checkMaterialesAsignado[{{ $material->id }}]">
                </div>
              </td>
              <td>{{ $material->m_descripcion }}</td>
              <td>{{ $material->m_unidad_medida }}</td>
              <td>{{ $material->m_costo }}</td>
              <td>
                @foreach($material->obras as $obrasMaterial)
                {{$obrasMaterial->pivot->cantidad_disponible}}
                @endforeach
              </td>
              <td>
                <input type="text" name="cantidad_solicitada" id="cantidad_solicitada" value="9">
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>


        <td>
          @foreach($material->obras as $obrasMaterial)
           {{$obrasMaterial->nombre_proyecto}}
          @endforeach
        </td>
        <div class="modal-footer">
          <button style="display: inline" type="submit" class="btn btn-default" id="confirmar" aria-label="Left Align">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
          Confirmar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- @endforeach --}}
@stop

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

  function changeFormAction() {
    var action = "{{ route('almacenGeneral.store', ['id' => 'id_obra']) }}";
    let obra_id = $('#obra_id').val();
    console.log(action.replace('id_obra', obra_id));
    $("#form-obra-maquinaria").prop('action', action.replace('id_obra', obra_id));
    console.log(action.replace('id_obra', obra_id));
  }
  

  // changeFormAction();
  $('#obra_id').change(function () {
    changeFormAction();
  });

  function changeFormActionMaterial() {
    var action = "{{ route('materialesObras', ['id' => 'materialObra_id']) }}";
    let materialObra_id = $('#materialObra_id').val();
    console.log(action.replace('materialObra_id', materialObra_id));
    $("#form-obra-material").prop('action', action.replace('materialObra_id', materialObra_id));
    console.log(action.replace('materialObra_id', materialObra_id));
  }
  
  // changeFormActionMaterial();
  $('#materialObra_id').change(function () {
    changeFormActionMaterial();
  });

</script>
@endpush