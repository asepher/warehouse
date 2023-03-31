@extends('layouts.master')

@section('title')
	Generate Dn
@endsection

@section('breadcrumb')
	<a href="{{ route('wh.manifest.index',[$vsl]) }}">Vessel</a>
@endsection


@section('content')

	<div class="page-header">
		<h1>Generate Debet Note </h1>
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
											<td>: {{ $vessel->jum_pos }} |
												<strong>Cont </strong> : {{ $jumcon }}		
							
											</td>
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

@if ($flash == 0 )

		<div class="row">		
				<div class="col-xs-11">
					<div class="alert alert-block alert-success">
									Data vessel {{ $vessel->vessel }}  tidak ada  data FOB !
					</div>

				</div>
		</div>

@else 





@foreach ($container as $ctn)
@php				
	//$query 	= DB::table('manifest')->where('kd_vsl', $vsl)->count();
	$inv = App\Models\InvWhMaster::where('container',$ctn->container)->first();  
	$manifest = App\Models\Manifest::where('term','FOB')->where('container',$ctn->container)->get();  
@endphp
		<div class="row">		
				<div class="col-xs-11">
					<div class="widget-box widget-color-blue2">
						<div class="widget-header">
							<h4 class="widget-title smaller">
							Container {{ $ctn->container }} - Inv : {{ $inv->kd_inv }}</h4>		
								<div class="widget-toolbar">
										 
				   					<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
												Action
												<span class="ace-icon fa fa-caret-down icon-on-right"></span>
											</button>
											<ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
												<li>
													<a href="#"
														onclick="event.preventDefault();
                               				document.getElementById('view-form{{$ctn->id}}').submit();" 
															target="_blank" >Generate PDF</a>
			 				<form id="view-form{{$ctn->id}}" 
                   action="{{ route('wh.generate-pdf.invoicedn',[$vsl]) }}" 
                   method="POST" target="_blank" >
                   {{ csrf_field() }}
                   <input type="hidden" name="container" value="{{ $ctn->container}}"> 
              </form>

												</li>	
												<li>
														<a href="#"
														onclick="event.preventDefault();
                               				document.getElementById('tgldn-form{{$ctn->id}}').submit();" >Input Tanggal</a>
			 				<form id="tgldn-form{{$ctn->id}}" 
                   action="{{ route('wh.generate-pdf.form-tgldn',[$vsl]) }}" 
                   method="POST">
                   {{ csrf_field() }}
                   <input type="hidden" name="container" value="{{ $ctn->container}}">
                   <input type="hidden" name="kd_inv" value="{{ $inv->kd_inv}}">
              </form>
												</li>

											</ul>
										</div><!-- /.btn-group -->
									</div>


							</div>
				
						<div class="widget-body">
							<div class="widget-main">					
										@php
				 							$ttotal = 0;	$vtot = 0; $grandtot = 0; $rec = 0;
				 						@endphp							 					
									 <table class="table table-bordered">
								@foreach ($manifest as $man)
										
								 		<tr>
								 			<th>{{ $man->seq . ' - ' .$man->cnee_name }}</th>
								 		</tr>
								 		<tr>
								 			<td>
								 				<table style="width: 70%;">	
									 					@foreach ($tarif as $trf)									 							
									 					@php
									 								if ($trf->is_adm == 1){
									 									$wm = 1;
									 								} else {
									 									$wm = number_format($man->min_actual,4);
									 								}
									 								$jumlah = $wm * $trf->charge;
									 								$ttotal = $ttotal + $jumlah;
									 						@endphp
									 						<tr>
									 							<td>{{ $trf->nama_tarif }}</td>	
									 							<td style="text-align: center;">{{ Helper::Rupiah($trf->charge)  }}</td>
									 							<td style="text-align: center;">{{ $wm }}</td>
																<td style="width: 20%;text-align: right;">{{ Helper::Rupiah($jumlah) }}</td>
									 						</tr>
									 					@endforeach								 					
								 				</table>
								 			</td>
								 		</tr>
								

								   @php
											$rec = $rec +1;
								    	$vtot = $ttotal * 0.11;
								    	$grandtot = $ttotal + $vtot;
								    @endphp								 
							@endforeach	
							 </table>
								<table class="table table-bordered" style="width: 70%;">
										<tr>
											<td>Total</td>
											<td style="width: 20%;text-align: right;font-weight: bold;">{{ Helper::Rupiah($ttotal) }}</td>
										</tr>
										<tr>
											<td >VAT</td>
											<td style="width: 20%;text-align: right;font-weight: bold;">{{ number_format($vtot,2) }}</td>
										</tr>
										@if ($grandtot > 5000000)
											<tr>
												<td >MATERAI</td>
												<td style="width: 20%;text-align: right;font-weight: bold;">
													{{ Helper::Rupiah(Helper::Materai()) }}</td>
											</tr>										
											@php
												$grandtot = $grandtot + Helper::Materai();
											@endphp
											
										@endif
										<tr>
											<td >Grand Total</td>
											<td style="width: 20%;text-align: right;font-weight: bold;">{{ Helper::Rupiah($grandtot) }}</td>
										</tr>
										<tr>
											<td>Jumlah Record : <strong>{{ $rec }}</strong></td>
											<td></td>
										</tr>
									</table>									

							</div>
								
						</div>

						</div>
				</div>
		</div>

	@endforeach







@endif



 


@endsection	