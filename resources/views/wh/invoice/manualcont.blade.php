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
      <h1>Permohonan Dana Manual</h1>
   </div><!-- /.page-header -->



   <div class="row">
    <div class="col-sm-11">
      <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title">Create Invoice </h4>
               <div class="widget-toolbar"></div>
            </div>

            <div class="widget-body">
               <div class="widget-main">
               

                <form action="{{ route('wh.manual.createnew') }}" method="post" class="form-horizontal">
                  @csrf

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Vessel</label>
                        <div class="col-sm-5">
                             <select name="kd_vsl" class="chosen-select" >
                                  <option value="" > -- Pilih -- </option>  
                                @foreach ($vessels as $cus)                       
                                    <option value="{{ $cus->kd_vsl }}">{{ $cus->kd_vsl ." - " .$cus->vessel }}</option>
                                @endforeach
                            </select>
                                 @if($errors->has('kd_vsl'))
                                     <div class="text-danger">
                                         {{ $errors->first('kd_vsl')}}
                                     </div>
                                 @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Conainer</label>
                        <div class="col-sm-5">
                           <select class="form-control" name="course" id="course"></select>
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


@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#category').on('change',function(){
               console.log('welcome jquery');
            });
        });
    </script>
@endpush
   



