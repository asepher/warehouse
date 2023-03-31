@extends('layouts.master')

@section('title')
	Upload Data Vessel
@endsection

@section('breadcrumb')
	<a href="{{ route('wh.vessel.index') }}">Vessel</a>
@endsection


@section('content')



	<div class="page-header">
		<h1>Upload Page</h1>
	</div>


<div class="row">		
		<div class="col-xs-11">
			<div class="widget-box widget-color-blue2">
				<div class="widget-header">
					<h4 class="widget-title smaller">Pilih File</h4>				
				</div>

				<div class="widget-body">
					<div class="widget-main no-padding">


					<div class="table-responsive">
						<table  class="table table-striped table-bordered table-hover" id="dynamic-table123">	
							<thead>						
							<tr class="bg-light">
						
								<td>Seq</td>
								<td>Term</td>
								<td>Cnee</td>
								<td>Kd Vessel</td>
								<td>Vessel</td>
								<td>Vls Bl</td>
								<td>Qty</td>
								<td>Packing</td>
								<td>x</td>
							</tr>
							</thead>
							<tbody>
							@foreach ($tmpwhimp as $tmp)
								<tr>
									<td>{{ $tmp->seq }}</td>
									<td>{{ $tmp->term }}</td>
									<td>{{ $tmp->cnee_name }}</td>
									<td>{{ $tmp->kd_vessel }}</td>
									<td>{{ $tmp->vessel }}</td>
									<td>{{ $tmp->hbl }}</td>
									<td>{{ $tmp->vls_bl }}</td>
									<td>{{ $tmp->qty . ' ' .$tmp->packing }}</td>

									<td class="text-center">




<div>
										    <div class="inline position-relative">
										        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
										            <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
										        </a>

										        <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
										            <li>
										               <a  href="{{ route('wh.upload.edit',
										               [$tmp->kd_vessel,$tmp->seq])}}" >Edit</a>

										            </li>
										            <li>
										             <a href="{{ route('wh.upload.addOne',[$tmp->id]) }}"
										               onclick="event.preventDefault();
										                document.getElementById('add-manifest').submit();">
												                {{ __('Add Manifest') }}
												            </a>

										            <form id="add-manifest" action="{{ route('wh.upload.addOne',[$tmp->id]) }}" method="POST" class="d-none">
										            	<input type="hidden" name='kd_vessel' value="{{ $tmp->kd_vessel}}">
										                @csrf
										            </form>
														
																								
										            </li>
										        </ul>
										    </div>
										</div>





										<div class="fs-5 ms-auto dropdown">
	                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i>
	                            </div>
	                              <ul class="dropdown-menu dropdown-menu-end">
	                                <li style="font-size: 14px">

												<form action="{{ route('wh.upload.delete',[$tmp->id]) }}" 
												method="post">						
													@csrf																		
													@method('delete')
													<button type="submit" class="dropdown-item" onclick="return confirm('Anda yakin menghapus data ?')" >Delete</button>
												</form>

	                               </li>
	                               <li><hr class="dropdown-divider"></li>
	                               <li style="font-size: 14px">

												<form action="" 
												method="post">						
													@csrf																		
													
													<button type="submit" class="dropdown-item" onclick="return confirm('Tambahkan ke Manifest  ?')" >Add Manifest</button>
												</form>

	                               </li>
	                              </ul>
	                          </div>



									</td>
								</tr>
							@endforeach
							</tbody>	
						</table>

					</div>

					<form action="{{ route('wh.upload.addAll') }}" method="post">
						@csrf
						<input type="hidden" name='vsl' value="{{ $vsl }}">
						<button type="submit" class="btn btn-sm">Add All Manifest</button>
					</form>

					</div>
				</div>
			</div>
		</div>
</div>


 


@endsection	