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
	            <h4 class="widget-title">Add New</h4>
	            <div class="widget-toolbar">
	            </div>
	        </div>
	        <div class="widget-body">
	            <div class="widget-main no-padding">




	<div class="row">

				<div class="col-sm-6">
				<p></p>
				<fieldset>
					<form class="form-horizontal" action="{{ route('tarif.store') }}" method="POST">
					{{ csrf_field() }}
					

						<div class="form-group">
	                  <label class="col-sm-3 control-label"><strong>Term</strong></label>
	                  <div class="col-sm-3">
	                  	 <select name="term"  class="form-control">
                                             <option value="">-- PILIH --</option>
                                             <option value="FOB" selected>FOB</option>
                                             <option value="CNF" selected>CNF</option>
                                         </select>

	                      @if($errors->has('term'))
	                        <div class="text-danger">
	                            {{ $errors->first('term')}}
	                        </div>
	                    @endif
	                  </div>
	              </div>



						<div class="form-group">
	                  <label class="col-sm-3 control-label"><strong>Kode</strong></label>
	                  <div class="col-sm-4">
	                      <input type="text" class="form-control" name="kd_tarif" 
	                      	placeholder="Entry Kode.." value="{{ old('kd_tarif') }}"
	                      	autocomplete="off">
	                      @if($errors->has('kd_tarif'))
	                        <div class="text-danger">
	                            {{ $errors->first('kd_tarif')}}
	                        </div>
	                    @endif
	                  </div>
	              </div>

						<div class="form-group">
	                        <label class="col-sm-3 control-label"><strong>Item</strong></label>
	                        <div class="col-sm-5">
	                            <input type="text" class="form-control" name="item" placeholder="Entry Item"
	                            value="{{ old('item') }}" 
	                            autocomplete="off">
	                            @if($errors->has('item'))
		                            <div class="text-danger">
		                                {{ $errors->first('item')}}
		                            </div>
		                        @endif
	                        </div>
	                    </div>

						<div class="form-group">
	                        <label class="col-sm-3 control-label"><strong>Jumlah</strong></label>
	                        <div class="col-sm-3">
	                            <input type="number" class="form-control" name="jumlah" placeholder="Entry Negara.."
	                            value="{{ old('jumlah') }}" 
	                            autocomplete="off">
	                            @if($errors->has('jumlah'))
		                            <div class="text-danger">
		                                {{ $errors->first('jumlah')}}
		                            </div>
		                        @endif
	                        </div>
	                    </div>

						<div class="form-group">
	                        <label class="col-sm-3 control-label"><strong>PPN</strong></label>
	                        <div class="col-sm-3">
	                            <input type="number" class="form-control" name="ppn" placeholder="Entry PPn.."
	                            value="{{ old('ppn') }}" 
	                            autocomplete="off">
	                            @if($errors->has('ppn'))
		                            <div class="text-danger">
		                                {{ $errors->first('ppn')}}
		                            </div>
		                        @endif
	                        </div>
	                    </div>

	    				<div class="form-group">			
	    						<label class="col-sm-3"></label>
	    							<div class="col-sm-9">
	    									<button type="submit" class="btn btn-sm btn-primary px-5">Save</button>				
	    							</div>
						</div>


					</fieldset>
					</form>

				</div>
				<div class="col-sm-6">

					<table class="table align-middle" id="example123">
						<thead class="bg-light">
							<th>#</th>
							<th>Term</th>
							<th>Kode</th>
							<th>Item</th>
							<th>Jumlah</th>
							<th class="text-center" style="width: 5px;">x</th>
						</thead>
						<tbody>
							@php
								$no=1;
							@endphp
							@forelse ($tarif as $trf)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $trf->term }}</td>
								<td>{{ $trf->kd_tarif }}</td>
								<td>{{ $trf->nama_tarif }}</td>
								<td>{{ Helper::Rupiah($trf->jumlah) }}</td>
							 	<td class="text-center">

			               <div>
			                      <div class="inline position-relative">
			                          <a href="#" data-toggle="dropdown" class="dropdown-toggle">
			                              <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
			                          </a>

			                          <ul class="dropdown-menu dropdown-lighter dropdown-menu-right dropdown-100">
			                              <li>
			                                 <a  href="{{ route('tarif.edit',[$trf->id]) }}" >Edit</a>
			                              </li> 
			                              <li>
			                                 <a  href="{{ route('tarif.delete',[$trf->id]) }}"
			                                 onclick="event.preventDefault();
			                                         document.getElementById('delete-row').submit();"
			                                 >Delete</a>

			                              <form id="delete-row" action="{{ route('tarif.delete',[$trf->id]) }}" 
			                                 method="POST">
			                                 {{ csrf_field() }}
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