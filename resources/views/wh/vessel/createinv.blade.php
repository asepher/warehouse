@extends('layouts.master')

@section('title')
   Detail Permohoan Dana
@endsection

@section('breadcrumb')
   <a href="{{ route('pd.index') }}">Permohonan Dana</a>
@endsection

@section('content')

 <!-- /.page-header -->
   <div class="page-header">
      <h1>Permohonan Dana Detail</h1>
   </div><!-- /.page-header -->



   <div class="row">
    <div class="col-sm-11">
      <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title">Create Invoice -  Vessel : {{ $vsl }}</h4>
               <div class="widget-toolbar"></div>
            </div>

            <div class="widget-body">
               <div class="widget-main">
               

                <form action="{{ route('vessel.storeinv',[$vsl,$cnt]) }}" method="post" class="form-horizontal">
                  @csrf

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Container</label>
                        <div class="col-sm-3">
                          <input type="text" name="cont" class="form-control" 
                          value="{{ $cnt }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Charge</label>
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
                             <textarea class="form-control" rows="3" name="keterangan"></textarea>
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
                          <button type="submit" class="btn btn-primary btn-sm mb-3 px-3">Submit</button> 
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
                     <h4 class="widget-title">Permohonan Dana</h4>
                     <div class="widget-toolbar">
                        
                        <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
                              Action
                              <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret">                            
                              <li>
                                  <a href="{{ route('vessel.invcntpdf',[$vsl,$cnt]) }}" 
                                    onclick="event.preventDefault();
                                       document.getElementById('print-pdf').submit();" 
                                       >Print PDF</a>
                                    <form  id="print-pdf" action="{{ route('vessel.invcntpdf',[$vsl,$cnt]) }}" method="POST">
                                       @csrf      
                                        <input type="hidden" name="pd" value="">
                                    </form>
                              </li>
                             
                                <li class="divider"></li>
                                             <li>
                                                <a  href="{{ route('pd.posting') }}"
                                                onclick="event.preventDefault();
                                                        document.getElementById('posting-form').submit();" 
                                             >Posting</a>

                                             <form id="posting-form" action="{{ route('pd.posting') }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="pd" value="">                                                  
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


                         @php
                           $total = 0;
                           $no = 1;
                         @endphp                       
                        <table class="table table-bordered">
                              <thead class="bg-light">
                                  <tr>
                                      <th width="15px">#</th>
                                      <th>Keterangan</th>
                                      <th width="200px">Jumlah</th>
                                      <th width="5px">x</th>                                 
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($manDtl as $dtl)
                                  <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $dtl->keterangan}}</td>
                                    <td style="text-align:right;">{{ Helper::Rupiah($dtl->jumlah) }}</td>
                                    <td>


                             <div>
                             <div class="inline position-relative">
                                 <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                     <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
                                 </a>
                                 <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                                     <li>
                                        <a href="{{ route('vessel.container_edit',[$cnt,$dtl->id]) }}">Edit</a> 
                                     </li><li>
                                        <a href="{{ route('vessel.container_delete',[$cnt,$dtl->id]) }}">Delete</a> 
                                     </li>
                                     
                                 </ul>
                             </div>
                             </div>
                                      
                                    </td>
                                  </tr>

                                  @php
                                    $total = $total + $dtl->jumlah;
                                  @endphp
                                @endforeach
                                <tr>
                                  <td colspan="2" style="text-align:center;font-size: 14px;"><strong>Total</strong></td>
                                  <td style="text-align:right;font-weight: bold;font-size: 14px;">
                                      {{ Helper::Rupiah($total) }}</td>
                                </tr>
                              </tbody>
                        </table>
                        <p></p>   

                        @if (isset($manHd))
                            @php
                              $filename = $manHd->kd_inv . $manHd->tipe . ".PDF" ; 
                            @endphp
                            @if ($manHd->inv_mn == 1)                             
                              <a href="{{ url('wh/'.$filename) }}" class="btn btn-danger btn-sm text-danger" target="_blank" >{{ $manHd->kd_inv }}</a>
                            @else
                               {{ $manHd->kd_inv }}
                            @endif
                        @endif

                      </div>

                </div>          



                     </div>
                   </div>
                 
             </div>
           </div></div>



@endsection
