@extends('layouts.master')


@section('title')
    Shipping Instruction
@endsection

@section('breadcrumb')
    <a href="{{ route('si.index') }}">Shipping</a>
@endsection



@section('content')

    <!-- /.page-header -->
   <div class="page-header">
      <h1>Shipping Instruction </h1>
   </div><!-- /.page-header -->


 	<div class="row">
        <div class="col-md-11">

        	<div class="widget-box widget-color-blue2">
        		 <div class="widget-header widget-header-flat">
                  	<h4 class="widget-title">Data Shipping</h4>
                  	 <div class="widget-toolbar">
	               	<a href="{{ route('si.create') }}" class="btn btn-primary btn-sm">Add New</a>
	               </div>
               </div>

               <div class="widget-body">
                  <div class="widget-main no-padding">


                    <table class="table table-bordered" id="datatable-crud">
						<thead>
							<tr>
							<th>#</th>
							<th>SI</th>
							<th>CNEE</th>
							<th>COO</th>
							<th>POD/POL</th>
							<th width="5%">Action</th>
							</tr>
						</thead>						
						<tbody>
							@php
								$no = 1;
							@endphp
							@foreach ($shipping as $ship)
							<tr>
								<td>{{ $no++}}</td>
								<td>{{ $ship->kd_si }}</td>
								<td>{{ $ship->nmcnee->customer }}</td>
								<td>{{ $ship->coo }}</td>
								<td>{{ $ship->pod .'/'. $ship->pol }}</td>
								<td>

									<div>
										    <div class="inline position-relative">
										        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
										            <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
										        </a>

										        <ul class="dropdown-menu dropdown-lighter dropdown-menu-right dropdown-100">
										            <li>
										               <a  href="{{ route('customer.edit',[$cus->kd_cus]) }}"
													                  >Edit</a>
										            </li>
										            <li>
										            	<a  href="{{ route('customer.show',[$cus->kd_cus]) }}"
													                               	>View</a>

										            </li>
										            <li>

															<a  href="{{ route('customer.destroy',[$cus->kd_cus]) }}" onclick="return confirm('Yakin akan di hapus?')"
													                               	>Delete</a>
										            </li>
										        </ul>
										    </div>
										</div>
									



								</td>
							</tr>
							@endforeach

						</tbody>
					</table>


                  </div>
              </div>
        	</div>

		</div>
	</div>


<hr>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   {{ __('Shipping Instruction') }} | <a href="{{ route('si.create') }}">Add New</a>
               </div>

                <div class="card-body mt-2">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
</script>
@endpush



