@extends('layouts.master')

@section('title')
	View Invoice
@endsection

@section('breadcrumb')
	<a href="{{ route('wh.manifest.index',[$vsl]) }}">Vessel</a>
@endsection

@section('content')

	@php
		 $tgl=date('Y-m-d');
	@endphp

   <!-- /.page-header -->
   <div class="page-header">
      <h1>Generate Invoice</h1>
   </div><!-- /.page-header -->

	<div class="row">		
		<div class="col-xs-11">
			<div class="widget-box widget-color-blue2">
				<div class="widget-header">
					<h5 class="widget-title smaller">INVOICE</h5>
					<div class="widget-toolbar ">
						
  							<div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                              <li>
                                    <a href="{{ route('wh.invoice.uposting',[$vsl]) }}"
                                    onclick="event.preventDefault();
		                                       document.getElementById('view-form1').submit();"
                   @if ((Auth::user()->user_type !== 'AdminWh'))
                                    	style="pointer-events: none; color: red;" 
                   @endif
                                    >Unposting</a>

                                    <form id="view-form1" 
		                                  action="{{ route('wh.invoice.uposting',[$vsl]) }}" 
		                                       method="POST">
		                                       {{ csrf_field() }}
		                                  <input type="hidden" name="invoice" value="{{$nominv}}">     
		                                </form>
                              </li>
                           </ul>
                     </div><!-- /.btn-group -->

					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">
 


						<form class="form-horizontal" role="form" action="{{ route('wh.invoice.generate',[$nominv]) }}"
						method="post">
						{{ csrf_field() }}

						<div class="row">
								<div class="form-group">
									<label class="control-label col-sm-2">Date </label>				
									<div class="col-md-3 text-end">							
										<input type="date" class="form-control datepicker-input" name="tanggal"
										value="{{ $tgl }}"
											@if ($man->gen_inv == 1)
												Disabled 
											@endif
										 >
									</div>
									<div class="col-md-2 text-end">
											<button type="submit" class="btn btn-danger btn-sm px-3"
											@if ($man->gen_inv == 1)
												Disabled 
											@endif
											>Gen Invoice </button>					
									</div>
									<div class="col-md-5" style="text-align: center;">
										<h4> {{ Helper::FormatInvWh($man->kd_inv) }} - {{ $man->term }}</h4> 
									</div>
 
							</div>			
						</div>			
						</form>

						<div class="row">
							<div class="col-md-12">								
									@php
										if ($man->term == 'FOB') {
											$bill_to_name 		= $man->bill_to_name;
											$bill_to_address 	= $man->bill_to_address;
											$bill_to_npwp 		= $man->bill_to_npwp;			
										}
										if ($man->term == 'CNF'){
											$bill_to_name 		= $man->cnee_name;
											$bill_to_address 	= $man->cnee_address;
											$bill_to_npwp 		= $man->cnee_npwp;
											$weight   				= $man->min;			
										}
									@endphp								

									<table class="table table-sm">	
										<tr>	
											<td style="width: 100px"><strong>Bill To</strong></td>
											<td>: {{ $bill_to_name }}</td>
										</tr>
										<tr>	
											<td><strong>Address</strong></td>
											<td>: {{ $man->bill_to_address}}</td>
										</tr>
										<tr>	
											<td><strong>NPWP</strong></td>
											<td>: {{ $bill_to_npwp }}</td>
										</tr>
									</table>					
							</div>							
						</div>


	


					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">		
		<div class="col-xs-11">
			<div class="widget-box widget-color-blue2">
				<div class="widget-header">
					<h5 class="widget-title smaller">HEADER  - {{ $vsl}}</h5>
					<div class="widget-toolbar ">

						@if ($man->gen_inv == 1)


  							<div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Action<span class="ace-icon fa fa-caret-down icon-on-right"></span>
                           </button>

                           <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                              <li>
                                    <a href="{{ route('wh.invoice.formpaid',[$vsl]) }}"
                                    		onclick="event.preventDefault();
		                                       document.getElementById('view-form2').submit();"
		                                       >Paid</a>
                                    <form id="view-form2" 
		                                  action="{{ route('wh.invoice.formpaid',[$vsl]) }}" 
		                                       method="POST">
		                                       {{ csrf_field() }}
		                                  <input type="hidden" name="kd_inv" value="{{$nominv}}">     
		                                </form>
                              </li>
                           </ul>
                     </div><!-- /.btn-group -->


						@endif
						

					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">
					
						<table class="table table-sm">
							<tr>
								<td style="width: 100px">HBL</td>
								<td>: {{ $man->hbl }}</td>
							</tr>
						</table> 

					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="row">		
		<div class="col-xs-11">
			<div class="widget-box widget-color-blue2">
				<div class="widget-header">
					<h5 class="widget-title smaller">Detail</h5>
					<div class="widget-toolbar ">
			
					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main no-padding">


    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>ITEM</th>
          <th>TARIF</th>
          <th>W/M</th>
          <th>TOTAL</th>
        </tr>
      </thead>
      <tbody>
      	@php
      		$totsub = 0;
      		$no = 1; $jumlah=0;      		
      	@endphp
        @foreach ($tarif as $trf)
        	@php
        	  if ($man->term == 'FOB') { 
        	  		$weight = number_format($man->min_actual,0);
							}
	        	if ($man->term == 'CNF') { 
	        			//$weight = $man->min;
	        			$weight = number_format($man->min,0);
	        		 }

        		if ($trf->is_adm == 1 )  { 
        			$weight = 1; 
        		}  	        		
        		$jumlah = $trf->charge * $weight;    
        		$totsub = $totsub + $jumlah ;
        	@endphp
          <tr>
            <td style="text-align: center;">{{ $no++ }}</td>
            <td >{{  $trf->nama_tarif }}</td>
            <td style="text-align: center;">{{ Helper::Rupiah($trf->charge) }}</td>
            <td style="text-align: center;">{{ $weight }}</td>
            <td style="text-align: right;">{{ Helper::Rupiah($jumlah) }}</td>
          </tr>

        @endforeach   
      </tbody>
      @php
          $totppn = $totsub * Helper::PPn() ;
          $tmptot = $totsub + $totppn ;
          $materai = 0;

          if ($tmptot > 5000000)
            $materai = Helper::Materai();

           $grandtot = $tmptot + $materai;
        @endphp
        <tr>
            <td colspan="4">Subtototal</td>
            <td style="border-bottom: 1px solid;text-align: right;">{{ Helper::Rupiah($totsub) }}</td>
          </tr>
          <tr>
            <td colspan="4">VAT</td>
            <td style="border-bottom: 1px solid;text-align: right;">{{ Helper::Rupiah($totppn) }}</td>
          </tr>
          <tr>
            <td colspan="4">Stamp Duty</td>
            <td style="border-bottom: 1px solid;text-align: right;">{{ Helper::Rupiah($materai) }}</td>
          </tr>
          <tr>
            <td colspan="4">Grand Total </td>
            <td style="border-bottom: 1px solid;text-align: right;">{{ Helper::Rupiah($grandtot) }}</td>
          </tr>
    </table>



						


					</div>
				</div>
			</div>
		</div>
	</div>


@endsection	