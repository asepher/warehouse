@extends('layouts.master')

@section('title')
	Index Data Manifest
@endsection

@section('breadcrumb')
	<a href="{{ route('wh.vessel.index') }}">Vessel</a>
@endsection

@section('content')

	<div class="page-header">
		<h1>Data Manifest</h1>
	</div>

	<div class="row">		
		<div class="col-xs-11">
			<div class="widget-box widget-color-blue2">
				<div class="widget-header">
					<h5 class="widget-title smaller">Header</h5>
				</div>
				<div class="widget-body">
					<div class="widget-main">

							<div class="row">
								<div class="col-sm-12">
									<div class="col-sm-6">
											<table class="table">
												<tr>
													<td style="width: 100px"><strong>Vessel</strong></td>
													<td>: {{ $vsl }} - {{ $vessel->vessel }}</td>
												</tr>
												<tr>
													<td><strong>ETA</strong></td><td>: {{ date("d-m-Y",strtotime($vessel->eta)) }}</td>
												</tr>
												<tr>
													<td><strong>Container</strong></td><td valign="top">: {{ $vessel->container }} </td>
												</tr>
											</table>
									</div>
									<div class="col-sm-6">
											<table class="table">
												<tr>
													<td style="width: 100px"><strong>VLS BL</strong></td><td>: {{ $vessel->vls_bl }} </td>
												</tr>
												<tr>
													<td><strong>Jumlah Pos</strong></td><td>: {{ $vessel->jum_pos }} </td>
												</tr>
											</table>
									</div>

								</div>							
							</div>

					</div>
				</div>
			</div>
		</div>


	</div>

	<div class="row">
		<div class="col-xs-11">
			<div class="widget-box widget-color-blue2">
				<div class="widget-header">

					<h5 class="widget-title smaller">Detail </h5>
						<div class="widget-toolbar">

 @if ( Auth::user()->dept == 'GM' )


						@php				
							$query 	= DB::table('manifest')->where('kd_vsl', $vsl)->count();
						@endphp
   					<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
								Action
								<span class="ace-icon fa fa-caret-down icon-on-right"></span>
							</button>
							<ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
								<li>
									<a href="{{ route('wh.manifest.create', [$vsl]) }}" style="color: red;pointer-events: none;" 
									@if ($query >= $vessel->jum_pos)
										 style="color: red;pointer-events: none;" 
									@endif
									 >Create
									</a>
								</li> 
								<li>
									<a href="{{ route('wh.manifest.destroy', [$vsl]) }}" 
										 		onclick="event.preventDefault();
	                      document.getElementById('dele-all').submit();"
									 	 @if (Auth::user()->dept == 'GD' &&  Auth::user()->user_type == 'AdminWH')
                            style="color: red;pointer-events: none;" 
                     @endif                      
									     onclick="return confirm('Yakin')" >Delete All
									</a>
									<form  id="dele-all" action="{{ route('wh.manifest.destroy',[$vsl]) }}" method="POST">
                    @csrf      
                  </form>
								</li> 
								<li class="divider"></li>
									<li>
                     <a href="{{ route('wh.generate.invoicedn',[$vsl]) }}"
											 @if (Auth::user()->dept == 'GD' )
                            style="color: red;pointer-events: none;" 
                       @endif
                     >Generate for DN 
                     </a>                     
                 </li>
									<li>
                     <a href="{{ route('wh.generate.invoicecn',[$vsl]) }}"
											 	@if (Auth::user()->dept == 'GD' )
                            style="color: red;pointer-events: none;" 
                      	@endif
                     	>Generate for CN
                     </a>
                 </li>
								<li class="divider"></li>                 
								<li>
									<a href="{{ route('wh.upload.vessel',[$vsl]) }}"
 									@if (Auth::user()->dept == 'GD' )
                                        style="color: red;pointer-events: none;" 
                                    @endif
									>Upload</a>
								</li>													
							</ul>
						</div><!-- /.btn-group -->
	              
@endif       

						   </div>


				</div>
				<div class="widget-body">
					<div class="widget-main no-padding">
								
								<table class="table table-bordered table-striped" id="dynamic-table">
									<thead>
									<tr>
											<th class="text-center">#</th>
											<th class="text-center" width="250px">Consignee</th>
											<th class="text-center">Term</th>
											<th class="text-center">Cont</th>
											<th class="text-center">Seal</th>				
											<th class="text-center">HB/L</th>
											
											<th class="text-center" width="5px">Inv</th>
											<th class="text-center" width="5px">Paid</th>						
											<th class="text-center" width="5px">Memo</th>																	
									
											<th class="text-center" width="5px">x</th>								
									</tr>	
									</thead>					
								
									@php
										$no = 1;										
									@endphp
									<tbody>
									@forelse ($manifest as $man)
										<tr>						
											<td class="text-center" scope="row">{{ $no++  }}</td>					
											<td>{{ $man->cnee_name  }}</td>	
											<td>{{ $man->term  }}</td>	
											<td>{{ $man->container }}</td>
											<td>{{ $man->seal }}</td>
											<td>{{ $man->hbl }}</td>
											<td>
												@if ($man->tgl_inv !== null)
													<a href="{{ url('/wh/'.$man->kd_inv.$man->file_inv.'.PDF') }}" target="_blank">
														<span class="label label-sm label-success arrowed arrowed-right">{{ date('d-m-y',strtotime($man->tgl_inv)) }}</span>									
													</a>
												@endif
												
											</td>										
											<td>
												@if ($man->paid == 1)
													<span class="label label-sm label-danger arrowed arrowed-right">	
														{{date('d-m-y',strtotime($man->tgl_paid)) }}</span>							
												@endif
											</td>
											<td>
												@if ($man->gen_memo == 1)
													<a href="{{ url('/wh/'.$man->kd_inv.$man->file_mem.'.PDF') }}" target="_blank">
														<span class="label label-sm label-warning arrowed arrowed-right"
														>{{ date('d-m-y',strtotime($man->tgl_mem)) }}</span>							
													</a>
												@endif
											</td>
										
											<td class="text-center">
		 											

											<div>
												<div class="inline position-relative">
													<a href="#" data-toggle="dropdown" class="dropdown-toggle">
														<i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
													</a>

													<ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
														<li>
															<a class="dropdown-item" 
											        		href="{{ route('wh.manifest.edit',[
											        		$man->kd_vsl,$man->seq]) }}"
											        		@if ($man->gen_inv == 1)
											            	style="color: red;pointer-events: none;" 
											         		@endif
											         		>Edit</a>
														</li>													
														<li>
															<a class="dropdown-item" 
															href="{{route('wh.manifest.show',[$man->kd_inv])}}">
												      	View</a>
												     </li>
														
														<li class="divider"></li>

												
														<li style="font-size:14px">
																<a class="dropdown-item" 
																href="{{route('wh.invoice.view',[$man->kd_inv])}}">
													      	Invoice</a>
													   </li>
												     <li style="font-size:14px"><a class="dropdown-item" href="{{ route('wh.memo.view', [$man->kd_inv]) }}">
												      	Memo</a>
												     </li>													   
												 

													</ul>
												</div>
											</div>

 

												</td>
											</tr>

									@empty
										<tr>
											<td colspan="9">
												<center>No Record</center>
											</td>
										</tr>
									@endforelse

							 	</tbody>
							</table>







					</div>
				</div>
			</div>
		</div>
	</div>





@endsection 