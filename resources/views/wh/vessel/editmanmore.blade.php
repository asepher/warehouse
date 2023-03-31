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
               <h4 class="widget-title">Edit Invoice   {{ $kd_inv }} </h4>
               <div class="widget-toolbar"></div>
            </div>

            <div class="widget-body">
               <div class="widget-main">
               
         
                <form action="{{ route('wh.container.updatemore',[$kd_inv,$id]) }}" method="post" class="form-horizontal">
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
                                              {{ $row->kd_tarif == $chg->kd_charge ? 'selected' : '' }}
                                          >{{ $chg->kd_charge ." - " .$chg->charge }}</option>
                                      @endforeach
                                  </select>    
 
                                  </div>
                          }
                    </div>                    
          <div class="form-group">
              <label class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-5">
                   <textarea class="form-control" rows="3" name="keterangan">{{ $row->keterangan }}</textarea>
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
                          <input type="number" name="jumlah" class="form-control" id="jumlah" autocomplete="off" value="{{ $row->jumlah }}">
                        </div>
                      </div>
                    <div class="form-group">
                       <label for="" class="col-sm-2 col-form-label"></label>
                       <div class="col-sm-9">
                          <button type="submit" class="btn btn-primary btn-sm mb-3 px-3">Update</button> 
                        </div>
                    </div>                                      
                </form>

               </div>
           </div>
       </div>
      </div>
    </div>



@endsection
