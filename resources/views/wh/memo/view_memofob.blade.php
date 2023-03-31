@extends('layouts.master')

@section('title')
	View Memo 
@endsection

@section('breadcrumb')
	<a href="{{ route('wh.manifest.index',[$manifest->kd_vsl]) }}">Vessel</a>
@endsection

@section('content')
	@php
		$tgl = date("Y-m-d");
	@endphp


   <!-- /.page-header -->
   <div class="page-header">
      <h1>Generate Memo FOB</h1>
   </div><!-- /.page-header -->

 @if ($manifest->term == 'CNF')

			<div class="row">		
				<div class="col-xs-11">
					<div class="alert alert-block alert-danger">
						Memo belum bisa di generate!, Inv {{ Helper::FormatInvWh($manifest->kd_inv) }} belum ada. 
					</div>
				</div>
		</div>
   @endif



	<div class="row">		
		<div class="col-xs-11">
			<div class="widget-box widget-color-blue2">
				<div class="widget-header">
					<h5 class="widget-title smaller">MEMO</h5>
					<div class="widget-toolbar ">
						
  							<div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                              <li>
                                    <a href="#"
                                    onclick="event.preventDefault();
		                                       document.getElementById('view-form1').submit();"
                                    @if (Auth::user()->user_type !== 'SuperAdmin')
                                    	style="pointer-events: none; color: red;" 
                                    @endif
                                    >Unposting</a>

                                    <form id="view-form1" 
		                                  action="{{ route('wh.memo.uposting',[$vsl]) }}" 
		                                       method="POST">
		                                       {{ csrf_field() }}
		                                  <input type="hidden" name="invoice" value="{{$nominv}}">     
		                                </form>
                              </li>
                           </ul>
                     </div><!-- /.btn-group -->
 
					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">
														
														
								<form class="form-horizontal" role="form" action="{{ route('wh.memo.generate-memofob',[$nominv]) }}"
										method="post">					
										{{ csrf_field() }}

								<div class="row">
										<div class="form-group">
											<label class="control-label col-sm-2">Date </label>																
												<div class="col-md-3 text-end">							
															<input type="date" class="form-control datepicker-input" name="tanggal"
															value="{{ $tgl }}"
				@if (($manifest->gen_memo == 1 || $manifest->term == 'CNF'))
						Disabled 										
				@endif
															 >
														</div>
														<div class="col-md-2">
																<button type="submit" class="btn btn-danger btn-sm px-3"

													@if ($manifest->gen_memo == 1 || $manifest->term == 'CNF' )
															Disabled 
													@endif
													
																>Generate</button>					
														</div>	
														<div class="col-md-4" style="text-align: center;">
															<h4>{{ Helper::FormatInvWh($manifest->kd_inv) . ' - ' . $manifest->term }}</h4>
														</div>
										</div>
							</div>
					</form>


						<table  class="table">
							<tr>
								<td style="width: 120px"><strong>Bill To</strong></td><td style="width: 2px">:</td>
								<td>PT Agung Raya</td>
							</tr>
							<tr>
								<td><strong>Address</strong></td><td>:</td>
								<td>Jl Bangka No. 1 Gudang AGUNG RAYA Pelabuhan Tj Priok - Jakarta </td>
							</tr>
							<tr>
								<td><strong>Attent</strong></td><td>:</td>
								<td>Bpk Yusuf</td>
							</tr>
						</table>
				
						<p></p>




					</div>
				</div>


	</div>



	<div class="row">		
		<div class="col-md-12">
			<div class="widget-box widget-color-blue2">
				<div class="widget-header">
					<h5 class="widget-title smaller">PREVIEW</h5>
					<div class="widget-toolbar ">
					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">




							<div class="row">
								<div class="col-md-12">

					Dengan hormat,<p></p>
					Bersama ini kami ingin menyampaikan bahwa shipment dengan data - data yang di sebut dibawah ini :<p></p>
					<br>

									<table style="width: 100%">
						<tr>
							<td style="width: 15%">Customer</td><td style="width: 55%">: {{ $manifest->cnee_name }}</td>
							<td style="width: 15%"></td><td></td>
						</tr>
						<tr>
							<td>HB/L No</td><td>: {{ $manifest->hbl }}</td>
							<td>Quantity </td><td>: {{ number_format($manifest->qty,0) }}</td>
						</tr>
						<tr>
							<td>BL No</td><td>: {{ $manifest->vls_bl }}</td>
							<td>Type</td><td>: {{ $manifest->sat_qty }}</td>
						</tr>
						<tr>
							<td>Container</td><td>: {{ $manifest->container }}</td>
							<td>Gross Weight</td><td>: {{ $manifest->weight }}</td>
						</tr>
						<tr>
							<td>Vessel</td><td>: {{ $manifest->vessel }}</td>
							<td>Measure</td><td>: {{ $manifest->measure }}</td>
						</tr>
						<tr>
							<td>ETA</td><td>: {{ $manifest->eta }}</td>
							<td></td><td></td>
						</tr>
						<tr>
							<td valign="top">Description</td>
							<td colspan="3" style="white-space:wrap">
								@php
			            $value = Illuminate\Support\Str::limit($manifest->description, 50);
			            echo nl2br($value);
			          @endphp

							</td>

						</tr>
					</table>
					<p></p>	
					<table>
						<tr>
							<td>
								Mohon kiranya shipment tersebut  dapat di berikan ijin keluar dari gudang setelah menyelesaikan semua kewajiban RDM, Storage dan lain lainnya di PT AGUNG RAYA.				
							</td>
						</tr>
					</table>
					<p></p>
				<table>
						<tr>
							<td>
							Demikianlah penyampaian dari pihak kami dan atas perhatian serta kerja samanya kami mengucapkan terima kasih.
							</td>
						</tr>
					</table>
					<p></p>
					<p></p>
					<table border="0" width="85%">
						<tr>
							<td width='75%'></td><td>Hormat kami</td>
						</tr>
					</table>

						@if ($manifest->gen_note == 1)
							<a href="{{ '/MEM_'.$manifest->idp.'.pdf' }}" target="_blank">
								<span class="badge badge-secondary">Done</span>							
							</a>
						@endif

					<p></p>



								</div>
							</div>





					</div>
				</div>
			</div>
		</div>
	</div>








@endsection	