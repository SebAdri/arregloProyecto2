<div class="row form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;" for="first-name">Contrato <span class="required">*</span></label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text"class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}" name="nombreDoc" id="nombreDoc" value="" placeholder="Nombre del Plano">
    @if ($errors->has('documento'))
    <span class="invalid-feedback errors" role="alert">
      <strong>{{ $errors->first('documento') }}</strong>
    </span>
    @endif
  </div>
</div>
<div class="row form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;" for="first-name">Ubicación <span class="required">*</span></label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text"class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}" name="descripcion_contrato" id="descripcion_contrato4" value="" placeholder="Nombre del Plano">
    @if ($errors->has('documento'))
    <span class="invalid-feedback errors" role="alert">
      <strong>{{ $errors->first('documento') }}</strong>
    </span>
    @endif
  </div>
</div>
<h2 class="StepTitle">Establezca los montos a pagar <span>Detalles sobre el Pago</span></h2>
<div class="panel-heading">
  
</div>

<div id="cuo[]"></div>


<div class="row">
  <div class="col-md-3">
    <label for="monto_total"> Monto de la Obra</label>
    @empty ($presupuestos)
      <input type="text" class="form-control numeric" id="monto" name="monto_total" value="0" disabled="disabled">
    @endempty
    @isset ($presupuestos)
      <input type="text" class="form-control numeric" id="monto" name="monto_total" value="{{number_format($presupuestos->costo_total_obra,0,',','.') }}" disabled="disabled">
    @endisset
  </div>
  <div class="col-md-3 col-md-offset-4">
    <label for="porcentajePago">Porcentaje de Pago</label>
    <input type="text" class="form-control numeric" name="porcentajePago" id="porcentajePago" value="" placeholder="Porcentaje de Pago ">
  </div>
  {{-- <div class="col-md-3">
    <label for="prod">Porcentaje de Produccion</label>
    <input type="text" class="form-control numeric" id="prod" name="prod" value="" placeholder="Porcentaje de Produccion">
  </div> --}}
  <div class="col-md-2">
    <label>Acciones</label>
    <div class="row">
      <button type="button"class="btn button-primary" id="addRow" title="Agregar"><i class="fa fa-plus" style="font-size:20px;"></i></button>
      <button type="button"class="btn button-primary" id="rmvrow" title="Eliminar"><i class="fa fa-minus" style="font-size:20px;"></i></button>
    </div>
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
      <th  style="text-align: center;">Pago(%)</th>
      {{-- <th  style="text-align: center;">Producción(%)</th> --}}
      {{-- <th  style="text-align: center;"></th> --}}
    </tr>
  </thead>

  <tbody style="text-align: center">
  </tbody>
</table>

<div class="row">
  <div class="col-md-4 col-md-offset-4" style="margin-top: 20px">
    <button type="submit" id="submitDocumento" name="submitDocumento" value="4" class="btn button-primary">Guardar</button>
    <a class="btn button-primary" href="">Cancelar</a>
    <button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
  </div>
</div>
