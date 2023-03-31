@extends('layouts.master')

@section('title')
   Container
@endsection

@section('breadcrumb')
   <a href="{{ route('charge.index') }}">Container</a>
@endsection


@section('content')


   <!-- /.page-header -->
   <div class="page-header">
      <h1>Data Container</h1>
   </div><!-- /.page-header -->


    <div class="row">
       <div class="col-sm-11">
          
        
         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title">Invoice Credit - {{ $container }}</h4>
               <div class="widget-toolbar">

                     <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                              
                              <li>

                      <a href="#"  target="_blank" 
                        onclick="event.preventDefault();
                        document.getElementById('print-all').submit();"

                      >Print PDF
                      </a>
                      <form id="print-all" action="{{ route('wh.invoice.singlecontpdf') }}" method="POST" target="_blank">
                        @csrf
                        <input type="hidden" name="container" value="{{ $container }}">
                      </form>
                              </li>
                           </ul>
                     </div><!-- /.btn-group -->

               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">

 @php
   
    $dd = date('d');
    $mm = date('m');
    $yy = date('Y');
  @endphp

  
  <table class="table table-bordered table-striped table-hover">
      <tr>
         <th>#</th>
         <th>Invoice</th>
         <th>Cnee</th>
         <th>Jumlah</th>
         <th>PPN</th>
         <th>Materai</th>
         <th>Grand Total</th>
      </tr>
      @php
         $no=1;
      @endphp
      @foreach ($invWh as $wh)
      <tr>
         <td>{{ $no++ }}</td>
         <td>{{ $wh->kd_inv}}</td>
         <td>
            @php
               $cnee = App\Models\Manifest::where('kd_inv',$wh->kd_inv)->first();
            @endphp
            {{ $cnee->cnee_name }}
         </td>
         <td style="text-align:right;">{{ Helper::Rupiah($wh->jumlah) }}</td>
         <td style="text-align:right;">{{ Helper::Rupiah($wh->vat)}}</td>
         <td style="text-align:right;">{{ Helper::Rupiah($wh->materai)}}</td>
         <td style="text-align:right;">{{ Helper::Rupiah($wh->grandtot)}}</td>
      </tr>
      @endforeach
     
  </table>




                  </div>
               </div>
         </div>
      </div>
   </div>

<p></p>


    <div class="row">
       <div class="col-sm-11">
          
        
         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title">Invoice Tambahan - {{ $container }}</h4>
               <div class="widget-toolbar">




               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">


 
  <table class="table table-bordered table-striped table-hover">
      <tr>
         <th>#</th>
         <th>Invoice</th>
       
         <th>Jumlah</th>
         <th>PPN</th>
         <th>Materai</th>
         <th>Grand Total</th>
      </tr>
      @php
         $no=1;
      @endphp
      @foreach ($invMan as $man)
        <tr>
           <td>1</td>
           <td>{{ $man->kd_inv}}</td>          
           <td style="text-align:right;">{{ Helper::Rupiah($man->jumlah) }}</td>
           <td style="text-align:right;">{{ Helper::Rupiah($man->ppn)}}</td>
           <td style="text-align:right;">{{ Helper::Rupiah($man->materai)}}</td>
           <td style="text-align:right;">{{ Helper::Rupiah($man->grandtotal)}}</td>
        </tr>
      @endforeach
  </table>

                  </div>
                </div>
              </div>
            </div>
      </div>




   
@endsection