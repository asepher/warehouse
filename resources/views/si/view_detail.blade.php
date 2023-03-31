@extends('layouts.master')

@section('title')
   Shipping Instruction
@endsection

@section('breadcrumb')
   <a href="{{ route('si.index') }}">Shipping</a>
@endsection

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

   
   <div class="row">
       <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Invoice SI-Ref : {{ $kd_si }}</h4>
                  <div class="widget-toolbar">

                     <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
                              Action
                              <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">                            
                              @foreach ($jenis as $tp)
                                 <li>
                                    <a href="{{ route('si.inv.create',[$tp->param2,$si->kd_si]) }}">{{ $tp->param3 }}</a>
                                 </li>
                              @endforeach 
                                 <li class="divider"></li>
                                 <li>
                                    <a href="{{ route('si.cost.create',[$kd_si]) }}">Cost </a>
                                 </li>


                           </ul>
                        </div><!-- /.btn-group -->

                  </div>
               </div>




               <div class="widget-body">
                  <div class="widget-main no-padding">


                        <table class="table table-sm table-striped table-bordered" style="width:75%">

                        <tr>
                           <th>#</th>
                           <th>Inv</th>
                           <th>Jenis</th>
                           <th>Status</th>
                           <th>Jumlah</th>
                           <th>x</th>
                        </tr>
                      
                        @php
                           $no=1;
                        @endphp
                        @forelse ($viewInv as $inv)
                           @php
                              $file = $inv->no_inv.$inv->jenis.".PDF";
                              $tp = $inv->jenis;
                           @endphp
                           <tr>
                              <td>{{ $no++ }}</td>
                              <td>
                                 <a href="{{ route('si.inv.create',[$inv->jenis,$inv->kd_si]) }}">
                                 {{ $inv->kd_inv  }}
                                 </a>
                              </td>
                              <td>{{ $inv->jenis }}</a></td>
                              <td>                             
                                 @if ($inv->is_posting == 1)
                                    <span class="label label-sm label-success">Posting</span>
                                 @else
                                    <span class="label label-sm label-warning">Not Posting</span> 
                                 @endif
                              </td>
                              <td style="text-align: right;">


                                 {{ Helper::Rupiah($inv->grandtotal) }}

                              </td>
                              <td class="text-center">




                              <div>
                                     <div class="inline position-relative">
                                         <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                             <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
                                         </a>

                                         <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                                             <li>
                                                <a href="{{ route('si.inv.posting',[$inv->jenis,$inv->kd_si]) }}" class="first"
                                                >Posting</a>
                                             </li>
                                             
                                         </ul>
                                     </div>
                                 </div>

                               
                                 
                 
                                 
                              </td>
                           </tr>

                        @empty
                           <tr>
                              <td colspan="6" style="text-align:center;">No Invoice</td>
                           </tr>
                        @endforelse
                     </table>




                  </div>
               
                  </div>
             




            </div>
      </div>
   </div>




   <div class="row">
      <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Shipping Instruction</h4>
                  <div class="widget-toolbar">
                  </div>
               </div>

               <div class="widget-body">
                  <div class="widget-main no-padding">

                  <div class="row">
                     <div class="col-md-6">


  <table class="table table-sm table-striped">
                        <tr>
                           <th style="width: 150px">Kode SI</th><td style="width: 2px">:</td><td>{{ $kd_si }}</td>
                        </tr>
                        <tr>
                           <th>Services</th><td>:</td><td>{{ $si->service . '/' .  $si->tipe }}</td>
                        </tr>
                        <tr>
                           <th>CNEE</th><td>:</td><td>
                              {{ $si->cus_name }}
                           </td>
                        </tr>
                        <tr>
                           <th>Origin</th><td>:</td><td>{{ $si->coo }}</td>
                        </tr>
                        <tr>
                           <th>Port Of Loading</th><td>:</td><td>{{ $si->pol }}</td>
                        </tr>
                        <tr>
                           <th>Port of Discharge</th><td>:</td><td>{{ $si->pod }}</td>
                        </tr>
                        <tr>
                           <th>Vessel</th><td>:</td><td>{{ $si->vessel }}</td>
                        </tr>
                        <tr>
                           <th>Marking</th><td>:</td><td>
                              @php
                                 echo nl2br($si->marking);
                              @endphp
                           </td>
                        </tr>
                  </table>
            

                        

                     </div>
                     <div class="col-md-6">
                        



               <table class="table table-sm table-striped">

                  @if ($si->tipe == 'SEA')
                        <tr>
                           <th style="width: 150px">BL</th><td style="width: 2px">:</td><td>{{ $si->bl }}</td>
                        </tr>
                  @endif
                  @if ($si->tipe == 'AIR')
                        <tr>
                           <th>AWB</th><td>:</td><td>{{ $si->awb }}</td>
                        </tr>
                        <tr>
                           <th>Flight</th><td>:</td><td>{{ $si->flight }}</td>
                        </tr>

                  @endif
                        <tr>
                           <th>ETA</th><td>:</td><td>{{ date("d-m-Y",strtotime($si->eta)) }}</td>
                        </tr>
                        <tr>
                           <th>ETD</th><td>:</td><td>{{ date("d-m-Y",strtotime($si->etd))  }}</td>
                        </tr>
                        <tr>
                           <th>G.Weight</th><td>:</td><td>{{ number_format($si->gw,2) . " " . $si->sat_gw }}</td>
                        </tr>
                        <tr>
                           <th>Volume</th><td>:</td><td>{{ $si->vol . " " . $si->sat_vol }}</td>
                        </tr>
                        <tr>
                           <th>Tgl Release</th><td>:</td><td>
                              {{ date("d-m-Y",strtotime($si->tgl_release))  }}</td>
                        </tr>

                     </table>
                  






                     </div>
                  </div>

                
                   <hr>



                     

                  </div>
               </div>
         </div>
      </div>

   </div>


<script>

$(document).ready(function(){

document.querySelector(".first12").addEventListener('click', function(){
  Swal.fire({
   icon: 'success',
  title: 'Your work has been saved',
  showConfirmButton: false,
  timer: 1500
  });
});

});

</script>

@endsection