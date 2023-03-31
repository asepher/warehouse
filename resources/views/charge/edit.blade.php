@extends('layouts.master')

@section('title')
   Charge
@endsection

@section('breadcrumb')
   <a href="{{ route('charge.index') }}">Charge</a>
@endsection

@section('content')



   <!-- /.page-header -->
   <div class="page-header">
      <h1>Data Charge</h1>
   </div><!-- /.page-header -->



 <div class="row">
   <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
              <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Edit </h4>
                  <div class="widget-toolbar">
                  </div>
              </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">



               
               <form class="form-horizontal" action="{{ route('charge.update') }}" method="POST">
               {{ csrf_field() }}
               @method('PUT')                   
               <input type="hidden" name="id" value="{{ $id }}">
               <fieldset>

                  <div class="form-group">
                        <label class="col-sm-2 control-label"><strong>Kode</strong></label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kd_charge" 
                              placeholder="Entry Kode.." value="{{ $row->kd_charge }}"
                              autocomplete="off">
                            @if($errors->has('kd_charge'))
                               <div class="text-danger">
                                   {{ $errors->first('kd_charge')}}
                               </div>
                           @endif
                        </div>
                  </div>
                  <div class="form-group">
                           <label class="col-sm-2 control-label"><strong>Keterangan</strong></label>
                           <div class="col-sm-7">
                               <input type="text" class="form-control" name="charge" placeholder="Entry Charge.."
                               value="{{ $row->charge }}" autocomplete="off">
                               @if($errors->has('charge'))
                                  <div class="text-danger">
                                      {{ $errors->first('charge')}}
                                  </div>
                              @endif
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="col-sm-2 control-label"><strong>Ppn</strong></label>
                           <div class="col-sm-3">
                               <input type="number" class="form-control" name="ppn" placeholder="Jumlah Ppn"
                               value="{{ $row->ppn }}" autocomplete="off">
                               @if($errors->has('ppn'))
                                  <div class="text-danger">
                                      {{ $errors->first('ppn')}}
                                  </div>
                              @endif
                           </div>
                       </div>
                        <div class="form-group">  
                           <label class="col-sm-2 control-label"></label>
                           <div class="col-sm-4">
                              <button type="submit" class="btn btn-sm btn-primary px-5">Update</button>
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