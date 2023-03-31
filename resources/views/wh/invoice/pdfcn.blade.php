<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>INV CN - {{ $inv }}</title>
		<style type="text/css">	     
      body{
            font-family: Calibri, 'Trebuchet MS', sans-serif;
            color:black;
            text-align:left;
            font-size:12px;
            margin-top: 0;
        }
      table {           
         width: 100%;         
         border-collapse: collapse;
      }  
		th,td 	{			
			padding:1px;
		}	
      #Title {
      	border: 0.1px solid;      
      	font-size:  14px;
      	font-weight: bold;
      	padding: 4px;
      }     
      
      #judul {
      	border: 0.1px solid;     
      	font-size:  14px;
      	font-weight: bold;
      	padding: 4px;
      }     
      #item {
      	border: 0.1px solid;      	
      	padding: 2px;
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

p {
  text-align: justify;
  font-size: 1em;
  margin: 0.5em;
  padding: 10px;
}

	</style>
</head>
<body>
	<table>
			<tr>
				<td>	<img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/logo_ssl.png')); ?>" >
				</td>						
				<td width="45%">
					<strong>PT. SINERGI SUKSES LOGISTIK </strong><br>
					Gajah Mada Tower Fl 19th #7 <br>
					Jl. Gajah Mada No. 19-26 , Jakarta 10130 - Indonesia <br>
					Phone : +62 21 63851866  Fax : +62 21 6338155 <br>
					mail@sinergisukseslogistik.com <br>
					www.sinergisukseslogistik.com					
				</td>
			</tr>
		</table>
		<p></p>
			@php
				$Jmanifest 	= Helper::JumManifesByCont('FOB',$cont);
				$totAktual	= Helper::SumManifesByCont('FOB',$cont);
				$weightm 	= Helper::CountWeightByCont('FOB',$cont,$kd_vsl);

				$jumlah 	= DB::table('invwh_detail')->where('term', 'FOB')
								->where('kd_vsl', $kd_vsl)->where('tipe','DN')
								->where('container', $cont)
								->sum('wm');

				$totAdm 	= DB::table('invwh_detail')->where('term', 'FOB')->where('tipe','DN')
								->where('kd_vsl', $kd_vsl)->where('is_adm',1)
								->where('container', $cont)
								->count('wm');			
			@endphp
		
	    
	<table>
		<tr>
			<th id="Title" style="width:60%;font-size:15px"><center><b>CREDIT NOTE</b></center> </th>
			<th id="Title" style="font-size:15px" width="45%"><center><b>{{ Helper::FormatInvWh($inv) }}</b></center></th>
		</tr>
	</table>	
	<br>
	<table>	
		<tr>
			<td style='width: 20%'>Date </td><td style="width:5px">:</td>
			<td>@php echo date('m-d-Y') @endphp</td>
		</tr>
		<tr>
			<td>Bill To</td><td>:</td>
			<td>PT VARUNA LINTAS SARANA LOGISTIK</td>
		</tr>
		<tr><td>Address</td><td>:</td><td>HAYAM WURUK PLAZA TOWER LT.6 J-K, JAKARTA PUSAT </td></tr>
		<tr><td>NPWP</td><td>:</td><td>210073987032000</td></tr>
	</table>
	<hr style="border: 0.1px solid;">
	
	<table>
		
		<tr><td style='width: 20%'>BL</td><td style='width: 5px'>:</td><td>{{ $manifest->vls_bl }}</td></tr>
		<tr><td>Container</td><td>:</td><td>{{ $manifest->container }}</td></tr>
		<tr><td>Vessel</td><td>:</td><td>{{ $manifest->vessel }}</td></tr>
		<tr><td>ETA</td><td>:</td><td>{{ $manifest->eta }}</td></tr>
		<tr><td>Qty</td><td>:</td><td>{{ $totAktual }}</td></tr>
		<tr><td valign="top">Remark</td><td valign="top">:</td><td>
			@php
            $value = Illuminate\Support\Str::limit($manifest->description, 50);
            echo nl2br($value);
          @endphp
			</td>
	</tr>
	</table>

	@php
		$no = 1; $jumbrs = 7; $subTotal =0; $total =0; $materai =0; 
		$ttotal = 0;
	@endphp
	<p></p>

	<table>
	<tr>
			<td style="border-bottom: 0.1px solid;border-top:0.1px solid;"><strong>DESCRIPTION</strong></td>
			<th style="border-bottom: 0.1px solid;border-top:0.1px solid;">TARIF ( Rp )</th>
			<th style="border-bottom: 0.1px solid;border-top:0.1px solid;">WEIGHT</th>
			<th style="border-bottom: 0.1px solid;border-top:0.1px solid;">JUMLAH ( Rp )</th>
		</tr>
	@foreach ($header as $hd)
		<tr>
			<td colspan="4"><strong>{{ $hd->seq . '.' .$hd->cnee_name }}</strong></td>
		</tr>

				@php
						$detail = App\Models\InvDnDetail::where('seq',$hd->seq)
																			->where('kd_vsl',$manifest->kd_vsl)->get();
						$jumlah = 0;
					@endphp
				
						@foreach ($detail as $dtl)
								@php
									$jumlah = $dtl->tarif * $dtl->vol_actual;
								@endphp	
							<tr>
								<td>{{ $dtl->nama_tarif }}</td>
								<td width="25%" style="text-align:center;">{{ Helper::Angka($dtl->tarif) }}</td>
								<td style="text-align:center;">{{ $dtl->vol_actual }}</td>
								<td style="width: 20%;text-align: right">{{ Helper::Angka($jumlah) }}</td>
							</tr>
						@endforeach
											
		</tr>
		@php
			$ttotal = $ttotal + $jumlah;
		@endphp
	@endforeach	
		@php
 			$vtot = $ttotal* 0.11;
 			$grandtot = $ttotal + $vtot;
 		@endphp

 		<tr>
 			<td colspan="4">
 				<hr style="border: 0.1px solid;">
 			</td>
 		</tr>
 		
					<tr>
						<td colspan="3"  style="text-align:right;font-weight: bold;">Total &nbsp;&nbsp;</td>
						<td style="width: 20%;text-align: right;font-weight: bold;font-size:15px;">{{ Helper::Rupiah($ttotal) }}</td>
					</tr>
					<tr>
						<td colspan="3"  style="text-align:right;font-weight: bold;">VAT &nbsp;&nbsp;</td>
						<td style="width: 20%;text-align: right;font-weight: bold;font-size:15px;">{{ Helper::Rupiah($vtot) }}</td>
					</tr>
							<tr>
								<td colspan="3"  style="text-align:right;font-weight: bold;">Stamp Duty &nbsp;&nbsp;</td>
								<td style="width: 20%;text-align: right;font-weight: bold; font-size:15px;">
									{{ Helper::Rupiah(Helper::Materai()) }}</td>
							</tr>										
							@php
								$grandtot = $grandtot + Helper::Materai();
							@endphp
					<tr>
						<td colspan="3"  style="text-align:right;font-weight: bold;">Grand Total &nbsp;&nbsp;</td>
						<td style="width: 20%;text-align: right;font-weight: bold; font-size:15px;">{{ Helper::Rupiah($grandtot) }}</td>
					</tr>
					
</table>
<p><br></p>
<table>
	<tr>
		<td valign="top" width="70%">

<strong>
A/N PT SINERGI SUKSES LOGISTIK <br>
MANDIRI CAB JAKARTA KETAPANG INDAH <br>
A/C NO. 1150000787772 <br>
</strong>
			
		</td>
		<td valign="top" style="text-align: center;">
			<strong>Hormat kami,</strong>
			<p><br></p><p><br></p>
			.................................
		</td>
	</tr>
</table>


<script type="text/php">
	<script type="text/php">
    if ( isset($pdf) ) {
        $font = Font_Metrics::get_font("helvetica", "bold");
        $pdf->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
    }
</script> 
</script>
</body>
</html>