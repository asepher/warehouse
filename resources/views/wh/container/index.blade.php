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
                  <h4 class="widget-title">List</h4>
                  <div class="widget-toolbar">

                     <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                              <li>
                                    <a href="{{ route('wh.container.view_pdf') }}" target="_blank">Print PDF</a>

                              </li>
                           </ul>
                     </div><!-- /.btn-group -->


                  </div>
              </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">


                     <table class="table table-bordered table-striped table-hover" id="dynamic-table">
                        <thead>
                           <tr>
                              <th>NO</th>
                              <th>ETA</th>
                              <th>CONTAINER</th>
                              <th>INVOICE</th>
                              <th>JUMLAH</th>
                           </tr>                           
                        </thead>
                        @php
                           $no = 1;
                        @endphp
                        <tbody>
                           @foreach ($container as $cont)
                              <tr>
                                 <td style="width:5px;">{{ $no++ }}</td>
                                 <td>{{ Helper::TglIndo($cont->eta)}}</td>
                                 <td>{{ $cont->container }}</td>
                                 <td>
                                    @php
                                       $hitInv = App\Models\IwhHeader::where('container',$cont->container)->orderBy('eta','DESC')->count();
                                    @endphp
                                       {{ $hitInv }}
                                 </td>
                                 <td>
                                    0
                                 </td>

                              </tr>
                           @endforeach
                        </tbody>
                        
                     </table>


                  </div>
               </div>

      </div>
   </div>


@endsection