@extends('layouts.master')
 
@section('title')
   KasBank
@endsection

@section('breadcrumb')
   <a href="{{ route('si.index') }}">Kasbank</a>
@endsection


@section('content')


   <!-- /.page-header -->
   <div class="page-header">
      <h1>Harian Kas Bank</h1>
   </div><!-- /.page-header -->


   <div class="row">
         <div class="col-xs-11"> 

            <div class="widget-box widget-color-blue2">
              <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Kas Bank</h4>
                  <div class="widget-toolbar">



                     <div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
                              Action
                              <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">  
                              <li>
                                    <a href="{{ route('kb.create') }}">Create</a>
                              </li>
                              <li class="divider"></li>
                              <li>
                                  <a href="{{ route('kb.harian.view') }}">View Transaksi</a>
                              </li>


                           </ul>



                        </div><!-- /.btn-group -->

                     
                  </div>
              </div>
                 <div class="widget-body">
                     <div class="widget-main no-padding">

                        <div>
                                 <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                       <tr>
                                          <th class="center">#</th>
                                          <th class="center">Kode</th>
                                          <th>Tanggal</th>
                                          <th>Keterngan</th>
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
                                            <td>
                                              {{ Helper::Rupiah($h->debit) }}
                                            </td>
                                            <td>
                                              {{ Helper::Rupiah($h->kredit) }}
                                            </td>
                                            <td>
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
                                             <a  href="{{ route('kb.edit',$h->kd_tr) }}" >Edit</a>
                                          </li> 
                                          <li>
                                             <a  href="{{ route('kb.delete',$h->kd_tr) }}" 
                                              onclick="return confirm('Anda yakin?')">Delete</a>
                                          </li> 
                                          <li class="divider"></li>
                                          <li>
                                             <a  href="{{ route('kb.posting') }}"
                                             onclick="event.preventDefault();
                                                     document.getElementById('posting-form').submit();" 
                                             @if ($cek->is_posting == 1)
                                                disabled 
                                             @endif
                                          >Posting</a>

                                          <form id="posting-form" action="{{ route('kb.posting') }}" method="POST">
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

