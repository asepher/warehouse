@extends('layouts.master')

@section('title')
	Data Upload
@endsection

@section('breadcrumb')
	<a href="{{ route('wh.vessel.index') }}">Vessel</a>
@endsection


@section('content')





    <!-- /.page-header -->
   <div class="page-header">
      <h1>Upload data Manifest</h1>
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

                     <form class="form-horizontal" role="form" action="{{ route('wh.upload.viewdata') }}" method="post">
                     {{ csrf_field() }}

                     <div class="row">
                        <div class="col-md-5">
                           <select name="kd_vsl" class="chosen-select" >
                              <option value="" > -- Pilih -- </option>  
                              @foreach ($vessels as $cus)                       
                              	<option value="{{ $cus->kd_vsl }}" 
                                 {{ (@$cus->kd_vsl == $kd_vsl) ? "selected": "" }}>{{ $cus->kd_vsl ." - " .$cus->vessel }}</option>
                              @endforeach
                           </select>
                             @if($errors->has('kd_vsl'))
                                 <div class="text-danger">
                                     {{ $errors->first('kd_vsl')}}
                                 </div>
                             @endif
                           
                        </div>
                        <div class="col-md-3">
                           <button type="submit" class="btn btn-primary btn-sm px-5">Submit</button>
                        </div>
                     </div> 

                     </form>



               


                  </div>
               </div>


         </div>





       </div>
    </div>


    <div class="row">
       <div class="col-sm-11">
          
        
         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title">Result {{ $kd_vsl }}</h4>
               <div class="widget-toolbar">
               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main">

   
                     @php
                        $no=1;
                     @endphp

               <div class="table-responsive">


                        


                        <table class="table table-sm table-striped" style="width:200%">  
                           <tr>
                              <th>#</th>
                              <th>Term</th>
                              <th>Invoice</th>
                              <th>Cnee</th>
                              <th>Container</th>
                              <th>HBL</th>
                              <th>Weight</th>
                              <th>Measure</th>
                           </tr>                
                              @forelse ($temdatawh as $man)
                              <tr>
                                 <td>{{ $no++ }}</td>
                                 <td>{{ $man->term }}</td>
                                 <td>{{ $man->kd_inv }}</td>
                                 <td>{{ $man->cnee_name }}</td>
                                 <td>{{ $man->container }}</td>
                                 <td>{{ $man->hbl }}</td>
                                 <td>{{ $man->weight }}</td>
                                 <td>{{ $man->measure }}</td>
                              </tr>
                              @empty
                              <tr>
                                 <td colspan="7">No rerecord </td>
                              </tr>

                              @endforelse
                              </table>
                       
                              



                  </div>
               


               


                  </div>
               </div>


         </div>





       </div>
    </div>






@endsection