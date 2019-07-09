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
      <td colspan="4">{{$compra->fecha_compra}}</td>
    </tr>
    <tr>

      <td colspan="4">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Material</th>
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($compra->detalleCompra as $detalle)
            <tr class="subTabla">
              <td>{{$detalle->material->m_descripcion}}</td>
              <td>{{$detalle->cantidad_solicitada}}</td>
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