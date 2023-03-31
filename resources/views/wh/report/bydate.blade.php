@extends('layouts.master')

@section('title')
    Report Period
@endsection


@section('breadcrumb')
    <a href="">Invoice</a>
@endsection
 

@section('content')
<style>
      table {
            border-collapse: collapse;
            width: 100%;
        }
          
        th, td {
            text-align: left;
            padding: 2px;
        }
          
        .yelow {
            background-color: Lightgreen;
        }
</style>
   @php      
      $now = \Carbon\Carbon::now()
   @endphp
    <!-- /.page-header -->
   <div class="page-header">
      <h1>Query Invoice By Period</h1>
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

                    
                     <form class="form-horizontal" role="form" action="{{ route('wh.invoice.querybydate') }}" method="post">
                     {{ csrf_field() }}

                     <div class="row">
                        <div class="col-md-3">
                              <input type="date" name="tgl_awal" class="form-control" required> 
                               @if($errors->has('tgl_awal'))
                                  <div class="text-danger">
                                     {{ $errors->first('seq')}}
                                  </div>
                               @endif
                        </div>
                        <div class="col-md-3">
                              <input type="date" name="tgl_akhir" class="form-control" required> 
                               @if($errors->has('tgl_akhir'))
                                  <div class="text-danger">
                                {{ $errors->first('seq')}}
                                  </div>
                               @endif
                        </div>
                        <div class="col-md-5">
                           <button type="submit" class="btn btn-primary btn-sm px-5">Submit</button>
                          
                        </div>
                     </div> 

                     </form>



               


                  </div>
               </div>


         </div>





       </div>
    </div>



    <hr>
    <strong>TGL AWAL</strong>  : {{ Helper::TglIndo($tgl_awal)}}  - <strong>TGL AKHIR</strong>  : {{ Helper::TglIndo($tgl_akhir)}}

    <div class="row">
       <div class="col-sm-11">
          
        
         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title">Result</h4>
               <div class="widget-toolbar">


                     <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                              <li>
                                 <a href="#"
                                    onclick="event.preventDefault();
                                    document.getElementById('export-tgl').submit();"
                                 >Excel</a>
                                 <form id="export-tgl" 
                                       action="{{ route('vessel.manifest_bydate') }}" 
                                       method="POST">
                                       {{ csrf_field() }}
                                       <input type="hidden" name="tgl_awal" value="{{$tgl_awal}}">
                                       <input type="hidden" name="tgl_akhir" value="{{$tgl_akhir}}"> 
                                    </form>
                              </li>
                           </ul>
                     </div><!-- /.btn-group -->



               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">
                     @php
                        $no=1;
                     @endphp

              <div class="table-responsive">
               <table id="dynamic-table" style="width:150%;line-height: 30px;overflow: hidden;" class="table-bordered">   
               <thead>    
                     <tr id="yelow">
                        <th style="width: 5px;text-align: center;">NO</th>
                        <th style="text-align: center;">HBL</th>
                        <th style="text-align: center;">TERM</th>
                        <th style="text-align: center;">CNEE</th>                     
                        <th style="text-align: center;">ADDRESS</th> 
                        <th style="text-align: center;">NPWP</th>                     
                        <th style="text-align: center;">ETA</th>                     
                        <th style="width: 120px;text-align: center;">INV</th>
                        <th style="text-align: center;">AMMOUNT</th>
                        <th style="text-align: center;">DATE RELEASE</th>
                        <th style="text-align: center;">DATE PAID</th>        
                     </tr>   
                  </thead> 
                   <tbody>   
                     @php
                        $no = 1;
                     @endphp

                     @forelse ($manifest as $man )
                           <tr>                              
                              <td>{{ $no++ }}</td>
                              <td>{{ $man->hbl }}</td>
                              <td>{{ $man->term }}</td>
                              <td>{{ $man->cnee_name }}</td>
                              <td>{{ Str::limit($man->cnee_address, 30) }}</td>
                              <td>{{ $man->cnee_npwp }}</td>                             
                              <td>{{ date('d-m-Y',strtotime($man->eta)) }}</td>
                              <td>{{ $man->kd_inv }}</td>
                              <td style="text-align:center;">{{ Helper::Angka($man->inv_wh) }}</td>
                              <td>{{ date('d-m-Y',strtotime($man->tgl_inv)) }}</td>    
                              <td>
                                @if (isset($man->tgl_paid))
                                    {{ date('d-m-Y',strtotime($man->tgl_paid)) }}
                                @endif
                              </td>    
                           </tr>
                      
                        @empty
                           <tr>
                              <td colspan="9" style="text-align: center;">No record </td>
                           </tr>
                        @endforelse
                         
                          </tbody>
              </table>
               <p></p><br>
              </div>
                     



                  </div>
               </div>


         </div>





       </div>
    </div>




@endsection

