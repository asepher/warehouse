@extends('layouts.master')

@section('judul_page')
	View Manifest
@endsection

@section('content')

	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<h4>Invoice DN</h4>					
				</div>
			</div>

			@php
				$manifest 	= DB::table('manifest')->where('term', 'FOB')
								->where('container', $container)->count(); 

				$weight 	= DB::table('manifest')->where('term', 'FOB')							
								->where('container', $container)
								->sum('weight');

				$measure 	= DB::table('manifest')->where('term', 'FOB')
								->where('container', $container)
								->sum('measure');

				$totAktual	= DB::table('manifest')->where('term', 'FOB')
								->where('container', $container)
								->sum('measure'); 
				$hitInv		= DB::table('invwh_header')->where('term', 'FOB')
								->where('container', $container)->count();
			@endphp
		

			<div class="row">				
				<div class="col-md-12">			

					<table class="table table-sm">
						<tr>
							<td  class="text-center" > <h4>DEBET NOTE </h4></td>
							<td> No. </td>
						</tr>
					</table>
				</div>
			</div>

			<div class="row">
				
					@if ($manifest)


						<div class="col-sm-10">

								<table class="table table-sm">
									<tr>
										<td style='width: 150px'><strong> HBL</strong></td>
										<td style='width: 250px'><strong>:</strong> </td>
										<td style='width: 150px'><strong>Qty</strong></td>
										<td>: {{ $totAktual }}</td>
									</tr>
									<tr>
										<td><strong>BL</strong></td><td colspan="3">: {{ $vessel->vls_bl }}</td>
									<tr>
										<td><strong>Container</strong></td><td colspan="3">: {{ $container }}</td>
									</tr>
									<tr>
										<td><strong>Vessel</strong></td><td colspan="3">: {{ $vessel->vessel }}</td>
									</tr>
									<tr>
										<td><strong>ETA</strong></td><td colspan="3">: {{ $vessel->eta }}</td>
									</tr>
									<tr>
										
									</tr>
									<tr>
										<td>Remark</td><td></td>
									</tr>
								</table>
								@php
									$no = 1;
									$subtotal = 0;
								@endphp

									<table class="table table-sm table-bordered">
										<tr>
											<td class="text-center" style='width: 5px'>#</td>
											<td class="text-center" style='width: 200px'><strong>Description</strong></td>
											<td class="text-center" style='width: 100px'><strong>Tarif</strong></td>
											<td class="text-center" style='width: 100px'><strong>W/M</strong></td>
											<td class="text-center" style='width: 100px'><strong>Total</strong></td>
										</tr>



										@if ($manifest > 0)
											
											@foreach ($tarif as $trf)
												<tr>
													<td>{{ $no++ }}</td>
													<td>{{ $trf->item }} </td>
													<td class="text-right">
														{{ UserHelp::rupiah($trf->tarif) }} </td>										
													<td class="text-right">
														@if ($trf->kd_item == 'T0007')
															{{ $manifest }}
															@php
																$total = $trf->tarif * $manifest;
															@endphp
														@else
															{{ $measure }}	
															@php
																$total = $trf->tarif *  $measure;				
															@endphp
														@endif													
													</td>
													<td class="text-right">
														{{ UserHelp::rupiah($total) }}</td>
												</tr>
												@php
													
													$subtotal = $subtotal + $total;
													$ppn =	$subtotal * 0.1;
													$materai = 6000;

												@endphp
											@endforeach
											<tr>
												<td colspan="4" class="text-right">
													<strong>Subtotal</strong></td>
													<td class="text-right">{{  UserHelp::rupiah($subtotal) }}</td>
											</tr>
											<tr>
												<td colspan="4" class="text-right">
													<strong>PPN VAT</strong></td>
													<td class="text-right">{{ UserHelp::rupiah($ppn) }} </td>
											</tr>
											<tr>
												<td colspan="4" class="text-right">
													<strong>Materai</strong></td>
													<td class="text-right">{{ UserHelp::rupiah($materai) }}</td>
											</tr>
											<tr>
												<td colspan="4" class="text-right">
													<strong>Grand Total</strong></td>
													<td class="text-right">{{ UserHelp::rupiah($subtotal+$ppn+$materai) }}</td>
											</tr>

										@else
											<tr>
												<td colspan="5" class="text-center"><h5>No Record</h5></td>
											</tr>
										@endif	


									</table>


									<hr>


									<form action="/wh/invoice/dnpdf/{{ $id }}" method="POST">
				                    	@csrf 
		        	            	<input type="hidden" name="container" value="{{ $container }}">

									<table>
										<tr>
											<td>Tanggal </td>
											<td>
												 <input type="text" name="tanggal" 
													 class="form-control input-sm datepicker-input"
													 value="{{ date_format(now(), 'Y/m/d') }}">	
											</td>
											<td>
												
												 <button type="submit" class="btn btn-primary btn-sm"

												 @if ( $hitInv >= 1 )				
														Disabled 			 	 
												 @endif

												 >{{ $hitInv }} Generate >></button>

											</td>

										</tr>
									</table>

									</form>


							

						</div> <!-- col-10 -->


						
				


					@else 
						No Record		
					@endif

			</div>




			</div>

		</div>


	</div>



@endsection
