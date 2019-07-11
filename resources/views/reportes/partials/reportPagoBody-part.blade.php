<table id="tPagos" class="table table-responsive">
	<thead>
		<tr class="corte">
			<th style="text-align: center;">Nro.</th>
			<th style="text-align: center;">Saldo</th>
			<th style="text-align: center;">Monto pago</th>
			<th style="text-align: center;">Fecha pago</th>
			<th style="text-align: center;">Estado</th>

			{{-- <th  style="text-align: center;"></th> --}}
		</tr>
	</thead>

	<tbody id="tPagosBody" style="text-align: center">
		@isset ($pagos)
		@foreach ($pagos as $pago)
		<tr>
			<td>{{$pago->nro_pago}}</td>
			<td>{{$pago->saldo}}</td>
			<td>{{number_format($pago->monto_pago, 0, '','.')}}</td>
			<td>{{date_format(date_create($pago->fecha_pago), 'd/m/Y')}}</td>
			@if ($pago->estado==0)
			<td>Pendiente</td>
			@else
			<td>Pagado</td>
			@endif
		</tr>
		@endforeach

		@endisset
	</tbody>
</table>
