@extends('layouts.master')

@section('content')

				<form class="form-horizontal" role="form" action="/si/summary2" method="post">
				{{ csrf_field() }}

			<div class="form-group row m-b-10">

				<label class="col-sm-2 col-form-label">Services</label>
				<div class="col-sm-6">
					<select name="service" class="form-control">
						<option value="">-- Pilih --</option>
						<option value="IMPORT">IMPORT</option>
						<option value="EXPORT">EXPORT</option>
					</select>
				</div>
				<div class="col-sm-4">
					<button type="submit" class="btn btn-primary btn-sm"> >></button>
				</div>

			</div>			

			</form>


@endsection
