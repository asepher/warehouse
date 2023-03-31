@extends('layouts.master')

@section('title')
   Satuan
@endsection

@section('breadcrumb')
   <a href="{{ route('charge.index') }}">Satuan</a>
@endsection


@section('content')



   <!-- /.page-header -->
   <div class="page-header">
      <h1>Satuan</h1>
   </div><!-- /.page-header -->



 <div class="row">
    <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
              <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Edit</h4>
                  <div class="widget-toolbar">
                  </div>
              </div>
              <div class="widget-body">
                  <div class="widget-main">


                     <div class="row">
                        <div class="col-md-6">
                           


               <form class="form-horizontal" role="form" action="{{ route('wh.satuan.update') }}" method="POST">
               {{ csrf_field() }}
               <fieldset>

                  <div class="form-group">
                        <label class="col-sm-2 control-label"><strong>Kode</strong></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="kd_charge" 
                              placeholder="Entry Kode.." value="{{ old('kd_charge') }}"
                              autocomplete="off">
                            @if($errors->has('kd_charge'))
                               <div class="text-danger">
                                   {{ $errors->first('kd_charge')}}
                               </div>
                           @endif
                        </div>
                  </div>      

                  <div class="form-group">  
                           <label class="col-sm-2 control-label"></label>
                           <div class="col-sm-4">
                              <button type="submit" class="btn btn-sm btn-primary px-5">Save</button>
                           </div>
                  </div>


                  </fieldset>
            </form>

         </div>
         <div class="col-md-6">







         	
         </div>


                  </div>
               </div>
         </div>

      </div>
   </div>


@endsection