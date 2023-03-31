@extends('layouts.master')

@section('title')
    Create Shipping Instruction
@endsection

@section('breadcrumb')
    <a href="{{ route('si.index') }}">Shipping</a>
@endsection

@section('content')
   @php
      $tgl=date('Y-m-d');
   @endphp
 

    <!-- /.page-header -->
   <div class="page-header">
      <h1>Shipping Instruction </h1>
   </div><!-- /.page-header -->
               
                     <form class="form-horizontal" role="form" action="{{ route('si.store') }}" method="post">
                     {{ csrf_field() }}

    <div class="row">
        <div class="col-md-11">
            <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                     <h4 class="widget-title">Entry Service and Description</h4>
                    <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                           <i class="ace-icon fa fa-chevron-up"></i>
                        </a>                                         
                     </div>
               </div>
               <div class="widget-body">
                  <div class="widget-main">

                     
               
   
                     <div class="form-group">
                        <label class="col-sm-2 control-label"><strong>Ref.</strong></label>
                        <div class="col-sm-3">
                           <input type="text" name="jobid" value="{{ $job }}" readonly>            
                        </div>
                        <div class="col-sm-3">
                           <input type="text" name="service" value="{{ $service }}" readonly>
                        </div>
                        <div class="col-sm-3">
                           <input type="text" name="tipe" value="{{ $tipe }}" readonly>
                        </div>
                        </div>         
                        <div class="form-group">
                           <label for="" class="col-sm-2 control-label">
                              <a href="{{ route('customer.create') }}"><strong>CNEE Chosen</strong></a>
                              </label>
                           <div class="col-sm-6">

                             <select class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a State..." name="kd_cus">                                 
                                 <option value="">-- Pilih -- </option>
                                 @foreach ($customer as $c)
                                    <option value="{{ $c->kd_cus }}"
                                       @if ( old('kd_cus') == $c->kd_cus )
                                          selected
                                       @endif
                                       >{{ $c->customer }}</option>
                                 @endforeach
                              </select>               
                                 @if($errors->has('kd_cus'))
                                           <div class="text-danger">
                                               {{ $errors->first('kd_cus')}}
                                           </div>
                                       @endif

                           </div>
                        </div>         


                        <div class="form-group">
                           <label for="" class="col-sm-2 control-label ">
                              <a href="{{ route('country.index') }}"><strong>Origin</strong></label></a> 
                           <div class="col-sm-3">
                              <select name="coo" id="" class="form-control" 
                              >
                                 <option value="">-- Pilih -- </option>
                                 @foreach ($negara as $n)
                                    <option value="{{ $n->kd_neg }}"
                                       @if ( old('coo') == $n->kd_neg )
                                          selected
                                       @endif
                                       >{{ $n->negara }}</option>
                                 @endforeach
                              </select>               
                                 @if($errors->has('coo'))
                                           <div class="text-danger">
                                               {{ $errors->first('coo')}}
                                           </div>
                                       @endif

                           </div>
                        </div>         

                              <div class="form-group">
                                 <label class="col-sm-2 control-label"><strong>POL</strong></label>
                                 <div class="col-sm-4">
                                             <input type="text" name="pol" class="form-control" 
                                             autocomplete="off" placeholder="Entry Port Of Loading"  
                                             onkeyup="this.value = this.value.toUpperCase()" 
                                             value="{{ old('pol') }}"/>
                                       @if($errors->has('pol'))
                                                 <div class="text-danger font-w400 font-size-sm">
                                                     {{ $errors->first('pol')}}
                                                 </div>
                                             @endif

                                 </div>
                              </div>         

                              <div class="form-group">
                                 <label class="col-sm-2 control-label "><strong>POD</strong></label>
                                 <div class="col-sm-4">
                                    <input type="text" name="pod" class="form-control font-w500 font-size-sm"   autocomplete="off" placeholder="Entry Port Of Discharge"  
                                    onkeyup="this.value = this.value.toUpperCase()" 
                                    value="{{ old('pod') }}"/>
                                       @if($errors->has('pod'))
                                              <div class="text-danger font-w400 font-size-sm">
                                                  {{ $errors->first('pod')}}
                                              </div>
                                          @endif

                                 </div>
                              </div>         

                              <div class="form-group">
                                 <label class="col-sm-2 control-label"><strong>Vessel Name</strong></label>
                                 <div class="col-sm-4">
                                             <input type="text" name="vessel" class="form-control" 
                                              autocomplete="off" placeholder="Entry Vesel name"  onkeyup="this.value = this.value.toUpperCase()" 
                                             value="{{ old('vessel') }}"/>
                                       @if($errors->has('vessel'))
                                                 <div class="text-danger font-w400 font-size-sm">
                                                     {{ $errors->first('vessel')}}
                                                 </div>
                                             @endif

                                 </div>
                              </div>         

                              <div class="form-group">
                                 <label class="col-sm-2 control-label"><strong>Marking</strong></label>
                                 <div class="col-sm-6">
                                         <textarea class="form-control" rows="3" id="comment" name="marking" 
                                         >{{ old('marking') }}</textarea>
                                       @if($errors->has('marking'))
                                                 <div class="text-danger font-w400 font-size-sm">
                                                     {{ $errors->first('marking')}}
                                                 </div>
                                             @endif

                                 </div>
                              </div>         

                              <div class="form-group">
                                 <label for="description" class="col-sm-2 control-label"><strong>Description</strong></label>
                                 <div class="col-sm-6">
                                         <textarea class="form-control font-size-sm" 
                                         rows="3" id="comment" name="description" 
                                         >{{ old('description') }}</textarea>
                                 </div>
                              </div>     

               <hr>    

                 

                  </div>
               </div>


            </div>
        </div>
    </div>


     <div class="row">
        <div class="col-md-11">
            <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat widget-header-small">
                     <h5 class="widget-title">Term </h5>
                     <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                           <i class="ace-icon fa fa-chevron-up"></i>
                        </a>                                         
                     </div>
               </div>
               <div class="widget-body">
                  <div class="widget-main">



                              <div class="form-group">
                                 <label for="term" class="col-sm-2 control-label"><strong>Term</strong></label>
                                 <div class="col-sm-2">
                                    <select name="term" class="form-control">
                                       <option value="">-- Pilih -- </option>
                                       <option value="LCL">LCL</option>
                                       <option value="FCL">FCL</option>
                                    </select>
                                       @if($errors->has('term'))
                                           <div class="text-danger font-w400 font-size-sm">
                                               {{ $errors->first('term')}}
                                           </div>
                                       @endif
                                 </div>
                              </div>         
                              

@if ($tipe == 'SEA')


                              <div class="form-group">
                                 <label for="bl" class="col-sm-2 control-label"><strong>BL</strong></label>
                                 <div class="col-sm-4">
                                
                                         <input type="text" name="bl" class="form-control"   
                                         autocomplete="off" placeholder="Entry Bill Of Lading"  
                                         onkeyup="this.value = this.value.toUpperCase()" />
                                 </div>
                              </div>         
@else 

                              <div class="form-group">
                                 <label for="awb" class="col-sm-2 control-label"><strong>AWB</strong></label>
                                 <div class="col-sm-4">
                                         <input type="text" name="awb" class="form-control"   
                                         autocomplete="off" placeholder="Entry Awb"  
                                         onkeyup="this.value = this.value.toUpperCase()"/>
                                 </div>
                              </div>         

                              <div class="form-group">
                                 <label for="flight" class="col-sm-2 control-label"><strong>Flight</strong></label>
                                 <div class="col-sm-4">
                                         <input type="text" name="flight" class="form-control" 
                                         autocomplete="off" placeholder="Entry Flight"  
                                         onkeyup="this.value = this.value.toUpperCase()"/>
                                 </div>
                              </div>         


@endif

                              <div class="form-group">
                                 <label for="eta" class="col-sm-2 control-label"><strong>ETA</strong></label>
                                 <div class="col-sm-3">
                                         <input type="date" name="eta"  class="form-control datepicker-input"
                                         autocomplete="off" placeholder="Entry Eta"  
                                         value="{{ $tgl }}" 
                                         />
                                          @if($errors->has('eta'))
                                                 <div class="text-danger font-w400 font-size-sm">
                                                     {{ $errors->first('eta')}}
                                                 </div>
                                             @endif

                                 </div>
                              </div>         

                              <div class="form-group">
                                 <label for="etd" class="col-sm-2 control-label"><strong>ETD</strong></label>
                                 <div class="col-sm-3">
                                         <input type="date" name="etd" class="form-control datepicker-input" autocomplete="off" placeholder="Entry Etd" 
                                         value="{{ $tgl }}"
                                            id="datepicker2" />
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
        <div class="col-md-11">
            <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                     <h4 class="widget-title">Gross Weight</h4>
                     <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                           <i class="ace-icon fa fa-chevron-up"></i>
                        </a>                                         
                     </div>                     
               </div>
               <div class="widget-body">
                  <div class="widget-main">




                              <div class="form-group">
                                 <label for="gw" class="col-sm-2 control-label"><strong>Gross Weight</strong></label>
                                 <div class="col-sm-2">
                                         <input type="text" name="gw" value="0"  class="form-control"
                                         autocomplete="off" placeholder="Entry Gross Weight" 
                                          style="text-align: right" id="grossw" />
                                       @if($errors->has('gw'))
                                                 <div class="text-danger font-w400 font-size-sm">
                                                     {{ $errors->first('gw')}}
                                                 </div>
                                             @endif

                                 </div>
                                 <div class="col-sm-2">
                                         <select name="sat_gw" id="sat_gw" class="form-control">
                                             <option value="">-- PILIH --</option>
                                             <option value="KGS" selected>KGS</option>
                                         </select>
                                 </div>
                              </div>         

                              <div class="form-group">
                                 <label class="col-sm-2 control-label"><strong>Volume</strong></label>
                                 <div class="col-sm-2">
                                         <input type="text" name="vol" value="0" class="form-control"
                                          autocomplete="off" placeholder="Entry Volume" 
                                          style="text-align: right;" id="volume"/>
                                       @if($errors->has('vol'))
                                                 <div class="text-danger font-w400 font-size-sm">
                                                     {{ $errors->first('vol')}}
                                                 </div>
                                             @endif
                                 </div>

                                 <div class="col-sm-2">
                                         <select name="sat_vol"  class="form-control">
                                             <option value="">-- PILIH --</option>
                                             <option value="CMB" selected>CBM</option>
                                         </select>
                                 </div>            
                              </div>         

                              <div class="form-group">
                                 <label class="col-sm-2 control-label"><strong>Realease</strong></label>
                                 <div class="col-sm-3">
                                         <input type="date" name="tgl_release"  class="form-control datepicker-input"
                                         autocomplete="off" placeholder="Entry Tanggal" 
                                         value="{{ $tgl }}"
                                         />
                                 </div>
                              </div>         

                              <div class="form-group">
                                 <label for="" class="col-sm-2"></label>
                                 <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary btn-sm px-5">Submit</button>
                                 </div>
                              </div>                           




                  </div>
               </div>
            </div>
         </div>
   </div>



    </form>
@endsection
