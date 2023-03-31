@extends('layouts.master')


@section('title')
   Detail Permohoan Dana
@endsection

@section('breadcrumb')
   <a href="{{ route('pd.index') }}">Permohonan Dana</a>
@endsection


@section('content')


 <!-- /.page-header -->
   <div class="page-header">
      <h1>Permohonan Dana Manual</h1>
   </div><!-- /.page-header -->



   <div class="row">
    <div class="col-sm-11">
      <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title">Create Invoice </h4>
               <div class="widget-toolbar"></div>
            </div>

            <div class="widget-body">
               <div class="widget-main no-padding">

                <div class="row">
                 <div class="col-md-6">  
                    <table class="table" id="dynamic-table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>CONTAINER</th>
                          <th>BL</th>
                          <th>x</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($container as $cnt)
                       <tr>
                          <td>1</td>
                          <td>{{ $cnt->container }}</td>
                          <td>{{ $cnt->vls_bl }}</td>
                          <td>

                              <div>
                                  <div class="inline position-relative">
                                      <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                          <i class="ace-icon fa fa-ellipsis-v bigger-25"></i>
                                      </a>

                                      <ul class="dropdown-menu dropdown-yellow dropdown-menu-right">
                                          <li>
                                             <a  href="{{ route('wh.manual.createnew',[$cnt->container]) }}"
                                                      >Create Invoice</a>
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
      </div>
    </div>


@endsection



