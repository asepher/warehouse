@extends('layouts.master')

@section('title')
	Shipping Instruction
@endsection

@section('breadcrumb')
	<a href="{{ route('customer.index') }}">Shipping</a>
@endsection

@section('content')


    <!-- /.page-header -->
   <div class="page-header">
      <h1>Shipping Instruction </h1>
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
                                    <a href="{{ route('si.create.job') }}"
                                        style="color: red;" disable >Create Job</a>
                                 </li>
                            


                           </ul>
                        </div><!-- /.btn-group -->
	               </div>
	            </div>
	            <div class="widget-body">
	               <div class="widget-main no-padding">


			<table id="dynamic-table" class="table table-striped table-bordered table-hover">
						<thead>
							<tr class="bg-light">
								<th class="text-center">#</th>
								<th class="text-center">Ref</th>
								<th class="text-center">Services</th>	
								<th class="text-center">CNEE</th>
								<th class="text-center">Coo</th>
								<th class="text-center">pol/pod</th>
								<th class="text-center">eta/etd</th>
								<th class="text-center">Vessel</th>						
								<th class="text-center">x</th>

							</tr>						
						</thead>	
						<tbody>
							@php
								$no = 1 ;
							@endphp
							@forelse ($shipping as $si)
 
								@php	
									  $hit = App\Models\InvSiHeader::where('kd_si',$si->kd_si)->count();  
								    //$status = $cek->is_posting;
								    $cust = App\Models\Customer::where('kd_cus',$si->kd_cus)->first();  
								@endphp
 
								<tr>
									<td class="text-center" >{{ $no++ }}</td>
									<td
									@if ($si->is_posting == 1 )
										style="color: red;"
									@endif
									>{{ $si->kd_si }}</td>
									<td>{{ $si->service."/".$si->tipe }}</td>
									<td>{{ $cust->customer }}</td>
									<td>{{ $si->coo }}</td>
									<td>{{ $si->pol . '/' . $si->pod }}</td>
									<td>{{ Helper::TglIndo($si->eta) . '/' . Helper::TglIndo($si->etd) }}</td>
									<td>{{ $si->vessel  }}</td>							
									<td class="text-center">

 
  

			<div>
										    <div class="inline position-relative">
										        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
										            <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
										        </a>

										        <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
										            <li>
										               <a  href="{{ route('si.edit',[$si->kd_si]) }}"
										               	@if ($hit >= 1  )
																		style="pointer-events: none; color:red" 
																@endif
										               	>Edit</a>
										            </li>
										            <li class="divider"></li>
										            <li>
										            	<a  href="{{ route('si.aju.input',[$si->kd_si]) }}">
										            		Input Aju</a>
										            </li> 
										            <li>
										            	<a  href="{{ route('si.view.detail',[$si->kd_si]) }}">
										            		Create Invoice</a>
										            </li>
										        </ul>
										    </div>
										</div>




									</td>	
								</tr>
							@empty
								<tr>
									<td colspan="9" class="font-w500 font-size-sm text-center">No Record</td>
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
