<table id="lista_herramientas" class="table table-responsive">
  <thead>
    <tr class="corte">
      <th>Obra</th>
      <th>Maquinaria</th>
      <th>Modelo</th>
      <th>Fecha de Adquisición</th>
    </tr>
  </thead>
  <tbody>

    @foreach($obraMaquinarias as $obraMaquinaria)
    <tr>
      <td>{{$obraMaquinaria->obra->nombre_proyecto}}</td>
      <td>{{$obraMaquinaria->maquinarias[0]->ma_nombre}}</td>
      <td>{{$obraMaquinaria->maquinarias[0]->ma_modelo}}</td>
      <td>{{$obraMaquinaria->maquinarias[0]->ma_fecha_adquisicion}}</td>
    </tr>
    @endforeach 

  </tbody>
</table>