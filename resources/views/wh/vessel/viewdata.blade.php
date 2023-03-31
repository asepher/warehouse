@extends('layouts.master')

@section('title')
    Index Vessel
@endsection


@section('content')
 
    <!-- /.page-header -->
   <div class="page-header">
      <h1>Data Vessel </h1>
   </div><!-- /.page-header -->


    <div class="row">
       <div class="col-sm-11">
          
        

         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title"></h4>
               <div class="widget-toolbar">

                     <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                              <li>
                                    <a href="{{ route('wh.vessel.create') }}">Create</a>
                              </li>
                           </ul>
                     </div><!-- /.btn-group -->

 

               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main">
                        <a href="{{ route('vessel.export_excel') }}" class="btn btn-success btn-sm">excel</a>
                        <p></p>
                    <table class="table">
                    @foreach ($vessels as $vessel)
                      <tr>
                        <td>{{$vessel->kd_vsl}}</td>
                        <td>{{$vessel->vessel}}</td>
                        <td>{{$vessel->container}}</td>
                        <td>{{$vessel->jum_pos}}</td>
                      </tr>
                        
                    @endforeach
                    </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
  

@endsection  