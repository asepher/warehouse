@extends('layouts.master')

@section('title')
    Index Vessel
@endsection

 
@section('content')
 
    <!-- /.page-header -->
   <div class="page-header">
      <h1>Data Vessel </h1>
   </div><!-- /.page-header -->


    <div class="row">
       <div class="col-sm-11">
          
        
 
         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title"></h4>
               <div class="widget-toolbar">

                     <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                              <li>
                                    <a href="{{ route('wh.vessel.create') }}"
                                    @if (Auth::user()->dept == 'GD' )
                                        style="color: red;pointer-events: none;" 
                                    @endif
                                    >
                                    Create</a>
                              </li>
                           </ul>
                     </div><!-- /.btn-group -->

 

               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">

                     <table class="table table-striped table-bordered table-hover" id="dynamic-table">
                        <thead>
                        <tr>
                           <th>#</th>
                           <th>Kode</th>
                           <th>Eta</th>
                           <th>Vessel</th>
                           <th>Container</th>
                           <th>Pos</th>
                           <th>Inp</th>
                           <th>x</th>
                        </tr>
                        </thead>
                        @php
                            $no=1;
                        @endphp
                        <tbody>
                        @foreach ($vessels as $vessel)
                        
                           @php    
                              //$jumlah = "SELECT COUNT(kd_vsl) FROM manifest";
                                $jumlah = DB::table('manifest')->where('kd_vsl',$vessel->kd_vsl)->count();
                                $countIwh = App\Models\Manifest::where('kd_vsl',$vessel->kd_vsl)
                                                                ->where('gen_inv',1)->count(); 
                                $query  = DB::table('manifest')->where('kd_vsl',$vessel->kd_vsl)->count();
                                $stripping  =  App\Models\Stripping::where('kd_vsl',$vessel->kd_vsl)->count();
                           @endphp

                           <tr 
                           @if ($jumlah == $countIwh )
                               style="background-color: #ccdff3;"
                           @endif
                           >
                              <td class="center">{{ $no++  }}</td>
                              <td>{{ $vessel->kd_vsl}}</td>
                              <td>{{ Helper::TglIndo($vessel->eta) }}</td>
                              <td>
                              @if ($stripping >= 1)
                                <a href="{{ route('wh.stripping.view',[$vessel->kd_vsl]) }}">{{ $vessel->vessel}}</a>
                              @else 
                                {{ $vessel->vessel}}
                              @endif

                              </td>
                              <td>{{ $vessel->container}}</td>
                              <td class="center">{{ $vessel->jum_pos}}</td> 
                              <td class="center" 
                                @if ($jumlah == $countIwh )
                                    style="color: blue;"  
                                  @else
                                    style="color: red;"
                                @endif
                                >{{ $jumlah.'/'.$countIwh }}</td> 
                              <td class="center">

                                 <div>
                                 <div class="inline position-relative">
                                     <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                         <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
                                     </a>
                                     <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                                          <li>
                                            <a href="{{ route('wh.vessel.edit',[$vessel->kd_vsl]) }}"
                                                @if ($query >= $vessel->jum_pos)
                                                    style="pointer-events: none;color:red;" 
                                                @endif
                                                >Edit
                                            </a>                                            
                                         </li>
                                         <li class="divider"></li>
                                         <li>
                                             <a href="{{ route('wh.manifest.index',[$vessel->kd_vsl]) }}">
                                                 Manifest
                                             </a>
                                         </li>
                                         <li class="divider"></li>
                                            @if (Auth::user()->dept == 'GM' )
                                             <li>
                                                 <a href="{{ route('wh.container',[$vessel->kd_vsl]) }}">
                                                     Container
                                                   </a>
                                               </li>
                                            <li class="divider"></li>
                                            @endif
                                         <li>
                                             <a href="{{ route('wh.stripping.vessel',[$vessel->kd_vsl]) }}">
                                                 Stripping
                                               </a>
                                           </li>
                                           
                                     </ul>
                                 </div>
                                 </div>


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