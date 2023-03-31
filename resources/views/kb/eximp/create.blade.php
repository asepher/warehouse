@extends('layouts.app')


@section('title')
   Kasbank Export Import
@endsection

@section('content')

	@php
   $tgl=date('Y-m-d'); 
   @endphp

	<div class="container">
		<div class="row">
			<div class="col-md-12">	

				<div class="card border">
					<div class="card-header py-2 bg-primary text-white">
						<div class="row align-items-center g-3">
							<h4 class="mb-0">Entry Kas Bank Export Import</h4>							
						</div>
					</div>

					<form  method="post" action="{{ route('kb.eximp.store') }}" >
			    	{{ csrf_field() }}
						<div class="card-body">
							<div class="row">
								
								<div class="col-md-6">
										

							    <div class="mb-3 row">
						  			<label class="col-md-3 col-form-label"><strong>Tanggal</strong></label>
						            <div class="col-md-9">
						                <input type="date" name="tanggal" class="form-control datepicker-input" placeholder="yyyy/mm/dd" 
						                value="{{ $tgl }}" autocomplete="off">
						                @if($errors->has('tanggal'))
						                    <div class="text-danger">
						                        {{ $errors->first('tanggal')}}
						                    </div>
						                @endif    
						            </div>
							    </div>

							    

							<div class="mb-3 row">
						  			<label class="col-md-3 col-form-label"><strong>Mata Uang</strong></label>
						            <div class="col-md-6">
						                <select name="matauang" class="form-control">
						                	<option value="">-- Pilih --</option>
						                	<option value="Rp" selected >Rp</option>
						                	<option value="Usd">Usd</option>
						                </select>
						                @if($errors->has('matauang'))
						                    <div class="text-danger">
						                        {{ $errors->first('Usd')}}
						                    </div>
						                @endif    

						            </div>
							    </div>




 							<div class="mb-3 row">
                                <label class="col-sm-3 col-form-label"><strong>Customer</strong></label>
                                <div class="col-md-9">
                                    <select class="single-select" name="keterangan1">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($customer as  $c)
                                          <option value="{{ $c->kd_cus }}">{{ $c->customer }}</option>
                                        @endforeach
                                    </select>    
                                    @if($errors->has('keterangan1'))
                                        <div class="text-danger">
                                            {{ $errors->first('keterangan1')}}
                                        </div>
                                    @endif
                                </div>
                            </div>



							   


							    <div class="mb-3 row">
						  			<label class="col-md-3 col-form-label"><strong>Keterangan</strong></label>
						            <div class="col-md-9">
										<textarea name="keterangan2" cols="40" rows="4" id="keterangan2" placeholder="Keterangan" 
										class="form-control">{{ old('keterangan2') }}</textarea>
						            </div>
							    </div>



										</div> {{-- end col 6 --}}
											<div class="col-md-6">
										


								
							    <div class="mb-3 row">
						  			<label class="col-md-3 col-form-label"><strong>Lokasi</strong></label>
						            <div class="col-md-9" >

						            	<select name="keterangan3" class="form-control">
						                	<option value="">-- Pilih --</option>
						                	<option value="Office" selected >Office</option>
						                	<option value="Warehouse">Warehouse</option>
						                </select>
						            	@if($errors->has('keterangan3'))
						                    <div class="text-danger">
						                        {{ $errors->first('keterangan3')}}
						                    </div>
							             @endif
						            </div>
							    </div>



							    <div class="mb-3 row">
						  			<label class="col-md-3 col-form-label"><strong>Jumlah</strong></label>
						            <div class="col-md-6">
						            	<input type="text" name="jumlah" placeholder="Jumlah" 
						            	class="form-control allow_decimal" 
						            	id="jumlah" autocomplete="off" value="{{ old('jumlah') }}">
						            	 @if($errors->has('jumlah'))
						                    <div class="text-danger">
						                        {{ $errors->first('jumlah')}}
						                    </div>
						                @endif    
						            </div>
							    </div>


							    <div class="mb-3 row">
						  			<label class="col-md-3 control-label" ></label>
						            <div class="col-md-9">
						            	<button type="submit" class="btn btn-primary btn-sm px-5">Save </button>
						            </div>
							    </div>


									</div> {{-- end col 6 --}}
							</div> {{-- end row --}}


						</div>
					</form>
				</div> {{-- end card --}}
			</div> {{-- end col md 12 --}}
		</div>
	</div>	
@endsection