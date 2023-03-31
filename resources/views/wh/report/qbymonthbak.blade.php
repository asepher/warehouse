@extends('layouts.master')

@section('title')
    Report Period
@endsection


@section('breadcrumb')
    <a href="{{ route('wh.invoice.bymonth') }}">By Month</a>
@endsection
 

@section('content')


    <!-- /.page-header -->
   <div class="page-header">
      <h1>Query By Month</h1>
   </div><!-- /.page-header -->


    <div class="row">
       <div class="col-sm-11">
          
        
         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title">Search </h4>
               <div class="widget-toolbar">
               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">


@if ($container)
      <table class="table">
         <tr style="background-color: #ccdff3;">
            <th>#</th>
            <th>Eta</th>
            <th>Container</th>
            <th>BL</th>
         </tr>
         @foreach ($container as $cnt)
            <tr>
               <td>1</td>
               <td>{{ $cnt->eta }}</td>
               <td>{{ $cnt->container }}</td>
               <td>{{ $cnt->vls_bl }}</td>
            </tr>
         @endforeach
      </table>
@endif
@if ($vessel)
   vessel ada data
@endif




                  </div>
              </div>
          </div>
      </div>
  </div>


@endsection