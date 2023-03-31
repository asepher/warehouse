
						@foreach ($manifest as $mf)
						
							<table class="table table-sm table-bordered">
								<tr>
									<td>{{ $no++ }}</td>
									<td style='width: 200px'>Invoice </td><td> {{ $mf->kd_inv }}</td>		
									<td>Cnee</td><td> {{ $mf->nmcustomer->customer }}</td>
									<td>Cont</td><td> {{ $mf->container  }}</td>		
								</tr>							
							</table>
							@php
								$sql = DB::table('invwh_detail')->where('kd_inv', $mf->kd_inv )->get();
								echo "<table class='table table-sm table-bordered'>";
								foreach ($sql as $hd) {
	    							echo "
	    								<tr>
	    									<td style='width: 200px'>".$hd->item. 	"</td>
	    									<td style='width: 100px'>".$hd->tarif.	"</td>
	    									<td style='width: 100px'>".$hd->weight.	"</td>
	    									<td style='width: 100px'>Rp. 0</td>
	    								</tr>	    								
	    							 ";	
								}												
								echo "</table>";




							@endphp

						@endforeach
						