@extends('layouts.master')

@section('title')
   Container
@endsection

@section('breadcrumb')
   <a href="{{ route('wh.manifest.bycontainer') }}">Container</a>
@endsection

 
@section('content')


   <!-- /.page-header -->
   <div class="page-header">
      <h1>SOA</h1>
   </div><!-- /.page-header -->
   
 <div class="row">
    <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
              <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">List - Bulan : {{ $nmbulan.'-'. $tahun}}</h4>
                  <div class="widget-toolbar">

                     <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                              
                              <li>

                      <a href="#"  target="_blank" 
                        onclick="event.preventDefault();
                        document.getElementById('print-all').submit();"

                      >Print PDF
                      </a>
                      <form id="print-all" action="{{ route('wh.manifest.qbysoapdf') }}" method="POST" target="_blank">
                        @csrf
                        <input type="hidden" name="bulan" value="{{ $bulan }}">
                        <input type="hidden" name="tahun" value="{{ $tahun }}">
                      </form>
                              </li>
                              
                              <li>
                                 <a href="#"
                                    onclick="event.preventDefault();
                                    document.getElementById('export-tgl').submit();"
                                    >Excel</a>
                                    <form id="export-tgl" 
                                       action="{{ route('manifest.soa.excel') }}" 
                                       method="POST">
                                       {{ csrf_field() }}
                                        <input type="hidden" name="bulan" value="{{ $bulan }}">
                                        <input type="hidden" name="tahun" value="{{ $tahun }}">                                      
                                    </form>
                              </li>                              
                           </ul>
                     </div><!-- /.btn-group -->


                  </div>
              </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">


    <table class="table table-striped">
        <tr>
          <th>#</th>
          <th>INV</th>
          <th>CNEE</th>
          <th>BL</th>
          <th>WEIGHT</th>
          <th>ACTUAL</th>
          <th>SOA</th>
        </tr>
      </table>
    @foreach ($invMaster as $mas)
     <table class="table table-striped">
        @php
          $hitrec = App\Models\InvDnHeader::where('container',$mas->container)->count();
          $header = App\Models\InvDnHeader::where('container',$mas->container)->get();
          $no = 1; $totPPn = 0;
        @endphp   

          <tr>
            <td colspan="7"><strong>{{ $mas->container }}</strong> -- {{ $hitrec }}</td>
          </tr> 

          @if ( $hitrec >= 1 )

                
          @foreach ($header as $hd)
            <tr>
              <td style="width:7px">{{ $no++ }}</td>
              <td style="width:150px">{{ $hd->kd_inv }}</td>
              <td style="width:250px">{{ $hd->cnee_name }}</td>
              <td>{{ $hd->vls_bl }}</td>
              <td style="width:120px">{{ $hd->weight }}</td>
              <td style="width:120px">{{ $hd->min_actual }}</td>
              <td style="text-align:right;font-weight:bold;width:120px">{{ Helper::Angka($hd->inv_soa_vls) }}</td>
            </tr>
            @php
              $totPPn = $totPPn+$hd->inv_soa_vls;
            @endphp
          @endforeach



          @endif        
        
          <tr>
            <td colspan="6" style="text-align:right;font-weight:14px;">PPN &nbsp&nbsp&nbsp</td>
            <td style="text-align:right;font-weight:bold;font-size: 14px;">{{ Helper::Angka($totPPn*0.11) }} &nbsp&nbsp&nbsp</td>
          </tr>
      </table>
    
    @endforeach



<p><br></p>
<p><br></p>
<p><br></p>

@endsection