@extends('layouts.master')

@section('title')
   Edit Detail Invoice
@endsection

@section('breadcrumb')
   <a href="{{ route('si.index') }}">Detail Si</a>
@endsection

@section('content')

    <!-- /.page-header -->
   <div class="page-header">
      <h1>Edit Detail Invoice </h1>
   </div><!-- /.page-header -->


 <div class="row">
    <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
              <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Edit Invoice</h4>
                  <div class="widget-toolbar">
                  </div>
              </div>
              <div class="widget-body">
                  <div class="widget-main">

 


          <form class="form-horizontal" role="form" 
          action="{{ route('si.inv.update',[$kd_si,$id]) }}" method="post">
                {{ csrf_field() }}




            <div class="form-group">
              <label class="control-label col-sm-2"><strong>Tipe</strong></label>
              <div class="col-sm-4">          
                <input type="text" value="{{ $item->jenis }}" readonly>                
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2"><strong>Categori</strong></label>
              <div class="col-sm-4">          
                 <select class="form-control" name="charge" id="charge">
                               <option value="">-- Pilih --</option>
                              @foreach ($charge as  $c)
                                <option value="{{ $c->kd_charge }}"
                                    {{ $item->kd_chg == $c->kd_charge ? 'selected' : '' }}
                                  >{{ $c->kd_charge . " - " . $c->charge }}</option>
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
                        >{{ $item->keterangan }}</textarea>
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
                                value="{{ $item->jumlah }}" id="jumlah" autocomplete="off">
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
                  <button type="submit" class="btn btn-primary btn-sm px-5">Update  </button> 
              </div>



            </div>                
                                              
                </form>




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
