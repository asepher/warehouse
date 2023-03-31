@extends('layouts.app')

@section('content')

<div class="container">
	<div class="card">
		<div class="card-header bg-primary text-white ">
			<div class="row align-items-center">
				<h4 class="mb-0">Data Negara</h4>
			</div>			
		</div>
		<div class="card-body">
	

	<div class="row">

				<div class="col-sm-6">

					<form action="{{ route('country.update', [$id]) }}" method="POST">
					{{ csrf_field() }}
					{{ method_field('PUT') }}

						<div class="mb-3 row">
	                        <label class="col-sm-3 col-form-label"><strong>Kode</strong></label>
	                        <div class="col-sm-6">
	                            <input type="text" class="form-control" name="kd_neg" style="background-color: #eff0f8" value="{{ $neg->kd_neg }}" autocomplete="off">
	                            @if($errors->has('kd_neg'))
		                            <div class="text-danger">
		                                {{ $errors->first('kd_neg')}}
		                            </div>
		                        @endif
	                        </div>
	                    </div>
						<div class="mb-3 row">
	                        <label class="col-sm-3 col-form-label"><strong>Negara</strong></label>
	                        <div class="col-sm-9">
	                            <input type="text" class="form-control" name="negara" placeholder="Entry Negara.."
	                            value="{{ $neg->negara }}" autocomplete="off" style="background-color: #eff0f8">
	                            @if($errors->has('negara'))
		                            <div class="text-danger">
		                                {{ $errors->first('negara')}}
		                            </div>
		                        @endif
	                        </div>
	                    </div>
	    				<div class="mb-3 row">
	    					<label class="col-sm-3 col-form-label"></label>
	    					<div class="col-md-9">
							    <button type="submit" class="btn btn-sm btn-primary px-5">Update</button>
	    					</div>
						</div>

					</form>

				</div>
			</div>



		</div>
	</div>	
</div>


		

@endsection