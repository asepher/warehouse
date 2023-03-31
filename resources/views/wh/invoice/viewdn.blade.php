<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inv DN - {{ $inv }}</title>
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
				$jumManifest 	= Helper::JumManifesByCont('FOB',$container);
				$totAktual		= Helper::SumManifesByCont('FOB',$container);
				$weightm 		= Helper::CountWeightByCont('FOB',$container,$vessel);
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
			<td>: PT VARUNA LINTAS SARANA LOGISTIK</td>							
		</tr>
		<tr>
			<td>Address</td><td>: HAYAM WURUK PLAZA TOWER LT.6 J-K, JAKARTA PUSAT </td> 
		</tr>
		<tr>
			<td>NPWP</td><td>: 210073987032000</td>
		</tr>
	</table>
	<hr style="border: 0.1px solid;">
	
	<table>
		
		<tr><td style='width: 150px'>BL</td><td>: {{ $manifest->vls_bl }}</td></tr>
		<tr><td>Container</td><td>: {{ $container }}</td></tr>
		<tr><td>Vessel</td><td>: {{ $manifest->kd_vsl . ' - ' . $manifest->vessel }}</td></tr>
		<tr><td>ETA</td><td>: {{ $manifest->eta }}</td></tr>
		<tr><td>Qty</td><td>: {{ $totAktual }}</td></tr>
		<tr><td valign="top">Remark</td><td>: 
			@php
            $value = Illuminate\Support\Str::limit($manifest->description, 50);
            echo nl2br($value);
          @endphp
		</td></tr>
	</table>
	<p></p><br>
	@php
		$no = 1; $jumbrs = 7; $subTotal =0; $total =0; $materai =0; $measure = 0;
		$ttotal = 0;	 $ptotal = 0;			
	@endphp


<table border="0" width="650px">
	<tr>
		<td><strong>DESCRIPTION</strong></th>
		<th>TARIF</th>
		<th>WEIGHT</th>
		<th>JUMLAH</th>
	</tr>
	@foreach ($header as $hd)
		<tr>
			<td colspan="4"><strong>{{ $hd->seq . ' ' .$hd->cnee_name }}</strong></td>		
		</tr>	
					@php
						$detail = App\Models\InvDnDetail::where('seq',$hd->seq)
																			->where('kd_vsl',$hd->kd_vsl)->get();
						$ptotal = 0;
					@endphp

				
							@foreach ($detail as $dtl)
								@php
										if ($dtl->is_adm == 1){
			 									$wm = number_format($dtl->vol_actual,0);
			 								} else {
			 									$wm = number_format($dtl->vol_actual,4);
			 								}
			 								$jumlah = $wm * $dtl->tarif;
			 								$ttotal = $ttotal + $jumlah;
											//$jumlah = $dtl->tarif * $dtl->vol_actual;
								@endphp						
								<tr>
									<td>{{ $dtl->nama_tarif }}</td>
									<td style="text-align: center;">{{ Helper::Rupiah($dtl->tarif) }}</td> 
								
									<td style="text-align: center;">{{ $wm  }}</td>

									<td width="15%" style="text-align: right;">{{ Helper::Rupiah($jumlah) }}</td>									
								</tr>
								@php
									$ptotal = $ptotal+$jumlah;
								@endphp
							@endforeach
	
	@endforeach
		@php
 			$vtot = $ttotal* 0.11;
 			$grandtot = $ttotal + $vtot;
 		@endphp
 		<tr>
 			<td  colspan="4">TOTAL</td>
 		</tr>
 		<tr>
 			
 						<td colspan="3">Total </td>
 						<td width="15%" style="text-align: right;font-weight: bold">{{ Helper::Rupiah($ttotal) }} </td>
 					</tr>
 					<tr>
 						<td colspan="3">VAT</td>
 						<td style="text-align: right;font-weight: bold">{{ Helper::Rupiah($vtot) }}  </td>
 					</tr> 	
					@if ($grandtot > 5000000)
							<tr>
								<td colspan="3">MATERAI</td>
								<td style="width: 20%;text-align: right;font-weight: bold;">
									{{ Helper::Rupiah(Helper::Materai()) }}</td>
							</tr>										
							@php
								$grandtot = $grandtot + Helper::Materai();
							@endphp
							
						@endif 										
 					<tr>
 						<td colspan="3">Grand Total </td> 
 						<td style="text-align: right;font-weight: bold">{{ Helper::Rupiah($grandtot) }}</td>
 				
 		</tr>

</table>
<p></p>

<table>
	<tr>
		<td> <a href="{{ route('wh.generate.invoicedn',[$manifest->kd_vsl]) }}">Back</a> </td>
		<td>
			

			<form action="{{ route('wh.generate-pdf.invoicedn',[$manifest->kd_vsl ]) }}" method="post">  
			   {{ csrf_field() }}
			   <input type="hidden" name="container" value="{{ $container }}">
			   <button type="submit" >Print PDF</button>
			</form>



		</td>
	</tr>
</table>


</body>
</html>