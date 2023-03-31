<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>INV - {{ $id }}</title>
		<style>
			    @page {
         margin-top: 0.5cm;
         margin-bottom: 0cm;
      }
		body{
            font-family: Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:13px;
            margin:0; 
        }
	  table   {               
            width: 100%;            
            border-collapse: collapse;
        } 
		th,td 	{			
			padding:0.1px;
		}			
		#judul {		
			border: 0.1px solid black;
		}		
		#item th  {			
			border: 0.1px solid black;
		}

	</style>
</head>
<body>
	<img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/logo_ssl.png')); ?>" >
	

	<table id="judul" style="width:100%;">
		<tr>
			<td><center><b>INVOICE</b></center> </td>
			<td><center><b>{{ $id }}</b></center></td>
		</tr>
	</table>	
	<p></p>

	<table>
		<tr>
			<td>Tanggal </td>
			<td>{{ $hd->tgl_gen }}</td>
		</tr>
		<tr>
			<td>Bill To </td>
			<td>PT Agung Raya</td>
		</tr>
		<tr>
			<td>Address</td>
			<td>Jl Bangka No. 1 Gudang Agung Raya 
				Pelabuhan Tj Priok - Jakarta </td>
		</tr>
		<tr>
			<td>NPWP</td>
			<td>00000000000000000</td>
		</tr>
		<tr>
			<td>Att</td>
			<td>Bpk Yusuf</td>
		</tr>
	</table>

	<hr>

	<table>
		<tr>
			<td>Customer</td><td>{{ $manifest->consignee_name }}</td>
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
	<table id="item">
		<thead>
			<tr>
				<th>Item</th>
				<th>Tarif</th>
				<th>W/M</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>

			@foreach ($detail as $dtl)
			<tr>
				<td>{{ $dtl->item }}</td>
				<td>{{ $dtl->tarif }}</td>
				<td>{{ $dtl->wm }}</td>
				<td>{{ $dtl->tarif * $dtl->wm  }}</td>
			</tr>
			@endforeach
			
		</tbody>
	</table>
    


</body>
</html>