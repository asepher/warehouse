@extends('layouts.master')

@section('title')
   Shipping Instruction
@endsection

@section('breadcrumb')
   <a href="{{ route('si.index') }}">Shipping</a>
@endsection

@section('content')

    <!-- /.page-header -->
   <div class="page-header">
      <h1>Shipping Instruction </h1>
   </div><!-- /.page-header -->


   <div class="row">
       <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Search </h4>
                  <div class="widget-toolbar">
                  </div>
               </div>

               <div class="widget-body">
                  <div class="widget-main">

                  <form class="form-horizontal" role="form" action="{{ route('si.inv.search') }}" method="post">
                     {{ csrf_field() }}


                      <div class="form-group">
                           <label for="" class="col-sm-2 control-label "><strong>CNEE </strong></label>
                           <div class="col-sm-6 input-group">
                             <select class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a State..." name="kd_cus"> 
                                 <option value="">-- Pilih -- </option>
                                 @foreach ($customers as $cus)
                                    <option value="{{ $cus->kd_cus }}"
                                       @if ( old('kd_cus') == $cus->kd_cus )
                                          selected
                                       @endif
                                       >{{ $cus->customer }}</option>
                                 @endforeach
                              </select>                                             
                           </div>
                        </div>   
                        <div class="form-group">
                           <label for="" class="col-sm-2"></label>
                           <div class="col-sm-4">
                           
                              <button class="btn btn-sm btn-primary" type="submit">
                                 <i class="ace-icon fa fa-search bigger-110"></i>
                                 Search 
                              </button>

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
                  <h4 class="widget-title">Invoice </h4>
                  <div class="widget-toolbar">
                  </div>
               </div>

               <div class="widget-body">
                  <div class="widget-main no-padding">


                     <table class="table table-striped table-bordered" id="dynamic-table1">
                        <thead>
                        <tr>
                           <td class="text-center">#</td>
                           <th class="text-center">SI</th>
                           <th class="text-center">Inv</th>
                           <th class="text-center">CNEE</th>
                           <th class="text-center">Tanggal</th>
                           <th class="text-center">Jumlah</th>
                           <th class="text-center">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                           @foreach($allData as $key => $value )
                           <tr>
                              <td class="text-center">{{ $key+1 }}</td>   
                              <td>{{ $value->kd_si }}</td>
                              <td>{{ $value->no_inv }}</td>
                              <td></td>
                              <td>{{ $value->tanggal }}</td>
                              <td>{{ Helper::Rupiah($value->jumlah) }}</td>
                              <td>
                                   @if ($value->is_posting == 1)
                                    <span class="label label-sm label-success">Posting</span>
                                 @else
                                    <span class="label label-sm label-warning">Not Posting</span> 
                                 @endif
                                 
                              </td>
                           </tr>   
                           @endforeach
                  

                        </tbody>
                     </table>



                  </div>
               </div>
            </div>
      </div>
   </div>


@endsection