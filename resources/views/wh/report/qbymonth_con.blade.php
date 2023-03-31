@extends('layouts.master')

@section('title')
    Report Period Container
@endsection


@section('breadcrumb')
    <a href="{{ route('wh.invoice.bymonth') }}">By Month</a>
@endsection
 

@section('content')


    <!-- /.page-header -->
   <div class="page-header">
      <h1>Query Container </h1>
   </div><!-- /.page-header -->


   <div class="row">
       <div class="col-sm-11">
          
        
         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title">Search - Container - {{ Helper::GetMonth($bulan) }}</h4>
               <div class="widget-toolbar">

                  <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                              <li>
                                 <a href="#"
                                    onclick="event.preventDefault();
                                    document.getElementById('export-tgl').submit();"
                                    >Excel</a>
                                    <form id="export-tgl" 
                                       action="{{ route('manifest.montly.cont_excel') }}" 
                                       method="POST">
                                       {{ csrf_field() }}
                                       <input type="hidden" name="bln" value="{{ $bulan }}">
                                      
                                    </form>
                              </li>
                           </ul>
                     </div><!-- /.btn-group -->

               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">


      <table style="width:120%;line-height: 20px;overflow: hidden;padding: 10px;" class="table table-striped table-hover">
         <tr style="background-color: #ccdff3;">
            <th style="width:5px;text-align: center;">#</th>
            <th style="width:150px;text-align: center;">ETA</th>
            <th style="width:250px;text-align: center;">CONTAINER</th>
            <th style="text-align: center;">VESSEL</th>
            <th style="text-align: center;">INVOICE</th>
         </tr>
         @php
            $brs = 1;
         @endphp
         @foreach ($container as $cnt)
            <tr>
               <td>{{ $brs++ }}</td>
               <td>{{ Helper::TglIndo($cnt->eta) }}</td>
               <td>
                  <a href="{{ route('wh.container.report',$cnt->container) }}">{{ $cnt->container }}</a>
               </td>
               <td>{{ $cnt->vessel }}</td>
               <td style="text-align: right;">
                   @php
                     $totbyCont = App\Models\IwhHeader::where('container', $cnt->container)
                              ->where('term','CNF')->sum('grandtot');
                  @endphp
                     {{ Helper::Rupiah($totbyCont) }}
               </td>
            </tr>
         @endforeach
      </table>



                  </div>
              </div>
          </div>
      </div>
  </div>






@endsection