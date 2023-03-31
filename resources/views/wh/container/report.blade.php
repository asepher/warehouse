@extends('layouts.master')

@section('title')
   Report Container
@endsection

@section('breadcrumb')
   <a href="{{ route('charge.index') }}">Container</a>
@endsection


@section('content')



   <!-- /.page-header -->
   <div class="page-header">
      <h1>Container Report</h1>
   </div><!-- /.page-header -->



 <div class="row">
    <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
              <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Container  {{ $container }}</h4>
                  <div class="widget-toolbar">

                     <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                              <li>
                                    <a href="#" >Excel </a>

                              </li>
                           </ul>
                     </div><!-- /.btn-group -->


                  </div>
              </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">


                     <table class="table table-bordered table-striped table-hover">
                        
                           <tr style="background-color: #ccdff3;">
                              <th>NO</th>
                              <th>No. INV.</th>
                              <th>INV.</th>
                              <th>VAT.</th>
                              <th>MATERAI</th>
                              <th>TOTAL</th>
                           </tr>                           
                        
                        @php
                           $no = 1;
                        @endphp
                        <tbody>
                           @foreach ($invoices as $inv)
                              <tr>
                                 <td style="width:5px;">{{ $no++ }}</td>
                                 <td>{{ Helper::FormatInvWh($inv->kd_inv) }}</td>
                                 <td>{{ Helper::Rupiah($inv->jumlah) }}</td>
                                 <td>{{ Helper::Rupiah($inv->vat) }}</td>
                                 <td>{{ Helper::Rupiah($inv->materai) }}</td>
                                 <td>{{ Helper::Rupiah($inv->grandtot) }}</td>
                              </tr>
                           @endforeach
                        </tbody>
                        
                     </table>


                  </div>
               </div>

      </div>
   </div>


@endsection