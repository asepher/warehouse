@extends('layouts.master')

@section('title')
    Report Period Container
@endsection


@section('breadcrumb')
    <a href="{{ route('wh.invoice.bymonth') }}">By Month</a>
@endsection
  

@section('content')

<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
          
        th, td {
            text-align: left;
            padding: 4px;
        }

        #yelow {
            background-color: yellow;
        }
    </style>

    <!-- /.page-header -->
   <div class="page-header">
      <h1>Query Vessel </h1>
   </div><!-- /.page-header -->


    <div class="row">
       <div class="col-sm-11">
          
        
         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title">Search - Vessel - {{ Helper::GetMonth($bulan) }}</h4>
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
                                       action="{{ route('manifest.montly.vsl_excel') }}" 
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


<div class="table-responsive">
   


      <table style="width:120%;line-height: 20px;overflow: hidden;padding: 10px;" class="table-bordered table-striped table-hover">
         <tr style="background-color: #bdbbff;">
            <th style="width:5px" rowspan="2">#</th>
            <th style="width:70px" rowspan="2">ETA</th>
            <th style="width:100px" rowspan="2">VESSEL</th>
            <th style="width:100px" rowspan="2">HBL</th>
            <th style="text-align:center;" rowspan="2">CONT.</th>
            <th style="text-align:center;" rowspan="2">POS</th>
            <th style="text-align:center;" colspan="2">C/F</th>
            <th style="text-align:center;" colspan="3">WAREHOUSE</th>
         </tr>
         <tr style="background-color: #bdbbff;">            
            <th style="text-align:center;">FOB</th>
            <th style="text-align:center;">CNF</th>
            <th style="text-align:center;">IN</th>
            <th style="width:5%;text-align:center;">OUT</th>
            <th style="width:5%;text-align:center;">STOCK</th>
         </tr>


         @php
            $brs = 1;
         @endphp
         @foreach ($vessel as $vsl)
            <tr>
               <td>{{ $brs++ }}</td>
               <td>{{ Helper::TglIndo($vsl->eta) }}</td>
               <td>
                  <a href="{{ route('wh.manifest.index',[$vsl->kd_vsl]) }}">{{ $vsl->vessel }}</a>
               </td>
               <td>{{ $vsl->vls_bl }}</td>
               <td style="width: 5%;text-align: center;">
                  @php
                     $jumlahCon = App\Models\Container::where('kd_vsl', $vsl->kd_vsl)->count();
                  @endphp
                     {{ $jumlahCon }}
               </td>
               <td style="width: 5%;text-align: center;">
                  {{ $vsl->jum_pos }}</td>
               <td style="width: 5%;color: blue;text-align: center;">
                  @php
                     $jumlahFob = App\Models\Manifest::where('kd_vsl', $vsl->kd_vsl)
                                          ->where('term','FOB')->count();
                  @endphp
                     {{ $jumlahFob }}
               </td>
               <td style="width: 5%;color: blue; text-align: center;">
                  @php
                     $jumlahCnf = App\Models\Manifest::where('kd_vsl', $vsl->kd_vsl)
                                          ->where('term','CNF')->count();
                  @endphp
                     {{ $jumlahCnf }}
               </td>
               <td style="width: 5%;color: red; text-align: center;">
                  @php
                     $jumlahInv = App\Models\Manifest::where('kd_vsl', $vsl->kd_vsl)
                                          ->where('gen_inv',1)->count();
                  @endphp
                     {{ $jumlahInv }}

               </td>
               <td style="width: 5%;color: red; text-align: center;">
                   @php
                     $jumlahMem = App\Models\Manifest::where('kd_vsl', $vsl->kd_vsl)
                                          ->where('gen_memo',1)->count();
                  @endphp
                     {{ $jumlahMem }}                  
               </td>
               <td style="width: 5%;color: red; text-align: center;">
                   @php
                     $jumlahStock = $vsl->jum_pos - $jumlahMem;
                  @endphp
                     {{ $jumlahStock }}                  
               </td>
            </tr>
         @endforeach
      </table>

<p></p>
<p></p>
<p></p>
</div>



                  </div>
              </div>
          </div>
      </div>
  </div>




   <div class="row">
       <div class="col-sm-11">
          
        
         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title">Summary</h4>
               <div class="widget-toolbar">
               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main">


      @php
         $totCon = App\Models\Container::whereMonth('eta',$bulan)->count();
         $totPos = App\Models\Vessel::whereMonth('eta',$bulan)->sum('jum_pos');

         $totCNF = App\Models\Manifest::whereMonth('eta',$bulan)->where('term','CNF')->count();
         $totFOB = App\Models\Manifest::whereMonth('eta',$bulan)->where('term','FOB')->count();

         $totInv = App\Models\Manifest::whereMonth('eta',$bulan)->where('gen_inv',1)->count();
         $totOut = App\Models\Manifest::whereMonth('eta',$bulan)->where('gen_memo',1)->count();
         $totStock = $totPos - $totOut;

      @endphp


      <table style="width:100%;line-height: 20px;overflow: hidden;padding: 10px;" class="table-bordered table-striped">
         <tr>
            <th rowspan="2">KETERANGAN</th>
            <th style="text-align:center;width: 150px;" rowspan="2">CONT.</th>
            <th style="text-align:center;width: 150px;" rowspan="2">POS</th>
            <th style="text-align:center;" colspan="2">C/F</th>
            <th style="text-align:center;" colspan="3">WAREHOUSE</th>
         </tr>
         <tr>            
            <th style="width: 100px;text-align:center;">FOB</th>
            <th style="width: 100px;text-align:center;">CNF</th>
            <th style="width: 100px;text-align:center;">IN</th>
            <th style="width: 100px;width:5%;text-align:center;">OUT</th>
            <th style="width: 100px;width:5%;text-align:center;">STOCK</th>
         </tr>
         <tr>
            <td style="padding: 10px;">Summary - {{ Helper::GetMonth($bulan) }}</td>
            <td style="text-align:center;"> {{$totCon}} </td>
            <td style="text-align:center;"> {{$totPos }}</td>
            <td style="text-align:center;color: blue;"> {{$totCNF}}</td>
            <td style="text-align:center;color: blue;"> {{$totFOB}} </td>
            <td style="text-align:center;color: red;">{{ $totInv }}</td>
            <td style="text-align:center;color: red;">{{ $totOut }}</td>
            <td style="text-align:center;color: red;">{{$totStock}}</td>
            
         </tr>
      </table>







                  </div>
               </div>
            </div>
         </div>
      </div>

@endsection