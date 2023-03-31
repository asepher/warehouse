@extends('layouts.app')

@section('title')
	Upload File Execel
@endsection

@section('content')

<div class="container">
	<div class="card">
		<div class="row1">
			<div class="card-header">

				<div class="col-md-12">
					<h4 class="mb-0">Upload File Excel</h4>
				</div>
			</div>
			<div class="card-body">

				<div class="row">
					<div class="col-md-12">
						<strong>Import Manifest</strong>
					</div>
				</div>
				<div class="row">					
			      <form method="post" action="{{ route('wh.manifest.import-excel') }}" enctype="multipart/form-data">
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
							<div class="col-md-6">
								<button type="submit" class="btn btn-sm btn-primary px-5">Import</button>
							</div>								
						</div>
					</form>
				</div>	
				<p></p>
				<div class="row">
					<div class="col-md-10">
						@php
							$no=0;
						@endphp
						<table class="table-sm table-center table-bordered" width="80%">
							<tr class="bg-light">
								<td>#</td>
								<td>No BL</td>
								<td>Tanggal</td>
								<td>Host BL</td>
							</tr>
							@foreach ($tmpwhimp as $tmp)
								<tr>
									<td>{{ $no++ }}</td>
									<td>{{ $tmp->no_master_bl }}</td>
									<td>{{ $tmp->tgl_master_bl }}</td>
									<td>{{ $tmp->no_host_bl }}</td>
								</tr>
							@endforeach
						</table>
					</div>

				</div>

			</div>



		</div>
	</div>

</div>

@endsection	