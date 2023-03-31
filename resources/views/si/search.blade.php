@extends('layouts.master')


@section('judul_page')
    Search
@endsection


@section('content')


	<div class="block block-rounded">

		<div class="block-header block-header-default">
			<h3 class="block-title">Search</h3>					
		</div>		

		<div class="block-content block-content-full">
			<p></p>

			<div class="row">
				<div class="col-sm-6">

					<form class="form-horizontal" role="form" action="/si/result" method="post">
					{{ csrf_field() }}

						<div class="form-group row">
							<label class="col-sm-3 font-w500 font-size-sm">No. SI</label>
							<div class="col-sm-9">
			                        <input type="text" name="search" class="form-control font-w500 font-size-sm" 
			                         autocomplete="off" placeholder="Entry Vesel name" 
			                        value="{{ old('search') }}"/>
									@if($errors->has('search'))
			                            <div class="text-danger font-w400 font-size-sm">
			                                {{ $errors->first('search')}}
			                            </div>
			                        @endif
							</div>
						</div>		

						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label"></label>
							<div class="col-sm-9">
								<button type="submit" class="btn btn-primary btn-sm">Submit >></button>
							</div>
						</div>									
							
					</form>


				</div>				
			</div>
			<!-- end row -->


		</div>
		<!-- end block contain -->


</div>
	<!-- end ROund -->


	<div class="block block-rounded">

			<div class="block-header block-header-default">
				<h3 class="block-title">Data Shipping Instruction</h3>					
			</div>		

			<div class="block-content block-content-full">
			<p></p>

				<div class="row">
					<div class="col-sm-10">
						

					</div>

				</div>

				<table class="table table-striped table-sm">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Kode</th>
							<th class="text-center">Service</th>
							<th class="text-center">Cnee</th>
							<th class="text-center">x</th>
						</tr>						
					</thead>	
					<tbody>
						@php
							$no = 1;
						@endphp
					@forelse ($hasil as $h)
						<tr>
							<td class="font-w400 font-size-sm">{{ $no++ }} </td>
							<td class="font-w400 font-size-sm">{{ $h->kd_si }} </td>
							<td class="font-w400 font-size-sm">{{ $h->service ."/". $h->service }} </td>
							<td class="font-w400 font-size-sm">{{ $h->cnee }} </td>
							<td class="font-w400 font-size-sm">
  								<div class="col-sm-6 col-xl-4">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-light font-w400 font-size-sm dropdown-toggle" id="dropdown-default-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Dropdown
                                        </button>
                                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-light">
                                            <a class="dropdown-item font-w400 font-size-sm" 
                                            	href="/si/inv/CR/{{ $h->kd_si }}">Credit</a>
                                            <a class="dropdown-item font-w400 font-size-sm" 
                                            	href="/si/inv/CN/{{ $h->kd_si }}">Credit Note</a>
                                        </div>
                                    </div>
                                </div>

							</td>
						</tr>
					@empty
						<tr>
							<td colspan="4"> No Record </td>
						</tr>
					@endforelse
					</tbody>

				</table>



			</div>



</div>
	<!-- end ROund -->





@endsection
