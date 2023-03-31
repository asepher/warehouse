
		<div class="row">		
				<div class="col-xs-11">
					<div class="widget-box widget-color-blue2">
						<div class="widget-header">
							<h4 class="widget-title smaller">Container {{ $cont }}</h4>		

									<div class="widget-toolbar">
											@php				
												//$query 	= DB::table('manifest')->where('kd_vsl', $vsl)->count();
												$cek = App\Models\Harian::where('id',0)->count();  
											@endphp
					   					<div class="btn-group">
												<button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
													Action
													<span class="ace-icon fa fa-caret-down icon-on-right"></span>
												</button>
												<ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
													<li>
														<a href="{{ route('wh.invoice.generate-vessel.view',[$vsl]) }}"
															onclick="event.preventDefault();
		                                       document.getElementById('view-form1').submit();" 
		                                          @if ($cek >= 1)
		                                             disabled 
		                                          @endif
														>View PDF</a>

													 <form id="view-form1" 
		                                       action="{{ route('wh.invoice.generate-vessel.view',[$vsl]) }}" 
		                                       method="POST">
		                                       {{ csrf_field() }}
		                                          <input type="hidden" name="container" value="{{ $cont}}">
		                                       </form>
		 

													</li>													
												</ul>
											</div><!-- /.btn-group -->
										</div>


						</div>

						<div class="widget-body">
							<div class="widget-main">

									@foreach ($invdn_header as $dnH)
										<table class="table table-bordered">
											<tr>
												<td><strong>{{ 'seq ' .$dnH->seq . ' - ' . $dnH->cnee_name }} </strong><br>
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
															<td style="width: 20%;">{{ Helper::Rupiah($dtl->jumlah) }}</td>
														</tr>
														@php
															$ptotal = $ptotal+$dtl->jumlah;
														@endphp
														@endforeach
														<tr>
															<td colspan="3">Total</td>
															<td>{{ Helper::Rupiah($ptotal) }}</td>
														</tr>
														
													</table>
												</td>
											</tr>

										</table>
										
									@endforeach

							</div>
						</div>
					</div>
				</div>
		</div>


<li>
                                    <a  href="{{ route('wh.generate.invoicedn',[$vsl]) }}"
                                    		onclick="event.preventDefault();
                                       	document.getElementById('gen-form').submit();" 
                                          
                                          >Generate by Cntr</a>

                                          <form id="gen-form" 
                                          action="{{ route('wh.generate.invoicedn',[$vsl]) }}" 
                                          method="POST">
                                          {{ csrf_field() }}                                            
                                          </form>


                                  </li>  		





	<div class="row">
		<div class="col-xs-11">
			<div class="widget-box widget-color-blue2">
				<div class="widget-header">

					<h5 class="widget-title smaller">Detail </h5>
						<div class="widget-toolbar">
						@php				
							$query 	= DB::table('manifest')->where('kd_vsl', $vsl)->count();
						@endphp
   					<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
								Action
								<span class="ace-icon fa fa-caret-down icon-on-right"></span>
							</button>
							<ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
								<li>
									<a href="{{ route('wh.manifest.create', [$vsl]) }}"
									@if ($query >= $vessel->jum_pos)
											class="disabled-link" style="color: red;" 
									@endif
									>Create
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="{{ route('wh.upload.vessel',[$vsl]) }}">Upload</a>
								</li>	
										<li>
									<a href="{{ route('wh.generate.invoicedn',[$vsl]) }}">Generate </a>
								</li>	
																		
							</ul>
						</div><!-- /.btn-group -->
	                     

						   </div>


				</div>
				<div class="widget-body">
					<div class="widget-main no-padding">
								
								<table class="table table-bordered table-striped">
									<tr>
											<th class="text-center">#</th>
											<th class="text-center" width="250px">Consignee</th>
											<th class="text-center">Term</th>
											<th class="text-center">Cont</th>
											<th class="text-center">Seal</th>				
											<th class="text-center">HB/L</th>
											
											<th class="text-center" width="5px">Inv</th>						
											<th class="text-center" width="5px">Memo</th>						
									
											<th class="text-center" width="5px">x</th>								
									</tr>						
								
									@php
										$no = 1;										
									@endphp

									@forelse ($manifest as $man)
										<tr>						
											<td class="text-center" scope="row">{{ $no++  }}</td>					
											<td>{{ $man->cnee_name  }}</td>	
											<td>{{ $man->term  }}</td>	
											<td>{{ $man->container }}</td>
											<td>{{ $man->seal }}</td>
											<td>{{ $man->hbl }}</td>
											<td>
												@if ($man->gen_inv == 1)
													<a href="{{ url('/wh/'.$man->kd_inv.$man->file_inv.'.PDF') }}" target="_blank">
														<span class="badge badge-primary">Done</span>									
													</a>
												@endif

											</td>
											<td>
												@if ($man->gen_memo == 1)
													<a href="{{ url('/wh/'.$man->kd_inv.$man->file_mem.'.PDF') }}" target="_blank">
														<span class="badge badge-secondary">Done</span>							
													</a>
												@endif
											</td>
										
											<td class="text-center">
		 											

											<div>
												<div class="inline position-relative">
													<a href="#" data-toggle="dropdown" class="dropdown-toggle">
														<i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
													</a>

													<ul class="dropdown-menu dropdown-default dropdown-menu-right">
														<li>
															<a class="dropdown-item" 
											        		href="{{ route('wh.manifest.edit',[$man->id]) }}"
											        		@if ($man->is_posting == 1)
											            	style="pointer-events: none;" 
											         		@endif
											         		>Edit</a>
														</li>													
														<li>
															<a class="dropdown-item" 
															href="{{route('wh.manifest.show',[$man->kd_inv])}}">
												      	View</a>
												     </li>
														
														<li class="divider"></li>
														<li style="font-size:14px">
															<a class="dropdown-item" 
															href="{{route('wh.invoice.view',[$man->kd_inv])}}">
												      	Invoice</a>
												     </li>
												     <li style="font-size:14px"><a class="dropdown-item" href="{{ route('wh.memo.view', [$man->kd_inv]) }}">
												      	Memo</a>
												     </li>
													</ul>
												</div>
											</div>



												</td>
											</tr>

									@empty
										<tr>
											<td colspan="9">
												<center>No Record</center>
											</td>
										</tr>
									@endforelse

							
							</table>







					</div>
				</div>
			</div>
		</div>
	</div>


<div class="row">
								<div class="col-sm-12">
									<div class="col-sm-6">
											<table class="table">
												<tr>
													<td style="width: 100px"><strong>Vessel</strong></td>
													<td>: {{ $vsl }} - {{ $vessel }}</td>
												</tr>
												<tr>
													<td><strong>ETA</strong></td><td>: {{ date("d-m-Y",strtotime($vessel->eta)) }}</td>
												</tr>
											</table>
									</div>
									<div class="col-sm-6">
											<table class="table">
												<tr>
													<td style="width: 100px"><strong>VLS BL</strong></td><td>: {{ $vessel->vls_bl }} </td>
												</tr>
												<tr>
													<td><strong>Jumlah Pos</strong></td><td>: {{ $vessel->jum_pos }} </td>
												</tr>
											</table>
									</div>

								</div>							
							</div>


		<table class="table table-bordered">
											<tr>
												<td><strong>{{ 'seq ' .$dnH->seq . ' - ' . $dnH->cnee_name }} </strong><br>
													@php
														$detail = App\Models\InvDnDetail::where('kd_vsl',$dnH->kd_vsl)->get();
														$ptotal = 0;
													@endphp
													<table style="width: 70%;">
														@foreach ($detail as $dtl)
														<tr>
															<td>{{ $dtl->nama_tarif }}</td>
															<td>{{ Helper::Rupiah($dtl->tarif) }}</td>
															<td>{{ $dtl->vol_actual }}</td>
															<td style="width: 20%;">{{ Helper::Rupiah($dtl->jumlah) }}</td>
														</tr>
														@php
															$ptotal = $ptotal+$dtl->jumlah;
														@endphp
														@endforeach
														<tr>
															<td colspan="3">Total</td>
															<td>{{ Helper::Rupiah($ptotal) }}</td>
														</tr>
														
													</table>
												</td>
											</tr>

										</table>
										

										PT VARUNA LINTAS SARANA LOGISTIK
										HAYAM WURUK PLAZA TOWER LT.6 J-K, JAKARTA BARAT
										210073987032000
										

	<table width="90%">		
		<tr>
			<th id="Judul">#</th>
			<th id="Judul"><strong>Description</strong></th>
			<th id="Judul"><strong>Tarif</strong></th>
			<th id="Judul"><strong>W/M</strong></th>
			<th id="Judul"><strong>Total</strong></th>
		</tr>
	
	
				@foreach ($tarif as $trf)				
					<tr>
						<td id="Item" style="text-align:center">{{ $no++ }}</td>
						<td id="Item" >{{ $trf->nama_tarif }} </td>
						<td id="Item" style="text-align:right">{{ Helper::Rupiah($trf->jumlah) }} </td>
						@if ($trf->is_adm == 1)
							<td id="Item" style="text-align:center">
								@php
									$measure = $totAdm;
								@endphp
								{{ $measure }}
							</td>
						@else
							<td id="Item" style="text-align:center">
								@php
									$measure = $jumlah;
								@endphp
								{{ $measure }}
							</td>										
						@endif
						@php
							$total = $trf->jumlah * $measure;
						@endphp
						<td id="Item" style="text-align:right;border-left: 0.1px solid;">
							{{ Helper::Rupiah($total) }}
						</td>
					</tr>
					@php
						$subTotal = $subTotal + $total;
					@endphp
				@endforeach
				@for ($i = $no; $i < $jumbrs ; $i++)
					<tr>
						<td id="Item">&nbsp;</td>
						<td id="Item"></td>
						<td id="Item"></td>
						<td id="Item"></td>
						<td id="Item"></td>
					</tr>
				@endfor
				@php
					$ppn = $subTotal * 0.1;
					$grandTotal = $subTotal + $ppn;
					if ($grandTotal >= 5000000){
							$materai = 10000;
					}
				@endphp
				<tr>
					<td colspan="4" id="Total" >Subtototal</td>
					<td id="TotalValue" style="border-right: 0.1px solid;">{{ Helper::Rupiah($subTotal) }}</td>
				</tr>
				<tr>
					<td colspan="4" id="Total">PPN</td>
					<td id="TotalValue" style="border-right: 0.1px solid;">{{ Helper::Rupiah($ppn) }}</td>
				</tr>

				@if ($grandTotal >= 5000000)
					<tr>
						<td colspan="4" id="Total">Materai</td>
						<td id="TotalValue" style="border-right: 0.1px solid;">{{ Helper::Rupiah($materai) }}</td>
					</tr>
				@endif

				<tr>
					<td colspan="4" id="Total" style="font-size: 14px;font-weight:bold;">
						Grand Total </td>
					<td id="TotalValue" style="font-size: 14px;font-weight:bold; border-right: 0.1px solid;">
						{{ Helper::Rupiah($subTotal) }}</td>
				</tr>

		</table>

	<table width="90%">		
		<tr>
			<th id="Judul">#</th>
			<th id="Judul"><strong>Description</strong></th>
			<th id="Judul"><strong>Tarif</strong></th>
			<th id="Judul"><strong>W/M</strong></th>
			<th id="Judul"><strong>Total</strong></th>
		</tr>
	
				@foreach ($tarif as $trf)				
					<tr>
						<td id="Item" style="text-align:center">{{ $no++ }}</td>
						<td id="Item" >{{ $trf->nama_tarif }} </td>
						<td id="Item" style="text-align:right">{{ Helper::Rupiah($trf->jumlah) }} </td>
						@if ($trf->is_adm == 1)
							<td id="Item" style="text-align:center">
								@php
									$measure = $totAdm;
								@endphp
								{{ $measure }}
							</td>
						@else
							<td id="Item" style="text-align:center">
								@php
									$measure = $jumlah;
								@endphp
								{{ $measure }}
							</td>										
						@endif
						@php
							$total = $trf->jumlah * $measure;
						@endphp
						<td id="Item" style="text-align:right;border-left: 0.1px solid;">
							{{ Helper::Rupiah($total) }}
						</td>
					</tr>
					@php
						$subTotal = $subTotal + $total;
					@endphp
				@endforeach
				@for ($i = $no; $i < $jumbrs ; $i++)
					<tr>
						<td id="Item">&nbsp;</td>
						<td id="Item"></td>
						<td id="Item"></td>
						<td id="Item"></td>
						<td id="Item"></td>
					</tr>
				@endfor
				@php
					$ppn = $subTotal * 0.1;
					$grandTotal = $subTotal + $ppn;
					if ($grandTotal >= 5000000){
							$materai = 10000;
					}
				@endphp
				<tr>
					<td colspan="4" id="Total" >Subtototal</td>
					<td id="TotalValue" style="border-right: 0.1px solid;">{{ Helper::Rupiah($subTotal) }}</td>
				</tr>
				<tr>
					<td colspan="4" id="Total">PPN</td>
					<td id="TotalValue" style="border-right: 0.1px solid;">{{ Helper::Rupiah($ppn) }}</td>
				</tr>

				@if ($grandTotal >= 5000000)
					<tr>
						<td colspan="4" id="Total">Materai</td>
						<td id="TotalValue" style="border-right: 0.1px solid;">{{ Rupiah($materai) }}</td>
					</tr>
				@endif

				<tr>
					<td colspan="4" id="Total" style="font-size: 14px;font-weight:bold;">
						Grand Total </td>
					<td id="TotalValue" style="font-size: 14px;font-weight:bold; border-right: 0.1px solid;">
						{{ Helper::Rupiah($subTotal) }}</td>
				</tr>

		</table>