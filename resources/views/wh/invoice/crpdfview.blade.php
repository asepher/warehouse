<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INV - {{ $inv }}</title>
    <style type="text/css">
    body{
            font-family: Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:14px;
            margin:0;
        }
    table {     
      width: 70%;
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

  </style>
</head>
<body>

  <center>


  <table>
      <tr>
        <td>  <img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/logo_ssl.png')); ?>" >
        </td>           
        <td width="40%" style="font-size:15px">
          <strong>PT. SINERGI SUKSES LOGISTIK </strong><br>
          Gajah Mada Tower Fl 19th #7 <br>
          Jl. Gajah Mada No. 19-26 , Jakarta 10130 - Indonesia <br>
          Phone : +62 21 63851866  Fax : +62 21 6338155 <br>
          mail@sinergisukseslogistik.com <br>
          www.sinergisukseslogistik.com         
        </td>
      </tr>
    </table>

    <table id="judul">
      <tr style="height: 25px">
        <td width="75%" style="border-right: 0.1px solid;font-size:17px;font-weight: bold;"><center><b>INVOICE</b></center> </td>
        <td style="font-size:17px;font-weight: bold;"><center><b>{{ Helper::FormatInvWh($inv) }}</b></center></td>
      </tr>
    </table>  
    <p></p>
 
    <table>
      <tr>
        <td style="width:20%">Date </td><td>:</td>
        <td>{{ Helper::TglIndo($tgl) }}</td>
      </tr>
      <tr>
        <td>Bill To </td><td>:</td>
        <td>{{ $manifest->cnee_name }}</td>
      </tr>
      <tr>
        <td>Address</td><td>:</td>
        <td>{{ $manifest->cnee_address }}</td>
      </tr>
      <tr>
        <td>NPWP</td><td>:</td>
        <td>{{ $manifest->cnee_npwp }}</td>
      </tr>
    </table>
    <hr>
  
    <table border="0">
      <tr>
        <td style="width:20%">HB/L No</td><td>:</td><td>{{ $manifest->hbl }}</td>
        <td>Quantity </td><td>:</td><td>{{ number_format($manifest->qty,0) }}</td>
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
        <td>Measure</td><td>:</td><td>{{ $manifest->measure }}</td>
      </tr>
      <tr>
        <td>ETA</td><td>:</td><td>{{ $manifest->eta }}</td>        
      </tr>
      <tr>
        <td valign="top">Description </td><td>:</td><td colspan="2">: 
          @php
            $value = Illuminate\Support\Str::limit($manifest->description, 50);
            echo nl2br($value);
          @endphp
      </tr>
    </table>
    <p></p>
  
<div 
  @if ($manifest->term == 'FOB')
    id="bg"
  @endif
  >

    <table id="item" style="width: 65%;">
      <thead>
        <tr style="height: 25px">
          <th style="border: 1px solid; width: 5%;">NO</th>
          <th style="border: 1px solid black;">ITEM</th>
          <th style="border:  1px solid black;width: 20%;">TARIF</th>
          <th style="border: 1px solid black;width: 10%;">W/M</th>
          <th style="border: 1px solid black;width: 20%;">TOTAL</th>
        </tr>
      </thead>
      <tbody>
        @php               
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
            <td style="border: 1px solid; text-align: center;">{{ Helper::Rupiah($dtl->tarif) }}</td>
            <td style="border: 1px solid; text-align: center;">{{ number_format($dtl->wm) }}</td>
            <td style="border: 1px solid;text-align: right;">{{ Helper::Rupiah($jumlah) }}</td>
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
          $totppn = $totsub * Helper::PPn() ;
          $tmptot = $totsub + $totppn ;
          $materai = 0;

          if ($tmptot > 5000000)
            $materai = Helper::Materai();

           $grandtot = $tmptot + $materai;
        @endphp
        <tr>
            <td colspan="4" style="text-align:right;font-size:17px;font-weight: bold;">Subtototal</td>
            <td style="border: 1px solid black;text-align:right;font-size:17px;font-weight: bold;">{{ Helper::Rupiah($totsub) }}</td>
          </tr>
          <tr>
            <td colspan="4" style="text-align:right;font-size:17px;font-weight: bold;">PPN</td>
            <td style="border: 1px solid black;text-align:right;font-size:17px;font-weight: bold;">{{ Helper::Rupiah($totppn) }}</td>
          </tr>
          <tr>
            <td colspan="4" style="text-align:right;font-size:17px;font-weight: bold;">Materai</td>
            <td style="border: 1px solid black;text-align:right;font-size:17px;font-weight: bold;">{{ Helper::Rupiah($materai) }}</td>
          </tr>
          <tr>
            <td colspan="4" style="text-align:right;font-size:17px;font-weight: bold;">Grand Total </td>
            <td style="border: 1px solid black;text-align:right;font-size:17px;font-weight: bold;">{{ Helper::Rupiah($grandtot) }}</td>
          </tr>
    </table>
 
 </div>

      <p></p>

      <table style="width:20%">
        <tr>
          <td>
          <a href="{{ route('wh.invoice.view',[$inv]) }}" type="button"> Back </a>                 
          </td>
          <td>
              <form action="{{ route('wh.invoice.crpdf',[$inv]) }}" method="post">  
            {{ csrf_field() }}
            <input type="hidden" name="tipe" value="CR">
            <input type="hidden" name="inv" value="{{$inv}}">
            <button type="submit" >Print PDF</button>
          </form>
            
          </td>

        </tr>        
      </table>

       <p><br></p>
</center>

</body>
</html>