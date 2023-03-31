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
         <div class="col-md-11">
            <div class="widget-box widget-color-blue2">
               <div class="widget-header widget-header-flat">
                  <h4 class="widget-title">Add Data </h4>
               </div>

               <div class="widget-body">
                  <div class="widget-main no-padding">

                     <form action="{{ route('customer.store') }}" class="form-horizontal" role="form" method="POST">
                        @csrf
                        <!-- <legend>Form</legend> -->
                        <fieldset>

                           

                           <div class="form-group">
                               <label class="col-sm-2 col-form-label"><strong>Customer</strong></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="customer" placeholder="Customer Name.." value="{{ old('customer') }}" autocomplete="off">
                                    @if($errors->has('customer'))
                                       <div class="text-danger">
                                           {{ $errors->first('customer')}}
                                       </div>
                                   @endif
                                </div>
                           </div>
                           
                           <div class="form-group">
                             <label class="col-sm-2 col-form-label"><strong>Address</strong></label>
                              <div class="col-sm-8">                        
                                  <textarea name="address" class="form-control" cols="30" 
                                  rows="4">{{ old('address') }}</textarea>
                                  @if($errors->has('address'))
                                     <div class="text-danger">
                                         {{ $errors->first('address')}}
                                     </div>
                                    @endif
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-form-label"><strong>NPWP</strong></label>
                              <div class="col-sm-6">
                                  <input type="number" class="form-control" name="npwp" placeholder="Entry NPWP.."
                                   autocomplete="off" value="{{ old('npwp') }}">
                                  @if($errors->has('npwp'))
                                     <div class="text-danger">
                                         {{ $errors->first('npwp')}}
                                     </div>
                                 @endif
                              </div>
                          </div>  

                           <div class="form-group">
                              <label class="col-sm-2 col-form-label"><strong>Email</strong></label>
                              <div class="col-sm-6">
                                  <input type="text" class="form-control" name="email" placeholder="Entry Email.."
                                  autocomplete="off" value="{{ old('email') }}" >
                                  @if($errors->has('email'))
                                     <div class="text-danger">
                                         {{ $errors->first('email')}}
                                     </div>
                              @endif
                              </div>
                          </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-form-label"><strong>Kontak</strong></label>
                              <div class="col-sm-6">
                                 <input type="text" class="form-control" name="contact" placeholder="Entry Contact.."
                                 autocomplete="off" value="{{ old('contact') }}">
                                 @if($errors->has('contact'))
                                     <div class="text-danger">
                                         {{ $errors->first('contact')}}
                                     </div>
                                 @endif                            
                              </div>
                           </div>


                    <div class="form-group">
                         <label class="col-sm-2 col-form-label"><strong>Type</strong></label>
                         <div class="col-md-3">
                            <div class="checkbox">
                                <input id="checkbox2" type="checkbox" name="consignee" value="1" checked>
                                <label for="checkbox2">Consignee</label>
                            </div>                                
                            <div class="checkbox">
                                <input id="checkbox3" type="checkbox" name="consignee" value="1">
                                    <label for="checkbox3">Agent</label>
                            </div>                                
                        </div>


                    </div>



                        </fieldset>

                        <div class="form-actions center">
                           <button type="submit" class="btn btn-sm btn-primary">Submit
                              <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                           </button>
                        </div>

                      </form>
                  </div>                
               </div>
            </div>
         </div>         
      </div>







@endsection