@extends('layouts.app')

@section('title')
    Surat Jalan    
@endsection

@section('content')


   @php
   $tgl=$sj->tanggal ; 
   @endphp

	<div class="card border">

         <div class="card-header py-2 bg-primary text-white">         
            <div class="row">
                <div class="col-sm-8">
                     <h4 class="mb-0">Edit Surat Jalan</h4> 
                     <strong>{{ $id }}</strong>
                </div>
                <div class="col-sm-4 text-end">   
                    
                     <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown" style="font-size: 14px;"><i class="fadeIn animated bx bx-dots-vertical-rounded"></i>
                            </div>

                              <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="{{ route('sj.delete',[$id] ) }}" method="post">
                                       @method('DELETE')
                                       @csrf
                                       <button type="submit" class="dropdown-item"  style="font-size: 14px;"
                                       onclick="return confirm('Anda yakin menghapus data ?')">Delete</button>
                                    </form>
                                 </li> 
                            </ul>
                   </div>



                </div>
            </div>
         </div>

         <div class="card-body">

                <form class="form-horizontal" role="form" action="/sj/update/{{ $id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="row">
                    <div class="col-md-6">                     

                        <div class="mb-3 row">
                            <label class="col-md-3 col-form-label"><strong>Tanggal</strong></label>
                            <div class="col-md-9">

                                <input type="date" name="tanggal" class="form-control" placeholder="yyyy/mm/dd" 
                                value="{{ $tgl }}" id="datepicker-autoclose">
                                @if($errors->has('tanggal'))
                                    <div class="text-danger">
                                        {{ $errors->first('tanggal')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                  
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label"><strong>Customer</strong></label>
                            <div class="col-md-9">                              
                                <select class="form-control" name="customer">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($customer as  $c)
                                      <option value="{{ $c->kd_cus }}"
                                        @if ($c->kd_cus === $sj->kd_cus )
                                            selected
                                        @endif
                                        >{{ $c->customer }}</option>
                                    @endforeach
                                </select>    
                                @if($errors->has('customer'))
                                    <div class="text-danger">
                                        {{ $errors->first('customer')}}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label"><strong>Penerima</strong></label>
                            <div class="col-md-9">
                                <input type="text" name="penerima" class="form-control" value="{{ $sj->penerima }}">
                                  @if($errors->has('penerima'))
                                    <div class="text-danger">
                                        {{ $errors->first('penerima')}}
                                    </div>
                                @endif            
                            </div>
                        </div>


                 
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label"><strong>Keterangan</strong></label>
                            <div class="col-md-9">
                                <input type="text" name="keterangan1" class="form-control" 
                                value="{{ $sj->keterangan1 }}">    
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-md-9">
                                <input type="text" name="keterangan2" class="form-control" 
                                value="{{ $sj->keterangan2 }}">    
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">


                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label"><strong>Aju</strong></label>
                            <div class="col-md-9">
                                <input type="text" name="keterangan3" class="form-control" 
                                value="{{ $sj->keterangan3 }}">    
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label"><strong>BL</strong></label>
                            <div class="col-md-9">
                                <input type="text" name="keterangan4" class="form-control" 
                                value="{{ $sj->keterangan4 }}">    
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label"><strong>Vessel</strong></label>
                            <div class="col-md-9">
                                <input type="text" name="keterangan5" class="form-control" 
                                value="{{ $sj->keterangan5 }}">    
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label class="col-md-3 col-form-label"><strong>Note</strong></label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="3" name="note">{{ $sj->note }}</textarea>
                                 @if($errors->has('note'))                         
                                    <div class="text-danger">
                                        {{ $errors->first('note')}}
                                    </div>
                                @endif
                            </div>
                        </div>
             


                        <div class="mb-3 row">
                            <label for="" class="col-md-3"></label>
                            <div class="col-md-9">
                                    <button type="submit" class="btn btn-primary btn-sm px-3"
                                    @if ($sj->is_posting == 1)
                                         disabled 
                                    @endif
                                    >Update</button>
                            </div>
                        </div>
                </div>

 


            </div>
            <!-- end row -->

            </form>




        </div>
    </div>

@endsection
