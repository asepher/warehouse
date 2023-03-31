@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    
                    <h4>Welcome, {{ Auth::user()->name }} </h4>

                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Now,  You are logged in! ...') }}
                    <p></p>
                    <span style="font-weight: bold;">Warehouse  </span>
                    <p></p>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-2">
                            <div class="infobox infobox-blue">                                 
                                  <div class="infobox-data">
                                      <span class="infobox-data-number">{{ $jum_vsl }}</span>
                                      <div class="infobox-content">Vessel</div>
                                  </div>
                                  <!-- /section:pages/dashboard.infobox.stat -->
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="infobox infobox-green">                                 
                                  <div class="infobox-data">
                                      <span class="infobox-data-number">{{ $jum_man }}</span>
                                      <div class="infobox-content">Manifest</div>
                                  </div>
                                  <!-- /section:pages/dashboard.infobox.stat -->
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="infobox infobox-red">                                 
                                  <div class="infobox-data">
                                      <span class="infobox-data-number">{{ $jum_cust }}</span>
                                      <div class="infobox-content">CNEE</div>
                                  </div>
                                  <!-- /section:pages/dashboard.infobox.stat -->
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="infobox infobox-orange2">                                 
                                  <div class="infobox-data">
                                      <span class="infobox-data-number">{{ $jum_inv }}</span>
                                      <div class="infobox-content">Invoice</div>
                                  </div>
                                  <!-- /section:pages/dashboard.infobox.stat -->
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="infobox infobox-orange2">                                 
                                  <div class="infobox-data">
                                      <span class="infobox-data-number">{{ $jum_cont }}</span>
                                      <div class="infobox-content">Container</div>
                                  </div>
                                  <!-- /section:pages/dashboard.infobox.stat -->
                            </div>
                        </div>


                      </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
