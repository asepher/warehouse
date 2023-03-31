@extends('layouts.master')

@section('title')
   Container
@endsection

@section('breadcrumb')
   <a href="{{ route('charge.index') }}">Container</a>
@endsection


@section('content')



   <!-- /.page-header -->
   <div class="page-header">
      <h1>Data Container</h1>
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
                  <div class="widget-main">


@php   
    $dd = date('d');
    $mm = date('m');
    $yy = date('Y');
@endphp

  
<form class="form-horizontal" role="form" action="{{ route('wh.log.search') }}" method="post">
                     {{ csrf_field() }}

      <div class="form-group">
         <label class="col-sm-2 control-label" for="eta"><strong> No.Invoice </strong></label>
         <div class="col-md-4">
            <input type="text" name="invoice" class="form-control">
         </div>
         <div class="col-md-5">
            <button type="submit" class="btn btn-primary btn-sm px-5">Submit</button>
         </div>
      </div>

</form>



                  </div>
               </div>
         </div>
      </div>
   </div>


@if ($logs)


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


<div class="row">
   <div class="col-md-10">
      

<table class="table table-bordered table-striped">
   <tr>
      <th>#</th>
      <th>INV</th>
      <th>Term</th>
      <th>Keterangan</th>
      <th>Tgl.Inv</th>
      <th>Username</th>
      <th>Update</th>
   </tr>
   @php
      $no = 1;
   @endphp
   @foreach ($logs as $log)
      <tr>
         <td>{{ $no++ }}</td>
         <td>{{ $log->inv }}</td>
         <td>{{ $log->term }}</td>
         <td>{{ $log->description }}</td>
         <td>{{ $log->tgl_inv }}</td>
         <td>{{ $log->username }}</td>
         <td>{{ $log->updated_at }}</td>        
      </tr>
   @endforeach
</table>





   </div>
</div>


                  </div>
               </div>
         </div>
      </div>
   </div>





@endif






   
@endsection