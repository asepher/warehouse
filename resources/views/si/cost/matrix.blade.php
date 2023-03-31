@extends('layouts.master')

@section('judul_page')
	Cost
@endsection

@section('content')
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h4>Profit / Lost</h4>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-6">

					<table class="table table-sm table-hover" >
						<tr>
							<td style="width: 150px"><strong> Si Ref </strong></td>
							<td> : {{ $si }} </td>
						</tr>
						<tr>
							<td><strong> Country of Origin </strong></td><td> : {{ $hd->coo }} </td>
						</tr>
						<tr>
							<td><strong> Port of Loading </strong></td><td>: {{ $hd->pol }}</td>
						</tr>

						<tr>
							<td><strong> Port of Discharge </strong></td><td>: {{ $hd->pod }}</td>
						</tr>

						<tr>
							<td><strong> Vessel </strong></td><td>: {{ $hd->vessel }}</td>
						</tr>
						
					</table>

				</div>
				<div class="col-sm-6">

					<table class="table table-sm table-hover">
						<tr>
							<td style="width: 150px"><strong>BL No</strong></td>
							<td>: {{ $hd->bl }}</td>
						</tr>
						<tr>
							<td><strong>ETD</strong></td>
							<td>: {{ UserHelp::tglindo($hd->etd) }}</td>
						</tr>
						<tr>
							<td><strong>ETA </strong></td>
							<td>: {{ UserHelp::tglindo($hd->eta) }}</td>
						</tr>
						<tr>
							<td><strong>Date of Issue </strong></td>
							<td>: {{ UserHelp::tglindo($hd->tgl_release) }} </td>
						</tr>
					</table>

				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">					
					<table class="table table-sm table-hover" style="width: 90%; border: 1.5px solid black">
						<tr>
							<td colspan="2" style="border: 1px solid black">
								<strong>Cost</strong>
							</td>
						</tr>
							@php
								$totalCost = 0;
							@endphp
							@foreach ($biaya as $dtl)
							<tr>
								<td>
									{{$dtl->keterangan}} 
								</td>
								<td style="text-align: right; border-left: 1px solid black;width: 30%">
									{{ UserHelp::rupiah($dtl->jumlah) }} 
								</td>							
							</tr>
							@php
								$totalCost = $totalCost + $dtl->jumlah;
							@endphp
							@endforeach	
						<tr>
							<td><strong>Total Cost</strong></td>
							<td style="text-align: right; border-left: 1px solid black">
							{{ UserHelp::rupiah($totalCost) }}</td>
						</tr>												
						<tr>
							<td colspan="2" style="border: 1px solid black">
								<strong>Invoice</strong>
							</td>
						</tr>
							@php
								$total = 0;
							@endphp
							@foreach ($invoice as $inv)
							<tr>
								<td>
									{{$inv->no_inv . $inv->tipe}} 
								</td>
								<td style="text-align: right; border-left: 1px solid black;width: 30%">
									{{ UserHelp::rupiah($inv->grandtotal) }} 
								</td>							
							</tr>
							@php
								$total = $total + $inv->grandtotal;
							@endphp
							@endforeach						

						<tr>
							<td><strong>Total Inv</strong></td>
							<td style="text-align: right; border-left: 1px solid black">
							{{ UserHelp::rupiah($total) }}</td>
						</tr>
					</table>

					@php
						$hitung = $total - $totalCost ;
					@endphp

					@if ( $total > $totalCost )
						<strong>Profit</strong>  - {{ UserHelp::rupiah($hitung) }}
					@else	
						<strong>Lost</strong> - {{ UserHelp::rupiah($hitung) }}
					@endif
				</div>
			</div>


		</div>		
	</div>
@endsection