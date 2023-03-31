<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INV - {{ $inv }}</title>
    <style type="text/css">
    body{
            font-family: Calibri, 'Trebuchet MS', sans-serif;
            color:black;
            text-align:left;
            font-size:12px;
            margin:0;
     
        }
    table {     
      width: 100%;
      border-collapse: collapse;
    } 
    th,td   {     
      padding: 1px;
    }     
    #judul {    
      border: 0.1px solid black;
    }   
    #item th  {     
      border: 0.1px solid black;
      padding: 2px;
    }
    #item td  {       
      padding: 2px;
    }

    #bg {   
      
      background-repeat: no-repeat;
      
      background-image: url('http://localhost:8000/images/nomimasi.png');
      background-repeat: no-repeat;
    }    

    
 .center-image {
         background-image: url("images/ssl_gw.png");        
         height: 250px;
         background-position: center;
         background-repeat: no-repeat;
         background-size: cover;
         position: relative;
      }

  </style>
</head>
<body>
  <center>
  <table>
      <tr>
        <td>  <img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/logo_ssl.png')); ?>" >
        </td>           
        <td width="40%">
          <strong style="font-size:15px;">PT. SINERGI SUKSES LOGISTIK </strong><br>
          Gajah Mada Tower Fl 19th #7 <br>
          Jl. Gajah Mada No. 19-26 , Jakarta 10130 - Indonesia <br>
          Phone : +62 21 63851866  Fax : +62 21 6338155 <br>
          mail@sinergisukseslogistik.com <br>
          www.sinergisukseslogistik.com         
        </td>
      </tr>
    </table> 
    <p></p>
    <table id="judul">
      <tr style="height: 25px">
        <td width="75%" style="border-right: 0.1px solid;font-size:15px;font-weight: bold;"><center><b>INVOICE</b></center> </td>
        <td style="font-size:15px;font-weight: bold;"><center><b>{{ Helper::FormatInvWh($inv) }}</b></center></td>
      </tr>
    </table>  
    <p></p>

               
    <table>
      <tr>
        <td style="width:20%">Tanggal </td><td style="width:5px">:</td>
        <td>{{ Helper::TglIndo($header->tgl_gen) }}</td>
      </tr>
      <tr>
        <td>Bill To </td><td>:</td>
        <td>{{ $manifest->bill_to_name}}</td>
      </tr>
      <tr>
        <td valign="top">Address</td><td valign="top">:</td>
        <td>{{ $manifest->bill_to_address }}</td>
      </tr>
      <tr>
        <td>NPWP</td><td>:</td>
        <td>{{ $manifest->bill_to_npwp }}</td>
      </tr>
    </table>
    <hr>
  

    <table border="0">
      <tr>
        <td style="width:20%">HB/L No</td><td style="width:5px">:</td><td>{{ $manifest->hbl }}</td>
        <td>Quantity </td><td style="width:5px">:</td><td>{{ number_format($manifest->qty,0) }}</td>
      </tr>
      <tr>
        <td>BL No</td><td>:</td><td>{{ $manifest->vls_bl }}</td>
        <td>Type</td><td>:</td><td>{{ $manifest->sat_qty }}</td>
      </tr>
      <tr>
        <td>Container</td><td>:</td><td>{{ $manifest->container }}</td>
        <td>Gross Weight</td><td>:</td><td>{{ $manifest->weight }}</td>
      </tr>
      <tr>
        <td>Vessel</td><td>:</td><td>{{ $manifest->vessel }}</td>
        <td>Measurement</td><td>:</td><td>{{ $manifest->measure }}</td>
      </tr>
      <tr>
        <td>ETA</td><td style="width:5px">:</td><td>{{ $manifest->eta }}</td>
        @if ($manifest->term == 'FOB' )
            <td colspan="2" style="text-align:center;font-size:15px;font-weight: bold;"><strong>NOMINASI</strong></td>  
        @endif        
      </tr>
      <tr>
        <td valign="top">Description </td><td valign="top">:</td><td colspan="2">
          @php
            $value = Illuminate\Support\Str::limit($manifest->description, 50);
            echo nl2br($value);
          @endphp
        </td>
      </tr>
    </table>
    <p></p>
  

<div class="center-image">

    <table id="item" style="width: 100%;">
      <thead>
        <tr style="height: 25px">
          <th style="border: 1px solid; width: 5%;">NO</th>
          <th style="border: 1px solid black;">ITEM</th>
          <th style="border:  1px solid black;width: 20%;">TARIF ( Rp )</th>
          <th style="border: 1px solid black;width: 10%;">W/M</th>
          <th style="border: 1px solid black;width: 20%;">JUMLAH ( Rp )</th>
        </tr>
      </thead>
      <tbody>
        @php
          // hitung weight/measure
           $totsub =  $totppn = 0; 
           $brs = 0; $no = 1;
        @endphp

        @foreach ($dtls as $dtl)
          @php
            $brs++;            
            $jumlah = $dtl->tarif * $dtl->wm;
            $totsub = $totsub + $jumlah ;
          @endphp
          <tr>
            <td style="border: 1px solid black;text-align: center;">{{ $no++ }}</td>
            <td style="border: 1px solid black;">{{ $dtl->nama_tarif }}</td>
            <td style="border: 1px solid; text-align: center;">{{ Helper::Angka($dtl->tarif) }}</td>

            <td style="border: 1px solid; text-align: center;">{{ number_format($dtl->wm) }}</td>
            
            <td style="border: 1px solid;text-align: right;">{{ Helper::Angka($jumlah) }}</td>
          </tr>
        @endforeach          
        @for ($i = $brs; $i < 7 ; $i++)
          <tr>
            <td style="border: 1px solid black;">&nbsp;</td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"></td>
          </tr>
        @endfor   
      </tbody>
      @php
          $totppn = $totsub * 0.11 ;
          $tmptot = $totsub + $totppn ;
          $materai = 0;

          if ($tmptot > 5000000)
            $materai = 10000;

           $grandtot = $tmptot + $materai;
        @endphp
        <tr>
            <td colspan="4" style="text-align:right;font-weight: bold;">Sub Total &nbsp;&nbsp;</td>
            <td style="border: 1px solid black;text-align:right;font-size:15px;font-weight: bold;">{{ Helper::Rupiah($totsub) }}</td>
          </tr>
          <tr>
            <td colspan="4" style="text-align:right;font-weight: bold;">VAT &nbsp;&nbsp;</td>
            <td style="border: 1px solid black;text-align:right;font-size:15px;font-weight: bold;">{{ Helper::Rupiah($totppn) }}</td>
          </tr>
          <tr>
            <td colspan="4" style="text-align:right;font-weight: bold;">Stamp Duty &nbsp;&nbsp;</td>
            <td style="border: 1px solid black;text-align:right;font-size:15px;font-weight: bold;">{{ Helper::Rupiah($materai) }}</td>
          </tr>
          <tr>
            <td colspan="4" style="text-align:right;font-weight: bold;">Grand Total &nbsp;&nbsp;</td>
            <td style="border: 1px solid black;text-align:right;font-size:15px;font-weight: bold;">{{ Helper::Rupiah($grandtot) }}</td>
          </tr>
    </table>

</div>


</center>
<p><br></p>
<p><br></p>
<table class="table">
  <tr>
    <td width="70%" valign="top">  
      <strong>
      A/N PT SINERGI SUKSES LOGISTIK <br>
      MANDIRI CAB JAKARTA KETAPANG INDAH <br>
      A/C NO. 1150000787772 <br>
      </strong>
      
    </td>
    <td style="text-align:center;font-size:13px;font-weight: bold;" valign="top">

      Hormat kami, 
      <p><br></p>
      <p><br></p>

      ..........................

    </td>
  </tr>
</table>

</body>
</html>