<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>INV - {{ $inv }}</title>
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
      border: 0.1px solid black;
    }   
    #item th  {     
      border: 0.1px solid black;
      padding: 2px;
    }
    #item td  {       
      padding: 2px;
    }


	</style>
</head>
<body>

<div id="header">
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
			<th id="Title" style="width:60%;font-size:15px"><center><b>DEBIT NOTE</b></center> </th>
			<th id="Title" style="font-size:15px" width="45%"><center><b>{{ Helper::FormatInvWh($inv) }}</b></center></th>
		</tr>
	</table>		
	<p></p>
	<table>	
		<tr>
			<td style='width: 100px'>Date </td>
			<td>: @php echo date('m-d-Y') @endphp</td>
		</tr>
		<tr>
			<td>Bill </td>
			<td>: PT VARUNA LINTAS SARANA LOGISTIK</td>
		</tr>
		<tr><td>Address</td><td>: HAYAM WURUK PLAZA TOWER LT.6 J-K, JAKARTA PUSAT </td></tr>
		<tr><td>NPWP</td><td>: 210073987032000</td></tr>
	</table>
	<hr style="border: 0.1px solid;">
	
	<table>

		<tr><td style='width: 100px'>BL</td><td style="width:5px">:</td><td> {{ $manifest->vls_bl }}</td></tr>
		<tr><td>Container</td><td>:</td><td>{{ $manifest->container }}</td></tr>
		<tr><td>Vessel</td><td>:</td><td>{{ $manifest->vessel }}</td></tr>
		<tr><td>ETA</td><td>:</td><td>{{ $manifest->eta }}</td></tr>
		<tr><td>Qty</td><td>:</td><td>{{ $totAktual }}</td></tr>
		<tr><td valign="top">Remark</td><td valign="top">:</td><td>
				@php
            	$value = Illuminate\Support\Str::limit($manifest->description, 50);
              // echo nl2br($value);
          @endphp
		</td></tr>
	</table>
</div>

	<p></p>
	@php
		$no = 1; $jumbrs = 7; $subTotal =0; $total =0; $materai =0; 
		$ttotal = 0;
	@endphp
	<table  border="0">
		<tr id="item">
		<td  style="border-bottom: 0.1px solid;border-top:0.1px solid;"><strong>DESCRIPTION</strong></td>
		<th  style="border-bottom: 0.1px solid;border-top:0.1px solid;">TARIF ( Rp ) </th>
		<th  style="border-bottom: 0.1px solid;border-top:0.1px solid;">WEIGHT</th>
		<th  style="border-bottom: 0.1px solid;border-top:0.1px solid;">AMOUNT ( Rp )</th>
	</tr>

	@foreach ($header as $hd)	
		<tr>
			<td colspan="4"><strong>{{ $hd->seq . '.' .$hd->cnee_name }}</strong></td>
		</tr>

				@php
						$detail = App\Models\InvDnDetail::where('seq',$hd->seq)
																			->where('kd_vsl',$manifest->kd_vsl)->get();
						$ptotal = 0;

					@endphp
						@foreach ($detail as $dtl)
							@php
									$jumlah = $dtl->tarif * $dtl->vol_actual;
								@endphp	
							<tr>
								<td>{{ $dtl->nama_tarif }}</td>
								<td style="text-align: center;">{{ Helper::Angka($dtl->tarif) }}</td>

								@if ($dtl->is_adm == 1)
									<td style="text-align: center;">{{ number_format($dtl->vol_actual,0) }}</td>
								@else
									<td style="text-align: center;">{{ number_format($dtl->vol_actual,4) }}</td>
								@endif

								<td style="width: 20%;text-align: right">{{ Helper::Angka($jumlah) }}</td>
								
							</tr>
							@php
								$ptotal = $ptotal+$jumlah;
							@endphp
						@endforeach						
			
		</tr>
		@php
			$ttotal = $ttotal + $ptotal;
		@endphp
	@endforeach

 		<tr>
 			<td  colspan="4">
 				<hr style="border: 0.1px solid;">
 			</td>
 		</tr>
 		<tr>

	@php
 	$vtot = $ttotal* 0.11;
 	$grandtot = $ttotal + $vtot;
	$materai = 0;

 @endphp
	<tr>
		<td colspan="3" style="text-align:right;font-weight: bold;">Total &nbsp;&nbsp;</td>
		<td style="width: 20%;text-align: right;font-weight: bold;font-size:15px;">{{ Helper::Rupiah($ttotal) }}</td>
	</tr>
		<td colspan="3" style="text-align:right;font-weight: bold;">VAT &nbsp;&nbsp;</td>
		<td style="width: 20%;text-align: right;font-weight: bold;font-size:15px;">{{ Helper::Rupiah($vtot) }}</td>
	</tr>
		@php
				if($grandtot >= 5000000){
							$materai = Helper::Materai();
							$grandtot = $grandtot + $materai;
					}
		@endphp
		<tr>
			<td colspan="3" style="text-align:right;font-weight: bold;">Stamp Duty &nbsp;&nbsp;</td>
			<td style="width: 20%;text-align: right;font-weight: bold;font-size:15px;">{{ Helper::Rupiah($materai) }}</td>
		</tr>
	</tr>
	<tr>
		<td colspan="3" style="text-align:right;font-weight: bold;">Grand Total &nbsp;&nbsp;</td>
		<td style="width: 20%;text-align: right;font-weight: bold;font-size:15px;">{{ Helper::Rupiah($grandtot) }}</td>
	</tr>
</table>
<p></p>
<p><br></p>
<table>
	<tr>
		<td valign="top">

<strong>
A/N PT SINERGI SUKSES LOGISTIK <br>
MANDIRI CAB JAKARTA KETAPANG INDAH <br>
A/C NO. 1150000787772 <br>
</strong>

			
		</td>
		<td style="text-align: center;font-weight: bold;" valign="top">
				Hormat kami,			
				<p><br></p>
				<p><br></p>
				<p><br></p>
				<p><br></p>
				....................................

		</td>
	</tr>
</table>



</body>
</html>