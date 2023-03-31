@extends('layouts.master')

@section('title')
   Shipping Instruction
@endsection

@section('breadcrumb')
   <a href="{{ route('si.view.detail',[$si]) }}">Shipping</a>
@endsection

@section('content')

  @isset($header)
      @php
        $cek = App\Models\InvSiHeader::where('no_inv',$header->no_inv)->where('jenis',$jenis)->first();
        $hit = App\Models\InvSiHeader::where('no_inv',$header->no_inv)->where('jenis',$jenis)->count();
      @endphp
  @else
     @php
       $cek = App\Models\InvSiHeader::where('no_inv','90909090')->where('jenis',$jenis)->first();
       $hit = 0;
     @endphp
  @endisset

    <!-- /.page-header -->
   <div class="page-header">
      <h1>Shipping Instruction </h1>
   </div><!-- /.page-header -->


 <div class="row">
    <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
              <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Create Invoice</h4>
                  <div class="widget-toolbar">

                     
                  </div>
              </div>
              <div class="widget-body">
                  <div class="widget-main">




          <form class="form-horizontal" role="form" action="{{ route('si.inv.store',[$jenis,$si]) }}" 
                method="post">
                {{ csrf_field() }}




            <div class="form-group">
              <label class="control-label col-sm-2"><strong>Tipe</strong></label>
              <div class="col-sm-4">          
                <input type="text" value="{{ $jenis }}" disabled>                
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2"><strong>Categori</strong></label>
              <div class="col-sm-4">          
                 <select class="form-control" name="charge" id="charge">
                               <option value="">-- Pilih --</option>
                              @foreach ($charge as  $c)
                                <option value="{{ $c->kd_charge }}">{{ $c->kd_charge . " - " . $c->charge }}</option>
                              @endforeach
                        </select>   
                    
                        @if($errors->has('charge'))
                              <div class="text-danger">
                                  {{ $errors->first('charge')}}
                              </div>
                        @endif  
            </div>
          </div>


            <div class="form-group">
              <label class="control-label col-sm-2"><strong>Keterangan</strong></label>
              <div class="col-sm-5">                  
                        <textarea class="form-control" rows="3" name="keterangan"
                        >{{ old('keterangan') }}</textarea>
                             @if($errors->has('keterangan'))                         
                                <div class="text-danger">
                                    {{ $errors->first('keterangan')}}
                                </div>
                            @endif   
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2"><strong>Jumlah</strong></label>
              <div class="col-sm-4">          
                 <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" 
                                value="{{ old('jumlah') }}" id="jumlah" autocomplete="off">

                                  @if($errors->has('jumlah'))
                                    <div class="text-danger">
                                        {{ $errors->first('jumlah')}}
                                    </div>
                                @endif
            </div>
          </div>

            <div class="form-group">
              <label class="control-label col-sm-2"></label>
              <div class="col-sm-4">          
                  <button type="submit" class="btn btn-primary btn-sm px-5"                              
                          @php
                            if ($cek) {
                                if ($cek->is_posting == 1) {
                                  echo 'disabled';
                                }
                            }                          
                          @endphp   
                          >Submit  </button> 
  


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
                  <h4 class="widget-title">Invoice Detail - {{ $si }}</h4>
                  <div class="widget-toolbar">

                     <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
                              Action
                              <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">                            
                              <li>
                                 <a href="{{ route('si.inv.printpdf') }}"  onclick="event.preventDefault();
                                                     document.getElementById('export-pdf').submit();"
                                        target="_blank">Print PDF </a>

                                   <form id="export-pdf" action="{{ route('si.inv.printpdf') }}" 
                                      method="post" target="_blank">
                                      @csrf
                                      <input type="hidden" name="jenis" value="{{ $jenis }}">
                                      <input type="hidden" name="kd_si" value="{{ $si }}">
                                    </form>
                              </li> 
                           </ul>
                        </div><!-- /.btn-group -->
 
                  </div>
              </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">
                     <div class="row">
                        <div class="col-md-10">
                           



                        <table class="table align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>#</th>
                                    <th style="text-align: center;"><strong>Keterangan</strong></th>
                                    <th style="text-align: center;"><strong>Jumlah</strong></th>
                                    <th style="text-align: center;" width="5px"><strong>x</strong></th>
                                </tr>                   
                            </thead>
                            <tbody>
                                @php
                                    $no     = 1;    $tot = 0;   $jum = 0;
                                    $hitppn = 0;
                                    $mat = 0;
                                @endphp
                                @forelse ($detail as $dt)
                                    <tr>

                                        @if (substr($dt->kd_chg,0,2) == 99)
                                            <td></td>                                        
                                            <td>
                                              @php
                                                echo nl2br($dt->keterangan)
                                              @endphp
                                            </td>                                          
                                            <td></td>                                          
                                        @elseif (substr($dt->kd_chg,0,2) == 77)
                                            <td></td>
                                            <td><strong>{{ $dt->keterangan }}</strong></td>
                                            <td></td>
                                        @else 
                                            <td>{{ $no++ }}</td>                                        
                                            <td>{{ $dt->keterangan }}</td>
                                            <td style="text-align: right;">{{ Helper::Rupiah($dt->jumlah) }}</td>
                                        @endif

                                        <td class="text-center">

                           <div>
                                  <div class="inline position-relative">
                                      <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                          <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
                                      </a>

                                      <ul class="dropdown-menu dropdown-lighter dropdown-menu-right">
                                          <li>
                                             <a  href="{{ route('si.inv.edit',[$si,$dt->id]) }}" 
                                                @if ($header->is_posting == 1)
                                                   style="pointer-events: none;" 
                                                @endif
                                             >Edit</a>
                                          </li> 
                                          <li class="divider"></li>
                                          <li>
                                             <a  href="{{ route('si.detail.delete',$dt->id) }}" 
                                                onclick="event.preventDefault();
                                                     document.getElementById('delete-si{{$dt->id}}').submit();"
                                                @if ($header->is_posting == 1)
                                                   style="pointer-events: none;" 
                                                @endif
                                             >Delete</a>

                                             <form id="delete-si{{$dt->id}}" action="{{ route('si.detail.delete',$dt->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf                                                
                                            </form>


                                          </li>
                                      </ul>

                                  </div>
                              </div>


                  



                                          </td>
                                    </tr>
                                      @php
                                            $tot = $tot + $dt->jumlah;
                                            if ( $dt->ppn >= 1)
                                            {
                                                $hitppn = ( $dt->ppn * $dt->jumlah ) / 100 ;
                                            }                                            
                                      @endphp  
                                @empty
                                    <tr>
                                        <td colspan="3">No Record</td>
                                    </tr>
                                @endforelse
                                @php
                                  if ($tot > 5000000 ) {
                                    $mat = 10000;
                                  }
                                @endphp
                            <tr>
                                <td colspan="2" style="text-align: right;"> <strong>VAT</strong> </td>
                                <td style="text-align: right;">{{ Helper::Rupiah($hitppn) }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: right;"> <strong>Materai</strong> </td>
                                <td style="text-align: right;">
                                  {{ Helper::Rupiah($mat) }}
                                </td>
                            </tr>                        
                            @php
                                $grandtot = $tot + $hitppn + $mat;
                            @endphp
                            <tr>
                                <td colspan="2" style="text-align: right;"> <strong>Grand Total<strong> </td>
                                <td style="text-align: right;">{{ Helper::Rupiah($grandtot) }}</td>
                            </tr>

                            </tbody> 
                        </table>

                        


                        </div>
                     </div>


                        <p></p> 





                  </div>
              </div>





        </div>
    </div>
</div>

@endsection

@push('script')

    <script>
                          $(document).ready(function() {
                            $('#charge').onchange(function() {                                 
                              alert('hello');
                            });
                          });
                        </script> 

@endpush
