@extends('layouts.app')

@section('title')
    Cost
@endsection

@section('content')


	<div class="container">
		<div class="row">

				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<h4>Preview Cost</h4>
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
										<td>: {{ Tglindo($hd->etd) }}</td>
									</tr>
									<tr>
										<td><strong>ETA </strong></td>
										<td>: {{ Tglindo($hd->eta) }}</td>
									</tr>
									<tr>
										<td><strong>Date of Issue </strong></td>
										<td>: {{ Tglindo($hd->tgl_release) }} </td>
									</tr>
								</table>

							</div>
						</div>

						<div class="row">
							<div class="col-sm-12 d-flex justify-content-center">					

								<table class="table table-sm table-hover" style="width: 75%; border: 1.5px solid black" cellpadding="2">
									<tr>
										<td style="border: 1px solid black;text-align:center;">
											<strong>Keterangan</strong>
										</td>
										<td style="border: 1px solid black;text-align:center">
											<strong>Cost</strong>
										</td>
									</tr>
									@php
										$total = 0;
									@endphp
									@foreach ($biaya as $dtl)
									<tr>
										<td>
											{{$dtl->keterangan}} 
										</td>
										<td style="text-align: right; border-left: 1px solid black;width: 30%">
											{{ Rupiah($dtl->jumlah) }} 
										</td>							
									</tr>
									@php
										$total = $total + $dtl->jumlah;
									@endphp
									@endforeach
									<tr>
										<td class="d-flex justify-content-end"><strong>Total</strong></td>
										<td style="text-align: right; border-left: 1px solid black">
											<strong>{{ Rupiah($total) }}</strong>
										</td>
									</tr>

								</table>
							</div>
						</div>

					</div>	{{-- end card body --}}	
				</div> {{-- end card --}}
				<p></p>

				<div class="card">
					<div class="card-body">
						<div class="row">
								<div class="col-md-6">
									<h4>Selling </h4>
								</div>
						</div>
						<hr>
						<div class="row d-flex justify-content-center">

							<table  class="table table-sm table-hover" style="width: 75%; border: 1.5px solid black" cellpadding="2">
									<tr>
										<td style="border: 1px solid black;text-align:center;">
											<strong>Keterangan</strong>
										</td>
										<td style="border: 1px solid black;text-align:center">
											<strong>Cost</strong>
										</td>
									</tr>	

									@php
										$totsell = 0;
									@endphp
									@foreach ($selling as $sell)
									<tr>
										<td>
											{{$sell->no_inv . $sell->tipe}} 
										</td>
										<td style="text-align: right; border-left: 1px solid black;width: 30%">
											{{ Rupiah($sell->grandtotal) }} 
										</td>							
									</tr>
									@php
										$totsell = $totsell + $sell->jumlah;
									@endphp
									@endforeach
									<tr>
										<td class="d-flex justify-content-end"><strong>Total</strong></td>
										<td style="text-align: right; border-left: 1px solid black">
											<strong>{{ Rupiah($totsell) }}</strong>
										</td>
									</tr>

							</table>

							
						</div> {{-- end row --}}

						 <div class="dropdown d-flex justify-content-center">
                                     <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                     Action
                                     </button>

                                     <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                         
                                           <li>
                                             <form action="{{ route('si.cost.exportpdf') }}" method="post" target="_blank">
                                                @csrf
                                                <input type="hidden" name="si" value="{{ $si }}">
                                                <button type="submit" class="btn btn-default btn-sm dropdown-item">Export PDF</button>
                                              </form>
                                           </li>
                                     </ul>
                               </div> 

						
					</div>
				</div>

			
		</div> {{-- end row --}}
	</div>

@endsection