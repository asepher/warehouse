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
      <h1>Data Customer </h1>
   </div><!-- /.page-header -->


   <div class="row">
       <div class="col-sm-11">        

            <div class="widget-box widget-color-blue2">
                <div class="widget-header widget-header-flat">
                   <h4 class="widget-title">Edit Data</h4>
                   <div class="widget-toolbar"> 

                   </div>
                </div>
                <div class="widget-body">
                   <div class="widget-main no-padding">





            <form class="form-horizontal" action="{{ route('customer.update', $id)}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <fieldset>

            <div class="row">
                <div class="col-sm-10">

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><strong>Customer</strong></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="customer" placeholder="Customer Name.." autocomplete="off" value="{{ $customer->customer }}">
                            @if($errors->has('customer'))
                                <div class="text-danger">
                                    {{ $errors->first('customer')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><strong>Address</strong></label>
                        <div class="col-sm-8">                        
                            <textarea name="address" class="form-control" cols="30" rows="4" >{{ $customer->address }}</textarea>
                            @if($errors->has('address'))
                                <div class="text-danger">
                                    {{ $errors->first('address')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><strong>NPWP</strong></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="npwp" placeholder="Entry NPWP.."
                            value="{{ $customer->npwp }}" autocomplete="off">
                            @if($errors->has('npwp'))
                                <div class="text-danger">
                                    {{ $errors->first('npwp')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><strong>Email</strong></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="email" placeholder="Entry Email.."
                            value="{{ $customer->email }}" autocomplete="off">
                            @if($errors->has('email'))
                                <div class="text-danger">
                                    {{ $errors->first('email')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><strong>Kontak</strong></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="contact" placeholder="Entry Contact.."
                            value="{{ $customer->pic }}" autocomplete="off">
                            @if($errors->has('contact'))
                                <div class="text-danger">
                                    {{ $errors->first('contact')}}
                                </div>
                            @endif                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-md-3">
                            <div class="checkbox">
                                <input id="checkbox2" type="checkbox" name="consignee" value="1"
                                @if ($customer->consignee == 1)
                                    checked
                                @endif
                                >
                                <label for="checkbox2">Consignee</label>
                            </div>                                
                        </div>

                        <div class="col-md-3">
                            <div class="checkbox">
                                <input id="checkbox3" type="checkbox" name="consignee" value="1"
                                @if ($customer->agent == '1')
                                    checked
                                @endif
                                >
                                    <label for="checkbox3">Agent</label>
                            </div>                                
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="" class="col-md-2"></label>
                        <div class="col-md-6">
                             <button type="submit" class="btn btn-sm btn-primary px-5">Update</button>
                        </div>
                    </div>
                </div>                          
            </div> <!-- End row -->

            </fieldset>
        </form>











                   </div>
               </div>



           </div>
       </div>
   </div>




@endsection