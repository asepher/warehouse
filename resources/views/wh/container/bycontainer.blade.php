@extends('layouts.master')

@section('title')
   Container
@endsection

@section('breadcrumb')
   <a href="{{ route('wh.manifest.bycontainer') }}">Container</a>
@endsection


@section('content')



   <!-- /.page-header -->
   <div class="page-header">
      <h1>Data Container</h1>
   </div><!-- /.page-header -->




    <div class="row">
       <div class="col-sm-11">
          
        
         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title">Search </h4>
               <div class="widget-toolbar">
               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main">

 @php
   
    $dd = date('d');
    $mm = date('m');
    $yy = date('Y');
  @endphp

  
<form class="form-horizontal" role="form" action="{{ route('wh.invoice.qbycontainer') }}" method="post">
                     {{ csrf_field() }}

<div class="form-group">
                        <label class="col-sm-2 control-label" for="eta"><strong> Bulan </strong></label>
                        <div class="col-md-4">
                            <select name="bulan" id="" class="form-control">
                               <option value="">--Pilih--</option>
                               <option value="01">Januari</option>
                               <option value="02">Februari</option>
                               <option value="03">Maret</option>
                               <option value="04">April</option>
                               <option value="05">Mei</option>
                               <option value="06">Juni</option>
                               <option value="07">Juli</option>
                               <option value="08">Agustus</option>
                               <option value="09">September</option>
                               <option value="10" @if ($mm == 10) selected @endif >Oktober</option>
                               <option value="11" @if ($mm == 11) selected @endif >November</option>
                               <option value="12" @if ($mm == 12) selected @endif >Desember</option>

                            </select>
                        </div> 
                        <div class="col-md-3">
                            <select name="tahun" id="" class="form-control">
                               <option value="">--Pilih--</option>
                               <option value="2022" selected>2022</option>
                               <option value="2023">2023</option>
                            </select>
                        </div>
</div>

<div class="form-group">
                    
                        <label class="col-sm-2 control-label" for="eta"><strong>  </strong></label>
                        <div class="col-md-3">
                            <select name="modul" id="" class="form-control">
                               <option value="">--Pilih--</option>
                               <option value="inv" selected>Invoice</option>
                               <option value="soa">SOA</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                           <button type="submit" class="btn btn-primary btn-sm px-5">Submit</button>
                          
                        </div>
                    

</div>
</form>







                  </div>
               </div>
         </div>
      </div>
   </div>





    <div class="row">
       <div class="col-sm-11">
          
        
         <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
               <h4 class="widget-title">Search </h4>
               <div class="widget-toolbar">
               </div>
            </div>
              <div class="widget-body">
                  <div class="widget-main">



<form class="form-horizontal" role="form" action="{{ route('wh.invoice.qbysinglecont') }}" method="post">
                     {{ csrf_field() }}

<div class="form-group">
                        <label class="col-sm-2 control-label" for="eta"><strong> Container </strong></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="container" autocomplete="off">
                        </div>                    

</div>

<div class="form-group">
                    
                        <label class="col-sm-2 control-label" for="eta"><strong>  </strong></label>
                       
                        <div class="col-md-5">
                           <button type="submit" class="btn btn-primary btn-sm px-5">Submit</button>
                          
                        </div>
                    

</div>
</form>




                  </div>
               </div>
            </div>
         </div>
      </div>
   
@endsection