<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Print INV {{ $hd->no_inv }}</title>    
    <style>
      body{
        margin-top: 270px;
        font-family: Calibri, 'Trebuchet MS', sans-serif;
        color:#333;
        text-align:left;
        font-size:14px;
      }

#header,
#footer {
  position: fixed;
  left: 0;
  right: 0;
  color: black;
  font-size: 0.9em;
}

#header {
  top: 0;
  border-bottom: 0.1pt solid #aaa;
}

#footer {
  bottom: 0;
  border-top: 0.1pt solid #aaa;
}

#header table,
#footer table {
  width: 100%;
  border-collapse: collapse;
  border: none;
}

#header td,
#footer td {
  padding: 0;
  width: 50%;
}

hr {
  page-break-after: always;
  border: 0;
}


    </style>
</head>
<body>


<div id="header">

    <table border="0" cellpadding="0" cellspacing="0" style="padding: 2px;">
      <tr>
        <td style="width:60%;" valign="top"> 
          <img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/logo_ssl.png')); ?>"><br>
          PT. SINERGI SUKSES LOGISTIK <br>
          GAJAH MADA PLAZA FL 19#07 <br>
          JL. GAJAH MADA NO.19-26 <br>
          JAKARTA 10130
        </td>
        <td style="width:50%; border-left:0.1px solid black ;border-right:0.1px solid black;border-top:0.1px solid black;">
          TO CONSIGNE : <br>
          {{ $cus->customer }}<br>
          {{ $cus->address }}<br>
          {{ $cus->email }}<br>
          {{ $cus->pic }}<br>
          {{ $cus->npwp }}
          <p></p>
          Customer Reference : {{ $si->kd_cus }}
        </td>
      </tr>      
    </table>


    <table border="0" cellpadding="0" cellspacing="0" style="padding: 2px;">
      <tr style="border-left:0.1px solid black;border-right:0.1px solid black;border-top:0.1px solid black;">
        <td rowspan="2" style="width: 60%;padding: 3px;"></td>
        <td style="width: 40%;padding: 3px;border-left:0.1px solid black;">Shipping Reference : {{ $si->kd_si }}</td>
      </tr>
      <tr style="border-left:0.1px solid black;border-right:0.1px solid black;border-top:0.1px solid black;">
        <td style="text-align:center; font-size: 16px;font-weight: bold;padding: 3px;border-left:0.1px solid black;"> 
            <strong>INVOICE {{ $hd->no_inv }}</strong><br>
        </td>        
      </tr>
      <tr>
        <td style="width: 50%">

          <table border="0" cellpadding="0" cellspacing="0" style="padding: 3px;">
              <tr style="border-left:0.1px solid black;border-right:0.1px solid black;border-top:0.1px solid black;">
                <td style="width:30%;">Country Of Ori</td>
                <td>: {{ $si->coo }}</td>
              </tr>
              <tr style="border-left:0.1px solid black;border-right:0.1px solid black;border-top:0.1px solid black;">
                <td>Port Of Loading</td><td>: {{ $si->pol }}</td>
              </tr>  
              <tr>
                <td>Port Of Dischart</td><td>: {{ $si->pod }}</td>
              </tr>
              <tr style="border-left:0.1px solid black;border-right:0.1px solid black;border-top:0.1px solid black;">
                <td>BL/Flight Name</td><td>: {{ $si->bl }}</td>
              </tr>
          </table>

        </td>        
        <td style="width: 50%">

            <table border="0" cellpadding="0" cellspacing="0" style="padding: 3px;">
                <tr>
                  <td style="width: 30%;border-left:0.1px solid black;border-top:0.1px solid black;">AWB</td>
                  <td style="border-right:0.1px solid black;border-top:0.1px solid black;">: {{ $si->awb }}</td>
                </tr>
                <tr>
                  <td style="border-left:0.1px solid black;border-top:0.1px solid black;">ETD Date</td>
                  <td style="border-right:0.1px solid black;border-top:0.1px solid black;">: {{ $si->etd }}</td>
                </tr>  
                <tr>
                  <td style="border-left:0.1px solid black;border-top:0.1px solid black;">ETA Date</td>
                  <td style="border-right:0.1px solid black;border-top:0.1px solid black;">: {{ $si->eta }}</td>
                </tr>
                <tr>
                  <td style="border-left:0.1px solid black;border-top:0.1px solid black;">Date Of Issue</td>
                  <td style="border-right:0.1px solid black;border-top:0.1px solid black;">: {{ $si->tgl_release }}</td>
                </tr>
            </table>

        </td>
      </tr>

    </table>  

</div>



  @php
    $brs = 1;
    $col = 0;
  @endphp

  <table style="width: 100%;border: 1px solid black; padding: 2px;">
    <tr>
      <th style="width: 30%;">Marks & Number</th>
      <th style="width: 35%;">Keterangan</th>
      <th style="width: 35%;">Jumlah</th>
    </tr>
   </table>

   <table style="width: 100%;border: 1px solid black; padding: 3px;">
     <tr>
       <td style="width: 30%;border-bottom: 1px solid black;" valign="top">

         <table style="width: 100%;">
           <tr>
             <td>
                  
                  @php
                                echo nl2br($hd->shipping->marking);
                                echo "<p><br>";
                                echo nl2br($hd->shipping->description);
                      @endphp                               


             </td>
           </tr>
         </table>
       </td>

       <td style="width: 70%;border-bottom: 1px solid black;">
       

        <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
          @foreach ($detail as $det)
            <tr>
              <td>{{ $det->keterangan }}</td>
              <td style="text-align:right;">{{ Helper::Angka($det->jumlah) }}</td>
            </tr>              
          @endforeach
        </table>


       </td>
     </tr>

   </table>







<hr>

<table>
       @foreach ($detail as $det)     
       @php
          $brs++;          
       @endphp
        <tr>
          <td style="width: 100%;border-bottom: 1px solid black;">{{ $brs }}
          </td>       
          <td style="width: 100%;border-bottom: 1px solid black;">{{ $det->keterangan }}</td>
          <td style="width: 100%;border-bottom: 1px solid black;">{{ $det->jumlah }}</td>
       </tr>
       @endforeach  
  </table>




       <table  style="width: 100%;border: 1px solid black;">
          <tr>
            <td style="width: 25%" valign="top">

                   <table style="width: 100%">
                        <tr style="height: 30px;">
                          <td style="width: 25%;border-bottom: 1px solid black">                            
                            <strong>&nbsp; Marks & Number</strong>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <br>                           
                              @php
                                echo nl2br($hd->shipping->marking);
                                echo "<p><br>";
                                echo nl2br($hd->shipping->description);
                              @endphp                               
                          </td>
                        </tr>
                    </table>



            </td>
            <td style="width: 100%" valign="top">


                      @php
                          $no = 1;$tot = 0;$jum = 0; $brs = 0;$sisa = 0;
                          $grandtot = 0; $hitppn = 0; $materai = 0;
                          $jumbaris = 20;
                          $sum = App\Models\InvSiDetail::where('no_inv', $hd->no_inv)->sum('subtotal');
                          if ($sum > 5000000) {
                              $materai = 10000;
                          }                         
                      @endphp
                      
                      <!--  Di print -->
                      <table style="width: 100%;" border="1">
                        <thead>
                          <tr style="height: 30px">
                            <td style="width: 70%;border-bottom: 1px solid black"><strong>Keterangan</strong></td>
                            <td style="text-align: center;border-left: 1px solid black;border-bottom: 1px solid black"><strong>Jumlah ( Rp. )</strong></td>
                          </tr>                         
                        </thead>
                        <tbody>
                          <tr>
                            <td>&nbsp;</td>
                            <td style="border-left: 1px solid black"></td>
                          </tr>

                              @foreach ($detail as $det)                                      
                                      
                                        @if (substr($det->kd_chg,0,2) !== '99' AND substr($det->kd_chg,0,2) !== '77')
                                          <tr>
                                              <td>                                                 
                                                {{ $det->keterangan }}</td>
                                              <td style="text-align: right;border-left: 1px solid black"> 
                                                   {{ Helper::Angka($det->jumlah) }} &nbsp;
                                              </td>                             
                                            </tr>
                                        @endif                                          
                                        @if (substr($det->kd_chg,0,2) == 77) 
                                          <tr>
                                                <td><br><strong>{{ $det->keterangan }}</strong></td>
                                                <td style="text-align: right;border-left: 1px solid black">
                                                  &nbsp; 
                                                </td>
                                          </tr>
                                        @endif

                                        @php
                                            $tot = $tot + $det->jumlah;$brs += 1;
                                            if ( $det->ppn >= 1)
                                                  {
                                                      $hitppn = ( $det->ppn * $det->jumlah ) / 100 ;
                                                  }                                            
                                        @endphp
                                      
                              @endforeach
                          </tr>
                        </tbody>
                          @php
                              //$sisa =  $jumbaris - $brs;
                              for ($sisa = $brs; $sisa <= 15; $sisa++) {
                                echo "<tr><td></td><td style='border-left: 1px solid black'> &nbsp; </td></tr>";
                              };
                              $grandtot = $tot + $hitppn + $materai;
                          @endphp

                          @foreach ($noted as $note)
                              <tr>
                                <td> {!! nl2br($note->keterangan) !!} </td>
                                <td style='border-left: 1px solid black'> &nbsp; </td></tr>;
                          @endforeach   
                          <tr>
                            <td > &nbsp; </td>
                            <td style='border-left: 1px solid black'></td>
                          </tr>       
                      </table>   

            </td>
          </tr>
 
        </table>
        
        <hr>

        <table style="border-collapse: collapse;border: 1px solid black;">
          
              <tr>
                <td style="width: 77%; text-align: right;"><strong>VAT &nbsp;</strong></td>
                <td style="text-align: right; border-left: 1px solid black">
                  {{ Helper::Rupiah($hitppn) }} &nbsp;
                </td>
              </tr> 
               <tr>
                <td style="width: 77%; text-align: right;"><strong>Materai &nbsp;</strong></td>
                <td style="text-align: right; border-left: 1px solid black">
                  {{ Helper::Rupiah($materai) }} &nbsp;
                </td>
              </tr>          
              <tr>
                <td  style="text-align: right;"><strong>Grand Total &nbsp;</strong></td>
                <td style="text-align: right; border-left: 1px solid black">
                 {{ Helper::Rupiah($grandtot) }} &nbsp;
                </td>
              </tr>
          
        </table>

        <table>
          <tr>
            <td colspan="2">
              1. All cheques should be crossed and payable to PT. SINERGI SUKSES LOGISTIK <br>
              2. Interest at rate of 1.5% a month or part there of, would be charged for outstanding invoices. <br>
              3. If there any discrepancy kindly contact our account departement within 7 days in writing from <br>
                 the date of this invoice otherwise all charges are deemed to be correct.
            </td>
          </tr>
          <tr>
            <td colspan="2" style="width: 80%;">
              @php
                $par = App\Models\Param::where('param1','NOTE')->first();
                echo nl2br($par->keterangan);
              @endphp
            </td>
            <td style="text-align: center;" valign="bottom">
              {{-- Auth::user()->name --}}
            </td>
          </tr>
        </table>

    <p><br></p>

  

</body>
</html>

