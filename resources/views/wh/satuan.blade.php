@extends('layouts.master')

@section('title')
   Satuan
@endsection

@section('breadcrumb')
   <a href="{{ route('charge.index') }}">Satuan</a>
@endsection


@section('content')



   <!-- /.page-header -->
   <div class="page-header">
      <h1>Satuan</h1>
   </div><!-- /.page-header -->



 <div class="row">
    <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
              <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Add New</h4>
                  <div class="widget-toolbar">
                  </div>
              </div>
              <div class="widget-body">
                  <div class="widget-main">


                     <div class="row">
                        <div class="col-md-6">
                           


               <form class="form-horizontal" role="form" action="{{ route('wh.satuan.store') }}" method="POST">
               {{ csrf_field() }}
              
               <fieldset>

                  <div class="form-group">
                        <label class="col-sm-2 control-label">Kode</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="kd_charge" 
                              placeholder="Entry Kode.." value="{{ old('kd_charge') }}"
                              autocomplete="off">
                            @if($errors->has('kd_charge'))
                               <div class="text-danger">
                                   {{ $errors->first('kd_charge')}}
                               </div>
                           @endif
                        </div>
                  </div>      

                  <div class="form-group">  
                           <label class="col-sm-2 control-label"></label>
                           <div class="col-sm-4">
                              <button type="submit" class="btn btn-sm btn-primary px-5">Save</button>
                           </div>
                  </div>


                  </fieldset>
            </form>

         </div>
         <div class="col-md-6">


	<table class="table align-middle" id="example">
                  <thead class="table-transparan">
                     <th>#</th>
                     <th>Kode</th>
               
                     <th class="text-center" style="width: 50px;">x</th>
                  </thead>
                  <tbody>
                     @php
                        $no=1;
                     @endphp
                     @forelse ($satuan as $st)
                     <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $st->param2 }}</td>
                        <td class="text-center">




               <div>
                      <div class="inline position-relative">
                          <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                              <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
                          </a>

                          <ul class="dropdown-menu dropdown-lighter dropdown-menu-right">
                              <li>
                                 <a  href="{{ route('wh.satuan.edit',[$st->id]) }}" >Edit</a>
                              </li> 
                              <li>
                                 <a  href="{{ route('wh.satuan.destroy',[$st->id]) }}"
                                 onclick="event.preventDefault();
                                         document.getElementById('posting-form').submit();
                                         return confirm('Yakin akan di hapus?')"
                                 >Delete</a>
                              <form id="posting-form" action="{{ route('wh.satuan.destroy',[$st->id]) }}" 
                                 method="POST">
                                 {{ csrf_field() }}
                                 <input type="hidden" name="id" value="{{ $st->id }}">
                              </form>


                              </li>
                          </ul>
                      </div>
                  </div>



                        
                        </td>

                     </tr> 
                     @empty
                     <tr>
                        <td colspan="3">No Record</td>
                     </tr> 
                     @endforelse

                  </tbody>
               </table>
                              







         	
         </div>


                  </div>
               </div>
         </div>

      </div>
   </div>


@endsection