<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Surat Jalan - {{ $id }}</title>
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
         width: 100%;         
         border-collapse: collapse;
      }  
      th,td    {
         padding:3px;
      }
      .garis {
         border-left: 1px solid #000;
      }

      .tabledetail {
         border: 1px solid #000;
         width: 100%;         
         border-collapse: collapse;
      }
      .ratakanan {
         text-align: right;
      }
      .ratatengah {
         text-align: center;
      }
      .paraf{
         height: 5;
      }
      div { height: 5;  }

      .center-image {
        background-image: url("images/ssl_gw.png");        
         height: 300px;
         background-position: center;
         background-repeat: no-repeat;
         background-size: cover;
         position: relative;
         }

	</style>
</head>
<body>
	@php
		$cs = App\Models\Customer::where('kd_cus',$hd->kd_cus)->first();
	@endphp
	
	<table class="table" style="border: 0px solid #000">
      <tr>
         <td><span style="font-size:18px;">PT SINERGI SUKSES LOGISTIK</span> <br>
         	Gajah Mada Tower Lt 19 #07, Jl Gajah Mada No. 19-26 <br>
         	Jakarta 10130 - Indonesia  <br>
         	Telp : +6221 6385 1866, +6221 6338 155 <br>
         </td>
         <td style="text-align:right">
         		<h2>{{ $id }}</h2>
         		@php
         			echo "Tanggal :" . date('d-m-Y');
         		@endphp

         </td>
      </tr>
      <tr>
			<th colspan="2"><h2>SURAT JALAN</h2></th>
		</tr>
 
		<tr>
			<td width="50%">

				CUSTOMER : {{ $cs->customer  }} <br>
				PIC      : {{$hd->penerima }}
			</td>			
			<td width="50%" valign="top">
				
				<table class="table">
					<tr>
						<td width="20%">Keterangan</td><td>: {{$hd->keterangan1 . ' '. $hd->keterangan2 . ' ' .
							$hd->keterangan3. ' '. $hd->keterangan4 . ' '. $hd->keterangan5 . ' '  }}</td>
					</tr>
					
				</table>

			</td>
		</tr>
		
	</table>

<div class="center-image">

	<table class="table" border="1">
		<thead>
			<tr style="border-top: 2px solid #000;">
				<th>#</th>
				<th>Keterangan </th>
				<th>Jumlah</th>
				<th>Check</th>
			</tr>			
		</thead>
		<tbody>
			@php
				$brs = 1; $jumbrs = 16;
			@endphp
			@foreach ($detail as $dtl)
			<tr>
				<td style="width: 20px">{{ $brs }}</td>
				<td>{{ $dtl->note }}</td>
				<td style="width: 150px">{{ $dtl->jumlah . " " . $dtl->satuan }}</td>
				<td style="width: 50px">&nbsp;</td>

			</tr>	
			@php
				$brs = $brs+1;
			@endphp
			@endforeach
			@for ($i = $brs; $i < $jumbrs ; $i++)
			<tr>
				<td>&nbsp;</td>
				<td></td>
				<td></td>
				<td></td>

			</tr>
				
			@endfor
		</tbody>		
	</table>
	<table class="table" style="border: 1px solid;">
		<tr>
			<th style="border: 1px solid;width: 25%" >Yang Menyerahkan </th>
			<th style="border: 1px solid;width: 25%">Yang Mengirim</th>
			<th style="border: 1px solid;width: 25%">Yang Menerima</th>
			<th style="border: 1px solid;width: 25%">Note</th>
		</tr>
		<tr>
			<th style="height:60px;"></th>
			<th style="border: 1px solid;"></th>
			<th></th>
			<th style="border: 1px solid;"></th>
		</tr>
	</table>

i: {{ $i }}

</div>


</body>
</html>