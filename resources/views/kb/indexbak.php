@extends('layouts.app')

@section('title')
   Kasbank
@endsection

@section('content')


<div class="container">
         
         <div class="card border">
            <div class="card-header py-3">
                  <div class="row align-items-center">
                     <div class="col-md-9">
                        <h4 class="mb-0">Kasbank</h4>                        
                     </div>
                     <div class="col-md-2 text-md-end">
                           <a href="{{ route('kb.create') }}" class="btn btn-primary btn-sm">Add New</a>
                     </div>

                     <div class="col-md-1 text-md-end">
                        <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></div>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li style="font-size: 14px"><a class="dropdown-item" href="">Query</a>
                               </li>                               
                                <li style="font-size: 14px"><a class="dropdown-item" href="{{ route('kb.exportexcel') }}">Export</a>
                               </li>                               
                              </ul>
                          </div>


                     </div>
                  </div>
               </div>



            <div class="card-body">

                  
                  <div class="table-responsive">      

                   <table class="table align-middle" id="example">
                     <thead class="table-secondary">
                        <tr>
                           <th class="text-center" >#</th>
                           <th class="text-center" >Kode</th>
                           <th class="text-center" >Tanggal</th>
                           <th class="text-center" >Keterangan</th>
                           <th class="text-center" >USD</th>
                           <th class="text-center" >Rp</th>                  
                           <th class="text-center" >Saldo</th>                  
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
              $cek = App\Models\Harian::where('id',$h->id)->first();  
              $status = $cek->is_posting;
          @endphp

                     <tr>                           
                        <td>{{ $no++ }}</td>
                        <td>{{ $h->kd_tr }}</td>
                        <td>{{ $h->tanggal }}</td>
                        <td>{{ $h->keterangan1 ." " . $h->keterangan3 }}</td>
                   
                        @if ($h->tipe == 'Debet')                    
                           <td style="text-align: right;">{{ Rupiah($h->jumlah) }}</td>
                           <td></td>                                          
                           @php
                              $jd = $jd + $h->jumlah;
                            @endphp 
                        @endif
                        @if ($h->tipe == 'Kredit')
                           <td></td>                                          
                           <td style="text-align: right;">{{ Rupiah($h->jumlah) }}</td>
                           @php
                              $jk = $jk + $h->jumlah; 
                           @endphp
                        @endif
                        <td style="text-align: right;" 
                            @if ($status == 1)
                              class="text-danger"
                           @endif
                           >
                              @php
                                 $saldo = $jd - $jk;  
                              @endphp                                                      
                              {{ Rupiah($saldo) }}
                        </td>
                        <td class="text-center">

   <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li style="font-size: 14px;"><a class="dropdown-item" href="{{ route('kb.edit',$h->kd_tr) }}"
                                  @if ($status == 1)
                                    style="pointer-events: none;" 
                                 @endif
                                 >Edit</a>
                               </li>
                               
                                <li><hr class="dropdown-divider"></li>
                                <li style="font-size: 14px;">

                        <form action="{{ route('kb.posting') }}" method="POST">
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
                        <td colspan="6"> No record</td>
                     </tr>

                     @endforelse          
                  </tbody>
                  <tr>
                     <td colspan="4">Jumlah</td>
                     <td style="text-align: right;"><strong>{{Rupiah($jd)}}</strong></td>
                     <td style="text-align: right;"><strong>{{Rupiah($jk)}}</strong></td>
                  </tr>

                  </table>
               </div>

            </div>
         </div>

</div>


@endsection






================




@extends('layouts.app')

@section('title')
   Kasbank
@endsection

@section('content')


<div class="container">
         
         <div class="card border">
            <div class="card-header py-3">
                  <div class="row align-items-center">
                     <div class="col-md-9">
                        <h4 class="mb-0">Kasbank</h4>                        
                     </div>
                     <div class="col-md-2 text-md-end">
                           <a href="{{ route('kb.create') }}" class="btn btn-primary btn-sm">Add New</a>
                     </div>

                     <div class="col-md-1 text-md-end">
                        <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></div>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li style="font-size: 14px"><a class="dropdown-item" href="">Query</a>
                               </li>                               
                                <li style="font-size: 14px"><a class="dropdown-item" href="{{ route('kb.exportexcel') }}">Export</a>
                               </li>                               
                              </ul>
                          </div>


                     </div>
                  </div>
               </div>



            <div class="card-body">

                  
                  <div class="table-responsive">      
                     @php
                        $no = 1;
                     @endphp
                   <table class="table align-middle" id="example">
                     <thead class="table-secondary">
                        <tr>
                           <th class="text-center" width="10px">#</th>
                           <th class="text-center" >Kode</th>
                           <th class="text-center" >Tanggal</th>
                           <th class="text-center" >Keterangan</th>
                           <th class="text-center" >Lokasi</th>
                           <th class="text-center" >USD</th>
                           <th class="text-center" >Rp</th>  
                           <th style="width:5px">x</th>
                         
                        </tr>               
                     </thead>
                  <tbody>

                     @forelse  ($harian as $h)
         @php    
              $cek = App\Models\Harian::where('id',$h->id)->first();  
              $status = $cek->is_posting;
          @endphp

                     <tr>                           
                        <td>{{ $no++ }}</td>
                        <td>{{ $h->kd_tr }}</td>
                        <td>{{ $h->tanggal }}</td>
                        <td>{{ $h->keterangan1 }}</td>                        
                        <td>{{ $h->keterangan3 }}</td> 
                        <td style="text-align: right;">

                           {{ ($h->usd >= 1) ? Usd($h->usd) :  '' }}

                        </td>
                        <td style="text-align: right;">

                           {{ ($h->jumlah >= 1) ? Rupiah($h->jumlah) :  '' }}

                        </td>
                        <td class="text-center">

   <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li style="font-size: 14px;"><a class="dropdown-item" href="{{ route('kb.edit',$h->kd_tr) }}"
                                  @if ($status == 1)
                                    style="pointer-events: none;" 
                                 @endif
                                 >Edit</a>
                               </li>
                               
                                <li><hr class="dropdown-divider"></li>
                                <li style="font-size: 14px;">

                        <form action="{{ route('kb.posting') }}" method="POST">
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
                        <td colspan="6"> No record</td>
                     </tr>

                     @endforelse          
                  </tbody>
                  <tr>
                     <td colspan="4">Jumlah</td>
                     <td style="text-align: right;">0</td>
                     <td style="text-align: right;">0</td>
                  </tr>

                  </table>
               </div>

            </div>
         </div>

</div>


@endsection