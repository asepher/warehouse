@extends('layouts.master')


@section('judul_page')
    Master File
@endsection


@section('content')


	<div class="block block-rounded">

		<div class="block-header block-header-default">
			<h3 class="block-title">Data Shipping Instruction</h3>			
			<a href="{{ route('si.create') }}/si/create" class="btn btn-success btn-sm">Add New</a>
		</div>		

		<div class="block-content block-content-full">
			<p></p>


			<div class="row">
				<div class="col-sm-6">

					<div class="form-group row">
						<label for="" class="col-sm-3 font-w500 font-size-sm">Seach</label>
						<div class="col-sm-9">
		                        <input type="text" name="vessel" class="form-control font-w500 font-size-sm" 
		                         autocomplete="off" placeholder="Entry Vesel name" 
		                        value="{{ old('vessel') }}"/>
								@if($errors->has('vessel'))
		                            <div class="text-danger font-w400 font-size-sm">
		                                {{ $errors->first('vessel')}}
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
						
					


				</div>
			</div>


		</div>

	</div>

@endsection