@extends('layouts.master')

@section('title')
    Data Customer
@endsection

@section('breadcrumb')
    <a href="{{ route('customer.index') }}">Customer</a>
@endsection


@section('content')


   <!-- /.page-header -->
   <div class="page-header">
      <h1>Data Customer</h1>
   </div><!-- /.page-header -->




 <div class="row">
    <div class="col-sm-11">
       <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title">View Customer</h4>
                <div class="widget-toolbar">
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main">

  <form class="form-horizontal" role="form" action="" method="post">
                    {{ csrf_field() }}


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Customer</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="customer" placeholder="Customer Name.."
                            value="{{ $customer->customer }}" style="background-color: #eff0f8" readonly>
                            @if($errors->has('customer'))
                                <div class="text-danger">
                                    {{ $errors->first('customer')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-8">                        
                            <textarea name="address" class="form-control" cols="30" rows="4" 
                            style="background-color: #eff0f8">{{ $customer->address }}</textarea>
                            @if($errors->has('address'))
                                <div class="text-danger">
                                    {{ $errors->first('address')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">NPWP</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="npwp" placeholder="Entry NPWP.."
                            value="{{ $customer->npwp }}" style="background-color: #eff0f8">
                            @if($errors->has('npwp'))
                                <div class="text-danger">
                                    {{ $errors->first('npwp')}}
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="email" placeholder="Entry Email.."
                            value="{{ $customer->email }}" style="background-color: #eff0f8">
                            @if($errors->has('email'))
                                <div class="text-danger">
                                    {{ $errors->first('email')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kontak</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="contact" placeholder="Entry Contact.."
                            value="{{ $customer->pic }}" style="background-color: #eff0f8">
                            @if($errors->has('contact'))
                                <div class="text-danger">
                                    {{ $errors->first('contact')}}
                                </div>
                            @endif                            
                        </div>
                    </div>
                    



</form>

                </div>
            </div>
        </div>
    </div>
</div>





@endsection