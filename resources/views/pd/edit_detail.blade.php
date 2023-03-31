@extends('layouts.master')


@section('title')
   Permohoan Dana
@endsection

@section('breadcrumb')
   <a href="{{ route('pd.index') }}">Permohonan Dana</a>
@endsection

@section('content')
   @php    
        $cek = App\Models\Pdhd::where('kd_pd', $id)->first();  
    @endphp




    <!-- /.page-header -->
   <div class="page-header">
      <h1>Permohonan Dana</h1>
   </div><!-- /.page-header -->

 <div class="row">
       <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                  <h4 class="widget-title"></h4>
                  <div class="widget-toolbar">


                  </div>
               </div>

               <div class="widget-body">
                  <div class="widget-main">




              <form action="{{ route('pd.updatedetail') }}" method="post" class="form-horizontal" method="POST">
                   @csrf
                  <input type="hidden" name="pd" value="{{ $pd }}">
                  <input type="hidden" name="id" value="{{ $id }}">
                  @method('PUT')

                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label"><strong>Kategori</strong></label>
                    <div class="col-sm-3">
                    <select class="form-control" name="charge">
                          <option value="">-- Pilih ---</option>
                          @foreach ($charge as  $c)
                              <option 
                                  value="{{ $c->kd_charge }}"
                                  {{ $det->ket_charge == $c->kd_charge ? 'selected' : '' }}
                              >{{ $c->kd_charge ." - " .$c->charge }}</option>
                          @endforeach
                      </select>    

                      </div>
                  </div>

                  <div class="form-group">
                      <label for="" class="col-sm-2 control-label"><strong>Keterangan</strong></label>
                      <div class="col-sm-5">
                           <textarea class="form-control" rows="3" name="keterangan">{{ $det->keterangan }}</textarea>
                           @if($errors->has('keterangan'))
                             <div class="text-danger">
                                 {{ $errors->first('keterangan')}}
                             </div>
                           @endif

                      </div>
                  </div>

                  <div class="form-group">
                      <label for="jumlah" class="col-sm-2 control-label"><strong>Jumlah</strong></label>
                      <div class="col-sm-3">
                        <input type="number" name="jumlah" class="form-control" id="jumlah" 
                        value="{{ $det->jumlah }}">
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-primary btn-sm mb-3 px-5">Update</button> 
                    </div>
                  </div>

            </form>





                  </div>
              </div>
          </div>


      </div>
  </div>




@endsection