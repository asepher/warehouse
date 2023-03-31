@extends('layouts.master')

@section('judul_page')
	View Manifest
@endsection

@section('content')
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-4">
					<h4>Data Veessel</h4>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">

				<table class="table table-sm" id="data-table">
							<thead>
								<tr class="bg-light">
									<th class="text-center"> Kode </th>
									<th class="text-center"> ETA </th>
									<th class="text-center">  Vessel </th>
									<th class="text-center"> Container </th>								
									<th class="text-center"> Pos </th>								
									<th class="text-center"> BL </th>								
									<th class="text-center"> FOB </th>								
									<th class="text-center"> CNF </th>								
								</tr>
							</thead>
							<tbody>
								@foreach ($vessel as $v)
									<tr>
										<td>{{ $v->kd_vsl }}</td>
										<td>{{ $v->eta }}</td>
										<td>{{ $v->vessel }}</td>
										<td>{{ $v->container }}</td>
										<td>{{ $v->jum_pos }}</td>
										<td>{{ $v->vls_bl }}</td>
										<td>
											@php
											  $fob = App\Manifest::where('kd_vsl',$v->kd_vsl)
											  				->where('term','FOB')
											  				->count();		
											@endphp	
											{{ $fob }}
										</td>
										<td>
											@php
											  $cnf = App\Manifest::where('kd_vsl',$v->kd_vsl)
											  				->where('term','CNF')
											  				->count();		
											@endphp	
											{{ $cnf }}</td>
									</tr>
								@endforeach
							</tbody>
				</table>

					
				</div>

			</div>
		</div>
	</div>


@endsection


