@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row11">
		<div class="card border">

			<div class="card-header py-2 bg-primary text-white">
				
				<div class="row align-items-center">
					<div class="col-sm-10">
						<h4 class="mb-0">Surat Jalan</h4>						
					</div>
					<div class="col-sm-2">
						<a href="{{ route('sj.create') }}" class="btn btn-sm btn-white px-3">Add New</a>	
					</div>
				</div>
			</div>


			<div class="card-body">


 <ul class="nav nav-pills mb-3" role="tablist">
                           <li class="nav-item" role="presentation">
                              <a class="nav-link active" data-bs-toggle="tab" href="#dangerhome" role="tab" aria-selected="true">
                                 <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Home</div>
                                 </div>
                              </a>
                           </li>
                           <li class="nav-item" role="presentation">
                              <a class="nav-link" data-bs-toggle="tab" href="#dangerprofile" role="tab" aria-selected="false">
                                 <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Status</div>
                                 </div>
                              </a>
                           </li>                           
                        </ul>


                          <div class="tab-content py-3">
                           <div class="tab-pane fade show active" id="dangerhome" role="tabpanel">

<div class="table-responsive123">	

					         <table class="table align-middle" id="11example">
					                <thead class="bg-light">
					                    <tr>
					                        <th class="text-center">#</th>
					                        <th class="text-center">Kode</th>
					                        <th class="text-center">Tanggal</th>
					                        <th class="text-center">Customer</th>
					                        <th class="text-center">Penerima</th>
					                        <th class="text-center">Keterangan</th>
					                        <th class="text-center" width="5">x</th>		                        
					                    </tr>
					                </thead>
									<tbody>
										@php
											$no=1;
										@endphp
									@forelse ($header as $hd)
										<tr>
											<td class="text-center" scope="row">{{ $no++ }}</td>
											<td>{{ $hd->kd_sj }}
											</td>
											<td>{{ TglIndo($hd->tanggal) }}</td>
											<td>{{ $hd->Customer->customer }}</td>
											<td>{{ $hd->penerima }}</td>
											<td>{{ $hd->keterangan1 . " " . $hd->keterangan2 . " " . $hd->keterangan3 }}</td>
										
											<td>

			   <div class="fs-5 dropdown">
			                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown" style="font-size: 12px">
			                            	<i class="bi bi-three-dots"></i></div>

			                              <ul class="dropdown-menu dropdown-menu-end">
			                                <li style="font-size: 14px"><a class="dropdown-item" href="{{ route('sj.edit',[$hd->kd_sj]) }}"
			                                @if ($hd->is_posting == 1)
			                                    style="pointer-events: none;" 
			                                 @endif
			                                 >Edit</a>
			                               </li> 
			                               <li><hr class="dropdown-divider"></li>			                               
			                               <li style="font-size: 14px"><a class="dropdown-item" href="{{ route('sj.detail',[$hd->kd_sj]) }}">Detail</a>
			                               </li>  

			                               
			                               
			                               
			                              </ul>
			                          </div>
			           					

											</td>

										</tr>
									@empty
										<tr>
											<td colspan="7" style="text-align: center;">
												No Record
											</td>
										</tr>
									@endforelse
										

									</tbody>
					            </table>
					          
						</div>
					            


    						</div>
                           <div class="tab-pane fade" id="dangerprofile" role="tabpanel">

<div class="table-responsive123">

	<table class="table align-middle" id="example">
					                <thead class="table-secondary">
					                    <tr>					                 
					                        <th class="text-center">Kode</th>
					                        <th class="text-center">Customer</th>
					                        <th class="text-center">Penerima</th>
					                        <th class="text-center">Keterangan</th>
					                        <th class="text-center">Status</th>		                        
					                        <th>x</th>
					                    </tr>
					                </thead>
									<tbody>
										@php
											$nom=1;
										@endphp
									@foreach ($status as $st)
										<tr>
											<td style="width:10%">{{ $st->kd_sj }} <br> 
												{{ TglIndo($st->tanggal) }}</td>
											<td>{{ $st->Customer->customer }}</td>
											<td>{{ $st->penerima }}</td>
											<td>{{ $st->keterangan1 . " " . $st->keterangan2 . " " . 
												$st->keterangan3 }}</td>
											<td style="width:5%">
  										@if ($st->is_posting == 1)
                                 <span class="badge bg-light-success text-success">posting</span>
                              @endif
											</td>
											<td style="width:2%">
												
											<div class="fs-5 dropdown">
			                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown" style="font-size: 12px">
			                            	<i class="bi bi-three-dots"></i></div>

			                              <ul class="dropdown-menu dropdown-menu-end">
			                                <li style="font-size: 14px"><a class="dropdown-item" 
			                                	href="">View</a>
			                               </li>
			                            </ul>
			                          </div>


											</td>


										</tr>
									@endforeach

                           </div>
                        </div>


                       </tbody>
                    </table>

                 </div>
                 

			</div> {{-- end card --}}
		</div>
	</div>
</div>


@endsection

