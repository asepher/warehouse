@extends('layouts.master')

@section('title')
    Daily Report
@endsection


@section('breadcrumb')
    <a href="">Report</a>
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
 
 @php
   
 @endphp
    <!-- /.page-header -->
   <div class="page-header">
      <h1>Daily Report</h1>
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

                     <form class="form-horizontal" role="form" action="{{ route('report.daily.view') }}" method="post">
                     {{ csrf_field() }}

                     <div class="row">
                        <div class="col-md-2">
                       
                           <select name="tanggal" class="form-control" >
                              <option value="" > -- Pilih -- </option> 
                                 @for ($i = 1; $i < 32 ; $i++)
                                    <option value="{{ $i }}"
                                    @if ( $dd == $i)
                                      selected 
                                    @endif
                                    > {{ $i }}</option>
                                 @endfor
                           </select>
                        </div> 
                        <div class="col-md-3">

                          @php
                          
                          $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                            $jlh_bln=count($bulan);

                          @endphp

                           <select name="bulan" class="form-control" >
                              <option value="" > -- Pilih -- </option>       

                                @php                                  
                                  for($c=0; $c<$jlh_bln; $c+=1){ @endphp
                                      <option value="{{ $c }}" 
                                      @if ($mm == $c )
                                        selected
                                      @endif                        
                                      > {{ $bulan[$c]  }}  </option>
                                  @php
                                    }
                                  @endphp}
                                

                           </select>
                        </div> 
                        <div class="col-md-2">                         
                           <select name="tahun" class="form-control" >
                                 <option value="2022" 
                                    @if ($yy == 2022)
                                        selected     
                                    @endif
                                 >2022</option>
                                 <option value="2023"
                                    @if ($yy == 2023)
                                        selected     
                                    @endif
                                 >2023</option>
                           </select>
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
               <h4 class="widget-title">Result - Date : {{ Helper::TglIndo($tgl)}}</h4>
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
                                       action="{{ route('manifest.daily.excel') }}" 
                                       method="POST">
                                       {{ csrf_field() }}
                                       <input type="hidden" name="tgl" value="{{$tgl}}">                                      
                                    </form>
                              </li>
                           </ul>
                     </div><!-- /.btn-group -->
 

               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">


 <div class="table-responsive">
                    <table style="width:200%;line-height: 20px;overflow: hidden;padding: 10px;" class="table-bordered">
                      <thead>
                        <tr style="background-color: #ccdff3;">
                          <th style="text-align:center;">NO</th>
                          <th style="text-align:center;">HBL</th>
                          <th style="text-align:center;">TERM</th>
                          <th style="text-align:center;">CNEE</th>
                          <th style="text-align:center;">NPWP</th>
                          <th style="text-align:center;">ADDRESS</th>
                          <th style="text-align:center;">VESSEL</th>
                          <th style="text-align:center;">ETA</th>
                          <th style="text-align:center;">INVOICE</th>
                          <th style="text-align:center;">AMMOUNT</th>
                          <th style="text-align:center;">RELEASE.INV</th>
                          <th style="text-align:center;">PAID</th>
                          <th style="text-align:center;">RELEASE.MEMO</th>                          
                          <th style="text-align:center;">METHOD</th>
                        </tr>                        
                      </thead>
                        @php 
                          $no = 1;
                          $total =  0;   
                        @endphp

                       @forelse ($manifest as $dt)
                            <tr
                            @if ($dt->paid_at == 2)
                              style="background-color: #ffff4d;"
                            @endif
                            >

                              <td style="text-align:center;">{{ $no++ }}</td>
                              <td>{{$dt->hbl}}</td>
                              <td>{{$dt->term}}</td>
                              <td>{{$dt->cnee_name}}</td>
                              <td>{{$dt->cnee_npwp}}</td>
                              <td>{{ Str::limit($dt->cnee_address, 30) }}</td>
                              <td>{{$dt->vessel}}</td>
                              <td>{{date('d-m-Y', strtotime($dt->eta))}}</td>
                              <td>
                                <a href="{{ route('wh.invoice.view',[$dt->kd_inv])}}">{{ $dt->kd_inv}}</a>
                                </td>
                              @if ($dt->term == 'FOB')
                                <td style="text-align: center;">0</td>
                              @endif
                              @if ($dt->term == 'CNF')              
                                <td style="text-align: center;">{{ Helper::Angka($dt->inv_wh)}}</td>
                                @php
                                  $total = $total + $dt->inv_wh;
                                @endphp
                              @endif

                              <td style="text-align: center;">{{ date('d-m-Y', strtotime($dt->tgl_inv)) }}</td>
                             
                              <td>
                                @if (isset($dt->tgl_paid))
                                  {{ date('d-m-Y', strtotime($dt->tgl_paid)) }}
                                @endif
                              </td>
                              <td style="text-align: center;">
                                @if (isset($dt->tgl_mem))
                                  {{ date('d-m-Y', strtotime($dt->tgl_mem)) }}
                                @endif
                              </td>                              
                              <td>
                                @if ($dt->paid_at == 1)
                                   EDC
                                @endif
                                @if ($dt->paid_at == 2)
                                   Transfer
                                @endif
                              </td>
                            </tr>  
                        @empty
                           <tr>
                              <td colspan="9" style="text-align: center;">No record </td>
                           </tr>
                        @endforelse
                </table>
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
               <h4 class="widget-title">Summary </h4>
               <div class="widget-toolbar">
               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main">

                  <table>
                    <tr>
                      <td style="width:150px;font-weight: bold;">Total CNF</td><td style="width:2px">:</td>
                      <td>{{ Helper::Rupiah($totCNF)  }}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold;">By EDC</td><td>:</td><td>{{ Helper::Rupiah($totCNfedc) }}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold;">By Transfer</td><td>:</td><td>{{ Helper::Rupiah($totCNTrans) }}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold;">Paid</td><td>:</td><td>{{ $sudahPaid }}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold;">Unpaid</td><td>:</td><td>{{ $blmPaid }}</td>
                    </tr>
                  </table>

                  </div>
               </div>
         </div>


       </div>
    </div>



@endsection