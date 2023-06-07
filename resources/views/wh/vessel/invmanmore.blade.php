@extends('layouts.master')

@section('title')
   Detail Permohoan Dana
@endsection

@section('breadcrumb')
   <a href="">Vessel</a>
@endsection
 
@section('content')

 <!-- /.page-header -->
   <div class="page-header">
      <h1>Create Invoice</h1>
   </div><!-- /.page-header -->



   <div class="row">
    <div class="col-sm-11">
      <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title">Invoice   {{ $kd_inv }} </h4>
               <div class="widget-toolbar"></div>
            </div>

            <div class="widget-body">
               <div class="widget-main">
               

                <form action="{{ route('wh.container.storemore',[$cont,$kd_inv]) }}" method="post" class="form-horizontal">
                  @csrf


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Container</label>
                        <div class="col-sm-3">
                          <input type="text" name="cont" class="form-control" 
                          value="{{ $cont }}" readonly>
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
                          <button type="submit" class="btn btn-primary btn-sm mb-3 px-3"
                          @if ($manHd->is_posting == 1)
                            disabled 
                          @endif
                          >Submit</button> 
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
                      <a href="{{ route('vessel.invcntmore_pdf',[$cont,$kd_inv]) }}" 
                        onclick="event.preventDefault();
                           document.getElementById('print-pdf').submit();" 
                           >Print PDF</a>
                        <form  id="print-pdf" action="{{ route('vessel.invcntmore_pdf',[$cont,$kd_inv]) }}" method="POST">
                           @csrf      
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
                           $subtotal = 0; $no = 1;
                           $jumppn = 0;$grandtot = 0;
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
                           
                             <div class="inline position-relative">
                                 <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                     <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
                                 </a>
                                 <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                                     <li>
                                        <a href="{{ route('vessel.contmore_edit',[$cont,$dtl->id]) }}">Edit</a> 
                                     </li>
                                     <li class="divider"></li>
                                     <li>
                                        <a href="{{ route('vessel.contmore_dele',[$cont,$dtl->id]) }}"
                                          onclick="return confirm('Yakin akan delete ?')" 
                                          >Delete</a> 
                                     </li>
                                     
                                 </ul>
                             </div>
                           
                                      
                                    </td>
                                  </tr>

                                  @php
                                    $subtotal     = $subtotal + $dtl->jumlah;
                                    $jumppn       = $jumppn + $dtl->ppn;
                                    $grandtot     = $jumppn + $subtotal;
                                  @endphp
                                  
                                @endforeach
                                <tr>
                                  <td colspan="2" style="text-align:center;font-size: 14px;"><strong>Subtotal</strong></td>
                                  <td style="text-align:right;font-weight: bold;font-size: 14px;">
                                      {{ Helper::Rupiah($manHd->jumlah) }}</td>
                                  <td></td>

                                </tr>

                                <tr>
                                  <td colspan="2" style="text-align:center;font-size: 14px;"><strong>VAT</strong></td>
                                  <td style="text-align:right;font-weight: bold;font-size: 14px;">
                                      {{ Helper::Rupiah($manHd->ppn) }}</td>
                                  <td></td>
                                </tr>


                      @if ( ($manHd->jumlah + $manHd->ppn) >= 5000000  )

                              <tr>
                                  <td colspan="2" style="text-align:center;font-size: 14px;"><strong>Stemp Duty</strong></td>
                                  <td style="text-align:right;font-weight: bold;font-size: 14px;">
                                      {{ Helper::Rupiah($manHd->materai) }}</td>
                                  <td></td>
                                </tr>



                      @endif          

                                


                                <tr>
                                  <td colspan="2" style="text-align:center;font-size: 14px;"><strong>Total </strong></td>
                                  <td style="text-align:right;font-weight: bold;font-size: 14px;">
                                      {{ Helper::Rupiah($manHd->grandtotal) }}</td>
                                  <td></td>
                                </tr>
                              </tbody>
                        </table>
                        <p></p>   

                      </div>

                </div>          



                     </div>
                   </div>
                 
             </div>
           </div></div>

@endsection
