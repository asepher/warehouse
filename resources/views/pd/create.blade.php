@extends('layouts.master')

@section('title')
   Permohoan Dana
@endsection

@section('breadcrumb')
   <a href="{{ route('pd.index') }}">Permohonan Dana</a>
@endsection

@section('content')

   @php
      $tgl=date('Y-m-d'); 
   @endphp



    <!-- /.page-header -->
   <div class="page-header">
      <h1>Permohonan Dana</h1>
   </div><!-- /.page-header -->

 <div class="row">
       <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Create New</h4>
                  <div class="widget-toolbar">



                  </div> 
               </div>

               <div class="widget-body">
                  <div class="widget-main no-padding">

            @if (Session::has('post_add'))
                <span style="color:green;">{{Session::get('post_add')}}</span>
            @endif

            <form class="form-horizontal" role="form" action="{{ route('pd.store') }}" method="post">
            {{ csrf_field() }}

               <fieldset>

                        <div class="form-group" >
                            <label class="col-sm-2 control-label">Tanggal</label>
                            <div class="col-sm-3">
                                <input type="date" name="tanggal" class="form-control  date-picker" 
                                placeholder="yyyy/mm/dd" value="{{ $tgl }}">
                                @if($errors->has('tanggal'))
                                    <div class="text-danger">
                                        {{ $errors->first('tanggal')}}
                                    </div>
                                @endif    
                            </div>
                            <div class="col-sm-3">
                               <select name="dept" id="">
                                   <option value="">-- Pilih --</option>
                                   <option value="Export">Export</option>
                                   <option value="Import">Import</option>
                                   <option value="Warehouse">Warehouse</option>
                               </select>

                                @if($errors->has('dept'))
                                    <div class="text-danger">
                                        {{ $errors->first('dept')}}
                                    </div>
                                @endif    
                            </div>
                        </div>

                  
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Customer</label>
                            <div class="col-md-5">
                                <select class="chosen-select form-control" name="customer">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($customer as  $c)
                                      <option value="{{ $c->kd_cus }}">{{ $c->customer }}</option>                                
                                    @endforeach
                                </select>    
                                @if($errors->has('customer'))
                                    <div class="text-danger">
                                        {{ $errors->first('customer')}}
                                    </div>
                                @endif    
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Penerima</label>
                            <div class="col-md-5">
                                <input type="text" name="penerima" class="form-control" autocomplete="off" 
                                value="{{ old('penerima') }}">
                                  @if($errors->has('penerima'))
                                    <div class="text-danger">
                                        {{ $errors->first('penerima')}}
                                    </div>
                                @endif    
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Keterangan</label>
                            <div class="col-md-7">
                                <textarea class="form-control" rows="3" name="keterangan">{{ old('keterangan') }}</textarea>
                                 @if($errors->has('keterangan'))                         
                                    <div class="text-danger">
                                        {{ $errors->first('keterangan')}}
                                    </div>
                                @endif
                            </div>
                        </div>

        
                        <div class="form-group">
                            <label class="col-md-2 control-label text-left">Noted</label>
                            <div class="col-md-7">
                                <textarea class="form-control" rows="3" name="noted">{{ old('noted') }}</textarea>
                                 @if($errors->has('noted'))                         
                                    <div class="text-danger">
                                        {{ $errors->first('noted')}}
                                    </div>
                                @endif
                            </div>
                        </div>

                     
                        <div class="form-group">
                            <label class="col-md-2 col-form-label"></label>               
                            <div class="col-md-7">
                                <button type="submit" class="btn btn-primary btn-sm px-5">Submit</button>
                            </div>
                        </div>                

   </fieldset>

 </form>
                  </div>
               </div>
            </div>
         </div>
      </div>

@push('scripts')
<script>
      $(document).ready(function () {
        alert('Hello');
      }
</script>
@endpush


@endsection