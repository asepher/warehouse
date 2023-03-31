<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
		<style type="text/css">
 		body{
            font-family: Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:13px;
            margin:0;
        }

		table {			
 			width: 100%;            
            border-collapse: collapse;		
		}	
        
        th,td   {
            padding:2px;
        }
	</style>
</head>
<body>
	<img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/logo_ssl.png')); ?>" >

	<table id="judul">
		<tr>
			<td width="75%" style="border: 1px solid black;font-size: 17px;"><span>
				<center><b>INVOICE</b></center> </span>
			</td>
			<td style="border: 1px solid black;font-size: 17px;"><center><b>{{ $inv }}</b></center></td>
		</tr>
	</table>
	<table>
		
		<tr>
			<td>Bill To </td>
			<td>PT Multi Terminal Indonesia</td>
		</tr>
		<tr>
			<td>Address</td>
			<td>Jl Banda No. 1 Gudang CDC Banda
				Pelabuhan Tj Priok - Jakarta </td>
		</tr>
		<tr>
			<td>NPWP</td>
			<td>Bpk Hasan</td>
		</tr>
	</table>
	<table>
		<tr>
			<td width="75">Customer</td><td>{{ $manifest->consignee }}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>HB/L No</td><td>{{ $manifest->hbl }}</td>
			<td>Quantity </td><td>{{ $manifest->qty }}</td>
		</tr>
		<tr>
			<td>BL No</td><td>{{ $manifest->vls_bl }}</td>
			<td>Type</td><td>{{ $manifest->sat_qty }}</td>
		</tr>
		<tr>
			<td>Container</td><td>{{ $manifest->container }}</td>
			<td>Gw</td><td>{{ $manifest->weight }}</td>
		</tr>
		<tr>
			<td>Vessel</td><td>{{ $manifest->vessel }}</td>
			<td>Measure</td><td>{{ $manifest->measure }}</td>
		</tr>
		<tr>
			<td>ETA</td><td>{{ $manifest->eta }}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Description :</td><td colspan="3">{{ $manifest->description }}</td>
		</tr>
	</table>
	<p></p>
	<table>
		<thead>
			<tr style="height: 550px">
				<th style="border: 1px solid black;">ITEM</th>
				<th style="border:  1px solid black;">TARIF</th>
				<th style="border: 1px solid black;">W/M</th>
				<th style="border: 1px solid black;">TOTAL</th>
			</tr>
		</thead>
		<tbody>
		@php
			// hitung weight/measure
		    $weight = $manifest->weight / 1000;
		    if ( $weight >= $manifest->measure)
		    {
		        $wm = $manifest->weight;
		    } else {
		        $wm = $manifest->measure;
		    }
		   $totsub =  $totppn = 0;
		@endphp
			@foreach ($tarif as $trf)
				@php
					if ( $trf->is_adm == 0)
					{
						$min = round($wm);
					}
					else	
					{
						$min = 1;				
					}
					
					$jumlah = $min * $trf->jumlah;
					$totsub = $totsub + $jumlah ;
				@endphp
			<tr>
				<td>{{ $trf->item }}</td>
				<td style="text-align: center;">{{ $trf->jumlah }}</td>
				<td style="text-align: center;">{{ Rupiah($trf->jumlah) }}</td>
				<td style="text-align: center;">{{ Rupiah($jumlah) }}</td>
			</tr>
			@endforeach
			</tbody>
				@php
					$totppn = $totsub * 0.1 ;
					$tmptot = $totsub + $totppn ;
					$materai = 0;

					if ($tmptot > 5000000)
						$materai = 10000;

					 $grandtot = $tmptot + $materai;
				@endphp
				<tr>
								<td colspan="3" class="text-end">Subtototal</td>
								<td class="text-end">{{ Rupiah($totsub) }}</td>
							</tr>
							<tr>
								<td colspan="3" class="text-end">PPN</td>
								<td class="text-end">{{ Rupiah($totppn) }}</td>
							</tr>
							<tr>
								<td colspan="3" class="text-end">Materai</td>
								<td class="text-end">{{ Rupiah($materai) }}</td>
							</tr>
							<tr>
								<td colspan="3" class="text-end">Grand Total </td>
								<td class="text-end">{{ Rupiah($grandtot) }}</td>
							</tr>
						</table>
		
	</table>
    


</body>
</html>