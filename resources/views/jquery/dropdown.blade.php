@extends('layouts.master')


@section('title')
    Create Shipping Instruction
@endsection

@section('breadcrumb')
    <a href="{{ route('si.index') }}">Shipping</a>
@endsection

@section('content')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 

  <!-- /.page-header -->
   <div class="page-header">
      <h1>Shipping Instruction </h1>
   </div><!-- /.page-header -->




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

   <form class="form-horizontal" role="form" action="{{ route('si.store') }}" method="post">
                     {{ csrf_field() }}



      <div class="form-group">
         <label class="col-sm-2 control-label"><strong>Services</strong></label>
         <div class="col-sm-3">
            <select name="service" class="form-control" id="service">
               <option value="">-- Pilih --</option>
               <option value="IMPORT"
               @if ( old('service') == 'IMPORT'  )
                   selected
               @endif
               >IMPORT</option>
               <option value="EXPORT" 
               @if ( old('service') == 'EXPORT'  )
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
         <div class="col-md-6">
               <p id="pilihService"></p>            
         </div>
      </div>    



         <div class="form-group">
            <label for="" class="col-sm-2"></label>
            <div class="col-sm-3">
               <select name="tipe" class="form-control">
                  <option value="">-- Pilih -- </option>
                  <option value="SEA"
                  @if ( old('tipe') == 'SEA')
                      selected
                  @endif
                  >SEA</option>
                  <option value="AIR"
                  @if ( old('tipe') == 'AIR')
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



<div id="bl"></div>    
<div id="awb"></div>    
<div id="flight"></div>    

                              <div class="form-group">
                                 <label for="bl" class="col-sm-2 control-label"><strong>BL</strong></label>
                                 <div class="col-sm-4">
                                         <input type="text" name="bl" class="form-control"   
                                         autocomplete="off" placeholder="Entry Bill Of Lading"  
                                         onkeyup="this.value = this.value.toUpperCase()" />
                                 </div>
                              </div>         

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




</form>

                  </div>
              </div>
            </div>
        </div>
    </div>



<script>
function displayServices() {    
  var singleServices = $( "#service" ).val();    
  $( "#pilihService" ).html( "<b>Value:</b> " + singleServices);    
}    
$( "select" ).change( displayServices );    

displayServices();  
</script>



@endsection