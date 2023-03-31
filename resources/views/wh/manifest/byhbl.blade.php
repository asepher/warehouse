@extends('layouts.master')

@section('title')
    Query By HBL
@endsection

@section('breadcrumb')
    <a href="">Query HBL</a>
@endsection


@section('content')
 
    <!-- /.page-header -->
   <div class="page-header">
      <h1>Query By HBL</h1>
   </div><!-- /.page-header -->


    <div class="row">
       <div class="col-sm-11">
          
        
         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title">Search</h4>
               <div class="widget-toolbar">
               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main">

                     <form class="form-horizontal" role="form" 
                     action="{{ route('wh.manifest.qbyhbl') }}" method="post">
                     {{ csrf_field() }}

                     <div class="row">
                        <div class="col-md-5">
                              <input type="text" class="form-control" name="hbl"> 
                             @if($errors->has('hbl'))
                                 <div class="text-danger">
                                     {{ $errors->first('hbl')}}
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
               <h4 class="widget-title">Result HBL - {{ $hbl }}</h4>
               <div class="widget-toolbar">

                   <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                              <li>
                                 <a href="#">Excel</a>
                              </li>
                           </ul>
                     </div><!-- /.btn-group -->


               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">

                     @php
                        $no=1;
                     @endphp

               <div class="table-responsive">
      
                  

                        <table style="width:120%;line-height: 20px;overflow: hidden;"  class="table table-striped table-hover">  
                           <thead>
                           <tr style="text-align: center;" >
                              <th style="padding: 5px;width: 20px;">#</th>
                              <th style="width: 40px;text-align: center;">Term</th>
                              <th style="width: 150px;text-align: center;">
                              	Invoice</th>
                              <th>Cnee</th>
                              <th>Container</th>
                              <th>HBL</th>
                              <th>Weight</th>
                              <th>Measure</th>
                           </tr>  
                           </thead>              
                              @forelse ($manifest as $man)
                              <tr>
                                 <td style="padding: 5px 0;padding-left: 5px">{{ $no++ }}</td>
                                 <td style="padding: 5px 0;padding-left: 5px">{{ $man->term }}</td>
                                 <td style="padding: 5px 0;padding-left: 5px">
                                 		<a href="{{ route('wh.invoice.view',[$man->kd_inv]) }}"
                                 			>{{ $man->kd_inv }}</a></td>
                                 <td style="padding: 5px 0;padding-left: 5px" >{{ $man->cnee_name }}</td>
                                 <td style="padding: 5px 0;padding-left: 5px">{{ $man->container }}</td>
                                 <td style="padding: 5px 0;padding-left: 5px">{{ $man->hbl }}</td>
                                 <td style="padding: 5px 0;padding-left: 5px;text-align: right;">{{ $man->weight }}</td>
                                 <td style="padding: 5px 0;padding-left: 5px;text-align: right;">{{ $man->measure }}</td>
                              </tr>
                              @empty
                              <tr>
                                 <td colspan="7">No rerecord </td>
                              </tr>

                              @endforelse
                              </table>
                       
                              
                              <p></p>
                              <br>


                  </div>
               


               </div>
               


               </div>


         </div>





       </div>
    </div>




@endsection