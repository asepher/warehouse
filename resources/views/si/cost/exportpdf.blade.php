<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cost #{{ $hd->no_inv }}</title>
    
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
            /*border-collapse: collapse;*/
        } 
        th,td   {
            padding:2px;
        }
    </style>
</head>
<body>

    <table border="0">
      <tr>
        <td style="width:70%"> 
          <img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/logo_ssl.png')); ?>">
        </td>
        <td>              
          PT. SINERGI SUKSES LOGISTIK <br>
          GAJAH MADA PLAZA FL 19#07 <br>
          JL. GAJAH MADA NO.19-26 <br>
          JAKARTA 10130
        </td>
      </tr>      
    </table>

  <hr style="border:1px">

    <table border="0">
      <tr>
        <td rowspan="2" style="width: 70%"></td>
        <td style="width: 30%">Si Ref : {{ $hd->kd_si }}</td>
      </tr>
      <tr>
        <td> 
            
        </td>        
      </tr>
      <tr>
        <td style="width: 50%">

          <table border="0">
              <tr>
                <td style="width: 30%">Country Of Origin</td><td style="width: 2px">:</td><td>{{ $hd->coo }}</td>
              </tr>
              <tr>
                <td>Port Of Loading</td><td>:</td><td>{{ $hd->pol }}</td>
              </tr>  
              <tr>
                <td>Port Of Dischart</td><td>:</td><td>{{ $hd->pod }}</td>
              </tr>
              <tr>
                <td>BL/Flight Name</td><td>:</td><td>{{ $hd->bl }}</td>
              </tr>
          </table>

        </td>
        <td style="width: 50%">

          <table>
              <tr>
                <td style="width: 30%">AWB</td><td style="width: 2px">:</td><td>{{ $hd->awb }}</td>
              </tr>
              <tr>
                <td>ETD Date</td><td>:</td><td>{{ $hd->etd }}</td>
              </tr>  
              <tr>
                <td>ETA Date</td><td>:</td><td>{{ $hd->eta }}</td>
              </tr>
              <tr>
                <td>Date Of Issue</td><td>:</td><td>{{ $hd->tgl_release }}</td>
              </tr>
          </table>

        </td>
      </tr>

    </table>

    <p></p>
    {{-- cost  --}}
    @php
      $brs = 0;
    @endphp
    <table style="border-bottom: 1px solid black; border-top: 1px solid black;  ">
      <tr style="border-bottom: 1px solid black; border-top: 1px solid black;  ">
        <th><h4>Cost</h4></th><th><h4>Jumlah</h4></th>      
      </tr>
      @foreach ($biaya as $dtl)

        @php
              $brs += 1;
        @endphp

        <tr>
          <td>{{ $dtl->keterangan}} </td>
          <td style="text-align: right; border-left: 1px solid black;width: 30%">
                      {{ Rupiah($dtl->jumlah) }} 
          </td>           
        </tr>
      @endforeach      

      @php
          //$sisa =  10 -  $brs;  <br/>
          for ($sisa = $brs; $sisa <= 8; $sisa++) {
            echo "<tr><td></td><td style='border-left: 1px solid black'><br/></td></tr>";
          }                             

      @endphp         

    </table>
    <p></p>
    {{-- selling --}}
    <table class="table" border="0" style="border-bottom: 1px solid black;">
      <tr style="border-top: 1px solid black;">
        <th><h3>Selling</h3></th><th><h3>Jumlah</h3></th>      
      </tr>
      @foreach ($selling as $sell)
        <tr>
          <td>{{ $sell->no_inv . $sell->tipe}} </td>
          <td style="text-align: right; border-left: 1px solid black;width: 30%">
                      {{ Rupiah($sell->grandtotal) }} 
          </td>           
        </tr>
      @endforeach      
      @php
          //$sisa =  10 -  $brs;  <br/>
          for ($sisa = $brs; $sisa <= 3; $sisa++) {
            echo "<tr><td></td><td style='border-left: 1px solid black'><br/></td></tr>";
          }                             

      @endphp         

    </table>

    
   
   </body>
   </html>