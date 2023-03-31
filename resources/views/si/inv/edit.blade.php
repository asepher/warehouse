@extends('layouts.master')

@section('title')
   Shipping Instruction
@endsection

@section('breadcrumb')
   <a href="{{ route('si.index') }}">Shipping</a>
@endsection


@section('content')
  

    <!-- /.page-header -->
   <div class="page-header">
      <h1>Shipping Instruction </h1>
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

          
<form class="form-horizontal" role="form" action="{{ route('si.inv.update',[$si,$id]) }}" method="post">
                {{ csrf_field() }}

                <table class="table align-middle">

                  <tr>
                    <td><strong>SI Ref</strong></td><td>: {{ $si }}</td>
                  </tr>

                  <tr>
                    <td><strong>Tipe</strong></td><td>: {{ $dtl->tipe }}</td>
                  </tr>

                  <tr>
                    <td><strong>Charge</strong></td><td>
                    
                       <select class="form-control" name="charge">
                               <option value="">-- Pilih --</option>
                              @foreach ($charge as  $c)
                                <option value="{{ $c->kd_charge }}"                                
                                @if ( $dtl->kd_chg === $c->kd_charge  )
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
                        >{{ $dtl->keterangan }}</textarea>
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
                                value="{{ $dtl->jumlah }}" id="jumlah"                                 
                                autocomplete="off">
                                  @if($errors->has('jumlah'))
                                    <div class="text-danger">
                                        {{ $errors->first('jumlah')}}
                                    </div>
                                @endif
                    </td>                    
                  </tr>

                 <tr>
                    <td>
                    </td>
                    <td>
                      <button type="submit" class="btn btn-primary btn-sm px-3">Update</button>
                      </td>
                  </tr>

                </table>
                                              
                </form>





                  </div>
               </div>
            </div>
      </div>
   </div>



  

@endsection 