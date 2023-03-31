@extends('layouts.master')

@section('judul_page')
    Query SI
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


			<table class="table table-sm table-hover" id="data-table12">
					<thead>
						<tr class="bg-light">
							<th class="text-center">#</th>
							<th class="text-center">SI</th>
							<th class="text-center">Serives</th>
							<th class="text-center">CNEE</th>						
							<th class="text-center">Vessel</th>
							<th class="text-center">x</th>
							<th class="text-center">x</th>							
						</tr>						
					</thead>	
					<tbody>
						@php
							$no=1;
						@endphp
						@foreach ($shipping as $si)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $si->kd_si }}</td>
								<td>{{ $si->service. "/" . $si->tipe }}</td>
								<td>{{ $si->cnee }}</td>
								<td>{{ $si->vessel }}</td>

								<form class="form-horizontal" role="form" action="/si/summary" method="post">
								{{ csrf_field() }}	
								
								<td>
									<input type="hidden" name="id" value="{{$si->kd_si}}">
										<select name="service" class="form-control">
											<option value="">-- Pilih --</option>
											<option value="summary">Summary</option>
										</select>

								</td>
								<td>
									<button type="submit" class="btn btn-primary btn-sm"> >></button>
								</td>
								</form>

								
							</tr>
						@endforeach
					</tbody>
				</table>


		</div>
	</div>
	

@endsection