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
      <h1>Form Paid</h1>
   </div><!-- /.page-header -->

	<div class="row">		
		<div class="col-xs-11">
			<div class="widget-box widget-color-blue2">
				<div class="widget-header">
					<h5 class="widget-title smaller">INVOICE</h5>
					<div class="widget-toolbar ">

  							<div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                              <li>
                                    <a href="{{ route('wh.invoice.unpaid',[$vsl]) }}"
                                    onclick="event.preventDefault();
		                                       document.getElementById('view-form1').submit();"
                                    @if (Auth::user()->user_type !== 'AdminWh')
                                    	style="pointer-events: none; color: red;" 
                                    @endif
                                    >Unpaid</a>

                                    <form id="view-form1" 
		                                  action="{{ route('wh.invoice.unpaid',[$vsl]) }}" 
		                                       method="POST">
		                                       {{ csrf_field() }}
		                                  <input type="hidden" name="kd_inv" value="{{$kd_inv}}">     
		                                </form>
                              </li>
                           </ul>
                     </div><!-- /.btn-group -->


					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">
 

					<form class="form-horizontal" role="form" action="{{ route('wh.invoice.paid',[$vsl]) }}"
						method="post">
						{{ csrf_field() }}
						<input type="hidden" name="kd_inv" value="{{$kd_inv}}">     


						<div class="row">
								<div class="form-group">
									<label class="control-label col-sm-2">Date </label>				
									<div class="col-md-3 text-end">							
										<input type="date" class="form-control datepicker-input" name="tgl_paid" required 
										value="{{ $tgl }}"
											@if ($man->paid == 1)
												Disabled 
											@endif
										 >
									</div>
									<div class="col-md-5" style="text-align: center;">
										<h4> {{ Helper::FormatInvWh($man->kd_inv) }} - {{ $man->term }}</h4> 
									</div>

							</div>			
						</div>			

						<div class="row">
							<div class="form-group">								
								<label class="control-label col-sm-2">Paid At</label>			
								<div class="col-md-3">		
									<select name="paid_at" class="form-control">
										<option value="1" selected>EDC</option>
										<option value="2">Transfer</option>
									</select>
								</div>
								<div class="col-md-2 text-end">
											<button type="submit" class="btn btn-danger btn-sm px-3"
											@if ($man->paid == 1)
												Disabled 
											@endif
											>Submit Paid At</button>					
								</div>
							</div>
						</div>
							

						</form>
<p></p>
						<div class="row">
							<div class="col-md-12">								
									@php
										if ($man->term == 'FOB') {
											$bill_to_name 		= $man->bill_to_name;
											$bill_to_address 	= $man->bill_to_address;
											$bill_to_npwp 		= $man->bill_to_npwp;			
										}
										if ($man->term == 'CNF'){
											$bill_to_name 		= $man->cnee_name;
											$bill_to_address 	= $man->cnee_address;
											$bill_to_npwp 		= $man->cnee_npwp;
											$weight   				= $man->min;			
										}
									@endphp								

									<table class="table table-sm">	
										<tr>	
											<td style="width: 100px"><strong>Bill To</strong></td>
											<td>: {{ $bill_to_name }}</td>
										</tr>
										<tr>	
											<td><strong>Address</strong></td>
											<td>: {{ $bill_to_address }}</td>
										</tr>
										<tr>	
											<td><strong>NPWP</strong></td>
											<td>: {{ $bill_to_npwp }}</td>
										</tr>
									</table>					
							</div>							
						</div>


	


					</div>
				</div>
			</div>
		</div>
	</div>

@endsection