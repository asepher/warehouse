@extends('layouts.master')

@section('title')
    Input Aju Number
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
      <h1>Aju Number </h1>
   </div><!-- /.page-header -->
               
                     <form class="form-horizontal" role="form" action="{{ route('si.aju.store',[$si]) }}" method="post">
                     {{ csrf_field() }}

   <div class="row">
        <div class="col-md-11">
            <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                     <h4 class="widget-title">Input Aju</h4>
                     <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                           <i class="ace-icon fa fa-chevron-up"></i>
                        </a>                                         
                     </div>                     
               </div>
               <div class="widget-body">
                  <div class="widget-main">




                              <div class="form-group">
                                 <label for="no_aju" class="col-sm-2 control-label"><strong>No. Aju</strong></label>
                                 <div class="col-sm-2">
                                         <input type="text" name="no_aju" value="0"  class="form-control"
                                         autocomplete="off" placeholder="Entry Aju Number" 
                                          style="text-align: right" id="no_aju" />
                                       @if($errors->has('no_aju'))
                                                 <div class="text-danger font-w400 font-size-sm">
                                                     {{ $errors->first('no_aju')}}
                                                 </div>
                                             @endif

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
