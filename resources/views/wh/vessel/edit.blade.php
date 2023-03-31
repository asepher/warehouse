@extends('layouts.master')

@section('title')
    Edit Data Vessel
@endsection

@section('breadcrumb')
    <a href="{{ route('wh.vessel.index') }}">Vessel</a>
@endsection


@section('content')

    @php
	    $tgl = $vessel->eta;
		//$count = App\Manifest::where('kd_vsl',$v->kd_vsl)->count();
		$cek = App\Models\Manifest::where('kd_vsl',$vessel->kd_vsl)->count();	
		
	@endphp


    <!-- /.page-header -->
   <div class="page-header">
      <h1>Data Vessel </h1>
   </div><!-- /.page-header -->



      <div class="row">
         <div class="col-md-10">
            <div class="widget-box widget-color-blue2">
            	<div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Edit Data Vessel</h4>
						

               </div>

	               <div class="widget-body">
	                  <div class="widget-main no-padding">

	                  	<form action="{{ route('wh.vessel.update',[$id]) }}" class="form-horizontal" role="form" method="POST">
                        	@csrf
                        	@method('PUT')
                     	   <fieldset>

										<div class="form-group">
	                              <label class="col-sm-2 control-label" for="eta"><strong> ETA </strong></label>
	                              <div class="col-sm-4">
	                                 <input type="date" id="eta" name="eta" placeholder="Alamat Email" 
	                                 class="form-control" autocomplete="off"/  value="{{ $tgl }}">
	                                    @if($errors->has('eta'))
	                                       <div class="text-danger">
	                                           {{ $errors->first('eta')}}
	                                       </div>
	                                    @endif	                             
	                              </div>
                           	</div>

                           	<div class="form-group">
							            <label class="col-md-2 control-label"><strong>Nama Kapal</strong></label>
							            <div class="col-md-6">
							                <input type="text" name="vessel" class="form-control"  value="{{ $vessel->vessel }}" autocomplete="off">
							                @if($errors->has('vessel'))
							                    <div class="text-danger">
							                        {{ $errors->first('vessel')}}
							                    </div>
							                @endif
							            </div>
					        			</div>


								<div class="form-group">
					            <label class="col-md-2 control-label"><strong>Container</strong></label>
					            <div class="col-md-6">
					                <input type="text" name="container" class="form-control" autocomplete="off"
					                value="{{ $vessel->container }}">
					                @if($errors->has('container'))
					                    <div class="text-danger">
					                        {{ $errors->first('container')}}
					                    </div>
					                @endif
					            </div>
					        </div>


						    <div class="form-group">
					            <label class="col-md-2 control-label"><strong>VLS BL</strong></label>
					            <div class="col-md-6">
					                <input type="text" name="vls_bl" class="form-control"  autocomplete="off"
					                value="{{ $vessel->vls_bl }}" >
					                @if($errors->has('vls_bl'))
					                    <div class="text-danger">
					                        {{ $errors->first('vls_bl')}}
					                    </div>
					                @endif
					            </div>
					        </div>

						    <div class="form-group">
					            <label class="col-md-2 control-label"><strong>Jumlah Pos</strong></label>
					            <div class="col-md-2">
					                <input type="number" name="jum_pos" class="form-control" 
					                 value="{{ $vessel->jum_pos }}"
					                 autocomplete="off">
					                @if($errors->has('jum_pos'))
					                    <div class="text-danger">
					                        {{ $errors->first('jum_pos')}}
					                    </div>
					                @endif

					            </div>
					        </div>

				            <div class="form-group">				            	
				                <label for="" class="col-md-2"></label>
				                <div class="col-md-9">
				                        <button type="submit" class="btn btn-primary btn-sm px-3"
				                        @if ($cek >= 1)
				                        	disabled 
				                        @endif
				                        >Update</button>
				                </div>
				            </div>
						</div>

									</fieldset>
	                     </form>
	                  </div>
	               </div>

            </div>    
        </div>
    </div>


@endsection	