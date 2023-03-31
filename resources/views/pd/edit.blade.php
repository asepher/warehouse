@extends('layouts.master')

@section('title')
   Permohoan Dana
@endsection

@section('breadcrumb')
   <a href="{{ route('pd.index') }}">Permohonan Dana</a>
@endsection


@section('content')

    @php    
       $cek = App\Models\Pdhd::where('kd_pd',$pd)->count();  
    @endphp




    <!-- /.page-header -->
   <div class="page-header">
      <h1>Permohonan Dana</h1>
   </div><!-- /.page-header -->

 <div class="row">
       <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Edit Data - {{ $pd }}</h4>
                  <div class="widget-toolbar">

                     <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
                              Action
                              <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">                                                        
                                 <li>
                                    <a href="#"
                                       >Delete</a>
                                 </li>
                            


                           </ul>
                        </div><!-- /.btn-group -->

                  </div>
               </div>

               <div class="widget-body">
                  <div class="widget-main">



<form class="form-horizontal" role="form" action="{{ route('pd.update',[$pd]) }}" 
                    method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                        <div class="form-group" >
                            <label class="col-sm-2 control-label">Tanggal</label>
                            <div class="col-sm-3">
                                <input type="date" name="tanggal" class="form-control  datepicker-input" 
                                placeholder="yy/mm/dd" value="{{ $hd->tanggal }}">
                                @if($errors->has('tanggal'))
                                    <div class="text-danger">
                                        {{ $errors->first('tanggal')}}
                                    </div>
                                @endif    
                            </div>
                            <div class="col-sm-3">                            
                     <select name="dept" id="">
                         <option value="">-- Pilih --</option>
                         <option value="Export" {{ $hd->dept == 'Export' ? 'Selected' : '' }}>Export</option>
                         <option value="Import" {{ $hd->dept == 'Import' ? 'Selected' : '' }} >Import</option>
                         <option value="Warehouse" {{ $hd->dept == 'Warehouse' ? 'Selected' : '' }} >Warehouse</option>
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
                                      <option value="{{ $c->kd_cus }}"
                                        @if ($c->kd_cus == $hd->kd_cus)
                                            selected
                                        @endif
                                        >{{ $c->customer }}</option>                                
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
                                value="{{ $hd->penerima }}">
                                  @if($errors->has('penerima'))
                                    <div class="text-danger">
                                        {{ $errors->first('penerima')}}
                                    </div>
                                @endif    
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Keterangan</label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="3" name="keterangan">{{ $hd->keterangan }}</textarea>
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
                                <textarea class="form-control" rows="3" name="noted">{{ $hd->noted }}</textarea>
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
                                <button type="submit" class="btn btn-primary btn-sm px-5">Update</button>
                            </div>
                        </div>                

                      



                    </div>
                </div>
        </div>
    </div>
</div>





@endsection