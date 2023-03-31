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

							<div class="row">
								<div class="col-md-12">		

									<table class="table table-bordered">
										<tr>
											<td colspan="2">   													
														<h4 class="blue">
															<span class="middle">{{ Auth::user()->name }}</span>									
															</h4>													
											</td>											
										</tr>
										<tr>
											<td style="width:20%">Username</td>
											<td><span>{{ Auth::user()->username }}</span></td>
										</tr>
										<tr>
											<td style="width:20%">Register</td>
											<td><span>20/07/2022</span></td>
										</tr>
										<tr>
											<td style="width:20%">Last Online</td>
											<td><span>3 hours ago</span></td>
										</tr>
									</table>

										




							</div>
	               </div>
	            </div>
	      </div>





@endsection
