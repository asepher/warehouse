@extends('layouts.master')

@section('title')
   Tarif
@endsection

@section('breadcrumb')
   <a href="{{ route('tarif.index') }}">Charge</a>
@endsection


@section('content')





   <!-- /.page-header -->
   <div class="page-header">
      <h1>Data Tarif Warehouse</h1>
   </div><!-- /.page-header -->



 <div class="row">
    <div class="col-sm-11">
       <div class="widget-box widget-color-blue2">
	        <div class="widget-header widget-header-flat">
	            <h4 class="widget-title">Edit Data Tarif</h4>
	            <div class="widget-toolbar">
	            </div>
	        </div>
	        <div class="widget-body">
	            <div class="widget-main no-padding">

							<form class="form-horizontal" action="{{ route('tarif.update') }}" method="POST">
							{{ csrf_field() }}					
							<input type="hidden" name="id" value="{{$id}}">
							<fieldset>

								<div class="form-group">
			                  <label class="col-sm-2 col-form-label control-label"><strong>Term</strong></label>
			                  <div class="col-sm-3">
			                  	 <select name="term"  class="form-control">
		                             <option value="">-- PILIH --</option>
		                             <option value="FOB"
		                             @if ($tarif->term == 'FOB')
		                             		selected
		                             @endif
		                             >FOB</option>
		                             <option value="CNF" 
		                             @if ($tarif->term == 'CNF')
		                             		selected
		                             @endif
		                             >CNF</option>
		                         </select>

			                      @if($errors->has('term'))
			                        <div class="text-danger">
			                            {{ $errors->first('term')}}
			                        </div>
			                    @endif
			                  </div>
			              </div>



								<div class="form-group">
			                  <label class="col-sm-2 col-form-label control-label"><strong>Kode</strong></label>
			                  <div class="col-sm-3">
			                      <input type="text" class="form-control" name="kd_tarif" 
			                      	placeholder="Entry Kode.." value="{{ $tarif->kd_tarif }}"
			                      	autocomplete="off">
			                      @if($errors->has('kd_tarif'))
			                        <div class="text-danger">
			                            {{ $errors->first('kd_tarif')}}
			                        </div>
			                    @endif
			                  </div>
			              </div>

								<div class="form-group">
			                        <label class="col-sm-2 control-label"><strong>Item</strong></label>
			                        <div class="col-sm-5">
			                            <input type="text" class="form-control" name="item" placeholder="Entry Item"
			                            value="{{ $tarif->nama_tarif }}" autocomplete="off">
			                            @if($errors->has('item'))
				                            <div class="text-danger">
				                                {{ $errors->first('item')}}
				                            </div>
				                        @endif
			                        </div>
			                    </div>

								<div class="form-group">
			                        <label class="col-sm-2 control-label"><strong>Jumlah</strong></label>
			                        <div class="col-sm-2">
			                            <input type="number" class="form-control" name="jumlah" placeholder="Entry Negara.."value="{{ $tarif->jumlah }}" autocomplete="off">
			                            @if($errors->has('jumlah'))
				                            <div class="text-danger">
				                                {{ $errors->first('jumlah')}}
				                            </div>
				                        @endif
			                        </div>
			                    </div>

								<div class="form-group">
			                        <label class="col-sm-2 control-label"><strong>PPN</strong></label>
			                        <div class="col-sm-2">
			                            <input type="number" class="form-control" name="ppn" placeholder="Entry PPn.."
			                            value="{{ $tarif->ppn }}"
			                            autocomplete="off">
			                            @if($errors->has('ppn'))
				                            <div class="text-danger">
				                                {{ $errors->first('ppn')}}
				                            </div>
				                        @endif
			                        </div>
			                    </div>

			    				<div class="form-group">			
			    						<label class="col-sm-2"></label>
			    							<div class="col-sm-9">
			    									<button type="submit" class="btn btn-sm btn-primary px-5">Update</button>				
			    							</div>
								</div>


						</fieldset>
					</form>







	            </div>
	         </div>
	      </div>

	   </div>
	</div>



@endsection