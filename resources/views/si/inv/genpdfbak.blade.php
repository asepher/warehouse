<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $hd->no_inv }}</title>
    
    <style>
        body{
            font-family: Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:13px;
            margin:0;
        }
        table   {               
            width: 100%;            
            border-collapse: collapse;
        } 
        
        th,td   {
            padding:1px;
        }

    </style>
</head>
<body>

    <table border="0">
      <tr>
        <td style="width:50%"> 
          <img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/logo_ssl.png')); ?>"><br>
          PT. SINERGI SUKSES LOGISTIK <br>
          GAJAH MADA PLAZA FL 19#07 <br>
          JL. GAJAH MADA NO.19-26 <br>
          JAKARTA 10130
        </td>
        <td style="width:50%; border-left:1px;border-right:1px;border-top:1px;">
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


    <table border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td rowspan="2" style="width: 50%"></td>
        <td style="width: 50%">Shipping Reference : {{ $si->kd_si }}</td>
      </tr>
      <tr>
        <td> 
            <strong>INVOICE {{ $hd->no_inv }}</strong><br>
        </td>        
      </tr>
      <tr>
        <td style="width: 50%">

          <table>
              <tr>
                <td style="width: 30%">Coutry Of Ori</td><td>: {{ $si->coo }}</td>
              </tr>
              <tr>
                <td>Port Of Loading</td><td>: {{ $si->pol }}</td>
              </tr>  
              <tr>
                <td>Port Of Dischart</td><td>: {{ $si->pod }}</td>
              </tr>
              <tr>
                <td>BL/Flight Name</td><td>: {{ $si->bl }}</td>
              </tr>
          </table>

        </td>
        <td style="width: 50%">


          <table>
              <tr>
                <td style="width: 30%">AWB</td><td>: {{ $si->awb }}</td>
              </tr>
              <tr>
                <td>ETD Date</td><td>: {{ $si->etd }}</td>
              </tr>  
              <tr>
                <td>ETA Date</td><td>: {{ $si->eta }}</td>
              </tr>
              <tr>
                <td>Date Of Issue</td><td>: {{ $si->tgl_release }}</td>
              </tr>
          </table>

        </td>
      </tr>

    </table>   
   <p></p>
       <table  style="width: 100%;border: 1px solid black;">
          <tr>
            <td style="width: 25%" valign="top">

                   <table style="width: 100%">
                        <tr style="height: 300px;">
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
            <td style="width: 75%" valign="top">


                      @php
                          $no = 1;$tot = 0;$jum = 0; $brs = 0;$sisa = 0;
                          $grandtot = 0; $hitppn = 0; $materai = 0;
                          $jumbaris = 20;
                          $sum = App\Models\InvSiDetail::where('no_inv', $hd->no_inv)->sum('subtotal');
                          if ($sum > 5000000) {
                              $materai = 10000;
                          }                         
                      @endphp
                      

                      <table style="width: 100%;">
                        <thead>
                          <tr style="height: 50px">
                            <td style="width: 70%;border-bottom: 1px solid black"><strong>Keteragan</strong></td>
                            <td style="text-align: center;border-left: 1px solid black;border-bottom: 1px solid black"><strong>Jumlah</strong></td>
                          </tr>                         
                        </thead>
                        <tbody>
                          <tr>
                            <td>&nbsp;</td>
                            <td style="border-left: 1px solid black"></td>
                          </tr>

                              @foreach ($detail as $det)
                                    @php
                                      $brs += 1;
                                    @endphp
                                    <tr>                                
                                        @if (substr($det->kd_chg,0,2) == 99)
                                          <td>@php
                                              echo nl2br($det->keterangan)  
                                             @endphp 
                                          </td>
                                          <td style="text-align: right;border-left: 1px solid black"></td>
                                        @else 
                                          <td> {{ $brs . '-' . $det->keterangan }}</td>
                                          <td style="text-align: right;border-left: 1px solid black"> 
                                             {{ Rupiah($det->jumlah) }} &nbsp;
                                          </td>
                                        @endif                                      
                                        @php
                                            $tot = $tot + $det->jumlah;
                                            if ( $det->ppn >= 1)
                                                  {
                                                      $hitppn = ( $det->ppn * $det->jumlah ) / 100 ;
                                                  }                                            
                                        @endphp
                                      </tr>

                                     
                                @endforeach
                          </tr>
                        </tbody>
                          @php
                              $sisa =  $jumbaris - $brs;
                              for ($sisa = $brs; $sisa <= 10; $sisa++) {
                                echo "<tr><td>". $sisa . "</td><td style='border-left: 1px solid black'> &nbsp; </td></tr>";
                              };
                              $grandtot = $tot + $hitppn + $materai;
                          @endphp
         

                      </table>   





            </td>
          </tr>
 
        </table>
        

        <table style="border-collapse: collapse;border: 1px solid black;">
          
           
              <tr>
                <td style="width: 78%; text-align: right;"><strong>VAT &nbsp;</strong></td>
                <td style="text-align: right; border-left: 1px solid black">
                  {{ Rupiah($hitppn) }} &nbsp;
                </td>
              </tr> 
               <tr>
                <td style="width: 78%; text-align: right;"><strong>Materai &nbsp;</strong></td>
                <td style="text-align: right; border-left: 1px solid black">
                  {{ Rupiah($materai) }} &nbsp;
                </td>
              </tr>          
              <tr>
                <td  style="text-align: right;"><strong>Grand Total &nbsp;</strong></td>
                <td style="text-align: right; border-left: 1px solid black">
                 {{ Rupiah($grandtot) }} &nbsp;
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

</body>
</html>

