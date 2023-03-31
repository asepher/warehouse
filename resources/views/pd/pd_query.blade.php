@extends('layouts.master')

@section('title')
   Permohoan Dana Query
@endsection

@section('breadcrumb')
   <a href="{{ route('pd.index') }}">Permohonan Dana Query</a>
@endsection


@section('content')



    <!-- /.page-header -->
   <div class="page-header">
      <h1>Permohonan Dana Query</h1>
   </div><!-- /.page-header -->

 <div class="row">
       <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                  <h4 class="widget-title"></h4>
                  <div class="widget-toolbar">

                     <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
                              Action
                              <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">                                                        
                                 <li>
                                    <a href="#">Excel</a>
                                 </li>
                            

 
                           </ul>
                        </div><!-- /.btn-group -->

                  </div>
               </div>

               <div class="widget-body">
                  <div class="widget-main no-padding">

 


                     <table  class="table align-middle" id="dynamic-table1234">
                        <thead class="bg-light">
                           <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>PD</th>
                                <th>Customer</th>
                                <th>Penerima</th>
                                <th>Keterangan</th>                             
                                <th>Jumlah</th>
                                <th style="width:5px">x</th>
                           </tr>                  
                        </thead>
                           @php
                              $no=1;
                           @endphp
                           @foreach($pdhd as $hd)  
                           <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ Helper::TglIndo($hd->tanggal) }}</td>
                              <td>{{ $hd->kd_pd  }}</td>
                              <td>{{ $hd->customer }}</td>
                              <td>{{ $hd->penerima }}</td>
                              <td>{{ $hd->keterangan }}</td>
                              <td class="text-end" 
                                    @if ($hd->is_posting == 1)
                                       style="color: red;text-align:right;"
                                    @endif                          
                                 >{{ Helper::Rupiah($hd->jumlah) }}
                              </td>
                              <td>


                       
                                 <div>
                                    <div class="inline position-relative">
                                         <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                             <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
                                         </a>

                                         <ul class="dropdown-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret">
                                             <li>
                                                <a href="{{ route('pd.query.detail',[$hd->kd_pd]) }}">View Detail</a>
                                             </li>                                             
                                         </ul>

                                     </div>
                                 </div>


           
                              </td>
                           </tr>
                           @endforeach 
                       </table>


               </div>

            </div>
      </div>
   </div>
</div>
  


@endsection