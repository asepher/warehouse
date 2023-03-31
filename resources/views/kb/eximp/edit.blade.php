@extends('layouts.app')

@section('content')

	@php
    	$tgl=$item->tanggal; 
   @endphp

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card border">					
					<div class="card-header bg-primary text-white">
						<div class="row align-items-center">
							<div class="col-md-9">
								<h4 class="mb-0">Edit Data Kasbank</h4>
							</div>
							<div class="col-md-3 text-end">

									<div class="fs-5 ms-auto dropdown">
	                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i>	                            	
	                            </div>
	                              <ul class="dropdown-menu dropdown-menu-end">
	                                <li style="font-size: 14px">

										<form action="{{ route('kb.eximp.delete',[$id]) }}" method="post">						
											@csrf																		
											@method('delete')
											<button type="submit" class="dropdown-item">Delete</button>
										</form>

	                               </li>
	                              </ul>
	                          </div>

								
							</div>			
						</div>				
					</div>


	<div class="card-body">
    @php    
      $cek = App\Models\KbEximp::where('kd_tr',$id)->first();  
      $status = $cek->is_posting;        
    @endphp 
    


    @if ($status == 1)
    	<h5>Data Sudah di posting</h5>
    	@else 
    	
						<form method="post" action="{{ route('kb.eximp.update',$id) }}" class="form-horizontal">
			 			{{ csrf_field() }}
						{{ method_field('PUT') }}

							<div class="row">

								<div class="col-sm-6">
									
								    <div class="mb-3 row">
							  			<label class="col-md-3 col-form-label"><strong>Tanggal</strong></label>
							            <div class="col-md-9">
							                <input type="date" name="tanggal" class="form-control" placeholder="yyyy/mm/dd" 
							                value="{{  $tgl  }}" id="datepicker-autoclose"  autocomplete="off">
							                @if($errors->has('tanggal'))
							                    <div class="text-danger">
							                        {{ $errors->first('tanggal')}}
							                    </div>
							                @endif    
							            </div>
								    </div>

									    


							<div class="mb-3 row">
						  			<label class="col-md-3 col-form-label"><strong>Mata Uang</strong></label>
						            <div class="col-md-9">
						                <select name="matauang" class="form-control">
						                	<option value="">-- Pilih --</option>
						                	<option value="Rp" 
						                		@if ($item->matauang == 'Rp')
								                			selected
								                @endif
						                	>Rp</option>
						                	<option value="Usd"
						                		@if ($item->matauang == 'Usd')
								                			selected
								                @endif
						                	>Usd</option>
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
                                          <option value="{{ $c->kd_cus }}"
                                          	@if ($c->kd_cus == $item->keterangan1)
								                							selected
								                						@endif
                                          	>{{ $c->customer }}</option>
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
													class="form-control">{{ $item->keterangan2 }}</textarea>
												</div>
									    </div>
									    
								
								</div>
								<div class="col-sm-6">
						
									    
						
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
								            <div class="col-md-9">								            	
								            	<input type="text" name="jumlah" placeholder="Jumlah" class="form-control" 
								            	autocomplete="off" value="{{ $item->jumlah }}">

								            	@if($errors->has('jumlah'))
								                    <div class="text-danger">
								                        {{ $errors->first('jumlah')}}
								                    </div>
								                @endif

								            </div>
									    </div>

									    <div class="row">
									    		<label class="col-md-3 col-form-label"></label>
								            <div class="col-md-9">
								            	<button type="submit" class="btn btn-primary btn-sm px-5">Update</button>
								            </div>
									    </div>
								</div>

										
						</div> {{-- end row --}}

						
			
				</form>

    @endif

					</div> {{-- end card body --}}
				</div> {{-- end card header --}}

				
			</div>
		</div> {{-- end row --}}
	</div>
	
@endsection
