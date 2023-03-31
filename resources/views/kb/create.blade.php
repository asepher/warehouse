@extends('layouts.master')


@section('title')
   KasBank
@endsection

@section('breadcrumb')
   <a href="{{ route('kb.index') }}">Kas Bank</a>
@endsection


@section('content')

	@php
   $tgl=date('Y-m-d'); 
   @endphp

 
 <div class="row">
    <div class="col-sm-11">

         <div class="widget-box widget-color-blue2">
              <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Create</h4>
                  <div class="widget-toolbar">
                     
                  </div>
              </div>
              <div class="widget-body">
                  <div class="widget-main">




                 	<form  method="post" action="{{ route('kb.store') }}" class="form-horizontal">
			    		{{ csrf_field() }}

							    <div class="form-group">
						  			<label class="col-md-2 control-label"><strong>Tanggal</strong></label>
						            <div class="col-md-4">
						                <input type="date" name="tanggal" class="form-control datepicker-input" placeholder="yyyy/mm/dd" 
						                value="{{ $tgl }}" autocomplete="off">
						                @if($errors->has('tanggal'))
						                    <div class="text-danger">
						                        {{ $errors->first('tanggal')}}
						                    </div>
						                @endif    
						            </div>
							    </div>

							    <div class="form-group">
						  			<label class="col-md-2 control-label"><strong>Tipe</strong></label>
						            <div class="col-md-3">
						                <select name="tipe" class="form-control">
						                	<option value="">-- Pilih --</option>
						                	<option value="Debit" 
												@if ( old('tipe') == 'Debet')
						                			selected
						                		@endif
						                	>Debet</option>
						                	<option value="Kredit" selected >Kredit</option>
						                </select>
						                @if($errors->has('tipe'))
						                    <div class="text-danger">
						                        {{ $errors->first('tipe')}}
						                    </div>
						                @endif    

						            </div>
							    </div>

							    <div class="form-group">
						  			<label class="col-md-2 control-label" ><strong>Keterangan</strong></label>
						            <div class="col-md-6">
						            <input type="text" name="keterangan1" id="keterangan" placeholder="Keterangan"
						            class="form-control" value="{{ old('keterangan1') }}" autocomplete="off">
										@if($errors->has('keterangan1'))
						                    <div class="text-danger">
						                        {{ $errors->first('keterangan1')}}
						                    </div>
						                @endif                    
						            </div>
							    </div>

							    <div class="form-group">
						  			<label class="col-md-2 control-label"><strong>Keterangan 2</strong></label>
						            <div class="col-md-6">
										<textarea name="keterangan2" cols="40" rows="4" id="keterangan2" placeholder="Keterangan" 
										class="form-control">{{ old('keterangan2') }}</textarea>
						            </div>
							    </div>



								
							    <div class="form-group">
						  			<label class="col-md-2 control-label"><strong>Lokasi</strong></label>
						            <div class="col-md-3">
						            	<select name="keterangan3" id="" class="form-control">
						            		<option value="">--PILIH--</option>
						            		<option value="GM" selected>Gajah Mada</option>
						            		<option value="GD">Gudang</option>
						            	</select>
						            	@if($errors->has('keterangan3'))
						                    <div class="text-danger">
						                        {{ $errors->first('keterangan3')}}
						                    </div>
							             @endif
						            </div>
							    </div>


							    <div class="form-group">
						  			<label class="col-md-2 control-label"><strong>Jumlah</strong></label>
						            <div class="col-md-3">
						            	<input type="number" name="jumlah" placeholder="Jumlah" class="form-control" 
						            	id="jumlah" autocomplete="off" value="{{ old('jumlah') }}">
						            	 @if($errors->has('jumlah'))
						                    <div class="text-danger">
						                        {{ $errors->first('jumlah')}}
						                    </div>
						                @endif    
						            </div>
							    </div>


							    <div class="form-group">
						  			<label class="col-md-2 control-label" ></label>
						            <div class="col-md-9">
						            	<button type="submit" class="btn btn-primary btn-sm px-5">Submit >> </button>
						            </div>
							    </div>


                  

				    	</form>


				    	
                  </div>
               </div>

            </div>
         </div>





@endsection