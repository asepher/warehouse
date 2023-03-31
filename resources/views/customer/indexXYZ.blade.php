@extends('layouts.master')

@section('content')

<div class="container">
	<div class="card border">	

			<div class="card-header py-2 bg-primary text-white">
			 <div class="row align-items-center">			 	
                <div class="col-lg-10">
                    <h4 class="mb-0">Data Customer</h4>          
                </div>
                <div class="col-lg-2">
                   <a href="" class="btn btn-sm btn-white px-3">Add New</a> 
                </div>
            </div>
       </div>
       
       <div class="card-body">


					@if(session()->has('success'))
					             Alert::success('Sukses', 'Data berhasil di tambahkan');
					             alert('Title','Lorem Lorem Lorem', 'success');
					@endif
				
				<div class="table-responsive123">

					<table class="table table-hover">
			            <thead>
			                <tr class="bg-light">
			                    <th>#</th>
			                    <th>Npwp</th>
			                    <th>Nama</th>
			                    <th width="350">Address</th>
			                    <th>Kontak</th>			                  
			                    <th>x</th>
			                </tr>
			            </thead>
			            <tbody>
			            	@php
			            		$no=1;
			            	@endphp 
			            	@foreach ($customer as $c)
			                <tr>
			                    <td>{{ $no++ }}</td>
			                   	<td>{{ $c->npwp  }}</td>
			                    <td>{{ $c->nama  }} </td>
			                    <td>
			                    	@php
			                    		echo nl2br($c->alamat);
			                    	@endphp
			                     </td>
			                    <td>{{ $c->pic }} </td>
			                 
			                    <td>

	<div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown" style="font-size:12px"><i class="bi bi-three-dots"></i></div>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li style="font-size:14px">
                                	<a class="dropdown-item" href="{{ route('customer.edit',[$c->kd_cus]) }}"
                                 >Edit</a>
                               </li> 
                               <li style="font-size:14px">
                               	<a class="dropdown-item" href="{{ route('customer.show',[$c->kd_cus]) }}"
                               	>View</a>
                               </li>      
                               <li><hr class="dropdown-divider"></li>                        
															 <li style="font-size:14px">
																<form action="{{ route('customer.destroy', $c->id) }}" method="POST">
				                        @csrf                     
				                        <input type="hidden" name="pd" value={{ $c->id }}>                                           
				                            <button type="submit" class="dropdown-item"
				                            onclick="return confirm('Yakin akan di hapus?')">
				                                Delete
				                            </button>
                       
                    						</form> 
                               	
                               </li> 

                              </ul>
                          </div>
   									
           					   
	                     
			                    </td>
			                </tr>
			            	@endforeach
			            </tbody>
		        	</table>
	

				</div>	

			</div> {{-- card body --}}


	</div> {{-- end card --}}
</div>

@endsection