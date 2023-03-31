@extends('layouts.master')

@section('title')
	Generate Vessel
@endsection

@section('content')
		

		<div class="page-header">
			<h1>Data Vessel - {{ $vsl }}</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<div class="row">
						<div class="col-xs-10">
							
							<table class="table table-bordered">
								<thead11>
									<tr>
										<th class="center" style="width:10px">
											<label class="pos-rel">#</label>
										</th>
										<th>Container</th> 
										<th>FOB</th> 
										<th>DN</th> 
										<th style="width:50px">Action</th> 
									</tr>
								</thea1d>
								<tbody1>	
									@php
										$no = 1;						
									@endphp					
									@foreach ($container as $con)
										@php
											$juml	= App\Models\Manifest::where('kd_vsl',$vsl)
														->where('container',$con->container)
														->count();
										@endphp

									<tr>
										<td class="center" valign="center">
										{{ $no++ }}
										</td>										
										<td>{{ $con->container }}</td>
										<td>{{ $juml }}</td>
										<td>
											@php
												$cek	= App\Models\InvDnHeader::where('kd_vsl',$vsl)
															->where('container',$con->container)
															->count();
											@endphp
											@if ($cek > 0)
												<span class="badge badge-danger">
													<a href="#" style="color: white;">ready</a>
												</span>
											@else

											@endif
										</td>
										<td>
											<form action="{{ route('invoice.generate-vessel.view',[$vsl])}}" method="post">
												{{ csrf_field() }}
												<input type="hidden" name="cont" value="{{$con->container}}">
												<button type="submit" class="btn btn-primary btn-minier">Generate</button>
											</form>
										</td>
									</tr>
									@endforeach
								</tbod1y>
							</table>

						</div>
					</div>



			</div>
		</div>

@endsection
