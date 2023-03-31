@extends('layouts.master')

@section('title')
	Form Paid
@endsection

@section('breadcrumb')
	<a href="{{ route('wh.manifest.index',[$vsl]) }}">Vessel</a>
@endsection

@section('content')

	@php
		 $tgl=date('Y-m-d');
	@endphp

   <!-- /.page-header -->
   <div class="page-header">
      <h1>Form Tgl Debet Note</h1>
   </div><!-- /.page-header -->

	<div class="row">		
		<div class="col-xs-11">
			<div class="widget-box widget-color-blue2">
				<div class="widget-header">
					<h5 class="widget-title smaller">Entry Tanggal - INV {{ $kd_inv }}</h5>
					<div class="widget-toolbar ">

  						


					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">
 

	<form class="form-horizontal" role="form" 
	action="{{ route('wh.generate-pdf.inv-tgldn',[$vsl]) }}"
		method="post" target="_blank">
		<input type="hidden" name="kd_inv" value="{{ $kd_inv }}">
		{{ csrf_field() }}

						<div class="row">
								<div class="form-group">
									<label class="control-label col-sm-2">Date </label>				
									<div class="col-md-3 text-end">							
										<input type="date" class="form-control datepicker-input" name="tgl_invdn" required value="{{ $tgl }}"		
										 >
									</div>
									<div class="col-md-5" style="text-align: center;">
										<h4>{{ $kd_inv }}</h4> 
									</div>

							</div>			
						</div>			
							<div class="row">
							<div class="form-group">								
								<label class="control-label col-sm-2"></label>											
								<div class="col-md-2 text-end">
											<button type="submit" class="btn btn-danger btn-sm px-3"	
											>Print PDF</button>					
								</div>
							</div>
						</div>
					

						</form>
	


					</div>
				</div>
			</div>
		</div>
	</div>

@endsection