@extends('layouts.master')

@section('content')

<table class="table align-middle table-hover" id="example">
			            <thead class="table-transparan">
			                <tr class="bg-light">
			                    <th>#</th>
			                    <th>Kode</th>
			                    <th>Customer</th>
			                    <th width="350">Address</th>
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
			                   	<td>{{ $c->kd_cus  }}</td>
			                    <td>{{ $c->nama  }} </td>
			                    <td>
			                    	@php
			                    		echo nl2br($c->alamat);
			                    	@endphp
			                     </td>
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


@endsection
