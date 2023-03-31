<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Print INV {{ $hd->no_inv }}</title>    
    <style>
      body{
        margin-top: 290px;
        font-family: Calibri, 'Trebuchet MS', sans-serif;
        color:black;
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

    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
      <tr>
        <td style="width:50%;" valign="top"> 
          <img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/logo_ssl.png')); ?>"><br>
          PT. SINERGI SUKSES LOGISTIK <br>
          GAJAH MADA PLAZA FL 19#07 <br>
          JL. GAJAH MADA NO.19-26 <br>
          JAKARTA 10130
        </td>
        <td style="width:50%; border-left:0.1px solid black ;border-right:0.1px solid black;border-top:0.1px solid black;padding: 2px;">
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





    <table  border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
      <tr style="border-left:0.1px solid black;border-right:0.1px solid black;border-top:0.1px solid black;">
        <td rowspan="2" colspan="2" style="width: 50%;padding: 3px;"></td>
        <td colspan="2" style="width: 50%;padding: 3px;border-left:0.1px solid black;">Shipping Reference : {{ $si->kd_si }}</td>
      </tr>
      <tr style="border-left:0.1px solid black;border-right:0.1px solid black;border-top:0.1px solid black;">
        <td colspan="2" style="text-align:center; font-size: 16px;font-weight: bold;padding: 3px;border-left:0.1px solid black;"> 
            <strong>INVOICE {{ $hd->no_inv }}</strong><br>
        </td>        
      </tr>
      <tr style="border-left:0.1px solid black;border-right:0.1px solid black;border-top:0.1px solid black;">  
        <td style="width:20%;padding: 1px;">Country Of Ori</td><td style="width:30%">:{{ $si->coo }}</td>
        <td style="width:20%;padding: 1px;">Bill Of Lading</td><td style="width:30%">: {{ $si->bl }}</td>
      </tr>  

      <tr style="border-left:0.1px solid black;border-right:0.1px solid black;">  
        <td style="width:20%;padding: 1px;">Port Of Loading</td><td style="width:30%">: {{ $si->pol }}</td> 
        <td style="width:20%;padding: 1px;">ETD Date</td><td style="width:30%">: {{ $si->etd }}</td>
      </tr>  
      <tr style="border-left:0.1px solid black;border-right:0.1px solid black;">  
        <td style="width:20%;padding: 1px;">Port Of Dischart</td><td style="width:30%">: {{ $si->pod }}</td> 
        <td style="width:20%;padding: 1px;">ETA Date</td><td style="width:30%">: {{ $si->eta }}</td>
      </tr>  
      <tr style="border-left:0.1px solid black;border-right:0.1px solid black;
        border-bottom:0.1px solid black;">  
        <td style="width:20%;padding: 1px;">AWB/Flight Name</td><td style="width:30%">: {{ $si->awb }}</td> 
        <td style="width:20%;padding: 1px;">Date Of Issue</td><td style="width:30%">: {{ $si->tgl_release }}</td>
      </tr>  
    </table> 
<br>

  <table style="width: 100%;" cellpadding="0" cellspacing="0">
    <tr>
      <th style="width: 30%;padding: 5px;border-top: 0.1 solid black;">Marks & Number</th>
      <th style="width: 35%;">Keterangan</th>
      <th style="width: 35%;">Jumlah (Rp.)</th>
    </tr>
   </table>

</div>

<br>

  @php
    $no = 1; $total = 0;
    $jumlah = 0; $brs = 0; $sisa = 0;
    $grandtot = 0; $hitppn = 0; $materai = 0;
  @endphp


   <table style="width: 100%;border: 0.1px solid black;" cellpadding="0" cellspacing="0">
     <tr>
       <td style="width: 25%;" valign="top">

         <table style="width: 100%;" cellpadding="0" cellspacing="0">
           <tr>
             <td style="padding-left: 5px;">
                  <p></p>
                  @php
                                echo nl2br($hd->shipping->marking);
                                echo "<p><br>";
                                echo nl2br($hd->shipping->description);
                      @endphp                               

 
             </td>
           </tr>
         </table>
       </td>

       <td style="width: 75%;">
        

        <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>&nbsp; </td>
            <td style="width: 150px;text-align:right;border-left: 0.1px solid black;padding-right: 5px;"></td>
          </tr>
          @foreach ($detail as $det)

           @if (substr($det->kd_chg,0,2) == 77 || substr($det->kd_chg,0,2) == 99) 

              <tr>
                <td style="padding-top: 10px;"><strong>{{ $det->keterangan }}</strong></td>
                <td style="width: 150px;text-align:right;border-left: 0.1px solid black;padding-right: 5px;"
                ></td>
              </tr>

            @else

              <tr>
                <td style="padding: 1px;">{{ $det->keterangan }}</td>
                <td style="width:  150px;text-align:right;border-left: 0.1px solid black;
                padding-right: 5px;"
                >{{ Helper::Angka($det->jumlah) }}</td>
              </tr>     

           @endif

            @php
                $total = $total + $det->jumlah ; $brs += 1;
                if ( $det->ppn >= 1)
                      {
                          $hitppn = ( $det->ppn * $det->jumlah ) / 100 ;
                      }                                            
            @endphp
                                      

          @endforeach

          @php
             for ($sisa = $brs; $sisa <= 15; $sisa++) {
                                echo "<tr><td></td><td style='border-left: 1px solid black'> &nbsp; </td></tr>";
                              };
          @endphp


        </table>

@php
  $jumtotal = $total + $hitppn;
  if ($jumtotal > 5000000) {
    $materai = 10000;
  } 
  $grandtot = $jumtotal + $materai;
@endphp


       </td>
     </tr>
   </table>

<p></p>
        <table style="width: 100%;border: 0.1px solid black;"  cellpadding="0" cellspacing="0">
          
              <tr>
                <td style="text-align: right;"><strong>Total &nbsp;</strong></td>
                <td style="width: 150px;text-align:right;border-left: 0.1px solid black;
                padding-right: 5px;padding-top: 1px;">
                  {{ Helper::Rupiah($total) }}
                </td>
              </tr> 
              <tr>
                <td style="text-align: right;"><strong>VAT &nbsp;</strong></td>
                <td style="width:  150px;text-align:right;border-left: 0.1px solid black;
                padding-right: 5px;padding-top: 1px;">
                  {{ Helper::Rupiah($hitppn) }} 
                </td>
              </tr> 
               <tr>
                <td style="text-align: right;"><strong>Materai &nbsp;</strong></td>
                <td style="width:  150px;text-align:right;border-left: 0.1px solid black;
                padding-right: 5px;padding-top: 1px;">
                  {{ Helper::Rupiah($materai) }}
                </td>
              </tr>          
              <tr>
                <td  style="text-align: right;"><strong>Grand Total &nbsp;</strong></td>
                <td style="width:  150px;text-align:right;border-left: 0.1px solid black;
                padding-right: 5px;padding-top: 1px;">
                 {{ Helper::Rupiah($grandtot) }}
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
          </tr>
          <tr>
            <td style="font-size: 10px;" valign="bottom">
              {{ $auth_name . ' ' . now() }}  
            </td>
          </tr>
        </table>
 

</body>
</html>

