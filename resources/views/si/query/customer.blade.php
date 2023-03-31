@extends('layouts.master')

@section('judul_page')
	Daftar Customer
@endsection

@section('content')

	<div class="card">
		<div class="card-body">

			<div class="row">
              <div class="col-lg-8">
				<h4>Query Shipping Instruction</h4>			
              </div>
          	</div>		
			<hr>

			<div class="row">
				<div class="col-md-12">
					
				<table class="table table-sm table-hover" id="data-table">
					<thead>
						<tr class="bg-light">
							<th class="text-center">#</th>
							<th class="text-center">Customer</th>
							<th class="text-center">x</th>
							<th class="text-center">x</th>							
						</tr>						
					</thead>	
					<tbody>
						@php
							$no = 1;
						@endphp					
						@foreach ($customer as $cus)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $cus->customer }}</td>
								<td>
								<form class="form-horizontal" role="form" action="/si/pilih" method="post">
								{{ csrf_field() }}

										<input type="hidden" name="id" value="{{$cus->kd_cus}}">
										<select name="service" class="form-control">
											<option value="">-- Pilih --</option>
											<option value="soa">SOA</option>
										</select>

								</td>
								<td>
									<button type="submit" class="btn btn-primary btn-sm"> >></button>
								</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>


				</div>
			</div>


		</div>
	</div>

@endsection