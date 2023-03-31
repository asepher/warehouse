@extends('layouts.master')

@section('title')
	Edit Manifest
@endsection

@section('breadcrumb')
	<a href="">Vessel</a>
@endsection

@section('content') 

	<div class="page-header">
		<h1>Edit  Manifest Detail</h1>
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


		 <hr class="col-md-11">

			<form class="form-horizontal"  role="form" action="{{ route('manifest.store',[$vsl])}}" method="post">
				@csrf	
				@method('PUT')	   
			 
			<input type="hidden" name="kd_vsl" value="{{ $vsl }}" />




			<div class="row">
				<div class="col-md-11">
					

			<div class="widget-box widget-color-blue2">
				<div class="widget-header widget-header-flat">
					<h4 class="widget-title lighter">Edit Data Manifest</h4>
			
				</div>

				<div class="widget-body">
					<div class="widget-main">



				<div class="form-group">
							<label class="control-label col-sm-2"><strong>Term</strong></label>
							<div class="col-sm-4">					
								<select name="term" class="form-control">
									<option value="">-- Pilih --</option>
									<option value="FOB" {{ old('term') == 'FOB' ? 'selected' : '' }}>FOB</option>
									<option value="CNF" {{ old('term') == 'CNF' ? 'selected' : '' }}>CNF</option>
								</select>
			                    @if($errors->has('term'))
			                        <div class="text-danger">
			                            {{ $errors->first('term')}}
			                        </div>
			                    @endif
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2"><strong>Bill To</strong></label>
							<div class="col-sm-6">
								<select name="bill_to" class="single-select" >
									<option value="" > -- Pilih -- </option>	
									@foreach ($customer as $cus)								
									<option value="{{ $cus->kd_cus }}"
												{{ old('bill_to') == $cus->kd_cus ? 'selected' : '' }}
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
								<select name="consignee" class="single-select" >
									<option value="" > -- Pilih -- </option>	
									@foreach ($consignee as $con)
										<option value="{{ $con->kd_cus }}"
												{{ old('consignee') == $con->kd_cus ? 'selected' : '' }}
											>{{ $con->customer }}</option>
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
								<select name="forwader" class="form-control">
									<option value=""> -- Pilih -- </option>	
									@foreach ($forwader as $fwd)
										<option value="{{ $fwd->kd_cus }}"
											{{ old('forwader') == $fwd->kd_cus ? 'selected' : '' }}
											>{{ $fwd->customer }}</option>
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
					            <textarea name="description"  cols="30" rows="4" class="form-control">{{ old('description') }}</textarea>
			                    @if($errors->has('description'))
			                        <div class="text-danger">
			                            {{ $errors->first('description')}}
			                        </div>
			                    @endif
							</div>
						</div>


						<div class="form-group">
				              <label class="control-label col-sm-2"><strong>Container No.</strong></label>
				              <div class="col-sm-5">
				              	<select name="container" class="form-control">
				              		<option value="">-- Pilih --</option>
				              		@foreach ($cont as $con)
				              			<option value="{{$con->container}}" {{ old('container') == $con->container ? 'selected' : '' }}>
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
				              <label class="control-label col-sm-2"><strong>Seal No</strong></label>
				              <div class="col-sm-5">          
					            <input type="text" name="seal"  placeholder="Entry Seal No" value="{{ old('seal') }}"
					              class="form-control" autocomplete="off"
					              onkeyup="this.value = this.value.toUpperCase()"/>
			                    @if($errors->has('seal'))
			                        <div class="text-danger">
			                            {{ $errors->first('seal')}}
			                        </div>
			                    @endif
				              </div>
			          </div>  




							<div class="form-group">
				              <label class="control-label col-sm-2"><strong>POL</strong></label>
				              <div class="col-sm-5">          
					              <input type="text" name="pol" placeholder="Enty POL"  value="{{ old('pol') }}" 
					              class="form-control" autocomplete="off" onkeyup="this.value = this.value.toUpperCase()"/>
			                    @if($errors->has('pol'))
			                        <div class="text-danger">
			                            {{ $errors->first('pol')}}
			                        </div>
			                    @endif

				              </div>
			            </div>  
			    		<div class="form-group">
				              <label class="control-label col-sm-2"><strong>Vessel $ Voy</strong></label>
				              <div class="col-sm-5">          
					              <input type="text" name="vessel"  placeholder="Entry Vessel" 
					              value="{{ $vessel->vessel }}"  readonly="true"  
					              class="form-control" autocomplete="off" />
			                    @if($errors->has('vessel'))
			                        <div class="text-danger">
			                            {{ $errors->first('vessel')}}
			                        </div>
			                    @endif

				              </div>

			            </div>  
			    		<div class="form-group">
				              <label class="control-label col-sm-2"><strong>Eta</strong></label>
				              <div class="col-sm-4">          
					              <input type="text" name="eta" placeholder="Entr Eta" 
					              value="{{ date("Y/m/d",strtotime($vessel->eta)) }}" 
					              class="form-control" autocomplete="off"
					              readonly="true" />
			                    @if($errors->has('eta'))
			                        <div class="text-danger">
			                            {{ $errors->first('eta')}}
			                        </div>
			                    @endif

				              </div>
			            </div>  
			    		<div class="form-group">
				              <label class="control-label col-sm-2"><strong>HBL</strong></label>
				              <div class="col-sm-6">          
					              <input type="text" name="hbl"  placeholder="Entry HBL" value="{{ old('hbl') }}" 
					              class="form-control" autocomplete="off"
					              onkeyup="this.value = this.value.toUpperCase()" />
			                    @if($errors->has('hbl'))
			                        <div class="text-danger">
			                            {{ $errors->first('hbl')}}
			                        </div>
			                    @endif

				              </div>
			            </div>  
			    		<div class="form-group">
				              <label class="control-label col-sm-2"><strong>VLS BL</strong></label>
				              <div class="col-sm-6">          
					              <input type="text" name="vls_bl" placeholder="Entry Vsl HBL" 
					              value="{{ $vessel->vls_bl }}" readonly="true" 
					              class="form-control" autocomplete="off" />
			                    @if($errors->has('vls_bl'))
			                        <div class="text-danger">
			                            {{ $errors->first('vls_bl')}}
			                        </div>
			                    @endif

				              </div>
			            </div>  


						<div class="form-group">
				              <label class="control-label col-sm-2"><strong>Qty</strong></label>
				              <div class="col-sm-2">          
					              <input type="text" name="qty" placeholder="Entry Qty" value="{{ old('qty') }}" 
					              class="form-control" autocomplete="off" style="text-align: right;" />
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
					              			<option value="{{ $s->param2 }}">{{ $s->param2 }}</option>	
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
				              <label class="control-label col-sm-2"><strong>Weight</strong></label>
				              <div class="col-sm-2" style="text-align: right;">          
					              <input type="text" name="weight" placeholder="Entr Weight" value="{{ old('weight') }}" 
					              class="form-control" autocomplete="off" style="text-align: right;"/>
								  @if($errors->has('weight'))
			                        <div class="text-danger">
			                            {{ $errors->first('weight')}}
			                        </div>
			                    @endif
				              </div>
			            </div>  
			    		<div class="form-group">
				              <label class="control-label col-sm-2"><strong>Measure</strong></label>
				              <div class="col-sm-2">
					              <input type="text" name="measure" placeholder="Entry Measure" value="{{ old('measure') }}" 
					              class="form-control" autocomplete="off" style="text-align: right;"/>
								  @if($errors->has('measure'))
			                        <div class="text-danger">
			                            {{ $errors->first('measure')}}
			                        </div>
			                    @endif

				              </div>
			            </div>  
									
						<div class="mb-3 row">        
							 	<label class="control-label col-sm-2"></label>
			              		<div class="col-sm-9">
			                		<button type="submit" class="btn btn-primary btn-sm px-5">Update</button>
			              		</div>
			            </div>		



					</div>
				</div>

			</div>


</div>
</div>




<p><br></p>





@endsection