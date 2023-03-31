@extends('layouts.app')

@section('content')



	<div class="container">
	
			<div class="card border">

				<div class="card-header py-3">
					<div class="row align-items-center">
			        <div class="col-lg-8">
							<h4 class="mb-0">Preview Invoice</h4>	
							<strong>{{ 'INVOICE '.$hd->no_inv . $hd->tipe}} </strong>							
			        </div>
			        <div class="col-lg-4 d-flex justify-content-end">
			        		
						<form action="{{ route('si.inv.exportpdf') }}" method="post" target="_blank">
							        @csrf
							        <input type="hidden" name="tipe" value="{{ $tipe }}">
							        <input type="hidden" name="si" value="{{ $si }}">
							        <button type="submit" class="btn btn-white btn-sm px-3">Export PDF</button>
							      </form>
			

			        </div>
					</div>
				</div>


					<div class="card-body">

					<div class="row">
						<div class="col-sm-6">

							<table class="table table-sm table-striped" >
								<tr>
									<td style="width: 150px"><strong> Si Ref </strong></td>
									<td> : {{ $si }} </td>
								</tr>
								<tr>
									<td><strong> CNEE </strong></td><td> : {{ $hd->customer->customer }} </td>
								</tr>
								<tr>
									<td><strong> Port of Loading </strong></td><td>: {{ $hd->shipping->pol }}</td>
								</tr>

								<tr>
									<td><strong> Port of Discharge </strong></td><td>: {{ $hd->shipping->pod }}</td>
								</tr>

								<tr>
									<td><strong> Vessel </strong></td><td>: {{ $hd->shipping->vessel }}</td>
								</tr>
								
							</table>

						</div>
						<div class="col-sm-6">

							<table class="table table-sm table-striped">
								<tr>
									<td style="width: 150px"><strong>Tipe</strong></td><td>: {{ $tipe }}</td>
								</tr>	
								<tr>
									<td><strong>BL No</strong></td>
									<td>: {{ $hd->shipping->bl }}</td>
								</tr>
								<tr>
									<td><strong>ETD</strong></td>
									<td>: {{ Tglindo($hd->shipping->etd) }}</td>
								</tr>
								<tr>
									<td><strong>ETA </strong></td>
									<td>: {{ Tglindo($hd->shipping->eta) }}</td>
								</tr>
								<tr>
									<td><strong>Date of Issue </strong></td>
									<td>: {{ Tglindo($hd->shipping->tgl_release) }} </td>
								</tr>
							</table>

						</div>
					</div>
					<p></p>			
					<div class="row">
							<div class="col-sm-12">
								<center>
										<table style="width: 90%;border: 1px solid black">
											<tr style="height: 30px;">
													<td style="width: 25%;border-bottom: 1px solid black">
														<strong>&nbsp; Marks & Number</strong>
													</td>
													<td  style="width: 50%;border-bottom: 1px solid black">
														<strong>Keteragan</strong>
													</td>
													<td style="width: 25%;border-left: 1px solid black;text-align: center;border-bottom: 1px solid black">
														<strong>Jumlah</strong>
													</td>
											</tr>

									

														@php
																	$no = 1;$tot = 0;$jum = 0; $brs = 0;$sisa = 0;
																	$grandtot = 0; $hitppn = 0; $materai = 0;
																	$sum = App\Models\InvSiDetail::where('no_inv', $hd->no_inv)
																				->sum('subtotal');
																	if ($sum > 5000000) {
																			$materai = 10000;
																	}													
															@endphp
											<tr>
													<td rowspan="11" valign="top">														
																	@php
																		echo nl2br($hd->shipping->marking);
																		echo "<p><br>";
																		echo nl2br($hd->shipping->description);
																	@endphp		
													</td>
													@foreach ($detail as $det)
													
												 				@php
		                                $brs += 1;
		                              @endphp

																@if (substr($det->kd_chg,0,2) == 99)
																	<td >
																		@php
																		 //	echo nl2br($det->keterangan) 	
																		 @endphp 
																	</td>
																	<td style="border-left: 1px solid black"></td>
																	</tr>
																@else 

																	<td> {{ $det->keterangan }}</td>
																	<td style="text-align: right; border-left: 1px solid black"> 
																		{{ Rupiah($det->jumlah) }} 
																	&nbsp&nbsp&nbsp</td>
																	</tr>
																@endif
																
																	@php
																		$tot = $tot + $det->jumlah;
																		if ( $det->ppn >= 1)
				                                  {
				                                      $hitppn = ( $det->ppn * $det->jumlah ) / 100 ;
				                                  }                                            
																	@endphp
													
													@endforeach
													
																	@php
		                              //$sisa =  10 -  $brs;
		                              for ($sisa = $brs; $sisa <= 10; $sisa++) {
		                                echo "<td></td><td style='border-left: 1px solid black'>&nbsp</td></tr>";
		                              } 		                            
		                            @endphp 
		                            @php
		                            	$cekNote = App\Models\InvSiDetail::where('no_inv',$hd->no_inv)
                                                                ->where('tipe',$tipe)
                                                                ->where('kd_chg', '9999')
                                                                ->first();
                                                            
		                            @endphp
		                            <tr>
		                            	<td></td>
		                            	<td>
		                            		@php
		                            			if($cekNote) {
		                            				echo nl2br($cekNote->keterangan); 	
		                            			}														
													@endphp 
												</td>
		                            	<td style="border-left: 1px solid black"></td>
		                            </tr>
		                            
											@php
												$grandtot = $tot + $hitppn + $materai;
											@endphp

											<tr>
												<td colspan="2" style="width: 85%; text-align: right; border-top: 1px solid black;"><strong>VAT  &nbsp&nbsp&nbsp </strong></td>
												<td style="text-align: right;  border-top: 1px solid black; border-left: 1px solid black;"> {{ Rupiah($hitppn) }} &nbsp&nbsp&nbsp</td>
											</tr>
											<tr>
												<td colspan="2" style="width: 85%; text-align: right;"><strong>Materai  &nbsp&nbsp&nbsp </strong></td>
												<td style="text-align: right;border-left: 1px solid black; "> {{ Rupiah($materai) }} &nbsp&nbsp&nbsp</td>
											</tr>
										
											<tr>
												<td colspan="2" style="text-align: right;border-right: 1px solid black"><strong>Grand Total  &nbsp&nbsp&nbsp 
												</strong></td>
												<td style="text-align: right; border-right:1px solid black"> {{ Rupiah($grandtot) }} &nbsp&nbsp&nbsp</td>
											</tr>

										</table>
									</center>
							</div>

						</div> <!-- end row -->


				</div>
			</div>	

		</div>
	</div>
	<div class="row">
		<div class="col-md-12 text-center">

	     
		</div>
	</div>

@endsection		