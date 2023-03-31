@extends('layouts.app')

@section('title')
	View Manifest
@endsection

@section('content')

	@php
		 $tgl=date('Y-m-d');
	@endphp

	<div class="card">

		<div class="card-header py-3">
			<form class="form-horizontal" role="form" action="{{ route('wh.vessel.manifest.detail.create',[$idp]) }}"method="post">
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
								@if ($man->gen_inv == 1)
									Disabled 
								@endif
								>Gen Invoice </button>					
						</div>							
			</div>			
			</form>
		</div>

	
			<div class="card-body">

			<div class="row">
				<div class="col-md-6 text-center">
					<h4>INVOICE DRAFT1</h4>
				</div>	
				<div class="col-md-4 text-center">
					<h4>{{ FormatInvWh($man->kd_inv) }}</h4>
				</div>
			</div>
			<p><br></p>
			<div class="row">
				<div class="col-md-10">

						<table class="table table-sm">	
							<tr>	
								<td style="width: 100px"><strong>Bill To</strong></td>
								<td>: {{ $man->nmcustomer->customer }}</td>
							</tr>
							<tr>	
								<td><strong>Address</strong></td>
								<td>: {{ $man->nmcustomer->address }}</td>
							</tr>
							<tr>	
								<td><strong>NPWP</strong></td>
								<td>: {{ $man->nmcustomer->npwp }}</td>
							</tr>
						</table>					
				</div>
			</div>
			<p></p>
			<div class="row">				
				<div class="col-md-5">

					<table class="table table-sm">
						<tr>
							<td style="width: 150px">HBL</td><td >: {{ $man->hbl }}</td>
						</tr>
						<tr>
							<td>B/L No </td><td>: {{ $man->vls_bl }}</td>		
						</tr>
						<tr>
							<td>Container No</td><td>: {{ $man->container }}</td>							
						</tr>		
						<tr>
							<td>Vessel Nama</td><td>: {{ $man->vessel }}</td>					
						</tr>
						<tr>
							<td>Eta</td><td>: {{ TglIndo($man->eta) }}</td>		
						</tr>
						<tr>
							<td style="vertical-align:top;">Description</td>
							<td style="white-space:wrap">: 
								@php
									echo  nl2br($man->description);
								@endphp
								</td>							
						</tr>						
					</table>		

				</div>
				<div class="col-md-5">
						<table class="table table-sm">
							<tr>
								<td style="width: 150px">Quantity</td>
								<td>: {{ $man->qty }}</td>
							</tr>
							<tr>
								<td>TYPE</td><td>: {{ $man->sat_qty }}</td>
							</tr>
							<tr>
								<td>Gross Weight</td><td>: {{ $man->weight }}</td>
							</tr>
							<tr>
								<td>Measure</td><td>: {{ $man->measure }} </td>
							</tr>
							<tr>
								<td>Term</td><td>: {{ $man->term }} </td>
							</tr>

						

						</table>

								

				</div>


			</div>
			<div class="row">
				<div class="col-md-10">	

							<hr>

						<table class="table table-sm table-bordered">
							<thead>
								<tr class="bg-light">
									<th class="text-center"> Item </th>
									<th class="text-center"> Tariff </th>
									<th class="text-center">  W/M </th>
									<th class="text-center"> Total </th>								
								</tr>
							</thead>
							<tbody>
								@php
									// hitung weight/measure
						            $weight = $man->weight / 1000;
						            if ( $weight >= $man->measure)
						            {
						                $wm = $man->weight;
						            } else {
						                $wm = $man->measure;
						            }
						           $totsub =  $totppn = 0;
								@endphp
								@foreach ($tarif as $trf)
										@php
											if ( $trf->is_adm == 0)
											{
												$min = round($wm);
											}
											else	
											{
												$min = 1;				
											}
											
											$jumlah = $min * $trf->tarif;
											$totsub = $totsub + $jumlah ;
										@endphp
									<tr>
										<td style="width: 55%">{{ $trf->item }}</td>
										<td style="width: 25%" class="text-right">{{ $trf->tarif }}</td>
										<td style="width: 5%" class="text-center">{{ $min }}</td>
										<td style="width: 15%" class="text-right">{{ Rupiah($jumlah)  }} </td>
									</tr>
								@endforeach
							</tbody>
							@php
								$totppn = $totsub * 0.1 ;
								$tmptot = $totsub + $totppn ;
								$materai = 0;

								if ($tmptot > 5000000)
									$materai = 10000;

								 $grandtot = $tmptot + $materai;
							@endphp
							<tr>
								<td colspan="3" class="text-right">Subtototal</td>
								<td class="text-right">{{ Rupiah($totsub) }}</td>
							</tr>
							<tr>
								<td colspan="3" class="text-right">PPN</td>
								<td class="text-right">{{ Rupiah($totppn) }}</td>
							</tr>
							<tr>
								<td colspan="3" class="text-right">Materai</td>
								<td class="text-right">{{ Rupiah($materai) }}</td>
							</tr>
							<tr>
								<td colspan="3" class="text-right">Grand Total </td>
								<td class="text-right">{{ Rupiah($grandtot) }}</td>
							</tr>
						</table>
						@if ($man->gen_inv == 1)
							<a href="{{ '/MEM_'.$man->idp.'.pdf' }}" target="_blank">
							<span class="badge badge-secondary">Done</span>
							</a>
						@endif


				</div>
			</div>
		</div>
	</div>



@endsection	