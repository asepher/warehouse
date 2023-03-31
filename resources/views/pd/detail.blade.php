@extends('layouts.master')


@section('title')
   Detail Permohoan Dana
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
      <h1>Permohonan Dana Detail</h1>
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
                                     <td>Tanggal </td><td>: {{ $pdhd->tanggal }}</td>
                                  </tr>
                                     <td>Penerima</td><td>: {{ $pdhd->penerima }}</td>
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
                     <h4 class="widget-title">Detail</h4>
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
                             
                                <li class="divider"></li>
                                             <li>
                                                <a  href="{{ route('pd.posting') }}"
                                                onclick="event.preventDefault();
                                                        document.getElementById('posting-form').submit();" 
                                                @if ($cek->is_posting == 1)
                                                   disabled 
                                                @endif
                                             >Posting</a>

                                             <form id="posting-form" action="{{ route('pd.posting') }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="pd" value="{{ $kd_pd }}">                                                  
                                             </form>                              
                                           </li>
                            


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
                                <th width="5px">x</th>
                           
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                                $jumlah_plus = 0; $jumlah_min = 0;
                            @endphp
                        
                            @forelse ($detail as $d)                        

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
                                        <td>                                                
                        


                                <div>
                                  <div class="inline position-relative">
                                      <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                          <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
                                      </a>

                                      <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                                          <li>
                                             <a  href="{{ route('pd.editdetail', [$kd_pd,$d->id]) }}" 
                                             @if ($cek->is_posting == 1)
                                                style="color: red; pointer-events: none;"
                                             @endif
                                                >Edit</a>
                                          </li> 
                                          <li>
                                             <a  href="{{ route('pd.deletedetail',[$d->id]) }}" 
                                             onclick="event.preventDefault();
                                                     document.getElementById('delete-row{{$d->id}}').submit();"
                                              @if ($cek->is_posting == 1)
                                                style="color: red; pointer-events: none;"
                                             @endif
                                                >Delete</a>

                                                <form id="delete-row{{$d->id}}" action="{{ route('pd.deletedetail',[$d->id]) }}" method="POST">
                                                  @csrf                                
                                                   <input type="hidden" name="kd_pd" value='{{ $kd_pd }}'>                                                  
                                              </form>
                                          </li> 
                                      </ul>
                                  </div>
                              </div>

                                        </td>

                       
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
                            @empty
                              <tr>
                                <th colspan="9" style="text-align:center"> No record found</th>
                              </tr>
                            @endforelse
                       
                        </tbody>  
                        @php
                          $jumlah_tot = $jumlah_plus - $jumlah_min;
                        @endphp
                        <tr>
                            <td colspan="2" style="text-align:center;">Jumlah</td>
                            <td style="text-align:right"> {{ Helper::Rupiah($jumlah_tot) }}</td>
                            <td>
                            </td>
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



   <div class="row">
          <div class="col-sm-11">
            <div class="widget-box widget-color-blue2">
                  <div class="widget-header widget-header-flat">
                     <h4 class="widget-title">Create</h4>
                     <div class="widget-toolbar"></div>
                  </div>

                  <div class="widget-body">
                     <div class="widget-main no-padding">
            
                    <form action="{{ route('pd.storedetail') }}" method="post" class="form-horizontal">
                     @csrf
                    <input type="hidden" name="id" value="{{ $kd_pd }}">                     

                     <fieldset>

                              <div class="form-group">
                                  <label class="col-sm-2 control-label">Kategori</label>
                                  <div class="col-sm-3">
                                 <select class="form-control" name="charge">
                                      <option value="">-- Pilih ---</option>
                                      @foreach ($charge as  $chg)
                                          <option 
                                              value="{{ $chg->kd_charge }}"
                                              {{ old('charge') == $chg->kd_charge ? 'selected' : '' }}
                                          >{{ $chg->kd_charge ." - " .$chg->charge }}</option>
                                      @endforeach
                                  </select>    

                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-2 control-label">Keterangan</label>
                                  <div class="col-sm-5">
                                       <textarea class="form-control" rows="3" name="keterangan">{{ old('keterangan') }}</textarea>
                                       @if($errors->has('keterangan'))
                                         <div class="text-danger">
                                             {{ $errors->first('keterangan')}}
                                         </div>
                                       @endif

                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="jumlah" class="col-sm-2 control-label">Jumlah</label>
                                  <div class="col-sm-3">
                                    <input type="number" name="jumlah" class="form-control" id="jumlah" autocomplete="off">
                                  </div>
                              </div>
                              <div class="form-group">
                                 <label for="" class="col-sm-2 col-form-label"></label>
                                 <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary btn-sm mb-3 px-3"
                                     @if ($cek->is_posting == 1)
                                          disabled 
                                      @endif
                                      >Submit</button> 
                                 </div>
                              </div>
                           </form>

                              

                        </fieldset>



                     </div>
                  </div>

               </div>


            </div>

   </div>





@endsection