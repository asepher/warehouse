@extends('layouts.master')

@section('title')
	Upload Data Vessel
@endsection

@section('breadcrumb')
	<a href="{{ route('wh.vessel.index') }}">Vessel</a>
@endsection


@section('content')



	<div class="page-header">
		<h1>Upload Page</h1>
	</div>


<div class="row">		
		<div class="col-xs-11">
			<div class="widget-box widget-color-blue2">
				<div class="widget-header">
					<h4 class="widget-title smaller">Pilih File - {{ $vsl}}</h4>				
				</div>

				<div class="widget-body">
					<div class="widget-main">



			      <form method="post" action="{{ route('wh.upload.store',[$vsl]) }}" enctype="multipart/form-data">
			      {{ csrf_field() }}
						<div class="row">
							<div class="col-md-6">
								<input type="file" name="file" class="form-control" id="full-name" required>	
								@if ($errors->has('file'))
			      			  	<span class="alert-primary" >
									{{ $errors->first('file') }}
									</span>
								@endif
							</div>
							<div class="col-md-3">
								<button type="submit" class="btn btn-sm btn-primary px-5">Import</button>
							</div>								
						</div>
					</form>

					



					</div>
				</div>
			</div>
		</div>
</div>


@endsection