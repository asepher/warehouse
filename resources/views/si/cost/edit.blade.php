@extends('layouts.master')

@section('title')
   Cost
@endsection

@section('breadcrumb')
   <a href="{{ route('si.index') }}">Shipping</a>
@endsection


@section('content')



   <!-- /.page-header -->
   <div class="page-header">
      <h1>Data Cost</h1>
   </div><!-- /.page-header -->




 <div class="row">
    <div class="col-sm-11">
       <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title">Edit Data  Cost</h4>
                <div class="widget-toolbar">
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main no-padding">



              <div class="row">
                  <div class="col-sm-6">

                    <form class="form-horizontal" role="form" action="{{ route('si.cost.update', [$id]) }}" 
                    method="post">
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
                                    <option value="{{ $c->kd_charge }}"
                                      @if ($c->kd_charge === $det->kd_chg)
                                        selected 
                                      @endif
                                      >{{ $c->kd_charge . " - " . $c->charge }}</option>
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
                            >{{ $det->keterangan }}</textarea>
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
                                    value="{{ $det->jumlah }}" id="jumlah" autocomplete="off">

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
                              >Update</button> 
      
                        </td>
                      </tr>

                    </table>
                                                  
                    </form>

                    </div>                    
                    <div class="col-sm-6">

                    </div>






                </div>
              </div>
        </div>
    </div>
</div>








@endsection