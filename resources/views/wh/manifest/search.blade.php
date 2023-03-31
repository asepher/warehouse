@extends('layouts.master')


@section('judul_page')
    Master File
@endsection


@section('content')


	<div class="block block-rounded">

		<div class="block-header block-header-default">
			<h3 class="block-title">Search</h3>						
		</div>		

		<div class="block-content block-content-full">

			<div class="col-sm-6">
				


			    <div class="form-group row">
		            <label class="col-md-3 control-label" >Eta</label>
		            <div class="col-md-9">
		                <input type="text" name="eta" class="form-control" placeholder="yyyy/mm/dd" 
		                value="{{ date_format(now(), 'yy/m/d') }}" id="datepicker-autoclose">
		                @if($errors->has('eta'))
		                    <div class="text-danger">
		                        {{ $errors->first('eta')}}
		                    </div>
		                @endif

		            </div>
		        </div>

			    <div class="form-group row">
		            <label class="col-md-3 control-label" >Eta</label>
		            <div class="col-md-9">
		                <input type="text" name="eta" class="form-control" placeholder="yyyy/mm/dd" 
		                value="{{ date_format(now(), 'yy/m/d') }}" id="datepicker-autoclose">
		                @if($errors->has('eta'))
		                    <div class="text-danger">
		                        {{ $errors->first('eta')}}
		                    </div>
		                @endif

		            </div>
		        </div>







			</div>


		</div>

	</div>


@endsection	