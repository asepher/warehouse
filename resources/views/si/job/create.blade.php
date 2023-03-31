@extends('layouts.master')

@section('title')
    Create Shipping Instruction
@endsection

@section('breadcrumb')
    <a href="{{ route('si.index') }}">Shipping</a>
@endsection

@section('content')
   @php
      $tgl=date('Y-m-d');
   @endphp



    <!-- /.page-header -->
   <div class="page-header">
      <h1>Job Number</h1>
   </div><!-- /.page-header -->
               
      <form class="form-horizontal" role="form" action="{{ route('si.job.service') }}" method="post">
      {{ csrf_field() }}

    <div class="row">
        <div class="col-md-11">
            <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                     <h4 class="widget-title">Create</h4>
                    <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                           <i class="ace-icon fa fa-chevron-up"></i>
                        </a>                                         
                     </div>
               </div>
               <div class="widget-body">
                  <div class="widget-main">

          

                     <div class="form-group">
                        <label class="col-sm-2 control-label"><strong>Services</strong></label>
                        <div class="col-sm-3">
                           <select name="service" class="form-control">
                              <option value="">-- Pilih --</option>
                              <option value="IMPORT"
                              @if ( old('service') == 'IMPORT'  )
                                  selected
                              @endif
                              >IMPORT</option>
                              <option value="EXPORT" 
                              @if ( old('service') == 'EXPORT'  )
                                  selected
                              @endif
                              >EXPORT</option>
                           </select>
                              @if($errors->has('service'))
                                        <div class="text-danger">
                                            {{ $errors->first('service')}}
                                        </div>
                                    @endif
                        </div>
                        </div>         

                        <div class="form-group">
                           <label for="" class="col-sm-2"></label>
                           <div class="col-sm-3">
                              <select name="tipe" class="form-control">
                                 <option value="">-- Pilih -- </option>
                                 <option value="SEA"
                                 @if ( old('tipe') == 'SEA')
                                     selected
                                 @endif
                                 >SEA</option>
                                 <option value="AIR"
                                 @if ( old('tipe') == 'AIR')
                                     selected
                                 @endif
                                 >AIR</option>
                              </select>               
                                 @if($errors->has('tipe'))
                                           <div class="text-danger">
                                               {{ $errors->first('tipe')}}
                                           </div>
                                       @endif
                           </div>
                        </div>     

        <div class="form-group">
                                 <label for="" class="col-sm-2"></label>
                                 <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary btn-sm px-5">Submit</button>
                                 </div>
                              </div>                           





                  </div>
               </div>
            </div>
         </div>
      </div>

   </form>


 <div class="row">
        <div class="col-md-11">
            <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                     <h4 class="widget-title">Get Job Number</h4>
                    <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                           <i class="ace-icon fa fa-chevron-up"></i>
                        </a>                                         
                     </div>
               </div>
               <div class="widget-body">
                  <div class="widget-main">

<form action="{{ route('si.get.jobsi') }}" method="post" >
 {{ csrf_field() }}

<div class="row">
   <div class="col-md-3">

<select name="pilihjob" class="form-control">
   <option value="">--PILIH--</option>
   @foreach ($siJob as $job)
      <option value="{{ $job->kd_si }}">
         {{ $job->kd_si . ' - ' . $job->tipe}}
      </option>
   @endforeach   

</select>

      
   </div>

   <div class="col-md-2">
        <button type="submit" class="btn btn-primary btn-sm px-5">Submit</button>
   </div>

</div>



   
</form>



                  </div>
               </div>
            </div>
         </div>
</div>



@endsection

