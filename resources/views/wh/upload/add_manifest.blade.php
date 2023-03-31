@extends('layouts.master')

@section('title')
	Upload Data Vessel
@endsection

@section('breadcrumb')
	<a href="{{ route('wh.vessel.index') }}">Vessel</a>
@endsection


@section('content')


<div class="row">		
		<div class="col-xs-11">
			<div class="widget-box widget-color-blue2">
				<div class="widget-header">
					<h4 class="widget-title smaller">Pilih File</h4>				
				</div>

				<div class="widget-body">
					<div class="widget-main no-padding">

							<table class="table table-bordered table-striped">
								@foreach ($dataTemp as $val)
									@php

										DB::table('manifest')->insert([
											'seq'			=>	$val->seq, 
   										'no' 			=> $val->no,
    										'idp' 		=> 0,
    										'term' 		=> $val->term,
    										'kd_inv' 	=> 0,
    										'kd_vsl' 	=> 0,
    										'kd_bill' 	=> $val->kd_bill,
    										'bill_to' 	=> $val->bill_to,
    										'consignee' => 0,
    										'kd_cnee' 	=> $val->kd_cnee,
    										'cnee_name' => $val->cnee_name,
    										'cnee_address' => $val->address,
    										'cnee_npwp' 	=> $val->cnee_npwp,
    										'forwader' 		=> 0,
    										'kd_forwader' => $val->kd_forwader,
    										'forwader_name' => $val->forwader_name,
    										'forwader_address' => $val->forwader_address,
    										'forwader_npwp' 	 => $val->forwader_npwp,
    										'kd_vessel' 	=> $val->kd_vessel,
    										'vessel' 		=> $val->vessel,,
    										'pol' 			=> $val->pol,
    										'container' 	=> $val->container,
    										'seal' 			=> $val->seal,
    										'eta' 			=> $val->eta,
    										'hbl' 			=> $val->hbl,
    										'vls_bl' 		=> $val->vls_bl,
    										'qty' 			=> $val->qty,
    										'sat_qty' 			=> $val->sat_qty,
    										'description' 	=> $val->description,
    										'weight' 		=> $val->weight,
    										'measure' 		=> $val->measure,
    										'min_actual' 	=> $val->min_actual,
    										'min' 			=> $val->min,
    										'username' 		=> $val->username,

										]);
									@endphp
									<tr>
										<td>{{ $val->seq }}</td>
										<td>{{ $val->npwp }}</td>
										<td>{{ $val->pol }}</td>
									</tr>
								@endforeach
							</table>


					</div>
				</div>	
			</div>
		</div>
</div>


@endsection
