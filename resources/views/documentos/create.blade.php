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
                <input type="text"class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}" name="nombre" value="" placeholder="Nombre del documento" required>
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
      

        <table id="detalle" class="table table-responsive">
          <thead>
            <tr>
              <th  style="text-align: center;">Monto Total</th>
              <th  style="text-align: center;">Producción(%)</th>
              <th  style="text-align: center;"></th>
            </tr>
          </thead>

          <tbody style="text-align: center">
            <tr>
              <td>
                <input type="text" class="form-control numeric" name="monto_total" value="1.000.000" disabled="disabled">
              </td>
              <td>
                <input type="text" class="form-control numeric" name="prod" value="">
              </td>
              <td>
                <button type="button"class="btn button-primary" id="" title="Agregar"><i class="fa fa-plus" style="font-size:20px;"></i></button>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="row">
            <div class="col-md-4 col-md-offset-4" style="margin-top: 20px">
              <button type="submit" class="btn button-primary">Guardar</button>
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
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></script>
<script>
  $(document).ready(function() {
    var t = $('#detalle').DataTable();
    var counter = 1;
 
    $('#addRow').on( 'click', function () {
        t.row.add( [
            counter +'.1',
            counter +'.2',
            counter +'.3'
        ] ).draw( false );
 
        counter++;
    } );
 
    // Automatically add a first row of data
    $('#addRow').click();
} );
</script>
@endpush