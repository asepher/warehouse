@extends('layouts.master')

@section('title')
    Query Data
@endsection


@section('breadcrumb')
    <a href="{{ route('wh.invoice') }}">Query</a>
@endsection

@section('content')
 
    <!-- /.page-header -->
   <div class="page-header">
      <h1>Query </h1>
   </div><!-- /.page-header -->


    <div class="row">
       <div class="col-sm-11">
          
        
         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title"> </h4>
               <div class="widget-toolbar">
               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main">

               
  <ul>
                        <li><a href="{{ route('wh.invoice.byvessel') }}">Query By Vessel</a></li>
                        <li><a href="{{ route('wh.invoice.bydate') }}">Query By Date</a></li>
                        <li><a href="{{ route('wh.invoice.bycustomer') }}">Query By Customer</a></li>
                     </ul>


                  </div>
               </div>
         </div>

       </div>
    </div>

    <div class="row">
       <div class="col-sm-11">
          
        
         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title"> </h4>
               <div class="widget-toolbar">
               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main">

               
  <ul>
                        <li><a href="{{ route('wh.invoice.byvessel') }}">Query By Vessel</a></li>
                        <li><a href="{{ route('wh.invoice.bydate') }}">Query By Date</a></li>
                        <li><a href="{{ route('wh.invoice.bycustomer') }}">Query By Customer</a></li>
                     </ul>


                  </div>
               </div>
         </div>

       </div>
    </div>

    <div class="row">
       <div class="col-sm-11">
          
        
         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title"> </h4>
               <div class="widget-toolbar">
               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main">

               
  <ul>
                        <li><a href="{{ route('wh.invoice.byvessel') }}">Query By Vessel</a></li>
                        <li><a href="{{ route('wh.invoice.bydate') }}">Query By Date</a></li>
                        <li><a href="{{ route('wh.invoice.bycustomer') }}">Query By Customer</a></li>
                     </ul>


                  </div>
               </div>
         </div>

       </div>
    </div>


@endsection