<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>INV DN</title>    
    <style>
      body{
        margin-top: 399px;
        font-family: Calibri, 'Trebuchet MS', sans-serif;
        color:black;
        text-align:left;
        font-size:14px;
      }

#header,
#footer {
  position: fixed;
  left: 0;
  right: 0;
  color: black;
  font-size: 0.9em;
}
 
#header {
  top: 0;  
}

#footer {
  bottom: 0;
  border-top: 0.1pt solid #aaa;
}

#header table,
#footer table {
  width: 100%;
  border-collapse: collapse;
  border: none;
}

#header td,
#footer td {
  padding: 0;
  width: 50%;
}

hr {
  page-break-after: always;
  border: 0;
}

.page-number:after {
	counter-increment: page;
}

.page-number:before {
	content: counter(page) " of " counter(pages);
}

    </style>
</head>
<body>


<div id="header">
<table style="width:100%">
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
			$totAktual	= Helper::SumManifesByCont('FOB',$cont);
	@endphp
<table style="border:0.1px solid black;width: 100%;">
	<tr>
		<th style="width:60%;font-size:15px;padding: 3px;"><center><b>DEBIT NOTE</b></center> </th>
		<th style="font-size:15px" width="45%"><center><b>{{ Helper::FormatInvWh($inv) }}</b></center></th>
	</tr>
</table>
<br>
	<table>	
		<tr>
			<td style='width: 100px'>Date </td><td style='width:5px'>:</td>
			<td>{{ Helper::TglBlnTh($masterDn->tgl_gen) }}</td>
		</tr>
		<tr>
			<td>Bill </td><td>:</td>
			<td>PT VARUNA LINTAS SARANA LOGISTIK</td>
		</tr>
		<tr><td valign="top">Address</td><td valign="top">:</td><td>GEDUNG PERKANTORAN HAYAM WURUK PLAZA TOWER LT.7 UNIT A-B, <br>
										JL. HAYAM WURUK 108 MAPHAR TAMAN SARI JAKARTA BARAT 	<br>
						DKI JAKARTA 11160 </td></tr>
		<tr><td>NPWP</td><td>:</td><td>210073987032000</td></tr>
	</table>
	<p style="border:0.1px solid black;"></p>
<table>

		<tr><td style='width: 100px'>BL</td><td style="width:5px">:</td><td> {{ $manifest->vls_bl }}</td></tr>
		<tr><td>Container</td><td>:</td><td>{{ $manifest->container }}</td></tr>
		<tr><td>Vessel</td><td>:</td><td>{{ $manifest->vessel }}</td></tr>
		<tr><td>ETA</td><td>:</td><td>{{ date("d M Y",strtotime($manifest->eta)) }}</td></tr>
		<tr><td>Qty</td><td>:</td><td>{{ $totAktual }}</td></tr>		
		</td></tr>		
	</table>
	<br>
	<table style="width:100%;">
		<tr>
			<td  style="border-bottom: 0.1px solid;border-top:0.1px solid;padding: 4px;"><strong>DESCRIPTION</strong></td>
			<th  style="border-bottom: 0.1px solid;border-top:0.1px solid;">TARIF ( Rp ) </th>
			<th  style="border-bottom: 0.1px solid;border-top:0.1px solid;">WEIGHT</th>
			<th  style="border-bottom: 0.1px solid;border-top:0.1px solid;">AMOUNT ( Rp )</th>
	</tr>
</table>
</div>

	@php
		$no = 1; $jumbrs = 7; $subTotal =0; $total =0; $materai =0; 
		$ttotal = 0;$page = 0;
	@endphp
	<table style="width:100%;border-spacing: 0px;" border="0">
	 
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
							<tr style="padding: 0px;">
								<td style="font-size:14px;padding: 0px;">{{ $dtl->nama_tarif }}</td>
								<td style="text-align: center;font-size:14px;padding: 0px;">{{ Helper::Angka($dtl->tarif) }}</td>

								@if ($dtl->is_adm == 1)
									<td style="text-align: center;font-size:14px;padding: 0px;">{{ number_format($dtl->vol_actual,0) }}</td>
								@else
									<td style="text-align: center;font-size:14px;padding: 0px;">{{ number_format($dtl->vol_actual,4) }}</td>
								@endif

								<td style="width: 20%;text-align: right;font-size:14px;padding: 0px;">{{ Helper::Angka($jumlah) }}</td>
								
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

	@php
 	$vtot = $ttotal* 0.11;
 	$grandtot = $ttotal + $vtot;
	$materai = 0;

 @endphp
	<tr>
		<td colspan="3" style="text-align:right;font-weight: bold;border-top: 0.1px solid;">Total &nbsp;&nbsp;</td>
		<td style="width: 20%;text-align: right;font-weight: bold;font-size:15px;border-top: 0.1px solid;">{{ Helper::Rupiah($ttotal) }}</td>
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
<table style="width:100%">
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

<div id="footer" style="font-size:10px">
   	{{ date("j M Y, G:i") }}
</div>



</body>
</html>