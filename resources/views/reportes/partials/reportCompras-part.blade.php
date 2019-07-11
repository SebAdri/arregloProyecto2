<table id="rCompras" class="table condensed ">
  <thead>
    <tr>
      <th>Id</th>
      <th>Obra</th>
      <th>Fecha de Compra</th>

      {{-- <th>Estado</th> --}}
    </tr>
  </thead>
  <tbody>

    @isset ($compras)
    @foreach ($compras as $compra)
    <tr class="corte">
      <td>{{$compra->id}}</td>
      <td>{{$compra->obra->nombre_proyecto}}</td>
      <td colspan="4">{{date_format(date_create($compra->fecha_compra), "d/m/Y")}}</td>
    </tr>
    <tr>
      <td></td>
      <td>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Material</th>
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($compra->detalleCompra as $detalle)
            <tr>
              <td style="width: 80%">{{$detalle->material->m_descripcion}}</td>
              <td style="width: 50%">{{$detalle->cantidad_solicitada}}</td>
            </tr>            
            @endforeach
            
          </tbody>
        </table>
        
      </td>
    </tr>
    @endforeach
    @endisset
  </tbody>
</table>        