@extends('layouts.master')

@section('judul_page')
	Invoice By Vessel
@endsection


@section('breadcrumb')
    <a href="{{ route('wh.vessel.index') }}">Vessel</a>
@endsection

@section('content')
	@php
		$jumrec 	= DB::table('manifest')->where('kd_vsl', $vsl)->count();
		$jumcon 	= DB::table('container')->where('kd_vsl', $vsl)->count();
	@endphp


	<div class="page-header">
		<h1>Invoice By Vessel</h1>
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

<div class="row">
		<div class="col-md-11">
			
	@foreach ($container as $cont)	

			@php
				 $cek = App\Models\Harian::where('id',0)->count();  
			@endphp

			<div class="widget-box widget-color-blue2">
				<div class="widget-header">
					<h5 class="widget-title">Container {{ $cont->container }}</h5>
						<div class="widget-toolbar">

                     <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
                              Action
                              <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">                                                        
											 <li>
                                    <a  href="{{ route('wh.generate.invoicedn',[$vessel->kd_vsl]) }}"
                                    		onclick="event.preventDefault();
                                       	document.getElementById('posting-form{{$cont->id}}').submit();" 
                                          @if ($cek >= 1)
                                             disabled 
                                          @endif
                                          >Generate DN</a>

                                          <form id="posting-form{{$cont->id}}" 
                                          action="{{ route('wh.generate.invoicedn',[$vessel->kd_vsl]) }}" 
                                          method="POST">
                                          {{ csrf_field() }}
                                             <input type="hidden" name="container" value="{{ $cont->container }}">
                                          </form>


                                  </li>                                 
                            


                           </ul>
                        </div><!-- /.btn-group -->

                  </div>
				</div>
				<div class="widget-body">
					<div class="widget-main">

						@php
							$manifest   = App\Models\Manifest::where('container',$cont->container)
															->where('term','FOB')
															->get();
						@endphp

						<table class="table">
								<tr>
									<th>Cnee</th>
									<th>Hbl</th>
									<th>Qty</th>
									<th>Weight</th>									
									<th>Measure</th>									
								</tr>
								@foreach ($manifest as $man)
								<tr>
									<td width="40%">{{$man->cnee_name}}</td>
									<td>{{$man->hbl}}</td>
									<td>{{$man->qty . ' ' . $man->sat_qty}}</td>
									<td>{{$man->weight}}</td>
									<td>{{$man->measure}}</td>
								</tr>
								@endforeach	
								
						</table>

					</div>
				</div>	
			</div>

	@endforeach






	@php
	  $jumlahUser = Helper::jumlahUser()
	@endphp
	Jumlah : {{ $jumlahUser }}

@endsection	