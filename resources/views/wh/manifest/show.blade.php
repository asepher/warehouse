@extends('layouts.master')

@section('title')
	Show Data Manifest
@endsection

@section('breadcrumb')
	<a href="{{ route('wh.vessel.index') }}">Vessel</a>
@endsection

@section('content')



	<div class="page-header">
		<h1>Show Data Manifest</h1>
	</div>

		<div class="row">
			<div class="col-md-11">
				
				<div class="widget-box widget-color-blue2">
					<div class="widget-header">
						<h5 class="widget-title">Header Manifest</h5>
					</div>
					<div class="widget-body">
						<div class="widget-main">
							<div class="row">
									<div class="col-sm-6">
										<table class="table">
											<tr>
												<td  style="width: 100px"><strong>Vessel</strong></td>
												<td>: {{ $vsl }} - {{ $vessel->vessel }}</td>
											</tr>
											<tr>
												<td  style="width: 100px"><strong>ETA</strong></td>
												<td>: {{ Helper::TglIndo($vessel->eta) }}</td>
											</tr>
										</table>
									</div>
									<div class="col-sm-6">
										<table class="table">
											<tr>
												<td  style="width: 100px"><strong>VLS BL</strong></td>
												<td>: {{ $vessel->vls_bl }} </td>
											</tr>
											<tr>
												<td  style="width: 100px"><strong>Jumlah Pos</strong></td>
												<td>: {{ $vessel->jum_pos }} </td>
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

			<div class="widget-box widget-color-blue2">
				<div class="widget-header widget-header-flat">
					<h5 class="widget-title">Show Data Manifest</h5>			
				</div>

				<div class="widget-body">
					<div class="widget-main no-padding">

						<table class="table table-bordered table-striped">
							<tr>
								<td style="width:30%"><strong>Term</strong></td>
								<td>{{ $man->term }}</td>
							</tr>
							<tr>
								<td><strong>Bill To Name</strong></td>
								<td><strong>{{ $man->bill_to_name }}</strong> <br>
								 {!! nl2br($man->bill_to_address) !!}</td>
							</tr>
							<tr>
								<td><strong>Consignee</strong></td>
								<td><strong>{{ $man->cnee_name }}</strong> <br> 
									{!! nl2br($man->cnee_address) !!} </td>
							</tr>
							<tr>
								<td><strong>Forwader</strong></td>
								<td><strong>{{ $man->forwader_name }}</strong> <br> 
									{!! nl2br($man->forwader_address) !!}</td>
							</tr>
							<tr>
								<td><strong>Description</strong></td>
								<td>{!! nl2br($man->description) !!}</td>
							</tr>
					
						</table>



					</div>
				</div>

			</div>

		</div>
	</div>


			<div class="row">
				<div class="col-md-11">					

					<div class="widget-box widget-color-blue2">
						<div class="widget-header widget-header-flat">
							<h5 class="widget-title">Container</h5>			
						</div>

						<div class="widget-body">
							<div class="widget-main no-padding">

								<table class="table table-bordered table-striped">
									<tr>
										<td style="width:30%"><strong>Container No.</strong></td>
										<td>{{ $man->container}}</td>
									</tr>
									<tr>
										<td><strong>Seal No</strong></td>
										<td>{{ $man->seal }}</td>
									</tr>	
										<tr>
										<td><strong>POL</strong></td>
										<td>{{ $man->pol }}</td>
									</tr>	<tr>
										<td><strong>Vessel $ Voy</strong></td>
										<td>{{ $vessel->vessel }}</td>
									</tr>	
									<tr>
										<td> <strong>Eta</strong> </td>
										<td> {{ $vessel->eta }} </td>
									</tr>
									<tr>
										<td> <strong>HBL</strong> </td>
										<td> {{ $man->hbl }} </td>
									</tr>
									<tr>
										<td> <strong>VLS BL</strong> </td>
										<td> {{ $vessel->vls_bl }} </td>
									</tr>
								</table>



							</div>
						</div>
					</div>

				</div>
			</div>


			<div class="row">
				<div class="col-md-11">					

					<div class="widget-box widget-color-blue2">
						<div class="widget-header widget-header-flat">
							<h5 class="widget-title">Quantity</h5>			
						</div>

						<div class="widget-body">
							<div class="widget-main no-padding">


								<table class="table table-bordered table-striped">
									<tr>
										<td style="width:30%"><strong>Qty</strong></td>
										<td>{{ $man->qty . ' '. $man->sat_qty }}</td>
									</tr>
									<tr>
										<td><strong>Weight</strong></td>
										<td>{{ $man->weight }}</td>
									</tr>
									<tr>
										<td><strong>Measure</strong></td>
										<td>{{ $man->measure }}</td>
									</tr>
								</table>





							</div>
						</div>
					</div>
		

				</div>
			</div>


@endsection