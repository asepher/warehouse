@extends('layouts.master')
 
@section('title')
   KasBank
@endsection

@section('breadcrumb')
   <a href="{{ route('kb.index') }}">Kasbank</a>
@endsection


@section('content')


   <!-- /.page-header -->
   <div class="page-header">
      <h1>Transaction Kas Bank</h1>
   </div><!-- /.page-header -->


   <div class="row">
         <div class="col-xs-11"> 

            <div class="widget-box widget-color-blue2">
              <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">View</h4>
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

                        <div>
                                 <table id="dynamic-table12" class="table table-striped table-bordered table-hover">
                                    <thead>
                                       <tr>
                                          <th class="center">#</th>
                                          <th class="center">Kode</th>
                                          <th>Tanggal</th>
                                          <th>Keterangan</th>
                                          <th>Debet</th>
                                          <th>                                             
                                             Kredit
                                          </th>
                                          <th>Saldo</th>

                                          <th>x</th>
                                       </tr>
                                    </thead>

                                    <tbody>
                                         @php
                        $no=1;
                        $debet=0;
                        $kredit=0;
                        $JumDebit = 0;
                        $JumKredit = 0;
                     @endphp
                                       @foreach ($harian as $h)

                                        @php    
                             $cek = App\Models\Harian::where('id',$h->id)->first();  
                             $status = $cek->is_posting;
                         @endphp
                                          <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $h->kd_tr }}</td>
                                            <td>{{ Helper::TglIndo($h->tanggal) }}</td>
                                            <td>{{ $h->keterangan1 ." " . $h->keterangan3 }}</td>
                                            <td style="text-align:right;">
                                              {{ Helper::Rupiah($h->debit) }}
                                            </td>
                                            <td style="text-align:right;">
                                              {{ Helper::Rupiah($h->kredit) }}
                                            </td>
                                            <td style="text-align:right;">
                                                @php 
                                                   if ($h->tipe == 'Debit') {
                                                      $JumDebit =  $JumDebit + $h->debit ;
                                                   }
                                                   if ($h->tipe == 'Kredit') {
                                                      $JumKredit = $JumKredit + $h->kredit;
                                                   }
                                                   $JumSaldo = $JumDebit - $JumKredit;  
                                                @endphp
                                                {{ Helper::Rupiah($JumSaldo) }}
                                            </td>
                                            <td class="text-center">
                                               

                              <div>
                                  <div class="inline position-relative">
                                      <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                          <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
                                      </a>
                                      <ul class="dropdown-menu dropdown-yellow dropdown-menu-right"> 
                                          <li>
                                             <a  href="{{ route('kb.unposting') }}"
                                             onclick="event.preventDefault();
                                                     document.getElementById('posting-form').submit();" 
                                          >Unposting</a>

                                          <form id="posting-form" action="{{ route('kb.unposting') }}" method="POST">
                                             {{ csrf_field() }}
                                             <input type="hidden" name="id" value="{{ $h->id }}">
                                          </form>


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




                              <!-- div.dataTables_borderWrap -->
                              
                           </div>
                        </div>










@endsection

