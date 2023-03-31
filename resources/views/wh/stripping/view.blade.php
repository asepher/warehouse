@extends('layouts.master')

@section('title')
	Draft Invoice
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
      <h1>View Stripping</h1>
   </div><!-- /.page-header -->

	<div class="row">		
		<div class="col-xs-11">
			<div class="widget-box widget-color-blue2">
				<div class="widget-header">
					<h5 class="widget-title smaller">View</h5>
					<div class="widget-toolbar ">

  							<div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                              <li>
                              	<a href="{{ route('wh.stripping.vessel',[$vsl]) }}">Add New</a>
                              </li>
                           </ul>
                     </div><!-- /.btn-group -->


					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">
 

						<div class="row">
							<div class="col-md-10">


						<table class="table">
							<tr>
								<th style="width:5px">#</th>
								<th style="width:100px">Tgl Stripping</th>
								<th>Keterangan</th>
								<th>Photo</th>
								<th>x</th>
							</tr>
							@php
								$no = 1;
							@endphp
							@foreach ($stripping as $strip)

								<tr>
									<td valign="center"> {{ $no++ }}</td>
									<td valign="center"> {{ $strip->tgl_stripping }} </td>
									<td valign="center"> {!! nl2br($strip->keterangan) !!}</td>
									<td style="width:250px"> 
										<center>
											<a href="{{ url('upload/'.$strip->photo) }}" target="_blank">
										<img src="{{ url('upload/'.$strip->photo) }}" alt=""
										width="150px" height="100px">
										</a>
										</center>
									</td>
									<td width="5px">



                                 <div>
                                 <div class="inline position-relative">
                                     <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                         <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
                                     </a>
                                     <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                                         <li>
                                             <a href="{{ route('wh.stripping.edit',[$vsl,$strip->id]) }}">
                                                 Edit
                                               </a>
                                           </li>
                                           <li class="divider"></li>

 								<li>
                                    <a href="{{ route('wh.stripping.delete',[$strip->id]) }}"
                                    onclick="event.preventDefault();
		                                       document.getElementById('dele-form').submit();"
                                    @if (Auth::user()->user_type !== 'SuperAdmin')
                                    	style="pointer-events: none; color: red;" 
                                    @endif                                   
                                    >Delete</a>

                                    <form id="dele-form" 
		                                  action="{{ route('wh.stripping.delete',[$strip->id]) }}" 
		                                       method="POST">
		                                       {{ csrf_field() }}
		                                  <input type="hidden" name="vsl" value="{{ $vsl }}">     
		                               </form>
                              </li>                                           
                                     </ul>
                                 </div>
                                 </div>



									</td>
								</tr>

							@endforeach
						</table>


								
							</div>
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>


@endsection