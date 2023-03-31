@extends('layouts.master')

@section('title')
	Input Tanggal
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
      <h1>Tanggal Stripping</h1>
   </div><!-- /.page-header -->

	<div class="row">		
		<div class="col-xs-11">
			<div class="widget-box widget-color-blue2">
				<div class="widget-header">
					<h5 class="widget-title smaller">Edit Form </h5>
					<div class="widget-toolbar ">

  							<div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                              <li>
                                    <a href="{{ route('wh.stripping.cancel') }}"
                                    onclick="event.preventDefault();
		                                       document.getElementById('view-form2').submit();"
                                    @if (Auth::user()->user_type !== 'SuperAdmin')
                                    	style="pointer-events: none; color: red;" 
                                    @endif
                                    style="pointer-events: none"; 
                                    >Unstripping</a>

                                    <form id="view-form-----1" 
		                                  action="{{ route('wh.stripping.cancel') }}" 
		                                       method="POST">
		                                       {{ csrf_field() }}
		                                  <input type="hidden" name="kd_inv" value="{{ $vsl }}">     
		                               </form>
                              </li>
                           </ul>
                     </div><!-- /.btn-group -->


					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">
 

					<form class="form-horizontal" role="form" action="{{ route('wh.stripping.update',[$vsl]) }}"
						method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<input type="hidden" name="id" value="{{$id}}">     


						<div class="row">
								<div class="form-group">
									<label class="control-label col-sm-2">Date </label>				
									<div class="col-md-3 text-end">							
										<input type="date" class="form-control datepicker-input" name="tgl_stripping" required 
										value="{{ $stripping->tgl_stripping }}"
											@if ($stripping->status_stripping == 1)
												Disabled 
											@endif
										 >
									</div>									
							</div>			
						</div>			

						<div class="row">
							<div class="form-group">								
								<label class="control-label col-sm-2">Keterangan</label>			
								<div class="col-md-5">		
									<textarea class="form-control" name="keterangan" rows="4">{{ $stripping->keterangan }}</textarea>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">								
								<label class="control-label col-sm-2">Photo</label>			
								<div class="col-md-5">		
									<input type="file" name="photo">
								</div>
							</div>
						</div>
 
						<div class="row">								
								<label class="control-label col-sm-2"></label>									
								<div class="col-md-5">
									<button type="submit" class="btn btn-danger btn-sm"
										@if ($stripping->paid == 1)
											Disabled 
										@endif
										>Submit 
									</button>					
								</div>
						</div>

						</form>
				<p></p>


					</div>
				</div>
			</div>
		</div>
	</div>

@endsection