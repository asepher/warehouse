@extends('layouts.app')

@section('content')

<div class="container">
      <div class="row11">

         <div class="card border">

            <div class="card-header py-3">

            <div class="row align-items-center">
               <div class="col-md-9">
                  <h4 class="mb-0">Permohonan Dana</h4>
               </div>
               <div class="col-md-2 text-end">
                  <a href="{{ route('pd.create') }}" class="btn btn-primary btn-sm">Add New</a>
               </div>               
               <div class="col-md-1 d-flex justify-content-end">
                        <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></div>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li style="font-size: 14px"><a href="{{ route('pd.exportexcel') }}" class="dropdown-item">Excel</a>
                                </li>
                                <li style="font-size: 14px"><a class="dropdown-item" href="">Query</a>
                               </li>                               
                              </ul>
                          </div>


               </div>
            </div>
           
            </div>
            <div class="card-body">

               @php
                  $no = 1;
               @endphp

               <div class="table-responsive123">      

              <table  class="table align-middle" id="example">
               <thead class="table-secondary">
                  <tr  class="bg-light">
                       <th>#</th>
                       <th>Tanggal</th>
                       <th>PD</th>
                       <th>Customer</th>
                       <th>Penerima</th>
                       <th>Keterangan</th>                             
                       <th>Jumlah</th>
                       <th style="width:5px">x</th>
                  </tr>                  
               </thead>
                  @foreach($pdhd as $p)  
                     @php    
                        $cek = App\Models\Pdhd::where('kd_pd', $p->kd_pd)->first();  
                        $status = $cek->is_posting;
                     @endphp                
                  <tr>
                     <td>{{ $no++ }}</td>
                     <td>{{ TglIndo($p->tanggal) }}</td>
                     <td>{{ $p->kd_pd  }}</td>
                     <td>{{ $p->customer }}</td>
                     <td>{{ $p->penerima }}</td>
                     <td>{{ $p->keterangan }}</td>
                     <td class="text-end" 
                     @if ($status == 1)
                      style="color: red;"
                     @endif
                     >{{ Rupiah($p->jumlah) }}</td>
                     <td>

                     <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li style="font-size: 14px"><a class="dropdown-item" href="{{ route('pd.edit',[$p->kd_pd]) }}"
                                  @if ($status == 1)
                                    style="pointer-events: none;" 
                                 @endif
                                 >
                                 Edit</a></li>
                                <li style="font-size: 14px"><a class="dropdown-item" href="{{ route('pd.detail',[$p->kd_pd]) }}">
                                  Detail</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li style="font-size: 14px">

                              <form action="{{ route('pd.posting') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="pd" value="{{ $p->kd_pd }}">
                                    <button type="submit" class="dropdown-item" 
                                    @if ($cek->is_posting == 1)
                                         disabled 
                                    @endif
                                    ><span style="font-size: 14px">Posting</span></button>
                                </form>


                                </li>
                              </ul>
                          </div>

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


                   <div class="fs-5 ms-auto dropdown">
                                     <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown" style="font-size: 12px"><i class="bi bi-three-dots"></i></div>
                                       <ul class="dropdown-menu dropdown-menu-end">
                                         <li style="font-size: 14px"><a class="dropdown-item" href="{{ route('pd.edit',[$p->kd_pd]) }}"
                                           @if ($status == 1)
                                             style="pointer-events: none;" 
                                          @endif
                                          >
                                          Edit</a></li>
                                         <li style="font-size: 14px"><a class="dropdown-item" href="{{ route('pd.detail',[$p->kd_pd]) }}">
                                           Detail</a></li>
                                         <li style="font-size: 14px">
                                             <form action="#" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item"  style="font-size: 14px;"
                                                onclick="return confirm('Anda yakin menghapus data ?')" 
                                                >Delete</button>
                                             </form>
                                         <li><hr class="dropdown-divider"></li>
                                         <li style="font-size: 14px">

                                       <form action="{{ route('pd.posting') }}" method="POST">
                                             {{ csrf_field() }}
                                             <input type="hidden" name="pd" value="{{ $p->kd_pd }}">
                                             <button type="submit" class="dropdown-item" 
                                             @if ($cek->is_posting == 1)
                                                  disabled 
                                             @endif
                                             ><span style="font-size: 14px">Posting</span></button>
                                         </form>


                                         </li>
                                       </ul>
                                   </div>



===================

      table {           
         width: 100%;         
         border-collapse: collapse;
      }  
      th,td    {
         padding:1px;
      }
      .garis {
         border-left: 1px solid #000;
      }

      .tabledetail {
         border: 1px solid #000;
         width: 100%;         
         border-collapse: collapse;
      }
      .ratakanan {
         text-align: right;
      }
      .ratatengah {
         text-align: center;
      }
      .paraf{
         height: 5;
      }
      div { height: 5;  }
      .center-image {
        background-image: url("images/ssl_gw.png");        
         height: 300px;
         background-position: center;
         background-repeat: no-repeat;
         background-size: cover;
         position: relative;
      }

      