<table class="table">
										<tr class="bg-light">
											<th>Cnee</th>
											<th>Term</th>
											<th>Measure</th>
											<th>Weight</th>
											<th>Actual</th>
											<th>Min</th>									
										</tr>

										@foreach ($manifest as $man)

										@php
											$cus  = App\Models\Customer::where('kd_cus',$man->consignee)					->first();
										@endphp

										<tr>
											<td>{{ $cus->customer }}</td>
											<td>{{ $man->term }}</td>
											<td>{{ $man->measure }}</td>
											<td>{{ $man->weight }}</td>
											<td>{{ $man->min_actual }}</td>
											<td>{{ $man->min }}</td>
										</tr>


										@endforeach
									</table>



=================
										@if ($cekdn >= 1)
										<span class="badge bg-secondary">Ready</span>
										<a href="{{ route('wh.invoice.pdfdn',[$hd->tipe,$hd->kd_inv]) }}" 
											target="_blank">
											{{ $hd->kd_inv }}
										</a>
									@else
										<span class="badge bg-secondary">No Ready</span>
									@endif




									@php
								$ttotal = 0;
							@endphp

							@foreach ($invdn_header as $dnH)

							 <table class="table table-bordered" id="dynamic-table">
								<tr>
									<td>{{$dnH->cnee_name}}

											@php
												$detail = App\Models\InvDnDetail::where('seq',$dnH->seq)
																									->where('kd_vsl',$dnH->kd_vsl)->get();
												$ptotal = 0;
											@endphp

											<table style="width: 70%;">
												@foreach ($detail as $dtl)
												<tr>
													<td>{{ $dtl->nama_tarif }}</td>
													<td>{{ Helper::Rupiah($dtl->tarif) }}</td>
													<td>{{ $dtl->vol_actual }}</td>
													<td style="width: 20%;text-align: right;">{{ Helper::Rupiah($dtl->jumlah) }}</td>
												</tr>
												@php
													$ptotal = $ptotal+$dtl->jumlah;
												@endphp
												@endforeach
												<tr>
													<td colspan="3">Total</td>
													<td style="text-align: right;">{{ Helper::Rupiah($ptotal) }}</td>
												</tr>
												
											</table>
									</td>
								</tr>
							</table>
								@php
									$ttotal = $ttotal + $ptotal;
								@endphp
								@endforeach
								    @php
								    	$vtot = $ttotal* 0.11;
								    	$grandtot = $ttotal + $vtot;
								    @endphp

								<table class="table table-bordered" style="width: 70%;">
										<tr>
											<td>Total</td>
											<td style="width: 20%;text-align: right;font-weight: bold;">{{ Helper::Rupiah($ttotal) }}</td>
										</tr>
											<td >VAT 11%</td>
											<td style="width: 20%;text-align: right;font-weight: bold;">{{ Helper::Rupiah($vtot) }}</td>
										</tr>
									</tr>
											<td >Grand Total</td>
											<td style="width: 20%;text-align: right;font-weight: bold;">{{ Helper::Rupiah($grandtot) }}</td>
										</tr>
									</table>
									
									@if ($inv)
										@if ($inv->inv_dn == 1 )
										<a href="{{ url('/wh/'.$inv->kd_inv.$inv->tipe.".PDF") }}" target="_blank"
											>Invoice Done</a>								
										@endif								
									@endif
									