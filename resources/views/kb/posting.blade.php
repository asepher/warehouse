@extends('layouts.master')

@section('content')

	<div class="block block-rounded">

		<div class="block-header block-header-default">
			<h3 class="block-title">Data Kas Bank</h3>
			<span>Data Posting</span>
		</div>	

		<div class="block-content block-content-full">
			<p></p>

		<table class="table table-striped table-sm table-vcenter">
				<thead>			
					<tr>
		               <th class="text-center">#</th>
		               <th class="text-center">Kb</th>
		               <th class="text-center">Tanggal</th>
		               <th class="text-center">Keterangan</th>
		               <th class="text-center">Debet</th>
		               <th class="text-center">Kredit</th>
		               <th class="text-center">jumlah</th>
		           </tr>
				</thead>		
				<tbody>
					
					@if (count($hasil) > 1)

						@php 
							$no=1; $debet=0; $kredit=0;
						@endphp
						@foreach ($hasil as $hs)

							<tr>
								<td class="font-w600 font-size-sm text-center" scope="row">{{ $no++ }}</td>
								<td class="font-w600 font-size-sm">{{ $hs->kd_tr }}</td>
								<td class="font-w600 font-size-sm">{{ $hs->tanggal }}</td>				
								<td class="font-w600 font-size-sm">{{ $hs->keterangan1 . " " . $hs->keterangan2 . " " . $hs->keterangan3 }}</td>

									@if ($hs->tipe == 'Debet')	
										<td class="font-w600 font-size-sm text-right">
											{{ UserHelp::rupiah($hs->jumlah) }}</td>
										<td></td>
										@php
										 	$debet = $hs->jumlah;
										 @endphp  
									@endif

									@if ($hs->tipe == 'Kredit')	
										<td></td>
										<td class="font-w600 font-size-sm text-right">
											{{ UserHelp::rupiah($hs->jumlah) }}</td>
										@php
											$kredit = $hs->jumlah;
										@endphp
									@endif	
										
								<td class="font-w600 font-size-sm text-right">
									{{ UserHelp::rupiah($debet + $kredit) }}
								</td>

							</tr>
							
						@endforeach

					 @else 
		 
						<tr>
							<td colspan="5" class="text-center"> no record</td>
						</tr>

					 @endif	

				</tbody>
			</table>


		</div>

	</div>


@endsection


				