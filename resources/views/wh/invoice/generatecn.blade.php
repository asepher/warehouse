@extends('layouts.master')

@section('title')
	Generate CN
@endsection

@section('breadcrumb')
	<a href="{{ route('wh.manifest.index',[$vsl]) }}">Vessel</a>
@endsection


@section('content')



	<div class="page-header">
		<h1>Generate Credit Note </h1>
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
									Data vessel {{ $vessel->vessel }}  tidak ada  data CNF !
					</div>

				</div>
		</div>

@else 





@foreach ($container as $ctn)
@php				
	//$query 	= DB::table('manifest')->where('kd_vsl', $vsl)->count();
	$cek = App\Models\Harian::where('id',0)->count();  											
	$inv = App\Models\InvWhMaster::where('container',$ctn->container)->first();  
	//$manifest = App\Models\Manifest::where('term','FOB')->get();  
@endphp
		<div class="row">		
				<div class="col-xs-11">
					<div class="widget-box widget-color-blue2">
						<div class="widget-header">
							<h4 class="widget-title smaller">
							Container {{ $ctn->container }}  - INV ...  </h4>		
								<div class="widget-toolbar">
										
				   					<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
												Action
												<span class="ace-icon fa fa-caret-down icon-on-right"></span>
											</button>
											<ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
												<li>
													<a href="{{ route('wh.invoice.genpdf-cn.print',[$vsl]) }}"
															onclick="event.preventDefault();
                              document.getElementById('view-form2').submit();"
                              @if ($cek >= 1)
                                disabled 
                              @endif
													>Generate PDF</a>
													
												 	<form id="view-form2" 
                              action="{{ route('wh.invoice.genpdf-cn.print',[$vsl]) }}" 
                              method="POST" target="_blank">
                              {{ csrf_field() }}
                                 <input type="hidden" name="container" value="{{ $ctn->container}}">
                            </form>
	 

												</li>													
											</ul>
										</div><!-- /.btn-group -->
									</div>


							</div>
				
						<div class="widget-body">
							<div class="widget-main">
															@php
								$ttotal = 0;							 						
							@endphp

									
									 <table class="table table-bordered">
							@foreach ($manifest as $man)
								
								 		<tr>
								 			<th>{{ $man->seq . ' ' . $man->cnee_name }}</th>
								 		</tr>
								 		<tr>
								 			<td> 
								 				<table style="width: 70%;">
									 					@foreach ($tarif as $trf)
									 					@php
									 						$jumlah = $man->min_actual * $trf->charge;
									 					@endphp
									 						@if ($trf->is_adm == 2)
										 						<tr>
										 							<td>{{ $trf->nama_tarif }}</td>	
										 							<td style="text-align: center;">{{ Helper::Rupiah($trf->charge)  }}</td>
										 							<td style="text-align: center;">{{ number_format($man->min_actual,4) }}</td>
																	<td style="width: 20%;text-align: right;">{{ Helper::Rupiah($jumlah) }}</td>
										 						</tr>
										 							@php
																 		$ttotal = $ttotal + $jumlah;
																 	@endphp

									 						@endif											 						
									 					@endforeach								 					
								 				</table>
								 			</td>
								 		</tr>
								
								   @php
								    	//$ttotal = 0;
								    	$vtot = $ttotal* 0.11;
								    	$grandtot = $ttotal + $vtot;
								    @endphp								 
							@endforeach	
						</table>
							<table class="table table-bordered" style="width: 70%;">
										<tr>
											<td>Total</td>
											<td style="width: 20%;text-align: right;font-weight: bold;">{{ Helper::Rupiah($ttotal) }}</td>
										</tr>
											<td >VAT</td>
											<td style="width: 20%;text-align: right;font-weight: bold;">{{ Helper::Rupiah($vtot) }}</td>
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
									</tr>
											<td >Grand Total</td>
											<td style="width: 20%;text-align: right;font-weight: bold;">{{ Helper::Rupiah($grandtot) }}</td>
										</tr>
									</table>	

									@php
										$cekMaster = App\models\InvWhMaster::where('kd_vsl',$vsl)
																->where('tipe','CN')->count();
									@endphp

									@if ($cekMaster >= 1)
											@php
												$getInv = App\models\InvWhMaster::where('kd_vsl',$vsl)->where('tipe','CN')->first();
												$nmfile  = $getInv->kd_inv . $getInv->tipe .".PDF";
											@endphp
											@if ($getInv->inv_dn == 1)
													<a href="{{ url('wh/'. $nmfile ) }}" class="btn btn-danger btn-sm" target="_blank">Invoice Ready</a>				
											@endif
									@endif



							</div>
								
						</div>

						</div>
				</div>
		</div>

@endforeach





@endif



 


@endsection	