@php
 $prefix = Request::route()->getPrefix();
 $route = Route::current()->getName();
@endphp


	<ul class="nav nav-list">
		<li class="">
			<a href="{{ route('home') }}">
				<i class="menu-icon fa fa-tachometer text-warning"></i>
				<span class="menu-text"> Dashboard </span>
			</a>

			<b class="arrow"></b>
		</li>

@if (Auth::user()->user_type == 'Admin' || Auth::user()->user_type == 'SuperAdmin')	 
		<li class="{{ ($prefix == '/ms')? 'open':'' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-desktop text-danger"></i>
				<span class="menu-text">
					Master File
				</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				 
		

				
			

				<li class="">
					<a href="{{ route('charge.index') }}">
						<i class="menu-icon fa fa-caret-right"></i>
						Data Charges
					</a>

					<b class="arrow"></b>
				</li>															
				<li class="">
					<a href="{{ route('country.index') }}">
						<i class="menu-icon fa fa-caret-right"></i>
						Data Country
					</a>

					<b class="arrow"></b>
				</li>

					<li class="">
						<a href="{{ route('tarif.index') }}">
							<i class="menu-icon fa fa-caret-right"></i>
							Data Tarif 
						</a>

						<b class="arrow"></b>
					</li>				
					<li class="">
						<a href="{{ route('wh.satuan.index') }}">
							<i class="menu-icon fa fa-caret-right"></i>
							Data Satuan 
						</a>

						<b class="arrow"></b>
					</li>							
		
			</ul>			
		</li>

	@endif
	@if (Auth::user()->user_type == 'AdminSi' || Auth::user()->user_type == 'SuperAdmin')	 

		<li class="{{ ($prefix == '/si')? 'open':'' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-list-alt text-success"></i>
				<span class="menu-text">
					Shipping
				</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>
 
			<b class="arrow"></b>

			<ul class="submenu">
				 <li class="">
					<a href="{{ route('si.create.job') }}">
						<i class="menu-icon fa fa-caret-right"></i>
						Create Job Number
					</a>
					<b class="arrow"></b>
				</li>
			
				<li class="">
					<a href="{{ route('si.index') }}">
						<i class="menu-icon fa fa-caret-right"></i>
						View Shipping
					</a>
					<b class="arrow"></b>
				</li>
				<li class="">
					<a href="{{ route('si.inv.all') }}">
						<i class="menu-icon fa fa-caret-right"></i>
						Query
					</a>					
					<b class="arrow"></b>
				</li>

			</ul>
		</li>

	@endif
	@if (Auth::user()->user_type == 'AdminWh' || 
			Auth::user()->user_type == 'SuperAdmin' ||
			Auth::user()->user_type == 'WH'
		)	 

		<li class="{{ ($prefix == '/wh')? 'open':'open' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-list text-primary"></i>
				<span class="menu-text">
					Warehouse
				</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				
				 <li class="">
					<a href="{{ route('customer.index') }}">
						<i class="menu-icon fa fa-caret-right"></i>
						Data Customer
					</a>

					<b class="arrow"></b>
				</li>

			
				<li class="">
					<a href="{{ route('wh.vessel.index') }}">
						<i class="menu-icon fa fa-caret-right"></i>
						Data Vessel
					</a>

					<b class="arrow"></b>
				</li>		
				<li class="">
					<a href="{{ route('wh.upload.viewUploadvessel') }}">
						<i class="menu-icon fa fa-caret-right"></i>
						Upload
					</a>

					<b class="arrow"></b>
				</li>
				<li class="{{ ($prefix == '/wh')? 'open':'' }}">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Query
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="">
										<a href="{{ route('wh.invoice.byvessel') }}">
											By Vessel
										</a>

										<b class="arrow"></b>
									</li>
								 
									<li class="">
										<a href="{{ route('wh.invoice.bycustomer') }}">										
											By Customer
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="{{ route('wh.invoice.bynom') }}">										
											By Nom Invoice
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="{{ route('wh.manifest.byhbl') }}">										
											By HBL
										</a>

										<b class="arrow"></b>
									</li>
									<li class="">
										<a href="{{ route('wh.manifest.bycontainer') }}">										
											By Container
										</a>

										<b class="arrow"></b>
									</li>

									
								</ul>
							</li>				
							<li class="{{ ($prefix == '/wh')? 'open':'' }}">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Report
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<li class="">
										<a href="{{ route('report.daily') }}">
											Daily
										</a>

										<b class="arrow"></b>
									</li>
										<li class="">
										<a href="{{ route('wh.invoice.bydate') }}">
											Period
										</a>
										<b class="arrow"></b>
									</li>
										<li class="">
										<a href="{{ route('wh.invoice.bymonth') }}">
											Monthly
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
							</li>						

			</ul>
		</li>

	
	@endif
	@if (Auth::user()->user_type == 'AdminWh' || Auth::user()->user_type == 'SuperAdmin')	 

		<li class="{{ ($prefix == '/pd' || $prefix == '/kb')? 'open':'' }}">			
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-pencil-square-o text-danger"></i>
				<span class="menu-text">
					Kas bank
				</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
 
			<ul class="submenu">				 
					<li class="{{ ($prefix == '/pd')? 'open':'' }}">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>
							Permohonan Dana
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
									<li >
										<a href="{{ route('pd.index') }}">
											View
										</a>

										<b class="arrow"></b>
									</li>
										<li class="">
										<a href="{{ route('pd.query') }}">
											Query
										</a>

										<b class="arrow"></b>
									</li>
									
						</ul>
					<li class="">
						<a href="{{ route('kb.index') }}">
							<i class="menu-icon fa fa-caret-right"></i>
							Harian
						</a>
						<b class="arrow"></b>
					</li>


					</li>
				</ul>
		</li>
	
	@endif
	@if (Auth::user()->user_type == 'Admin' || Auth::user()->user_type == 'SuperAdmin')	 

		<li class="{{ ($prefix == '/dl')? 'open':'' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-list-alt text-primary"></i>
				<span class="menu-text">
					Lain-Lain
				</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				 
			
							
				<li class="">
					<a href="{{ route('sj.index') }}">
						<i class="menu-icon fa fa-caret-right"></i>
						Surat Jalan 
					</a>

					<b class="arrow"></b>
				</li>
										
				<li class="">
					<a href="{{ route('user.view') }}">
						<i class="menu-icon fa fa-caret-right"></i>
						Manage User
					</a>

					<b class="arrow"></b>
				</li>
				
				<li class="">
					<a href="{{ route('wh.manual.create') }}">
						<i class="menu-icon fa fa-caret-right"></i>
						Invoice Manual WH
					</a>

					<b class="arrow"></b>
				</li>

			</ul>
		</li>			

@endif

	</ul><!-- /.nav-list -->
