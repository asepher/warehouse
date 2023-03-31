@extends('layouts.applogin')

@section('title')
	Generate View Invoice
@endsection

@section('content') 

	@php 	
		 $tgl=date('Y-m-d');
	@endphp
 


			<div class="card-header bg-transparent">
                <div class="row g-3 align-items-center">
                  <div class="col">
                    <h5 class="mb-0">Create Manifest</h5>
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
         	
		
		<form class="form-horizontal" role="form" action="{{ route('wh.invoice.generate',[$nominv]) }}"
			method="post">
			{{ csrf_field() }}

			<div class="row align-items-center">
				
						<div class="col-md-2">
							<h4 class="mb-0">Generate</h4>
						</div>	

						<div class="col-md-2 text-end">							
							<input type="date" class="form-control datepicker-input" name="tanggal"
							value="{{ $tgl }}"
								@if ($man->gen_inv == 1)
									Disabled 
								@endif
							 >
						</div>
						<div class="col-md-2">
								<button type="submit" class="btn btn-white btn-sm px-3"
								@if ($man->gen_inv == 1)
									Disabled 
								@endif
								>Generate </button>					
						</div>							
			</div>			
			</form>
			
<p></p>

<div class="row">
				<div class="col-md-6 text-center">
					<h4>INVOICE</h4>
				</div>	
				<div class="col-md-4 text-center">
					<h4>{{ Helper::FormatInvWh($man->kd_inv) }}</h4>
				</div>
			</div>



	<div class="row">
				<div class="col-md-10 mx-auto">
					
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

						<table class="table align-middle table-bordered">
							@foreach ($invhd as $e)
							<tr>
								<td><a href="{{ route('wh.invoice.pdfview',[$e->kd_inv]) }}"
									target="_blank">{{ $e->kd_inv }}</a></td>
							</tr>
							@endforeach
						</table>		
				</div>
			</div>






         </div>




@endsection	