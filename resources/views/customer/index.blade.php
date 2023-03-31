@extends('layouts.master')

@section('title')
	Data Customer
@endsection

@section('breadcrumb')
	<a href="{{ route('customer.index') }}">Customer</a>
@endsection

@section('content')


    <!-- /.page-header -->
   <div class="page-header">
      <h1>Data Customer </h1>
   </div><!-- /.page-header -->


   <div class="row">
       <div class="col-sm-11">

		

				<div class="widget-box widget-color-blue2">
	            <div class="widget-header widget-header-flat"> 
	               <h4 class="widget-title"></h4>
	               <div class="widget-toolbar">
							<div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
                              Action
                              <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right"> 
                              <li>
                                    <a href="{{ route('customer.create') }}"
                                     >Create</a>
                              </li>

                           </ul>
                        </div><!-- /.btn-group -->


 
	               </div>
	            </div>
	            <div class="widget-body">
	               <div class="widget-main no-padding">





					<table class="table table-striped table-bordered table-hover" id="dynamic-table">
							<thead>
								<tr>
									<th width="5%">#</th>
									<th>Kode</th>
									<th>NPWP</th>
									<th>Customer</th>
									<th>Address</th>
									<th width="5%">x</th>
								</tr>
							</thead>
							 @php
                            $no=1;
                     @endphp
                     <tbody>
							@foreach ($customer as $cus)
								<tr>
									<td class="center">{{ $no++ }}</td>
									<td>{{ $cus->kd_cus}}</td>
									<td>{{ $cus->npwp}}</td>
									<td>{{ $cus->customer}}</td>
									<td>{{ $cus->address}}</td>
									<td style="width: 3%;" class="center">


										<div>
										    <div class="inline position-relative">
										        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
										            <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
										        </a>

										        <ul class="dropdown-menu dropdown-default dropdown-menu-right">
										            <li>
										               <a  href="{{ route('customer.edit',[$cus->kd_cus]) }}"
										          @if (Auth::user()->user_type == 'AdminWh' &&  Auth::user()->dept == 'GD')
										              style="pointer-events:none;color:red;" 
										          @endif
													                  >Edit</a>
										            </li>
										            <li>
										            	<a  href="{{ route('customer.show',[$cus->kd_cus]) }}"
													                               	>View</a>

										            </li>
										            <li class="divider"></li>
										            <li>
															<a  href="{{ route('customer.destroy',[$cus->kd_cus]) }}" id="delete"
										          @if (Auth::user()->user_type == 'AdminWh' &&  Auth::user()->dept == 'GD')
										              style="pointer-events:none;color:red;" 
										          @endif

																>Delete</a>
										            </li>
										        </ul>
										    </div>
										</div>
						
									</td>
								</tr>
							@endforeach
							</tbody>

					</table>

					  
 

	               </div>
	            
	            </div>		            
	         </div>


 		</div>
	</div>




@endsection



