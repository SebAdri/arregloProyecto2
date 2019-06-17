<div class="panel-heading">
  <h4>Detalles sobre el Pago</h4>
</div>
<div class="row">
  <div class="col-md-3">
    <label for="monto_total"> Monto de la Obra</label>
    <input type="text" class="form-control numeric" id="monto" name="monto_total" value="1000000" disabled="disabled">
  </div>
  <div class="col-md-3">
    <label for="porcentajePago">Porcentaje de Pago</label>
    <input type="text" class="form-control numeric" name="porcentajePago" id="porcentajePago" value="" placeholder="Porcentaje de Pago ">
  </div>
  <div class="col-md-3">
    <label for="prod">Porcentaje de Produccion</label>
    <input type="text" class="form-control numeric" id="prod" name="prod" value="" placeholder="Porcentaje de Produccion">
  </div>
  <div class="col-md-3">
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
      <th  style="text-align: center;">Producción(%)</th>
      {{-- <th  style="text-align: center;"></th> --}}
    </tr>
  </thead>

  <tbody style="text-align: center">
  </tbody>
</table>

<div class="row">
  <div class="col-md-4 col-md-offset-4" style="margin-top: 20px">
    <button type="submit" name="submitDocumento" value="4" class="btn button-primary">Guardar</button>
    <a class="btn button-primary" href="">Cancelar</a>
    <button type="button" class="btn button-primary" id="volver" name="button">Volver</button>
  </div>
</div>
