@extends('layouts.master')

@section('title')
   Cost
@endsection

@section('breadcrumb')
   <a href="{{ route('si.index') }}">Shipping</a>
@endsection

@section('content')

    @php
          //$hit = App\Models\InvSiHeader::where('no_inv',$header->no_inv)->where('tipe',$tipe)->count();
    @endphp






   <!-- /.page-header -->
   <div class="page-header">
      <h1>Data Cost</h1>
   </div><!-- /.page-header -->




 <div class="row">
    <div class="col-sm-11">
       <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title">Create Cost</h4>
                <div class="widget-toolbar">
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main no-padding">




        <div class="row">
                <div class="col-sm-6">

                    <form class="form-horizontal" role="form" action="{{ route('si.cost.store',[$si]) }}" method="post">
                    {{ csrf_field() }}

                    <table class="table align-middle">

                      <tr>
                        <td><strong>SI Ref</strong></td><td>: {{ $si }}</td>
                      </tr>

                      <tr>
                        <td><strong>Categori</strong></td><td>
                           <select class="form-control" name="charge">
                                   <option value="">-- Pilih --</option>
                                  @foreach ($charge as  $c)
                                    <option value="{{ $c->kd_charge }}">{{ $c->kd_charge . " - " . $c->charge }}</option>
                                  @endforeach
                            </select>    
                            @if($errors->has('charge'))
                                  <div class="text-danger">
                                      {{ $errors->first('charge')}}
                                  </div>
                            @endif                         
                        </td>
                      </tr>
                        
                      <tr>
                        <td><strong>Keterangan</strong></td><td>
                            <textarea class="form-control" rows="3" name="keterangan"
                            >{{ old('keterangan') }}</textarea>
                                 @if($errors->has('keterangan'))                         
                                    <div class="text-danger">
                                        {{ $errors->first('keterangan')}}
                                    </div>
                                @endif                      
                        </td>
                      </tr>
     
                      <tr>
                        <td><strong>Jumlah</strong></td><td>
                          <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" 
                                    value="{{ old('jumlah') }}" id="jumlah" autocomplete="off">
                                      @if($errors->has('jumlah'))
                                        <div class="text-danger">
                                            {{ $errors->first('jumlah')}}
                                        </div>
                                    @endif
                        </td>                    
                      </tr>

                     <tr>
                        <td></td>
                        <td>                      
                              
                              <button type="submit" class="btn btn-primary btn-sm px-3"
                              @php
                                //$cek = App\InvSiHeader::where('no_inv',$header->no_inv)->count();
                                //disabled="true" 
                              @endphp
                              >Save</button> 
      
                        </td>
                      </tr>

                    </table>
                                                  
                    </form>


            
                </div>
                <div class="col-sm-6">



                            <p></p>
                            <table class="table align-middle">
                                <thead class="table-secondary">
                                    <tr class="bg-light">
                                        <th>#</th>
                                        <th style="text-align: center;"><strong>Keterangan</strong></th>
                                        <th style="text-align: center;"><strong>Jumlah</strong></th>
                                        <th style="text-align: center;"><strong>x</strong></th>
                                    </tr>                   
                                </thead>
                                <tbody>
                                    @php
                                        $no     = 1;    $tot = 0;   $jum = 0;
                                        $hitppn = 0;
                                        $mat = 0;
                                    @endphp
                                    @forelse ($biaya as $dt)


                                        <tr>
                                            @if (substr($dt->kd_chg,0,2) == 99)
                                              <td></td>                                        
                                              <td>
                                                @php
                                                  echo nl2br($dt->keterangan)
                                                @endphp
                                              </td>                                          
                                              <td></td>                                          
                                            @else
                                              <td>{{ $no++ }}</td>                                        
                                              <td>{{ $dt->keterangan }}</td>
                                              <td style="text-align: right;">{{ Helper::Rupiah($dt->jumlah) }}</td>
                                            @endif
                                              <td class="text-center">



                            <div>
                                  <div class="inline position-relative">
                                      <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                          <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
                                      </a>

                                      <ul class="dropdown-menu dropdown-lighter dropdown-menu-right">
                                          <li>
                                             <a  href="{{ route('si.cost.edit',[$dt->id])}}" >Edit</a>
                                          </li> 
                                          <li>
                                             <a  href="{{ route('si.cost.destroy',[$dt->id]) }}"
                                             onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();" 
                                            
                                          >Delete</a>

                                          <form id="delete-form" action="{{ route('si.cost.destroy',[$dt->id]) }}" method="POST">
                                             {{ csrf_field() }}
                                             <input type="hidden" name="id" value="{{ $dt->id }}">
                                          </form>


                                          </li>
                                      </ul>
                                  </div>
                              </div>




                                          </td>
                                        </tr>
                                          @php
                                                $tot = $tot + $dt->jumlah;
                                                if ( $dt->ppn >= 1)
                                                {
                                                    $hitppn = ( $dt->ppn * $dt->jumlah ) / 100 ;
                                                }                                            
                                          @endphp  
                                    @empty

                                        <tr>
                                            <td colspan="3">No Record</td>
                                        </tr>

                                    @endforelse
                                            
                                @php
                                    $grandtot = $tot ;
                                @endphp
                                <tr>
                                    <td colspan="2" style="text-align: right;"> <strong>Grand Total<strong> </td>
                                    <td style="text-align: right;">{{ Helper::Rupiah($grandtot) }}</td>
                                </tr>

                                </tbody> 
                            </table>   
                            <p></p> 





            
                </div>

            </div>




                </div>
            </div>
        </div>
    </div>
</div>



@endsection