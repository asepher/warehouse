@extends('layouts.master')

@section('title')
	Shipping Instruction
@endsection

@section('content')


    <!-- /.page-header -->
   <div class="page-header">
      <h1>Profile</h1>
   </div><!-- /.page-header -->


   <div class="row">
       <div class="col-sm-11">

       	<div class="widget-box widget-color-blue2">
	            <div class="widget-header widget-header-flat">
	               <h4 class="widget-title"></h4>
	               <div class="widget-toolbar">
	               </div>
	            </div>
	            <div class="widget-body">
	               <div class="widget-main no-padding">

			

	               	<table class="table table-striped table-bordered">
	               		<tr>
	               			<th>User </th>
	               			<th>EMail </th>
	               			<th>Dept </th>
	               		</tr>
	               		@foreach ($allData as $val)
	               			<tr>
	               				<td>{{ $val->name }}</td>
	               				<td>{{ $val->email }}</td>
	               				<td>{{ $val->dept }}</td>
	               			</tr>
	               		@endforeach
	               	</table>


	               </div>
	            </div>
	      </div>

	  </div>





@endsection
