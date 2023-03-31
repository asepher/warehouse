@extends('layouts.master')

@section('title')
    Container
@endsection

@section('breadcrumb')
   <a href="{{ route('wh.vessel.index') }}">Vessel</a>
@endsection

@section('content')
 
    <!-- /.page-header -->
   <div class="page-header">
      <h1>Data Container </h1>
   </div><!-- /.page-header -->



@foreach ($container as $cnt)
 
  <div class="row">
       <div class="col-sm-11">
          
        
         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title">Container {{ $cnt->container }} | Vessel : {{ $vsl}} </h4>
               <div class="widget-toolbar">


                  <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                              <li>
                          <a href="{{ route('wh.container.invoicenew',[$cnt->container]) }}">Create Invoice</a>                                    
                              </li>
                           </ul>
                  </div><!-- /.btn-group -->



               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">



            <div class="row">
                     <div class="col-md-8">
      @php
        $invmanuals = App\Models\InvManHeader::where('container',$cnt->container)->get()
      @endphp

                       <table class="table">
                         <tr>
                           <th style="width: 5px;">#</th>
                           <th>Inv</th>
                           <th>Jumlah</th>
                           <th>x</th>
                         </tr>
                         @php
                           $no = 1;
                         @endphp
                         @foreach ($invmanuals as $invman)
                           <tr 
                               @if ($invman->is_posting == 1)
                                style="background-color:#ffff4d"
                               @endif
                           >
                            <td>{{ $no++ }}</td>
                             <td>

                              @if ($invman->inv_mn == 1)
                                @php
                                  $nmfile = $invman->kd_inv.$invman->tipe.".PDF";
                                @endphp
                                <a href="{{ url('wh/'.$nmfile )}}" target="_blank">{{ $invman->kd_inv }}</a>
                              @else 
                                {{ $invman->kd_inv }}
                              @endif
                              
                              

                            </td>
                             <td>
                          @php
                            $invjum = App\Models\InvManHeader::where('kd_inv',$invman->kd_inv)
                                  ->first();
                          @endphp
                            {{ Helper::Rupiah($invjum->grandtotal) }}
                             </td>
                             <td>
                               

                          <div class="inline position-relative">
                                 <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                     <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
                                 </a>
                                 <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                                     <li>
                                        <a href="{{ route('wh.container.createmore',[$cnt->container,$invman->kd_inv]) }}">Edit</a> 
                                     </li>
                                     <li class="divider"></li>
                     <li>
                        <a href="{{ route('vessel.invman.posting',[$cnt->container,$invman->kd_inv]) }}">Posting</a> 
                     </li>
                                     
                                 </ul>
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

      </div>
  </div>



@endforeach



  


@endsection