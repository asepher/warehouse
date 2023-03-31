@extends('layouts.master')

@section('judul_page')
	Container
@endsection


@section('breadcrumb')
    <a href="{{ route('wh.vessel.index') }}">Vessel</a>
@endsection

@section('content')
	


	<div class="page-header">
		<h1>By Container</h1>
	</div>

	<div class="row">
		<div class="col-md-11">
			
			<div class="widget-box widget-color-blue2">
				<div class="widget-header">
					<h5 class="widget-title">Container</h5>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="row">
								<div class="col-sm-6">
									<table class="table">
										<tr>
											<td  style="width: 100px"><strong>Container</strong></td>
											<td>: {{ $container }} </td>
										</tr>
										<tr>
											<td  style="width: 100px"><strong>ETA</strong></td>
											<td>: {{ $row->eta }}</td>
										</tr>
									</table>
								</div><div class="col-sm-6">
									<table class="table">
										<tr>
											<td  style="width: 100px"><strong>Vessel</strong></td>
											<td>: {{ $row->vessel }}</td>
										</tr>
									</table>
								</div>
						</div>				
							

					</div>
				</div>
			</div>

		</div>
	</div>

<hr>

<div class="row">
		<div class="col-md-11">
			

			

			
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width: 250px">CNEE</th>
								<th style="width: 100px" class="text-center">TERM</th>							
								<th>x</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($manifest as $man)
							
							<tr>
								<td style="width: 200px">{{ $man->nmcustomer->customer }}</td>
								<td>{{ $man->term }}</td>
								<td width="5%">									

								</td>
							</tr>	
														
						@endforeach
						</tbody>
					</table>




		</div>
</div>



			<div class="row">

				<div class="col-md-10">
{{ $row->kd_vsl }}
					<form class="form-horizontal" role="form" 
					action="{{ route('wh.generate-invoice.bycont',[$container]) }}" 
					method="post">
					{{ csrf_field() }}
					<input type="hidden" name="kd_vsl" value="{{ $row->kd_vsl }}">

					<div class="form-group row m-b-10">						
						<label class="control-label col-sm-4 col-form-label"></label>
						<div class="col-sm-4">							
							<button type="submit" class="btn btn-danger btn-sm px-3"					
							>Generate By Container</button>	
						</div>

					</div>
					</form>
				</div>	
			</div>

@endsection	