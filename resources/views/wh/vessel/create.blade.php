@extends('layouts.master')

@section('title')
    Create Vessel
@endsection

@section('breadcrumb')
    <a href="{{ route('wh.vessel.index') }}">Vessel</a>
@endsection
 

@section('content')

   @php       
      $tgl = date("Y/m/d");      
   @endphp

    <!-- /.page-header -->
   <div class="page-header">
      <h1>Entry Data Vessel </h1>
   </div><!-- /.page-header -->

 

      <div class="row">
         <div class="col-md-10">
            
            <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Add New</h4>
               </div>


               <div class="widget-body">
                  <div class="widget-main no-padding">


                     <form action="{{ route('wh.vessel.store') }}" class="form-horizontal" role="form" method="POST">
                        @csrf
                        <!-- <legend>Form</legend> -->
                        <fieldset>        
                           
                           <div class="form-group">
                              <label class="col-sm-2 control-label" for="eta"><strong> ETA </strong></label>
                              <div class="col-sm-4">                                 
                                 <input type="date" name="eta" placeholder="Alamat Email" 
                                 class="form-control date-picker" autocomplete="off" />
                                
                                    @if($errors->has('eta'))
                                       <div class="text-danger">
                                           {{ $errors->first('eta')}}
                                       </div>
                                    @endif
                             
                              </div>
                           </div>
                           
                           <div class="form-group">
                              <label class="col-sm-2 control-label" for="vessel"><strong>Vessel</strong></label>
                              <div class="col-sm-5">
                                 <input type="text" id="vessel" name="vessel" placeholder="Entry Vessel" 
                                 class="form-control" autocomplete="off" value="{{ old('vessel') }}" />
                                    @if($errors->has('vessel'))
                                       <div class="text-danger">
                                           {{ $errors->first('vessel')}}
                                       </div>
                                    @endif

                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-2 control-label" for="container"><strong>Container</strong> </label>
                              <div class="col-sm-5">
                                 <input type="text" id="container" name="container" placeholder="Entry Container" class="form-control"
                                 autocomplete="off" value="{{ old('container') }}" />
                                    @if($errors->has('container'))
                                       <div class="text-danger">
                                           {{ $errors->first('container')}}
                                       </div>
                                    @endif

                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 control-label" for="vls_bl"><strong> VLS BL</strong> </label>
                              <div class="col-sm-5">
                                 <input type="text" id="vls_bl" name="vls_bl" placeholder="Nomor VLS BL" class="form-control" 
                                 autocomplete="off" value="{{ old('vls_bl') }}" />
                                    @if($errors->has('vls_bl'))
                                       <div class="text-danger">
                                           {{ $errors->first('vls_bl')}}
                                       </div>
                                    @endif

                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 control-label" for="pos"><strong> POS </strong></label>
                              <div class="col-sm-3">
                                 <input type="text" id="pos" name="jum_pos" placeholder="Jumlah POS" class="form-control"
                                 autocomplete="off" value="{{ old('jum_pos') }}"/>
                                    @if($errors->has('jum_pos'))
                                       <div class="text-danger">
                                           {{ $errors->first('jum_pos')}}
                                       </div>
                                    @endif

                              </div>
                           </div>



                        </fieldset>

                        <div class="form-actions center">
                           <button type="submit" class="btn btn-sm btn-primary">Submit
                              <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                           </button>
                        </div>

                      </form>
                  </div>                
               </div>
            </div>
         </div>         
      </div>

@endsection
