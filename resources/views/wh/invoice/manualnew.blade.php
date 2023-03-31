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
               <h4 class="widget-title">Create Invoice - {{ $container }}</h4>
               <div class="widget-toolbar"></div>
            </div>

            <div class="widget-body">
               <div class="widget-main">
               

                <form action="{{ route('wh.manual.store') }}" method="post" class="form-horizontal">
                  @csrf
                    <input type="hidden" name="container" value="{{ $container  }}">

                   
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Charge</label>
                        <div class="col-sm-3">
                          <select class="form-control" name="kd_tarif">
                              <option value="">-- Pilih ---</option>
                              @foreach ($tarif as  $trf)
                                  <option 
                                      value="{{ $trf->kd_tarif }}"
                                      {{ old('tarif') == $trf->kd_tarif ? 'selected' : '' }}
                                  >{{ $trf->kd_tarif ." - " .$trf->nama_tarif }}</option>
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
                          <button type="submit" class="btn btn-primary btn-sm mb-3 px-3">Submit</button> 
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
                     <h4 class="widget-title">Container : {{ $container }}</h4>
                     <div class="widget-toolbar">
                        
                        <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
                              Action
                              <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret">                            
                              <li>
                                 <a href="" 
                                    onclick="event.preventDefault();
                                       document.getElementById('print-pdf').submit();" 
                                       >Print PDF</a>
                                    <form  id="print-pdf" action="" method="POST">
                                       @csrf      
                                        <input type="hidden" name="pd" value="">
                                    </form>
                              </li>
                             
                                <li class="divider"></li>
                                             <li>
                                                <a  href=""
                                                onclick="event.preventDefault();
                                                        document.getElementById('posting-form').submit();" 
                                             >Posting</a>

                                             <form id="posting-form" action="" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="pd" value="">                                                  
                                             </form> 
                                             </li>                             

                           </ul>
                        </div><!-- /.btn-group -->



                     </div>
                  </div>

                  <div class="widget-body">
                     <div class="widget-main">
                        
                    <div class="row">
                      <div class="col-md-10">

                         
                       
                        <table class="table table-bordered">
                              <thead class="bg-light">
                                  <tr>
                                      <th width="5px">#</th>
                                      <th>Keterangan</th>
                                      <th width="200px">Jumlah</th>
                                      <th width="5px">x</th>
                                 
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($details as $dtl)
                                  <tr>
                                    <td>1</td>
                                    <td>{{ $dtl->keterangan }}</td>
                                    <td>{{ $dtl->jumlah }} </td>
                                    <td>
           

                      <div>
                        <div class="inline position-relative">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-default dropdown-menu-right">
                                <li>
                                   <a  href="{{ route('wh.manual.edit_detail',[$dtl->id]) }}"
                                            >Edit</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                              <a  href="{{ route('wh.manual.delete_detail',[$dtl->id]) }}" onclick="return confirm('Yakin akan di hapus?')"
                                                          >Delete</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                                    </td>
                                  </tr>
                                @endforeach 
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
