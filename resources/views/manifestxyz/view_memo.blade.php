@extends('layouts.app')

@section('title')
	View Manifest
@endsection

@section('content')
	@php
		 $tgl=date('Y-m-d');
	@endphp

	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-5">
					<h4>View Memo</h4>					
				</div>
				<div class="col-md-5">
				
					<form class="form-horizontal" role="form" action="/wh/genmem/pdf/{{$id}}"   
						method="post">					
						{{ csrf_field() }}

<div class="row align-items-center">
				
						<div class="col-md-6">
							<h4>View Manifest</h4>
						</div>				
						<div class="col-md-4 text-end">							
							<input type="date" class="form-control datepicker-input" name="tanggal"
							value="{{ $tgl }}"
								@if ($man->gen_inv == 1)
									Disabled 
								@endif
							 >
						</div>
						<div class="col-md-2 text-end">
								<button type="submit" class="btn btn-danger btn-sm px-3"
								@if ($man->gen_note == 1)
									Disabled 
								@endif
								>Gen Memo </button>					
						</div>							
			</div>	


						
					</form>

				</div>
			</div>	

			<hr>
			<p></p>

				<div class="row">
					<div class="col-md-12">
						
							<table style="width: 80%">
								<tr>
									<td><h4>RELEASE MEMO</h4></td>
									<td><h4>{{ Helper::FormatInvWh($manifest->kd_inv) }}</h4></td>
								</tr>
							</table>
					</div>
				</div>
			<hr>
			

				<div class="row">
					<div class="col-md-10">

					<table style="width: 100%">
						<tr>
							<td style="width: 150px">To</td>
							<td>: PT Multi Terminal Indonesia</td>
						</tr>
						<tr>
							<td>Address</td>
							<td>: Jl Banda No. 1 Gudang CDC Banda
								Pelabuhan Tj Priok - Jakarta </td>
						</tr>
						<tr>
							<td>Attent</td>
							<td>: Bpk Hasan</td>
						</tr>
					</table>
					<hr>

				Dengan Hormat,<p></p>
				Bersama ini kami ingin menyampaikan bahwa shipment dengan data - data yang di sebut dibawah ini <p></p>
				<br>
				<table style="width: 100%">
					<tr>
						<td style="width: 15%">Customer</td><td style="width: 55%">: {{ $manifest->consignee }}</td>
						<td style="width: 15%"></td><td></td>
					</tr>
					<tr>
						<td>HB/L No</td><td>: {{ $manifest->hbl }}</td>
						<td>Quantity </td><td>: {{ $manifest->qty }}</td>
					</tr>
					<tr>
						<td>BL No</td><td>: {{ $manifest->vls_bl }}</td>
						<td>Type</td><td>: {{ $manifest->sat_qty }}</td>
					</tr>
					<tr>
						<td>Container</td><td>: {{ $manifest->container }}</td>
						<td>Gw</td><td>: {{ $manifest->weight }}</td>
					</tr>
					<tr>
						<td>Vessel</td><td>: {{ $manifest->vessel }}</td>
						<td>Measure</td><td>: {{ $manifest->measure }}</td>
					</tr>
					<tr>
						<td>ETA</td><td>: {{ Helper::TglIndo($manifest->eta) }}</td>
						<td></td><td></td>
					</tr>
					<tr>
						<td>Description</td>
						<td colspan="3" style="white-space:wrap">
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
				@if ($manifest->gen_note == 1)
					<a href="{{ '/MEM_'.$manifest->idp.'.pdf' }}" target="_blank">
						<span class="badge badge-secondary">Done</span>							
					</a>
				@endif

				<p></p>



						


					</div>
				</div>




			</div>
		</div>
	

	</div>




@endsection	