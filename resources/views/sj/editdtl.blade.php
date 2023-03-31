@extends('layouts.app')

@section('title')
    Surat Jalan    
@endsection

@section('content')

    <div class="card border">
        <div class="card-header py-2 bg-primary text-white">
            
            <div class="row align-items-center">
                <div class="col-sm-8">
                    <h4 class="mb-0">Surat Jalan</h4>
                    <strong>{{ $sj }}</strong>
                </div>                
            </div>

        </div>    
        <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        
                         <form class="form-horizontal" role="form" action="{{ route('sj.detail.update',[$sj,$id])}}" 
                         method="post">
                            {{ csrf_field() }}

                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label"><strong>Tanggal</strong></label>
                                <div class="col-md-9">
                                    <input type="date" name="tanggal" class="form-control" placeholder="yyyy/mm/dd" 
                                    value="{{ $dtl->tanggal }}" id="datepicker-autoclose">
                                    @if($errors->has('tanggal'))
                                        <div class="text-danger">
                                            {{ $errors->first('tanggal')}}
                                        </div>
                                    @endif            
                                </div>
                            </div>

                             <div class="mb-3 row">                                
                                <label class="col-sm-3 col-form-label"><strong>Type</strong></label>
                                <div class="col-md-9">
                                    <select class="form-control" name="document">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($param as  $c)
                                          <option value="{{ $c->param2 }}"
                                                @if ( $dtl->document == $c->param2)
                                                    selected 
                                                @endif
                                            >{{ $c->param2 }}</option> 
                                        @endforeach
                                    </select>
                                    @if($errors->has('document'))
                                        <div class="text-danger">
                                            {{ $errors->first('document')}}
                                        </div>
                                    @endif
                
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label"><strong>Note</strong></label>
                                <div class="col-md-9">
                                    <textarea class="form-control" 
                                    rows="3" name="note">{{ $dtl->note }}</textarea>
                                     @if($errors->has('note'))                         
                                        <div class="text-danger">
                                            {{ $errors->first('note')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                         
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label"><strong>Jumlah</strong></label>
                                <div class="col-md-5">
                                    <input type="number" name="jumlah" class="form-control" 
                                    value="{{ $dtl->jumlah }}" autocomplete="off">
                                      @if($errors->has('jumlah'))
                                        <div class="text-danger font-w300 font-size-sm">
                                            {{ $errors->first('jumlah')}}
                                        </div>
                                    @endif
                
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label"><strong>Satuan</strong></label>
                                <div class="col-md-5">
                                    <select name="satuan" class="form-control font-w500 font-size-sm">
                                        <option value="">-- Pilih --</option>                                        
                                        <option value="Lembar"
                                           @if ( $dtl->satuan == 'Lembar')
                                             selected
                                            @endif                                            
                                        >Lembar</option>
                                        <option value="kg"
                                           @if ( $dtl->satuan == 'kg')
                                             selected
                                            @endif                                            
                                        >Kg</option>
                                    </select>
                                    @if($errors->has('satuan'))
                                        <div class="text-danger font-w300 font-size-sm">
                                            {{ $errors->first('satuan')}}
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div class="mb-3 row">
                                <label for="" class="col-md-3"></label>
                                <div class="col-md-9">
                                        <button type="submit" class="btn btn-primary btn-sm px-3"
                                        @if ($dtl->is_posting == 1)
                                             disabled 
                                        @endif
                                        >Update </button>
                                </div>
                            </div>

                         </form>





                    </div>
                  




                </div>
                <!-- END Row -->




        </div>        
    </div>    



@endsection


