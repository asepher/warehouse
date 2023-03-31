@extends('layouts.app')

@section('title')
   Surat Jalan
@endsection

@section('content')

   @php
   $tgl=date('Y-m-d'); 
   @endphp

      <div class="card border">
           
        <div class="card-header py-2 bg-primary text-white">
            <div class="row">
                 <div class="col-sm-8">
                     <h4 class="mb-0">Surat Jalan</h4>
                 </div>
            </div>
         </div>   

         <div class="card-body">

            <form class="form-horizontal" role="form" action="{{ route('sj.store') }}" method="post">
            {{ csrf_field() }}
                
         
                <div class="row">
                    <div class="col-sm-6">



                        <div class="mb-3 row">
                            <label class="col-md-3 col-form-label"><strong>Tanggal</strong></label>
                            <div class="col-md-9">
                                <input type="date" name="tanggal" class="form-control" placeholder="yyyy/mm/dd" 
                                value="{{ $tgl }}">
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
                                    <select class="single-select" name="customer">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($customer as  $c)
                                          <option value="{{ $c->kd_cus }}"
                                           @if ( old('customer') == $c->kd_cus)
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
                                <input type="text" name="penerima" class="form-control" value="{{ old('penerima') }}" autocomplete="off" >
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
                                    value="{{ old('keterangan1') }}" autocomplete="off" >    
                                    @if($errors->has('keterangan1'))
                                        <div class="text-danger">
                                            {{ $errors->first('keterangan1')}}
                                        </div>
                                    @endif

                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 control-label"> </label>
                                <div class="col-md-9">
                                    <input type="text" name="keterangan2" class="form-control" 
                                    value="{{ old('keterangan2') }}" autocomplete="off" >    
                                </div>
                            </div>




                    </div>                    
                    <div class="col-sm-6">



                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label"><strong>Aju</strong></label>
                                <div class="col-md-9">
                                    <input type="text" name="keterangan3" class="form-control" 
                                    value="{{ old('keterangan3') }}" autocomplete="off" >    
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label"><strong>BL</strong></label>
                                <div class="col-md-9">
                                    <input type="text" name="keterangan4" class="form-control" 
                                    value="{{ old('keterangan4') }}" autocomplete="off" >    
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label"><strong>Vessel</strong></label>
                                <div class="col-md-9">
                                    <input type="text" name="keterangan5" class="form-control" 
                                    value="{{ old('keterangan5') }}" autocomplete="off" >    
                                </div>
                            </div>


                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label"><strong>Note</strong></label>
                                <div class="col-md-9">
                                    <textarea class="form-control" rows="3" name="note">{{ old('note') }}</textarea>
                                    
                                </div>
                            </div>    


                            <div class="mb-3 row">
                                <label for="" class="col-md-3"></label>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-primary btn-sm px-3"
                                    >Submit</button>
                                </div>
                            </div>

                        
                    </div>

                    
                </div> {{-- end row --}}

            </form>






           

         </div>
      </div>






@endsection