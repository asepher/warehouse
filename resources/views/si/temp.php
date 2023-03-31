
   								<div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown" style="font-size: 13px;"><i class="bi bi-three-dots"></i></div>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li style="font-size: 14px;"><a class="dropdown-item" href="{{ route('si.edit',[$si->kd_si]) }}"
                                @if ($si->is_posting >= 1)
                                    style="pointer-events: none;" 
                                 @endif
                                 >Edit</a>
                               </li> 
                               <li style="font-size: 14px;"><a class="dropdown-item" 
                               	href="{{ route('si.destroy',[$si->kd_si]) }}" onclick="return confirm('Anda yakin menghapus data ?')"
                                @if ($si->is_posting >= 1)
                                    style="pointer-events: none;" 
                                 @endif
                                 >Delete</a>
                               </li> 
                               <li><hr class="dropdown-divider"></li>
                               <li style="font-size: 14px;">
                               		<a class="dropdown-item" href="{{ route('si.show',[$si->kd_si]) }}">Invoice</a>
                               </li>
                               <li style="font-size: 14px;">
	                               	<a class="dropdown-item" href="">Cost</a>
                               </li style="font-size: 14px;">  
                                <li><hr class="dropdown-divider"></li>
                               <li style="font-size: 14px;"><a class="dropdown-item" href="">
                                	 Summary</a>
                               </li>                               
                              </ul>
                          </div>
           					


                    <hr>


    <!-- /.page-header -->
   <div class="page-header">
      <h1>Shipping Instruction </h1>
   </div><!-- /.page-header -->




   <div class="row">
       <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                  <h4 class="widget-title"></h4>
                  <div class="widget-toolbar">

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