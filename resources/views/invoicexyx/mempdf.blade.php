<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-AU-Compatible" content="ie=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>MEM - {{$inv}} </title>
	<style type="text/css">
		body{
            font-family: Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:13px;
            margin:0;
        }
		table	{
					
			width: 100%;
			border-collapse: collapse;
		}	
		th,td 	{
			
			padding:3px;
		}
	

	</style>
</head>
<body>
	<img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/logo_ssl.png')); ?>" >
	<!-- img src="public_path('logo_ssl.png')" alt="" -->

	<table>
		<tr>
			<td><h4>Release Memo</h4></td>
			<td></h3>{{ $inv }}</h3></td>
		</tr>
		<tr>
			<td>To</td>
			<td>PT Multi Terminal Indonesia</td>
		</tr>
		<tr>
			<td>Address</td>
			<td>Jl Banda No. 1 Gudang CDC Banda
				Pelabuhan Tj Priok - Jakarta </td>
		</tr>
		<tr>
			<td>Attent</td>
			<td>Bpk Hasan</td>
		</tr>
	</table>
	<hr style="border: 0.3px solid dotted;">

	Dengan Hormat,<p></p>
	Bersama ini kami ingin menyampaikan bahwa shipment dengan data - data yang di sebut dibawah ini <p></p>

	<table>
		<tr>
			<td>Customer</td><td>{{ $manifest->consignee }}</td>
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
			<td>Description :</td>
			<td colspan="3">
				@php
					echo nl2br($manifest->description);
				@endphp

			</td>
		</tr>
	</table>
	<p></p>
	<table>
		<tr>
			<td>
				Mohon kirannya shipment tersebut  dapat di berikan ijin keluar dari gudang setelah menyelesaikan semua kewajiban RDM , Storage dan lain lainnya di PT AGUNG RAYA				
			</td>
		</tr>
	</table>
	<p></p>
	<table>
		<tr>
			<td>
			Demikianlah penyampaian dari pihak kami dan atas perhatian sera kerja samanya kami mengucapkan terima kasih.
			</td>
		</tr>
	</table>
	<p></p>
	<p></p>
	<table border="0" width="85%">
		<tr>
			<td width='75%'></td><td>Hormat Kami,</td>
		</tr>
	</table>


</body>
</html>