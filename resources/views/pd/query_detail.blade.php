@extends('layouts.master')


@section('title')
   Detail Query
@endsection

@section('breadcrumb')
   <a href="{{ route('pd.index') }}">Permohonan Dana</a>
@endsection


@section('content')
   @php    
     $cek = App\Models\Pdhd::where('kd_pd', $kd_pd)->first();  
     $status = $cek->is_posting;
     $hit = App\Models\Pddtl::where('kd_pd', $kd_pd)->count();  
   @endphp

    <!-- /.page-header -->
   <div class="page-header">
      <h1>Query</h1>
   </div><!-- /.page-header -->


    <!-- /.Data-header -->


   <div class="row">
          <div class="col-sm-11">
            <div class="widget-box widget-color-blue2">
                  <div class="widget-header widget-header-flat">
                     <h4 class="widget-title">Data Header</h4>
                     <div class="widget-toolbar"></div>
                  </div>

                  <div class="widget-body">
                     <div class="widget-main no-padding">

                        <div class="row">
                           <div class="col-md-6">
                              <table class="table">
                                  <tr>
                                     <td>No. PD</td><td>: {{ $kd_pd }}</td>
                                  </tr>
                                     <td>Customer</td><td>: {{ $pdhd->customer }}</td>
                                  </tr>
                              </table>                              
                           </div>
                           <div class="col-md-6">
                              <table class="table">
                                  <tr>
                                     <td>Tanggal </td><td>: {{ Helper::TglIndo($pdhd->tanggal) }}</td>
                                  </tr>
                                     <td>Keterangan</td><td>: {{ $pdhd->keterangan }}</td>
                                  </tr>
                              </table>                              
                           </div>
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
                     <h4 class="widget-title">Permohonan Dana</h4>
                     <div class="widget-toolbar">
                        
                     <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
                              Action
                              <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret">                            
                              <li>
                                 <a href="{{ route('pd.printpdf') }}" 
                                    onclick="event.preventDefault();
                                       document.getElementById('print-pdf').submit();"
                                       @if ($hit == 0)
                                          disabled 
                                       @endif
                                       >Print PDF</a>
                                    <form  id="print-pdf" action="{{ route('pd.printpdf') }}" method="POST" target="_blank">
                                       @csrf      
                                        <input type="hidden" name="pd" value="{{ $kd_pd }}">
                                    </form>
                              </li>
                              @if (Auth::user()->user_type == 'SuperAdmin')
                                    <li class="divider"></li>
                                    <li>
                                       <a href="" 
                                         >Unposting</a>
                                    </li>
                              @endif
                           </ul>
                           
                        </div><!-- /.btn-group -->



                     </div>
                  </div>

                  <div class="widget-body">
                     <div class="widget-main padding-16">

                        <strong>Customer</strong> : {{ $pdhd->customer }} <br>
                        <strong>Keterangan</strong> : {{ $pdhd->keterangan }} <p>
                   
                  <div class="row">
                     <div class="col-md-10">
                        

                        <fieldset>




                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th width="5px">#</th>
                                <th>Keterangan</th>
                                <th width="200px">Jumlah</th>                           
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                 $no = 1;
                                 $jumlah_plus = 0; $jumlah_min = 0;
                            @endphp
                            @foreach ($detail as $d)                        

                                @if ( $d->noted == 1)
                                    <tr>
                                        <td></td>
                                        <td>
                                            @php
                                                echo nl2br($d->keterangan);
                                            @endphp
                                            
                                        </td>
                                        <td></td>
                                        <td class="text-right">                                         
                                             <a href="{{ route('pd.editdetail', [$kd_pd,$d->id]) }}" 
                                                @if ($cek->is_posting == 1)
                                                style="color: red; pointer-events: none;"
                                             @endif >
                                             <i class="bi bi-pencil-fill"></i>
                                             </a>
                                        </td>    
                                    </tr>
                                @else
                                    <tr scope="row">
                                        <td>{{ $no++ }}</td>    
                                        <td>{{ $d->keterangan }} </td>    
                                        <td style="text-align:right">{{ Helper::Rupiah($d->jumlah)}} </td>
                                 </tr>               
                                @endif
                                
                                @php
                                  if ($d->operator == 'plus') {
                                      $jumlah_plus = $jumlah_plus + $d->jumlah;
                                    }                                    
                                    if ($d->operator == 'minus') {
                                      $jumlah_min = $jumlah_min + $d->jumlah;
                                    }
                                @endphp              
                            @endforeach                        
                        </tbody>  
                         @php
                          $jumlah_tot = $jumlah_plus - $jumlah_min;
                        @endphp
                        <tr>
                            <td colspan="2" style="text-align:center;">Jumlah</td>
                            <td style="text-align:right"> {{ Helper::Rupiah($jumlah_tot) }}</td>
                        </tr>                  
                    </table>




                 </fieldset>
                   
                     </div>
                  </div>                     


                     </div>

                  </div>

               </div>
            </div>

   </div>







@endsection