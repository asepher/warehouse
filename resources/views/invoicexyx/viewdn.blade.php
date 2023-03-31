<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>INV - {{ $inv }}</title>
		<style type="text/css">	
      @page {
         margin-top: 0.2cm;
         margin-bottom: 0cm;
      }
      body{
            font-family: Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:13px;
            margin-top: 0;
        }
      table {           
         width: 70%;         
         border-collapse: collapse;
      }  

      #Title {
      	border: 0.1px solid;      
      	font-size:  14px;
      	font-weight: bold;
      	padding: 4px;
      }     
      
      #Judul {
      	border: 0.1px solid;     
      	font-size:  14px;
      	font-weight: bold;
      	padding: 4px;
      }     
      #Item {
      	border: 0.1px solid;      	
      	padding: 4px;
      }
      #Total {
      	border-right: 0.1px solid;
      	text-align: right;
      	padding: 4px;
      }     
      #TotalValue {
      	border-bottom: 0.1px solid;      	
      	text-align: right;
      	padding: 4px;
      }
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

	</style>
</head>
<body>
	<center>
		<table>
			<tr>
				<td>	<img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/logo_ssl.png')); ?>" >
				</td>						
				<td width="35%">
					<strong>
					PT. SINERGI SUKSES LOGISTIK <br>
					Gajah Mada Tower Fl 19th #7 <br>
					Jl. Gajah Mada No. 19-26 , Jakarta 10130 - Indonesia <br>
					Phone : +62 21 63851866  Fax : +62 21 6338155 <br>
					mail@sinergisukseslogistik.com <br>
					www.sinergisukseslogistik.com
					</strong>
				</td>
			</tr>
		</table>

			@php
				$manifest 	= Helper::JumManifesByCont('FOB',$header->container);
				$totAktual	= Helper::SumManifesByCont('FOB',$header->container);
				$weightm 	= Helper::CountWeightByCont('FOB',$header->container,$header->kd_vsl);
			@endphp
		
	    
	<table>
		<tr>
			<th id="Title" style="width:60%;font-size:15px"><center><b>DEBIT NOTE</b></center> </th>
			<th id="Title" style="font-size:15px"><center><b>{{ $inv }}</b></center></th>
		</tr>
	</table>		
	<p></p>
	<table>	
		<tr>
			<td style='width: 150px'>Tanggal </td>
			<td>: @php echo date('m-d-Y') @endphp</td>
		</tr>
		<tr>
			<td style='width: 150px'>Bill </td>
			<td>: PT Varuna</td>							
		</tr>
		<tr>
			<td>Address</td><td>: Jln. Hayam Wuruk </td> 
		</tr>
		<tr>
			<td>NPWP</td><td>: 00000000000</td>
		</tr>
	</table>
	<hr style="border: 0.1px thin;">
	
	<table>
		<tr><td style='width: 150px'>HBL</td><td>....</td></tr>
		<tr><td style='width: 150px'>BL</td><td>: {{ $vessel->vls_bl }}</td></tr>
		<tr><td>Container</td><td>: {{ $header->container }}</td></tr>
		<tr><td>Vessel</td><td>: {{ $header->kd_vsl . ' - ' . $vessel->vessel }}</td></tr>
		<tr><td>ETA</td><td>: {{ $vessel->eta }}</td></tr>
		<tr><td>Qty</td><td>: {{ $totAktual }}</td></tr>
		<tr><td>Remark</td><td></td></tr>
	</table>
	<p></p><br>
	@php
		$no = 1; $jumbrs = 7; $subTotal =0; $total =0; $materai =0; $measure = 0;
		$jumlah 	= DB::table('invwh_detail')->where('term', 'FOB')->where('tipe','DN')
						->where('kd_vsl', $header->kd_vsl)
						->where('container', $header->container)
						->sum('wm');

		$totAdm 	= DB::table('invwh_detail')->where('term', 'FOB')->where('tipe','DN')
						->where('kd_vsl', $header->kd_vsl)->where('is_adm',1)
						->where('container', $header->container)
						->count('wm');					
	@endphp

	<table width="90%">		
		<tr>
			<th id="Judul">#</th>
			<th id="Judul"><strong>Description</strong></th>
			<th id="Judul"><strong>Tarif</strong></th>
			<th id="Judul"><strong>W/M</strong></th>
			<th id="Judul"><strong>Total</strong></th>
		</tr>
	
				@foreach ($tarif as $trf)				
					<tr>
						<td id="Item" style="text-align:center">{{ $no++ }}</td>
						<td id="Item" >{{ $trf->nama_tarif }} </td>
						<td id="Item" style="text-align:right">{{ Rupiah($trf->jumlah) }} </td>
						@if ($trf->is_adm == 1)
							<td id="Item" style="text-align:center">
								@php
									$measure = $totAdm;
								@endphp
								{{ $measure }}
							</td>
						@else
							<td id="Item" style="text-align:center">
								@php
									$measure = $jumlah;
								@endphp
								{{ $measure }}
							</td>										
						@endif
						@php
							$total = $trf->jumlah * $measure;
						@endphp
						<td id="Item" style="text-align:right;border-left: 0.1px solid;">
							{{ Rupiah($total) }}
						</td>
					</tr>
					@php
						$subTotal = $subTotal + $total;
					@endphp
				@endforeach
				@for ($i = $no; $i < $jumbrs ; $i++)
					<tr>
						<td id="Item">&nbsp;</td>
						<td id="Item"></td>
						<td id="Item"></td>
						<td id="Item"></td>
						<td id="Item"></td>
					</tr>
				@endfor
				@php
					$ppn = $subTotal * 0.1;
					$grandTotal = $subTotal + $ppn;
					if ($grandTotal >= 5000000){
							$materai = 10000;
					}
				@endphp
				<tr>
					<td colspan="4" id="Total" >Subtototal</td>
					<td id="TotalValue" style="border-right: 0.1px solid;">{{ Rupiah($subTotal) }}</td>
				</tr>
				<tr>
					<td colspan="4" id="Total">PPN</td>
					<td id="TotalValue" style="border-right: 0.1px solid;">{{ Rupiah($ppn) }}</td>
				</tr>

				@if ($grandTotal >= 5000000)
					<tr>
						<td colspan="4" id="Total">Materai</td>
						<td id="TotalValue" style="border-right: 0.1px solid;">{{ Rupiah($materai) }}</td>
					</tr>
				@endif

				<tr>
					<td colspan="4" id="Total" style="font-size: 14px;font-weight:bold;">
						Grand Total </td>
					<td id="TotalValue" style="font-size: 14px;font-weight:bold; border-right: 0.1px solid;">
						{{ Rupiah($subTotal) }}</td>
				</tr>

		</table>

		<form action="{{ route('wh.invoice.printpdfdn') }}" method="post">	
			{{ csrf_field() }}
			<input type="hidden" name="tipe" value="DN">
			<input type="hidden" name="inv" value="{{$inv}}">
			<button type="submit" >Print</button>
		</form>

</center>
</body>
</html>