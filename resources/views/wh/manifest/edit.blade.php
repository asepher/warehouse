@extends('layouts.master')

@section('title')
	Index Data Manifest
@endsection

@section('breadcrumb')
	<a href="{{ route('wh.manifest.index',[$vsl]) }}">Vessel</a>
@endsection

@section('content')



	<div class="page-header">
		<h1>Edit Data Manifest</h1>
	</div>

		<div class="row">
			<div class="col-md-11">
				
				<div class="widget-box widget-color-blue2">
					<div class="widget-header">
						<h5 class="widget-title">Header Manifest</h5>
 							<div class="widget-toolbar">


								<div class="btn-group">
                         <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                         </button>

                         <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                            <li>
                               <a href="#">Delete</a>
                            </li>
                         </ul>
                </div><!-- /.btn-group -->



              </div> 
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
												<td>: {{ $vessel->jum_pos }} </td>
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

			<form class="form-horizontal" role="form" action="{{ route('wh.manifest.update',[$vsl]) }}" method="post">
			{{ csrf_field() }}
			{{ method_field('PUT') }}		    
			<input type="hidden" name="seq" value="{{ $seq }}" />		

			<div class="row">
				<div class="col-md-11">					

			<div class="widget-box widget-color-blue2">
				<div class="widget-header widget-header-flat">
					<h5 class="widget-title">Edit Data Manifest</h5>			
				</div>

				<div class="widget-body">
					<div class="widget-main">



						<div class="form-group">
								<label class="control-label col-sm-2 col-form-label"><strong>Term</strong></label>
								<div class="col-sm-4">					
									<select name="term" class="form-control">
										<option value="">-- Pilih --</option>
										<option value="FOB" {{ $man->term == 'FOB' ? 'selected' : '' }}>FOB</option>
										<option value="CNF" {{ $man->term == 'CNF' ? 'selected' : '' }}>CNF</option>
									</select>
				                    @if($errors->has('term'))
				                        <div class="text-danger">
				                            {{ $errors->first('term')}}
				                        </div>
				                    @endif
								</div>
							</div>

							@if ($man->term == "FOB")
									@php
										$kd_bill_to = $man->kd_forwader;										
									@endphp
							@endif
							@if ($man->term == "CNF")
									@php
										$kd_bill_to = $man->kd_cnee;										
									@endphp
							@endif

								<div class="form-group">
								<label class="control-label col-sm-2 col-form-label"><strong>Bill To</strong></label>
								<div class="col-sm-6">
									<select name="kd_bill_to" class="chosen-select"  >
										<option value="" > -- Pilih -- </option>	
										@foreach ($customer as $cus)								
										<option value="{{ $cus->kd_cus }}"
													{{ $kd_bill_to == $cus->kd_cus ? 'selected' : '' }}
												>{{ $cus->customer }}</option>
										@endforeach
									</select>
				                    @if($errors->has('bill_to'))
				                        <div class="text-danger">
				                            {{ $errors->first('bill_to')}}
				                        </div>
				                    @endif
								</div>
							</div>

							

							



							<div class="form-group">
								<label for="" class="control-label col-sm-2"><strong>Consignee</strong></label>
								<div class="col-sm-6">
									<select name="consignee" class="chosen-select"  >
										<option value="" > -- Pilih -- </option>	
										@foreach ($customer as $cus)
											<option value="{{ $cus->kd_cus }}"
													{{ $man->kd_cnee == $cus->kd_cus ? 'selected' : '' }}
												>{{ $cus->customer }}</option>
										@endforeach
									</select>
				                    @if($errors->has('consignee'))
				                        <div class="text-danger">
				                            {{ $errors->first('consignee')}}
				                        </div>
				                    @endif

								</div>
							</div>

							<div class="form-group">
								<label for="" class="control-label col-sm-2"><strong>Forwader</strong></label>
								<div class="col-sm-6">
									<select name="forwader" class="chosen-select"  >
										<option value="" > -- Pilih -- </option>	
										@foreach ($customer as $cus)
											<option value="{{ $cus->kd_cus }}"
												{{ $man->kd_forwader == $cus->kd_cus ? 'selected' : '' }}
												>{{ $cus->customer }}</option>
										@endforeach
									</select>
				                    @if($errors->has('forwader'))
				                        <div class="text-danger">
				                            {{ $errors->first('forwader')}}
				                        </div>
				                    @endif

								</div>
							</div>

							<div class="form-group">
								<label for="" class="control-label col-sm-2"><strong>Description</strong></label>
								<div class="col-sm-6">
						            <textarea name="description" cols="30" rows="4" class="form-control"
						           >{{ $man->description }}</textarea>
				                    @if($errors->has('description'))
				                        <div class="text-danger">
				                            {{ $errors->first('description')}}
				                        </div>
				                    @endif
								</div>
							</div>



					</div>
				</div>

			</div>

		</div>
	</div>


			<div class="row">
				<div class="col-md-11">					

					<div class="widget-box widget-color-blue2">
						<div class="widget-header widget-header-flat">
							<h5 class="widget-title">Container</h5>			
						</div>

						<div class="widget-body">
							<div class="widget-main">


				    		<div class="form-group">				    			
					              <label class="control-label col-sm-2" for="weight">
					              	<strong>Container No.</strong></label>
					              <div class="col-sm-5">
					              	<select name="container" class="form-control">
					              		<option value="">-- Pilih --</option>
					              		@foreach ($cont as $con)
					              			<option value="{{$con->container}}" 
					              				{{ $man->container == $con->container ? 'selected' : '' }}>
					              				{{ $con->container }}</option>
					              		@endforeach
					              	</select>
				                    @if($errors->has('container'))
				                        <div class="text-danger">
				                            {{ $errors->first('container')}}
				                        </div>
				                    @endif
						        
					              </div>
				            </div>  

				    		<div class="form-group">
					              <label class="control-label col-sm-2" for="weight"><strong>Seal No</strong></label>
					              <div class="col-sm-5">          
						            <input type="text" name="seal"  placeholder="Entry Seal No" value="{{ $man->seal }}"
						              class="form-control" autocomplete="off"/>
				                    @if($errors->has('seal'))
				                        <div class="text-danger">
				                            {{ $errors->first('seal')}}
				                        </div>
				                    @endif

					              </div>

				            </div>  


				    		<div class="form-group">
					              <label class="control-label col-sm-2" for="pol"><strong>POL</strong></label>
					              <div class="col-sm-5">          
						              <input type="text" name="pol" placeholder="Enty POL"  value="{{ $man->pol }}" 
						              class="form-control" autocomplete="off"/>
				                    @if($errors->has('pol'))
				                        <div class="text-danger">
				                            {{ $errors->first('pol')}}
				                        </div>
				                    @endif

					              </div>
				            </div>  

				    		<div class="form-group">
				              <label class="control-label col-sm-2" for="vessel"><strong>Vessel $ Voy</strong></label>
				              <div class="col-sm-5">          
					              <input type="text" name="vessel"  placeholder="Entry Vessel" 
					              value="{{ $vessel->vessel }}" class="form-control" autocomplete="off" readonly="true"
					              />
			                    @if($errors->has('vessel'))
			                        <div class="text-danger">
			                            {{ $errors->first('vessel')}}
			                        </div>
			                    @endif
				              </div>
				        </div>  

				    		<div class="form-group">
					              <label class="control-label col-sm-2" for="eta"><strong>Eta</strong></label>
					              <div class="col-sm-5">          
						              <input type="date" name="eta" placeholder="Entr Eta" 
						              value="{{ $vessel->eta }}" readonly="true"
						              class="form-control" autocomplete="off"/>
				                    @if($errors->has('eta'))
				                        <div class="text-danger">
				                            {{ $errors->first('eta')}}
				                        </div>
				                    @endif

					              </div>
				            </div>  
				    		<div class="form-group">
					              <label class="control-label col-sm-2" for="hbl"><strong>HBL</strong></label>
					              <div class="col-sm-5">          
						              <input type="text" name="hbl"  placeholder="Entry HBL" value="{{ $man->hbl }}" 
						              class="form-control" autocomplete="off"/>
				                    @if($errors->has('hbl'))
				                        <div class="text-danger">
				                            {{ $errors->first('hbl')}}
				                        </div>
				                    @endif

					              </div>
				            </div>  
				    		<div class="form-group">
					              <label class="control-label col-sm-2" for="vls"><strong>VLS BL</strong></label>
					              <div class="col-sm-5">          
						              <input type="text" name="vls_bl" placeholder="Entry Vsl HBL" readonly="true"
						              value="{{ $vessel->vls_bl }}" class="form-control" autocomplete="off" 
						             />
				                    @if($errors->has('vls_bl'))
				                        <div class="text-danger">
				                            {{ $errors->first('vls_bl')}}
				                        </div>
				                    @endif
					              </div>
				            </div>  








							</div>
						</div>
					</div>

				</div>
			</div>


			<div class="row">
				<div class="col-md-11">					

					<div class="widget-box widget-color-blue2">
						<div class="widget-header widget-header-flat">
							<h5 class="widget-title">Quantity</h5>			
						</div>

						<div class="widget-body">
							<div class="widget-main">


				    		<div class="form-group">
					              <label class="control-label col-sm-2" for="qty"><strong>Qty</strong></label>
					              <div class="col-sm-2">          
						              <input type="text" name="qty" placeholder="Entry Qty" value="{{ $man->qty }}" 
						              class="form-control" autocomplete="off" style="text-align: right;"/>
				                    @if($errors->has('qty'))
				                        <div class="text-danger">
				                            {{ $errors->first('qty')}}
				                        </div>
				                    @endif


					              </div>
					              <div class="col-sm-2">          
						             	<select name="sat_qty" class="form-control">
					              			<option value="">-- PILIH -- </option>
					              			@foreach ($satuan as $s)
						              			<option value="{{ $s->param2 }}"
												{{ $man->sat_qty == $s->param2 ? 'selected' : '' }}
						              				>{{ $s->param2 }}</option>	
					              			@endforeach
					              	</select>	     
						          @if($errors->has('sat_qty'))
				                        <div class="text-danger">
				                            {{ $errors->first('sat_qty')}}
				                        </div>
				                    @endif
					              </div>

				            </div>  
				    		<div class="form-group">
					              <label class="control-label col-sm-2" for="weight"><strong>Weight</strong></label>
					              <div class="col-sm-2">          
						              <input type="text" name="weight" placeholder="Entr Weight" 
						              value="{{ $man->weight }}"  
						              class="form-control" autocomplete="off" style="text-align: right; "/>
									  @if($errors->has('weight'))
				                        <div class="text-danger">
				                            {{ $errors->first('weight')}}
				                        </div>
				                    @endif
					              </div>
				            </div>  
				    		<div class="form-group">
					              <label class="control-label col-sm-2" for="measure"><strong>Measure</strong></label>
					              <div class="col-sm-2">
						              <input type="text" name="measure" placeholder="Entry Measure" 
						              	value="{{ $man->measure }}" class="form-control" 
						              	autocomplete="off" style="text-align: right;"/>
									  @if($errors->has('measure'))
				                        <div class="text-danger">
				                            {{ $errors->first('measure')}}
				                        </div>
				                    @endif

					              </div>
				            </div>  
										
										<div class="form-group">
												<label class="control-label col-sm-2"></label>
			              		<div class="col-sm-9">
			                		<button type="submit" class="btn btn-primary btn-sm px-3">Update</button>
			              		</div>
				            </div>



							</div>
						</div>
					</div>
					
				</form>



				</div>
			</div>


@endsection