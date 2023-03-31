@extends('layouts.master')

@section('judul_page')
	SOA
@endsection

@section('content')
	<div class="card">
		<div class="card-body">

			<div class="row">
				<div class="col-md-6">
					<h3>Statment Of Account</h3>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<h4>{{ $cus->customer }}</h4>

					<table class="table table-sm table-hover" >
						<tr>
							<th>Tanggal</th>
							<th>SI</th>
							<th>Inv</th>
							<th>Debet</th>
							<th>Kredit</th>
							<th>Paid</th>
							<th>Tanggal</th>
						</tr>

						@foreach ($invHd as $inv)						
							<tr>
								<td></td>
								<td>{{$inv->no_inv}}</td>
								<td>{{$inv->kd_si.$inv->tipe}}</td>
								<td>{{UserHelp::rupiah($inv->grandtotal)}}</td>
								<td>{{UserHelp::rupiah($inv->grandtotal)}}</td>
								<td>paid</td>
								<td>02/02/21</td>
							</tr>
						@endforeach
					</table>


				</div>
			</div>

		</div>
	</div>
@endsection