<form class="form-horizontal form-label-left">
  <div class="row form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;" for="first-name">Plano <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text"class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}" name="nombre" id="nombre" value="" placeholder="Nombre del Plano">
      @if ($errors->has('documento'))
      <span class="invalid-feedback errors" role="alert">
        <strong>{{ $errors->first('documento') }}</strong>
      </span>
      @endif
    </div>
  </div>
  <div class="row form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;" for="last-name">Descripción <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text"class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}" name="descripcion" id="descripcion" value="" placeholder="Descripción del plano">
      @if ($errors->has('documento'))
      <span class="invalid-feedback errors" role="alert">
        <strong>{{ $errors->first('documento') }}</strong>
      </span>
      @endif
    </div>
  </div>
  <div class="row form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;" for="last-name">Fecha Emisión <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="date"class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}" name="fecha" id="fecha" value="{{date('Y-m-d')}}" placeholder="Fecha de emisión" required="required" >
      @if ($errors->has('documento'))
      <span class="invalid-feedback errors" role="alert">
        <strong>{{ $errors->first('documento') }}</strong>
      </span>
      @endif
    </div>
  </div>
  <div class="row form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;" for="last-name">Cliente <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="hidden"class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}" name="cliente_id" id="cliente_id" value="{{$clientes->id}}" placeholder="Cliente" required="required" >
      <input type="text"class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}" placeholder="Cliente" value="{{$clientes->nombre}}" disabled >
      @if ($errors->has('documento'))
      <span class="invalid-feedback errors" role="alert">
        <strong>{{ $errors->first('documento') }}</strong>
      </span>
      @endif
    </div>
  </div>
  <div class="row form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;" for="last-name">Obra <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="hidden"class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}" name="obra_id" id="obra_id" value="{{$obras->id}}" placeholder="Obra" required="required">
      <input type="text"class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}" value="{{$obras->nombre_proyecto}}" placeholder="Obra" disabled >
      @if ($errors->has('documento'))
      <span class="invalid-feedback errors" role="alert">
        <strong>{{ $errors->first('documento') }}</strong>
      </span>
      @endif
    </div>
  </div>
  

  <div class="row">
    <div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
      <button type="submit" name="submitDocumento" value="1" class="btn button-primary">Guardar</button>
      {{-- <button type="submit" name="submitPlano" value="1" class="btn button-primary">Guardar</button> --}}
      <a class="btn button-primary" href="{{ route('documentos.show', $id_obra) }}">Cancelar</a>
      <button type="button" class="btn button-primary" id="volverRubro" name="button">Volver</button>
    </div>
  </div>
</form>