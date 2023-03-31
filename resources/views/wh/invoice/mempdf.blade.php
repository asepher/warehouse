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
            color:black;
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
		
 .center-image {
         background-image: url("images/ssl_gw.png");        
         height: 250px;
         background-position: center;
         background-repeat: no-repeat;
         background-size: cover;
         position: relative;
      }
/*
.bg {
  //background-image: url("images/nomimasi.png");
}
*/
</style>

	</style>
</head>
<body>
	<table>
		<tr>
			<td style="width: 50%;">
				<img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/logo_ssl.png')); ?>" >				
			</td>
			<td style="width: 50%; text-align: center;">
                @if ($manifest->term == 'FOB')
				<img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/nominasi.png')); ?>" style="width:200px;height: 60px;">							
                @endif
			</td>

		</tr>
	</table>
	<!-- img src="public_path('logo_ssl.png')" alt="" -->

	<table>
		<tr>
			<td>Release Memo</td><td style="width:5px">:</td>
			<td><h4>{{ Helper::FormatInvWh($inv) }}</h4></td>
		</tr>
		<tr>
			<td>To</td><td style="width:5px">:</td>
			<td>PT Agung Raya</td>
		</tr>
		<tr>
			<td>Address</td><td style="width:5px">:</td>
			<td>Jl Bangka No. 1 Gudang Agung  Pelabuhan Tj Priok - Jakarta </td>
		</tr>
		<tr>
			<td>Attent</td><td style="width:5px">:</td>
			<td>Bpk Yusuf</td>
		</tr>
	</table>
	<hr style="border: 0.1px solid;">
	<p></p>
	Dengan hormat,<p></p>
	Bersama ini kami ingin menyampaikan bahwa shipment dengan data - data yang di sebut dibawah ini :<p></p>

<div class="center-image">
	<table> 
		<tr>
			<td>Date</td><td>:</td><td>{{ Helper::TglIndo($tgl) }}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Customer</td><td>:</td><td>{{ $manifest->cnee_name }}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>HB/L No</td><td>:</td><td>{{ $manifest->hbl }}</td>
			<td>Quantity </td><td>:</td><td> {{ number_format($manifest->qty,0) }}</td>
		</tr>
		<tr>
			<td>BL No</td><td>:</td><td>{{ $manifest->vls_bl }}</td>
			<td>Type</td><td>:</td><td>{{ $manifest->sat_qty }}</td>
		</tr>
		<tr>
			<td>Container</td><td>:</td><td>{{ $manifest->container }}</td>
			<td>Gross Weight</td><td>:</td><td>{{ $manifest->weight }}</td>
		</tr>
		<tr>
			<td>Vessel</td><td>:</td><td>{{ $manifest->vessel }}</td>
			<td>Measurement</td><td>:</td><td>{{ $manifest->measure }}</td>
		</tr>
		<tr>
			<td>ETA</td><td>:</td><td>{{ $manifest->eta }}</td>
			<td></td><td></td><td></td>
		</tr>
		<tr>
			<td valign="top">Description</td><td valign="top">:</td>
			<td colspan="3">
				@php
            $value = Illuminate\Support\Str::limit($manifest->description, 50);
            echo nl2br($value);
          @endphp
			</td>
		</tr>
	</table>

</div> 	

	<p></p>
	<table>
		<tr>
			<td>
				Mohon kiranya shipment tersebut  dapat di berikan ijin keluar dari gudang setelah menyelesaikan semua kewajiban RDM, Storage dan lain lainnya di PT AGUNG RAYA.
			</td>
		</tr>
	</table>
	<p></p>
	<table>
		<tr>
			<td>
			Demikianlah penyampaian dari pihak kami dan atas perhatian serta kerja samanya kami mengucapkan terima kasih.
			</td>
		</tr>
	</table>
	<p></p>
	<p></p>
	<table border="0" width="85%">
		<tr>
			<td width='75%'></td>
			<td><strong>Hormat kami,</strong>
				<p><br></p>
				<p><br></p>
				........................
			</td>			
		</tr>
		<tr>
			<td></td><td>
				<p></p>
				
		</tr>
	</table>
		{{ Auth::user()->name . " " . now() }}
</body>
</html>