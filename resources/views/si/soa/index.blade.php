@extends('layouts.master')

@section('title')
    Create Shipping Instruction
@endsection

@section('breadcrumb')
    <a href="{{ route('si.index') }}">Shipping</a>
@endsection

@section('content')



    <!-- /.page-header -->
   <div class="page-header">
      <h1>SOA </h1>
   </div><!-- /.page-header -->
               
                     <form class="form-horizontal" role="form" action="{{ route('si.store') }}" method="post">
                     {{ csrf_field() }}

    <div class="row">
        <div class="col-md-11">
            <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                     <h4 class="widget-title">Search</h4>
                    <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                           <i class="ace-icon fa fa-chevron-up"></i>
                        </a>                                         
                     </div>
               </div>
               <div class="widget-body">
                  <div class="widget-main">

                  





                  </div>
                </div>
            </div>
      	</div>
    </div>

@endsection
