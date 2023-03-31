@extends('layouts.master')

@section('title')
   Permohoan Dana
@endsection

@section('breadcrumb')
   <a href="{{ route('pd.index') }}">Permohonan Dana</a>
@endsection


@section('content')



    <!-- /.page-header -->
   <div class="page-header">
      <h1>Permohonan Dana</h1>
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
                                    <a href="{{ route('pd.create') }}"
                                       >Create</a>
                                 </li>
                            

 
                           </ul>
                        </div><!-- /.btn-group -->

                  </div>
               </div>

               <div class="widget-body">
                  <div class="widget-main no-padding">

 


                     <table  class="table align-middle" id="dynamic-table12">
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
                           @forelse($pdhd as $p)  
                              @php    
                                 $cek = App\Models\Pdhd::where('kd_pd', $p->kd_pd)->first();  
                              @endphp                
                           <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ Helper::TglIndo($p->tanggal) }}</td>
                              <td>{{ $p->kd_pd  }}</td>
                              <td>{{ $p->customer }}</td>
                              <td>{{ $p->penerima }}</td>
                              <td>{{ $p->keterangan }}</td>
                              <td class="text-end" 
                                 @if ($cek->is_posting == 1)
                                  style="color: red;text-align:center"
                                 @endif
                                 >{{ Helper::Rupiah($p->jumlah) }}
                              </td>
                              <td>


                       
                                 <div>
                                    <div class="inline position-relative">
                                         <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                             <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
                                         </a>

                                         <ul class="dropdown-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret">
                                             <li>
                                                <a  href="{{ route('pd.edit',[$p->kd_pd]) }}" 
                                             @if ($cek->is_posting == 1)
                                              style="color: red;pointer-events: none;"
                                             @endif
                                                               >Edit</a>
                                             </li> 
                                             <li class="divider"></li>
                                             <li>
                                                <a href="{{ route('pd.detail',[$p->kd_pd]) }}">Detail</a>
                                             </li>                                             
                                         </ul>

                                     </div>
                                 </div>


           
                              </td>
                           </tr>
                            @empty
                            <tr>
                               <th colspan="8" style="text-align:center"> No Record found</th>
                            </tr>
                           @endforelse

                       </table>


               </div>

            </div>
      </div>
   </div>
</div>

<script type="text/javascript">
   $(function(){
      $(document).on('click','#delete',function(e){
            alert('hello');
      }
          
   }
</script>
                        


@endsection