@extends('layouts.app')

@section('title')
   Kasbank Export Import
@endsection

@section('content')


<div class="container">
         
         <div class="card border">
            <div class="card-header py-2 bg-primary text-white">
                  <div class="row align-items-center">
                     <div class="col-md-9">
                        <h4 class="mb-0">Kasbank Export Import</h4>                        
                     </div>
                     <div class="col-md-2 text-md-end">
                           <a href="{{ route('kb.eximp.create') }}" class="btn btn-white btn-sm">Add New</a>
                     </div>

<div class="col-md-1 text-md-end">
                        <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" 
                            data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i>
                         </div>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li style="font-size: 14px"><a class="dropdown-item" href="">Query</a>
                               </li>                               
                                <li style="font-size: 14px"><a class="dropdown-item" href="">Export</a>
                               </li>                               
                              </ul>
                          </div>


                     </div>
                     
                  </div>
               </div>



            <div class="card-body">

                  

<ul class="nav nav-pills" role="tablist">
                           <li class="nav-item" role="presentation">
                              <a class="nav-link active" data-bs-toggle="tab" href="#dangerhome" role="tab" aria-selected="true">
                                 <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Home</div>
                                 </div>
                              </a>
                           </li>
                           <li class="nav-item" role="presentation">
                              <a class="nav-link" data-bs-toggle="tab" href="#dangerprofile" role="tab" aria-selected="false">
                                 <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Status</div>
                                 </div>
                              </a>
                           </li>                           
                        </ul>


   <div class="tab-content py-5">
                     <div class="tab-pane fade show active" id="dangerhome" role="tabpanel">




                  <div class="table-responsive123">      

                   <table class="table align-middle" id="example1213">
                     <thead class="bg-light">
                        <tr>
                           <th class="text-center" >#</th>
                           <th class="text-center" >Kode</th>
                           <th class="text-center" >Tanggal</th>
                           <th class="text-center" >Keterangan</th>
                           <th class="text-center" >USD</th>
                           <th class="text-center" >Rp</th>                  
                           <th style="width:5px">x</th>
                         
                        </tr>               
                     </thead>
                  <tbody>
                     @php
                        $no=1;
                        $debet=0;
                        $kredit=0;
                        $jd = 0;
                        $jk = 0;
                     @endphp
                     @forelse  ($harian as $h)

                        @php    
                             $cek = App\Models\KbEximp::where('id',$h->id)->first();  
                             $status = $cek->is_posting;
                             $cnee = App\Models\Customer::where('kd_cus', $cek->keterangan1)->first();
                         @endphp

                     <tr 
                     @if ($status == 1) 
                           style="color: red;"
                      @endif
                     >                           
                        <td>{{ $no++ }}</td>
                        <td>{{ $h->kd_tr }}</td>
                        <td>{{ Tglindo($h->tanggal) }}</td>
                        <td>
                           @if ($cnee)
                              {{ $cnee->customer }} - 
                           @endif

                           {{  $h->keterangan3 }}  -  {{ $h->matauang }}

                        </td>
                   

                        @if ($h->matauang == 'Usd')                    
                           <td style="text-align: right;">{{ Usd($h->jumlah) }}</td>
                           <td></td>                                          
                           @php
                              $jd = $jd + $h->jumlah;
                            @endphp 
                        @endif

                        @if ($h->matauang == 'Rp')
                           <td></td>                                          
                           <td style="text-align: right;">{{ Rupiah($h->jumlah) }}</td>
                           @php
                              $jk = $jk + $h->jumlah; 
                           @endphp
                        @endif

                        
                        <td class="text-center">

                  <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown" style="font-size: 12px;"><i class="bi bi-three-dots"></i></div>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li style="font-size: 14px;"><a class="dropdown-item" href="{{ route('kb.eximp.edit',$h->kd_tr) }}"
                                  @if ($status == 1)
                                    style="pointer-events: none;" 
                                 @endif
                                 >Edit</a>
                               </li>
                               
                                <li><hr class="dropdown-divider"></li>
                                <li style="font-size: 14px;">

                        <form action="{{ route('kb.eximp.posting') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ $h->id }}">
                                    <button type="submit" class="dropdown-item"
                                    @if ($cek->is_posting == 1)
                                         disabled 
                                    @endif
                                    >Posting</button>
                           </form>

                                </li>
                              </ul>
                          </div>


                           
                        </td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="8" class="text-center"> No record</td>
                     </tr>

                     @endforelse          
                  </tbody>
                  <tr>
                     <td colspan="4">Jumlah</td>
                     <td style="text-align: right;"><strong>{{Usd($jd)}}</strong></td>
                     <td style="text-align: right;"><strong>{{Rupiah($jk)}}</strong></td>
                  </tr>

                  </table>
               </div>






               </div>
                  <div class="tab-pane fade" id="dangerprofile" role="tabpanel">







                  <div class="table-responsive123">      

                   <table class="table align-middle" id="example">
                     <thead class="table-secondary">
                        <tr>
                           <th class="text-center" style="width: 5px;">#</th>
                           <th class="text-center" style="width: 10px;">Kode</th>
                           <th class="text-center" >Tanggal</th>
                           <th class="text-center" >Keterangan</th>
                           <th class="text-center" >USD</th>
                           <th class="text-center" >Rp</th>                  
                           <th style="width:5px">x</th>
                         
                        </tr>               
                     </thead>
                  <tbody>
                     @php
                        $no=1;
                        $debet2=0;
                        $kredit2=0;
                        $jd2 = 0;
                        $jk2 = 0;
                     @endphp
                     @forelse  ($harian2 as $h2)

                        @php    
                             $cek2 = App\Models\KbEximp::where('id',$h2->id)->first();  
                             $status2 = $cek2->is_posting;
                             $cnee2 = App\Models\Customer::where('kd_cus', $cek2->keterangan1)->first();
                         @endphp

                     <tr>                           
                        <td>{{ $no++ }}</td>
                        <td>{{ $h2->kd_tr }}</td>
                        <td>{{ Tglindo($h2->tanggal) }}</td>
                        <td>
                           @if ($cnee2)
                              {{ $cnee2->customer }} - 
                           @endif

                           {{  $h2->keterangan3 }}  -  {{ $h2->matauang }}

                        </td>
                   

                        @if ($h2->matauang == 'Usd')                    
                           <td style="text-align: right;">{{ Usd($h2->jumlah) }}</td>
                           <td></td>                                          
                           @php
                              $jd2 = $jd2 + $h2->jumlah;
                            @endphp 
                        @endif

                        @if ($h2->matauang == 'Rp')
                           <td></td>                                          
                           <td style="text-align: right;">{{ Rupiah($h2->jumlah) }}</td>
                           @php
                              $jk2 = $jk2 + $h2->jumlah; 
                           @endphp
                        @endif

                        
                        <td class="text-center">

                  <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown" style="font-size: 12px;"><i class="bi bi-three-dots"></i></div>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li style="font-size: 14px;"><a class="dropdown-item" href="{{ route('kb.eximp.edit',$h2->kd_tr) }}"
                                  @if ($status2 == 1)
                                    style="pointer-events: none;" 
                                 @endif
                                 >Edit</a>
                               </li>
                               
                                <li><hr class="dropdown-divider"></li>
                                <li style="font-size: 14px;">

                        <form action="{{ route('kb.eximp.posting') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ $h2->id }}">
                                    <button type="submit" class="dropdown-item"
                                    @if ($cek2->is_posting == 1)
                                         disabled 
                                    @endif
                                    >Posting</button>
                           </form>

                                </li>
                              </ul>
                          </div>


                           
                        </td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="8" class="text-center"> No record</td>
                     </tr>

                     @endforelse          
                  </tbody>
                  <tr>
                     <td colspan="4">Jumlah</td>
                     <td style="text-align: right;"><strong>{{Usd($jd2)}}</strong></td>
                     <td style="text-align: right;"><strong>{{Rupiah($jk2)}}</strong></td>
                  </tr>

                  </table>
               </div>









                  </div>               
         </div>   





            </div>
         </div>

</div>


@endsection