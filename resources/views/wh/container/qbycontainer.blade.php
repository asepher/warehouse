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
                  <h4 class="widget-title">List - Bulan : {{ $nmbulan.'-'. $tahun}}</h4>
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
                      <form id="print-all" action="{{ route('wh.invoice.qbycontpdf') }}" method="POST" target="_blank" >
                        @csrf
                        <input type="hidden" name="bulan" value="{{ $bulan }}">
                        <input type="hidden" name="tahun" value="{{ $tahun }}">
                      </form>
                              </li>
                           </ul>
                     </div><!-- /.btn-group -->


                  </div>
              </div>
              <div class="widget-body">
                  <div class="widget-main no-padding">


<div class="table-responsive">
   


                  <table style="width:110%;" class="table-bordered table-striped table-hover">
             
                   <tr style="border: 0.1px black solid;" >
                      <th rowspan="2" style="width: 10px;text-align: center;border: 1px black solid;" >NO</th>
                      <th rowspan="2" style="width: 50px;text-align: center;border: 1px black solid;">ETA</th>
                      <th rowspan="2" style="width: 50px;text-align: center;border: 1px black solid;">CONTAINER</th>
                      <th style="text-align: center;border: 1px black solid;" colspan="4">INVOICE</th> 
                      <th style="text-align: center;border: 1px black solid;" colspan="4">INVOICE TAMBAHAN</th>
                   </tr>                 
                   <tr>
                      <th style="width: 30px;text-align: center;border: 0.1px black solid;">TOTAL</th>
                      <th style="width: 30px;text-align: center;border: 0.1px black solid;">PPN</th>
                      <th style="width: 30px;text-align: center;border: 1px black solid;">MATERAI</th>
                      <th style="width: 30px;text-align: center;border: 1px black solid;">GRAND TOTAL</th>   <th style="width: 30px;text-align: center;border: 0.1px black solid;">TOTAL</th>
                      <th style="width: 30px;text-align: center;border: 0.1px black solid;">PPN</th>
                      <th style="width: 30px;text-align: center;border: 1px black solid;">MATERAI</th>
                      <th style="width: 30px;text-align: center;border: 1px black solid;">GRAND TOTAL</th>
                   </tr>                 
                        @php
                           $no = 1;
                        @endphp
                        <tbody>
                           @foreach ($container as $cont)
                              <tr>
                                 <td style="width:10px;padding: 5px;">{{ $no++ }}</td>
                                 <td>{{ Helper::TglIndo($cont->eta)}}</td>
                                 <td>{{ $cont->container }}</td>
                                 <td style="text-align:right;">
                                    @php
                                       $hitInv = App\Models\IwhHeader::where('container',$cont->container)->orderBy('eta','DESC')->sum('jumlah');
                                    @endphp
                                       {{ Helper::Rupiah($hitInv) }}
                                 </td>
                                 <td style="text-align:right;">
                                     @php
                                       $hitPPN = App\Models\IwhHeader::where('container',$cont->container)->orderBy('eta','DESC')->sum('vat');
                                    @endphp
                                      {{ Helper::Rupiah($hitPPN) }}
                                 </td>
                                 <td style="text-align:right;">
                                    @php
                                       $hitMat = App\Models\IwhHeader::where('container',$cont->container)->orderBy('eta','DESC')->sum('materai');
                                    @endphp
                                       {{ Helper::Rupiah($hitMat) }}
                                 </td>
                                 <td style="text-align:right;"> 
                                    @php
                                       $hitGrand = App\Models\IwhHeader::where('container',$cont->container)->orderBy('eta','DESC')->sum('grandtot');
                                    @endphp
                                    {{ Helper::Rupiah($hitGrand) }}
                                 </td>


                                 <td style="text-align:right;">
                                    @php
                                       $ManInvJum = App\Models\InvManHeader::where('container',$cont->container)->orderBy('eta','DESC')->sum('jumlah');
                                    @endphp
                                       {{ Helper::Rupiah($ManInvJum) }}
                                 </td>
                                 <td style="text-align:right;">
                                    @php
                                       $ManPPn = App\Models\InvManHeader::where('container',$cont->container)->orderBy('eta','DESC')->sum('ppn');
                                    @endphp
                                       {{ Helper::Rupiah($ManPPn) }}
                                 </td>
                                 <td style="text-align:right;">
                                    @php
                                       $ManJumVat = App\Models\InvManHeader::where('container',$cont->container)->orderBy('eta','DESC')->sum('vat');
                                    @endphp
                                       {{ Helper::Rupiah($ManJumVat) }}
                                 </td>
                                 <td style="text-align:right;">
                                    @php
                                       $ManGrandTot = App\Models\InvManHeader::where('container',$cont->container)->orderBy('eta','DESC')->sum('grandtotal');
                                    @endphp
                                       {{ Helper::Rupiah($ManGrandTot) }}
                                 </td>

                              </tr>
                           @endforeach
                        </tbody>
                        
                     </table>


<p><br></p>
<p><br></p>



</div>

                  </div>
               </div>

      </div>
   </div>

   <p></p>
   <p></p>
   <p></p>
@endsection