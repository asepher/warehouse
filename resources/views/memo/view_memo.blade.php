@extends('layouts.applogin')

@section('title')
	View Memo
@endsection

@section('content')
	@php
		$tgl = date("Y-m-d");
	@endphp

	


			<div class="card-header bg-transparent">
                <div class="row g-3 align-items-center">
                  <div class="col">
                    <h5 class="mb-0">Create Memo</h5>
                    {{ $manifest->kd_vsl }}
                  </div>
                  <div class="col">
                    <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                      <div class="dropdown">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{ route('customer.create') }}">Add New</a>
                          </li>
                          <li><a class="dropdown-item" href="javascript:;">Another action</a>
                          </li>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                 </div>
         	</div>




			<div class="card-body">
				<div class="row">
								
					<form class="form-horizontal" role="form" action="{{ route('wh.memo.generate',[$nominv]) }}"   
										method="post">					
										{{ csrf_field() }}
						<div class="card-header py-2">
							<div class="row align-items-center">
								
										<div class="col-md-7">
											<h4 class="mb-0">View Memo</h4>
										</div>	

										<div class="col-md-3 text-end">							
											<input type="date" class="form-control datepicker-input" name="tanggal"
											value="{{ $tgl }}"
												@if ($manifest->gen_memo == 1)
													Disabled 
												@endif
											 >
										</div>
										<div class="col-md-2">
												<button type="submit" class="btn btn-white btn-sm px-3"
												@if ($manifest->gen_memo == 1)
													Disabled 
												@endif
												>Memo</button>					
										</div>							
							</div>							

						</div>	
						</form>



				</div>
			</div>
		

				</div>

					<div class="row">
						<div class="col-md-6 text-center">
							<h4>RELEASE MEMO</h4>
						</div>
						<div class="col-md-4 text-center">
							<h4>{{ Helper::FormatInvWh($manifest->kd_inv) }}</h4>
						</div>							
					</div>			

					<div class="row mx-auto">
						<div class="col-md-10">
						
						<table style="width: 100%" border="0">
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
							<td>ETA</td><td>: {{ $manifest->eta }}</td>
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


<p><br></p>


@endsection	