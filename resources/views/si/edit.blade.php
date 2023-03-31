@extends('layouts.master')


@section('title')
	Shipping Instruction
@endsection

@section('breadcrumb')
	<a href="{{ route('si.index') }}">Shipping</a>
@endsection



@section('content')

 	@php
       $sts = App\Models\Shipping::where('kd_si', $id)->first();
   @endphp


    <!-- /.page-header -->
   <div class="page-header">
      <h1>Shipping Instruction </h1>
   </div><!-- /.page-header -->



			<form class="form-horizontal" role="form" action="{{ route('si.update', $id) }}" method="post">
			{{ csrf_field() }}


   <div class="row">
       <div class="col-sm-11">

       	<div class="widget-box widget-color-blue2">
	            <div class="widget-header widget-header-flat">
	               <h5 class="widget-title">Edit Data</h5>
	               <div class="widget-toolbar">
	              
	               </div>
	            </div>
	            <div class="widget-body">
	               <div class="widget-main">




						<div class="form-group">
								<label class="col-sm-2 control-label"><strong>Services</strong></label>
								<div class="col-sm-3">								
									<select name="service" class="form-control">
										<option value="">-- Pilih --</option>
										<option value="IMPORT"
										@if ( $si->service === 'IMPORT'  )
											 selected
										@endif
										>IMPORT</option>
										<option value="EXPORT" 
										@if ( $si->service === 'EXPORT'  )
											 selected
										@endif
										>EXPORT</option>
									</select>
										@if($errors->has('service'))
				                            <div class="text-danger">
				                                {{ $errors->first('service')}}
				                            </div>
				                        @endif
								</div>
							</div>			

							<div class="form-group">
								<label for="" class="col-sm-2"></label>
								<div class="col-sm-3">
									<select name="tipe" class="form-control">
										<option value="">-- Pilih -- </option>
										<option value="SEA"
										@if ( $si->tipe == 'SEA')
											 selected
										@endif
										>SEA</option>
										<option value="AIR"
										@if ( $si->tipe == 'AIR')
											 selected
										@endif
										>AIR</option>
									</select>					
										@if($errors->has('tipe'))
				                            <div class="text-danger">
				                                {{ $errors->first('tipe')}}
				                            </div>
				                        @endif
								</div>
							</div>			

							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><strong>CNEE</strong></label>
								<div class="col-sm-5">

									<select name="kd_cus"  class="chosen-select">
										<option value="">-- Pilih -- </option>
										@foreach ($customer as $c)
											<option value="{{ $c->kd_cus }}"
												@if ( $si->kd_cus == $c->kd_cus )
													selected
												@endif
												>{{ $c->customer }}</option>
										@endforeach
									</select>					
										@if($errors->has('cnee'))
				                            <div class="text-danger">
				                                {{ $errors->first('cnee')}}
				                            </div>
				                        @endif

								</div>
							</div>			


							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><strong>Country Origin</strong></label>
								<div class="col-sm-5">
									<select name="coo" id="" class="form-control" >
										<option value="">-- Pilih -- </option>
										@foreach ($negara as $n)
											<option value="{{ $n->kd_neg }}"
												@if ( $si->coo == $n->kd_neg )
													selected
												@endif
												>{{ $n->negara }}</option>
										@endforeach
									</select>					
										@if($errors->has('coo'))
				                            <div class="text-danger font-w400 font-size-sm">
				                                {{ $errors->first('coo')}}
				                            </div>
				                        @endif

								</div>
							</div>			

							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><strong>Port Of Loading</strong></label>
								<div class="col-sm-5">
				                        <input type="text" name="pol" class="form-control" 
				                        autocomplete="off" placeholder="Entry Port Of Loading"  
				                        value="{{ $si->pol }}"/>
										@if($errors->has('pol'))
				                            <div class="text-danger font-w400 font-size-sm">
				                                {{ $errors->first('pol')}}
				                            </div>
				                        @endif

								</div>
							</div>			

							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><strong>Port Of Discharge</strong></label>
								<div class="col-sm-5">
				                        <input type="text" name="pod" class="form-control"   autocomplete="off" placeholder="Entry Port Of Discharge"   
				                        value="{{ $si->pod }}"/>
										@if($errors->has('pod'))
				                            <div class="text-danger font-w400 font-size-sm">
				                                {{ $errors->first('pod')}}
				                            </div>
				                        @endif
								</div>
							</div>			

							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><strong>Vessel Name</strong></label>
								<div class="col-sm-5">
				                        <input type="text" name="vessel" class="form-control" 
				                         autocomplete="off" placeholder="Entry Vesel name"  onkeyup="this.value = this.value.toUpperCase()" 
				                        value="{{ $si->vessel }}" />
										@if($errors->has('vessel'))
				                            <div class="text-danger font-w400 font-size-sm">
				                                {{ $errors->first('vessel')}}
				                            </div>
				                        @endif

								</div>
							</div>			

							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><strong>Marking</strong></label>
								<div class="col-sm-6">
				                    <textarea class="form-control" 
				                    rows="3" id="comment" name="marking">{{ $si->marking }}</textarea>
										@if($errors->has('marking'))
				                            <div class="text-danger font-w400 font-size-sm">
				                                {{ $errors->first('marking')}}
				                            </div>
				                        @endif

								</div>
							</div>			

							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><strong>Description</strong></label>
								<div class="col-sm-6">
				                    <textarea class="form-control" 
				                    rows="3" id="comment" name="description"
				                    >{{ $si->description }}</textarea>
								</div>
							</div>



	               </div>
	            </div>
	         </div>
	    </div>
	</div>


   <div class="row">
       <div class="col-sm-11">

       	<div class="widget-box widget-color-blue2">
	            <div class="widget-header widget-header-flat">
	               <h4 class="widget-title">Term</h4>
	               <div class="widget-toolbar">
	              
	               </div>
	            </div>
	            <div class="widget-body">
	               <div class="widget-main">




							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><strong>Term</strong></label>
								<div class="col-sm-4">									
									<select name="term" class="form-control">
										<option value="">-- Pilih -- </option>
										<option value="LCL"
											@if ( $si->term == 'LCL' )
														selected 
											@endif
										>LCL</option>
										<option value="FCL"
											@if ( $si->term == 'FCL' )
														selected 
											@endif
										>FCL</option>
									</select>
										@if($errors->has('term'))
				                            <div class="text-danger font-w400 font-size-sm">
				                                {{ $errors->first('term')}}
				                            </div>
				                        @endif
								</div>
							</div>			
							

							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><strong>BL</strong></label>
								<div class="col-sm-5">
				                    <input type="text" name="bl" class="form-control"   
				                    autocomplete="off" placeholder="Entry Bill Of Lading"  
				                    onkeyup="this.value = this.value.toUpperCase()" value="{{ $si->bl }}" 
				                    />
								</div>
							</div>			
							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><strong>AWB</strong></label>
								<div class="col-sm-5">
				                    <input type="text" name="awb" class="form-control"   
				                    autocomplete="off" placeholder="Entry Awb"  
				                    onkeyup="this.value = this.value.toUpperCase()" value="{{ $si->awb }}"
				                    />
								</div>
							</div>			

							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><strong>Flight</strong></label>
								<div class="col-sm-5">
				                    <input type="text" name="flight" class="form-control" 
				                    autocomplete="off" placeholder="Entry Flight"  
				                    onkeyup="this.value = this.value.toUpperCase()" value="{{ $si->flight }}"
				                    />
								</div>
							</div>			

							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><strong>ETA</strong></label>
								<div class="col-sm-4">
				                    <input type="date" name="eta"  class="form-control datepicker-input"
				                    autocomplete="off" placeholder="Entry Eta"                    
				                    value="{{ $si->etd }}"
				                    id="datepicker"/>
				                    	@if($errors->has('eta'))
				                            <div class="text-danger font-w400 font-size-sm">
				                                {{ $errors->first('eta')}}
				                            </div>
				                        @endif

								</div>
							</div>			

							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><strong>ETD</strong></label>
								<div class="col-sm-4">
				                    <input type="date" name="etd" class="form-control datepicker-input" autocomplete="off" placeholder="Entry Etd" 
				                    value="{{ $si->etd }}"
					                    id="datepicker2"/>
										@if($errors->has('etd'))
				                            <div class="text-danger font-w400 font-size-sm">
				                                {{ $errors->first('etd')}}
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
       <div class="col-sm-11">

       	<div class="widget-box widget-color-blue2">
	            <div class="widget-header widget-header-flat">
	               <h4 class="widget-title">Gross Weight</h4>
	               <div class="widget-toolbar">
	              
	               </div>
	            </div>
	            <div class="widget-body">
	               <div class="widget-main">





							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><strong>Gross Weight</strong></label>
								<div class="col-sm-2">
				                    <input type="text" name="gw" value="{{ $si->gw }}"  class="form-control font-w500 font-size-sm"
				                    autocomplete="off" placeholder="Entry Gross Weight" 
				                    style="text-align: right;" id="grossw"/>
										@if($errors->has('gw'))
				                            <div class="text-danger font-w400 font-size-sm">
				                                {{ $errors->first('gw')}}
				                            </div>
				                        @endif

								</div>
								<div class="col-sm-2">
				                    <select name="sat_gw" id="sat_gw" class="form-control" >
				                        <option value="">-- PILIH --</option>
				                        <option value="KGS" selected>KGS</option>
				                    </select>
								</div>
							</div>			

							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><strong>Volume</strong></label>
								<div class="col-sm-2">
				                    <input type="text" name="vol" value="{{ $si->vol }}" 
				                    class="form-control font-w500 font-size-sm" autocomplete="off" placeholder="Entry Volume" style="text-align: right; " 
				                    id="volume"/>
										@if($errors->has('vol'))
				                            <div class="text-danger font-w400 font-size-sm">
				                                {{ $errors->first('vol')}}
				                            </div>
				                        @endif
								</div>

								<div class="col-sm-2">
				                    <select name="sat_vol"  class="form-control" >
				                        <option value="">-- PILIH --</option>
				                        <option value="CMB" selected>CBM</option>
				                    </select>
								</div>				
							</div>			

							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><strong>Release</strong></label>
								<div class="col-sm-4">
				                    <input type="date" name="tgl_release"  class="form-control datepicker-input"
				                    autocomplete="off" placeholder="Entry Tanggal" 
				                    value="{{ $si->tgl_release }}" id="datepicker-autoclose3"
				                    />
								</div>
							</div>			

							<div class="form-group">
								<label for="" class="col-sm-2"></label>
								<div class="col-sm-7">
									<button type="submit" class="btn btn-primary btn-sm px-5">Update</button>
								</div>
							</div>									
						



	              </div>
	            </div>
	       </div>

	       				</form>


	   </div>
	</div>





@endsection	