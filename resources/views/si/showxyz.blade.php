@extends('layouts.master')

@section('title')
   Shipping Instruction
@endsection

@section('breadcrumb')
   <a href="{{ route('si.index') }}">Shipping</a>
@endsection

@section('content')



    <!-- /.page-header -->
   <div class="page-header">
      <h1>Shipping Instruction </h1>
   </div><!-- /.page-header -->



   <div class="row">
       <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Invoice</h4>
                  <div class="widget-toolbar">

                  </div>
               </div>


               <div class="widget-body">
                  <div class="widget-main no-padding">


               <table class="table table-sm table-striped" style="width:75%">
                     <thead class="table-secondary">
                     <tr>
                        <th>#</th>
                        <th>Inv</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th>Jumlah</th>
                        <th>x</th>
                     </tr>
                     </thead>
                     @php
                        $no=1;
                     @endphp
                     @forelse ($viewInv as $inv)
                     @php
                        $file = $inv->no_inv.$inv->tipe.".PDF";
                     @endphp
                        <tr>
                           <td>{{ $no++ }}</td>
                           <td><a href="{{ asset('siinv/'.$file) }}" target="_blank">
                              {{ $inv->no_inv . $inv->tipe }}</a></td>
                           <td>{{ $inv->tipe }}</td>
                           <td >
                              
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
                                             <a  href="{{ url('/siinv/'.$file) }}" target="_blank" 
                                             >Download</a>
                                          </li>
                                          <li>
                                             <a  href="{{ route('si.inv.posting',[$inv->tipe]) }}" 
                                              onclick="event.preventDefault();
                                                     document.getElementById('posting-data').submit();"
                                             >Posting {{ $inv->tipe }}</a>
                                             <form id="posting-data" action="{{ route('si.inv.posting',[$inv->tipe]) }}" method="POST" class="d-none">
                                                @csrf
                                                <input type="hidden" name="si" value="{{ $id }}">
                                             </form>
                                          </li>
                                      </ul>
                                  </div>
                              </div>


                              
              
                              
                           </td>
                        </tr>

                     @empty
                        <tr>
                           <td colspan="5">No Invoice</td>
                        </tr>
                     @endforelse
                  </table>




                  </div>
               
                  </div>
               </div>




            </div>
      </div>
   </div>



<hr>

   <div class="row">
       <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Invoice SI-Ref : {{ $id }}</h4>
                  <div class="widget-toolbar">

                     <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
                              Action
                              <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">                            
                              @foreach ($tipe as $tp)
                                 <li>
                                    <a href="{{ route('si.inv.create',[$tp->param2,$si->kd_si]) }}">{{ $tp->param3 }}</a>
                                 </li>
                              @endforeach 


                           </ul>
                        </div><!-- /.btn-group -->

                  </div>
               </div>

               <div class="widget-body">
                  <div class="widget-main no-padding">



                  <table class="table table-sm table-striped">
                        <tr>
                           <th style="width: 150px">Kode SI</th><td style="width: 2px">:</td><td>{{ $id }}</td>
                        </tr>
                        <tr>
                           <th>Services</th><td>:</td><td>{{ $si->service . '/' .  $si->tipe }}</td>
                        </tr>
                        <tr>
                           <th>CNEE</th><td>:</td><td>
                              {{ $si->kd_cus }}
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
            
            <hr>



                     <table class="table table-sm table-striped">
                        <tr>
                           <th style="width: 150px">BL</th><td style="width: 2px">:</td><td>{{ $si->bl }}</td>
                        </tr>
                        <tr>
                           <th>AWB</th><td>:</td><td>{{ $si->awb }}</td>
                        </tr>
                        <tr>
                           <th>Flight</th><td>:</td><td>{{ $si->flight }}</td>
                        </tr>
                        <tr>
                           <th>ETA</th><td>:</td><td>{{ date("d-m-Y",strtotime($si->eta)) }}</td>
                        </tr>
                        <tr>
                           <th>ETD</th><td>:</td><td>{{ date("d-m-Y",strtotime($si->etd))  }}</td>
                        </tr>
                        <tr>
                           <th>G.Weight</th><td>:</td><td>{{ $si->gw . " " . $si->sat_gw }}</td>
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
            </div>
      </div>
   </div>




@endsection