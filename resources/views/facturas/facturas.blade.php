<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
	<style type="text/css">
		* {
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			 margin: 0;
			 padding: 0;
		}

	.container{
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			/*width: 595.28px;*/
			width: 90%;
			margin:0 auto;
    		z-index:1;
	}
	
	table{
		width: 100%;

	}
	
	.b-buttom {
	border-bottom: 1px solid; 
	}
	.b-top {
	border-top:1px solid;
	}
	
	.b-col {
		border-collapse: collapse;
	}

	.n-1{
		font-weight: 700;
	}

	.text{
		  overflow: hidden;
		  /*text-overflow: ellipsis;*/
		  white-space: nowrap;
		  display:block;
		  width:100%;
		  min-width:1px;
		}

	.f-10 {
		font-size: 10px !important;
	}

	.f-9 {
		font-size: 9px !important;
	}

	.f-11 {
		font-size: 11px !important;
	}

	.f-12 {
		font-size: 12px !important;
	}
	.c-text {
		text-align: center;
	}

	.cabecera {

	}

	.espacio-10 {
		margin-top: 20px;
	}


	#background{
	/*margin-top:100px;*/
    position:absolute;
    z-index:0;
    background:white;
    display:block;
    min-height:50%; 
    min-width:50%;
    color:yellow;
	}

	#bg-text
{
    color:lightgrey;
    font-size:120px;
    transform:rotate(300deg);
    -webkit-transform:rotate(300deg);
}

	.hidden {
		display: none;
	}



	</style>
	<title></title>
</head>
<body>
 <div id="background">
	<p id="bg-text" style="margin-top: 300px;">Filartiga-Cárdenas</p>
</div>  
<div class="container espacio-10">
	<table>
		<tr>
			<td style="width: 25%;" class="c-text">
				<img src="{{asset('images/big_logo alciC.jpg')}}" width="150">
			</td>
			<td style="width: 35%; padding: 10px;" class="c-text f-9">
				<span class="f-10">Constructora Filártiga - Cárdenas & Asoc.</span><br>
				<span class="f-10">Proyectos de Arquitectura e Ingeniería</span><br>
				<span class="f-10">Redacción de Proyectos</span><br>
				<span class="f-10">Servicios de Arquitectura</span><br>
				<span class="f-10">Supervisión, Dirección y Control de Obras</span><br>
				E-mail: constructorafca@gmail.com	<br>
			</td>
			<td style="width: 40%;">
				<div style="padding: 10px;">
					<div style="border:1px solid; text-align: center; padding: 10px;">
						<span class="n-1">Timbrado Nro:<span id="numTimbrado">timbrado</span></span><br>
						<span class="f-10">Fecha Inicio Vigencia: vigencia</span><br>
						<span class="f-10">Fecha Fin Vigencia:vigencia ?></span><br>
						R.U.C 607069-8<br>
						FACTURA Nro.: {{$factura->id}}<br>
						<span class="f-10"><b> clase factura </b></span>
					</div>

				</div>
			</td>
		</tr>

	</table>
	<table style="margin-top: 10px;"  class="b-buttom b-top">
		<tr>
			<td class="f-10" style="padding: 0 0 0 20px;">
				<b>Direccion:</b> Manuel Pisciotta Nº 1780 c/ Mayor Vargas, Asunción - Paraguay. Telefono/Fax: 021- 298719<br>
			</td>
		</tr>
	</table>
{{-- 	<table class="f-11" style="margin-top: 20px;">
		<tr>
			<td>
				Vendedor DTP: nombre_vendedor
			</td>

			<td>
				Vendedor Agencia: otro_vendedor
			</td>
		</tr>
	</table>
 --}}

	<table class="f-11"  style="border:1px solid">

		<colgroup>
			<col style="width: 10%"/>
			<col style="width: 10%"/>
			<col style="width: 10%"/>
			<col style="width: 10%"/>
			<col style="width: 10%"/>
			<col style="width: 10%"/>
			<col style="width: 10%"/>	
		</colgroup>
		<tr>
			<td colspan="3">
				<b>Fecha de Emision: {{$factura->fecha_emision}}</b>
			</td>

			<td colspan="3">
				<b>Vencimiento:</b>
			</td>

			<td colspan="3">
				<b>Tipo Factura:</b>
			</td>
		</tr>


		<tr>
			<td colspan="6">
				<b>Nombre / Razon Social: {{$cliente->nombre}}</b>
			</td>

			<td colspan="3">
				<b>RUC: @if ($cliente->ruc != '')
                {{$cliente->ruc}} @else {{$cliente->cedula}}
              @endif</b>
			</td>

		</tr>


		<tr>
			<td colspan="7">
				<b>Dirección: {{$cliente->direccion}}</b>
			</td>

			<td colspan="3">
				<b>Telefono: {{$cliente->telefono}}</b>
			</td>

		</tr>

	</table>


	<table style="margin-top: 10px;">

		<colgroup>
			<col style="width: 50%"/>
			<col style="width: 50%"/>
	
		</colgroup>
		<tr>
			<td>
				Detalles
			</td>
			<td>
				Valor de Ventas
			</td>
		</tr>
	</table>

	<table class="c-text b-col" border="1">

	<colgroup>
			<col/>
			<col/>
			<col/>
			<col/>
			<col/>	
			<col/>	
		</colgroup>

		<tr>
			<td width="5%">
				Cod
			</td>

			<td width="5%">
				Cant
			</td>
			<td width="40%">
				Descripción Producto
			</td>

			<td width="10%">
				Exentas
			</td>

			<td width="10%">
				Iva 5%
			</td>

			<td width="10%">
				Iva 10%
			</td>
		</tr>

		</table>
			
		<table class=""  FRAME="vsides" RULES="cols" style="border-bottom: 1px solid; ">

		<colgroup>
			<col/>
			<col/>
			<col/>
			<col/>
			<col/>
			<col/>
		</colgroup>

		

		{{-- ===================================
			AGREGAR SERVICIOS Y ESPACIOS
		=================================== --}}
		
	{{-- 	@foreach($facturaDetalle as $detalles)

		@php
		//Si es de tipo Ticket agregar codigo confirmacion
		$descripcion = $detalles->descripcion;
		$desc = $descripcion;
			if($detalles->producto->id == 9  || 
			   $detalles->producto->id == 31 ||
			   $detalles->producto->id == 29 ||
			   $detalles->producto->id == 32 ||
			   $detalles->producto->id == 31 ||
			   $detalles->producto->id == 1){

			
			
			   $descripcion .= ' ('. $detalles->cod_confirmacion.' )';
			   $longitud = strlen($descripcion);
			  $desc = wordwrap($descripcion,50,'<br />',true);

		
			}


		@endphp --}}
		
		{{-- VALIDAR SI EL PRODUCTO SE PUEDE IMPRIMIR EN FACTURA --}}
		{{-- @if($contadorDetalles <= 15 && $detalles->producto['imprimir_en_factura'] == 1) --}}
		@foreach ($detalles as $detalle)
			<tr valign="top" class="f-11" nowrap>
				<td class="c-text" width="5%"> 
					{{$detalle->item}}
				</td>

				<td class="c-text" width="5%">
					{{$detalle->cantidad}}
				</td>

				<td width="40%" >
					{{$detalle->concepto}}

				</td>

				<td class="c-text" width="10%">
					{{$detalle->exentas}}
				</td>

				<td class="c-text" width="10%">
					{{$detalle->iva_5}}
				</td>

				<td class="c-text" width="10%">
					{{$detalle->iva_10}}
				
				</td>

			</tr>
			{{-- expr --}}
		@endforeach




			{{-- @endif --}}



			

		{{-- @endforeach --}}
		

		{{-- AGREGAR ESPACIOS EN BLANCO PARA COMPLETAR 15 LINEAS EN TOTAL --}}
		<?php 
	

		for ($i=0; $i < 20 ; $i++):?>

			<tr valign="top" class="f-11">
		

			<td class="c-text" width="5%">
				&nbsp;
			</td>

			<td class="c-text" width="5%">
				
			</td>

			<td width="40%">
				
			</td>

			<td class="c-text" width="10%">
				
			</td>

			<td class="c-text" width="10%">
				
			</td>

			<td class="c-text" width="10%">
				
			</td>


		</tr>
			
		
	<?php endfor;?>
		
		
		<tr valign="top" class="f-12">
			<td class="c-text" colspan="6"></td>
			
		</tr>
	
		<tr valign="top" class="f-11">
		

			<td class="c-text" width="5%">
				&nbsp;
			</td>

			<td class="c-text" width="5%">
				
			</td>

			<td width="40%">
				
			</td>

			<td class="c-text" width="10%">
				
			</td>

			<td class="c-text" width="10%">
			</td>

			<td class="c-text" width="10%">

			</td>


		</tr>
		


		

	</table>


	<table style="border-bottom: 1px solid; margin-top: 10px;">

		<colgroup>
			<col/>
			<col/>
			<col/>
			<col/>
			<col/>
			<col/>
		</colgroup>


		<tr>

			<td style="width: 20%;" class="f-11" width="10%">
				<b>SUB-TOTALES:</b>
			</td>

			<td class="f-9" width="40%">
					********** Esta Factura será cancelada en  **********
			</td>
				
			<td  style="width: 10%;" class="c-text f-10" width="13%">
				
			</td>

			<td  style="width: 10%;" class="c-text f-10" width="13%">
				
			</td>

			<td  style="width: 10%;" class="c-text f-10" width="13%">
				
			</td>

		</tr>

	
	</table>

	<table  style="border-bottom: 1px solid;">
			<tr>

			<td class="f-12">
				<b>TOTAL DE FACTURA: {{$factura->monto_factura}}</b> &nbsp;&nbsp;&nbsp;&nbsp;
			</td>

			
		</tr>
	</table>

	<table  style="border-bottom: 1px solid;">
		<tr>
			<td class="f-11">
				son  
			</td>
		</tr>
	</table>

	<table   style="border-bottom: 1px solid;">
		<tr>
			<td class="f-12" >
				<b>LIQUIDACÍÓN IVA 10%: {{$factura->total_iva_10}}</b> <span> </span>
			</td>	
			
			<td class="f-12">
				<b>LIQUIDACÍÓN IVA 5%:</b> <span> 0,00</span>
			</td>
			
			
			<td class="f-12">
				<b>TOTAL IVA: {{$factura->total_iva_10}}</b> <span></span>
			</td>
			
		</tr>
		
	</table>

	<table>

		<tr>
			<!--SI ES FCTURA BRUTA -->
			{{-- @if($factura[0]->id_tipo_facturacion == 1)
			<td class="f-11">
				COM .AG : 
			</td>
			@endif --}}
		</tr>
		
	</table>


<table style="border:1px solid; margin-top: 20px;">
	<tr>
		<td class="f-9" style="padding: 5px;">
* Cantidad que en la fecha de vencimiento arriba señalada pagaré(mos) a Desarrollo Tutistico Paraguayo S.R.L en la ciudad de Asunción; en su domicilio en en Gral Bruguez 353 c/ 25 de Mayo por igual valor recibido de
conformidad en mercaderiasy/o servicios detallados mas arriba. Caso contrario se procederá por la via ejecutiva al reclamo de su pago.<br>
* La falta de pago de esta factura a su vencimiento establecera la mora en forma automatica, por lo que autorizo(amos) de manera irrevocable para que incluyan mi nombre personal o razon social a la que
represento, a la base de datos de Informconf S.A. conforme a lo establecido en la Ley 1682/01 y su modificatoria 1969/02 como asi tambien para que se pueda proceer la informacion.<br>
* A todos los efectos legales y procesales emeregentes de este documento, las partes aceptan la jurisdiccion y competencia de los jueces y tribunales de la ciudad de Asuncion y declaran prorrogada cualquier otra que pudiera corresponder.<br>
* El unico comprobante de cancelacion de la Factura Credito constituye nuestro Recibo de Dinero Oficial.<br>
* En caso de exigir algun tipo de devolucion, debera contar con la Nota de Credito correspondiente.<br>
* Si la presente operacion fuera abonada con cheque, dejo formal y expresa constancia que si el mismo fuera rechazado por algun motivo, el pago sera considerado nulo, tomandose la obligacion como impaga, liquida y exigible a partir de ese momento.<br>
<br>
RECIBI CONFORME (firma y sello).....................................................................Aclaracion de Firma...............................................................C.I.Nro........................



		</td>
	</tr>
</table>

</div>

</body>
</html>