@extends('layouts.master')

@section('title')
   Country
@endsection

@section('breadcrumb')
   <a href="{{ route('country.index') }}">Country</a>
@endsection

 
@section('content')


   <!-- /.page-header -->
   <div class="page-header">
      <h1>Country</h1>
   </div><!-- /.page-header -->



 <div class="row">
    <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
              <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Add New</h4>
                  <div class="widget-toolbar">
                     
                  </div>
              </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">



          <form class="form-horizontal" action="{{ route('country.store') }}" method="POST">
					{{ csrf_field() }}

					<fieldset>

						<div class="form-group">
	                        <label class="col-sm-2 control-label"><strong>Kode</strong></label>
	                        <div class="col-sm-3">
	                            <input type="text" class="form-control" name="kd_neg" 
	                            	placeholder="Entry Kode.." value="{{ old('kd_neg') }}"
	                            	autocomplete="off" onkeyup="this.value = this.value.toUpperCase()">
	                            @if($errors->has('kd_neg'))
		                            <div class="text-danger">
		                                {{ $errors->first('kd_neg')}}
		                            </div>
		                        @endif
	                        </div>
	                    </div>

						<div class="form-group">
	                        <label class="col-sm-2 control-label"><strong>Negara</strong></label>
	                        <div class="col-sm-4">
	                            <input type="text" class="form-control" name="negara" placeholder="Entry Negara.."
	                            value="{{ old('negara') }}" autocomplete="off" >
	                            @if($errors->has('negara'))
		                            <div class="text-danger">
		                                {{ $errors->first('negara')}}
		                            </div>
		                        @endif
	                        </div>
	                    </div>

	    				<div class="form-group">			
	    						<label class="col-sm-2"></label>
	    							<div class="col-sm-5">
							        <button type="submit" class="btn btn-sm btn-primary px-5">Save</button>				
	    							</div>
						</div>

						</fieldset>
					</form>


                  </div>
              </div>
         </div>
    </div>
</div>

<hr>

 <div class="row">
    <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
              <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Country</h4>
                  <div class="widget-toolbar">
                     
                  </div>
              </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">


        	<div class="row">
        		<div class="col-md-7">
        			


								<table class="table align-middle" id="example">
									<thead class="bg-light">
										<th>#</th>
										<th>Kode</th>
										<th>Negara</th>
										<th class="text-center" style="width: 20px;">x</th>
									</thead>
									<tbody>
										@php
											$no=1;
										@endphp
										@forelse ($country as $n)
										<tr>
											<td>{{ $no++ }}</td>
											<td>{{ $n->kd_neg }}</td>
											<td>{{ $n->negara }}</td>
										 	<td class="text-center">




                           <div>
                                  <div class="inline position-relative">
                                      <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                          <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
                                      </a>

                                      <ul class="dropdown-menu dropdown-lighter dropdown-menu-right dropdown-100">
                                          <li>
                                             <a  href="{{ route('country.edit',[$n->id]) }}" >Edit</a>
                                          </li> 
                                          <li>
                                             <a  href="{{ route('country.destroy',[$n->id]) }}"
                                             onclick="event.preventDefault();
                                                     document.getElementById('posting-form').submit();"                                             
                                          >Delete</a>

                                          <form id="posting-form" action="{{ route('country.destroy',[$n->id]) }}" method="POST">
                                             {{ csrf_field() }}
                                             
                                          </form>


                                          </li>
                                      </ul>
                                  </div>
                              </div>




						                    </td>
										</tr>	
										@empty
										<tr>
											<td colspan="3">No Record</td>
										</tr>	
										@endforelse

									</tbody>
								</table>
													


			        		</div>
			        	</div>          	
			           	
                  </div>
                </div>
              </div>
    </div>
   </div>







<hr>

	

@endsection